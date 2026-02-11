<?php
require_once __DIR__ . '/../../config/constants.php';
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/AuditService.php';

class ExportService
{
    public static function storagePath(): string
    {
        $dir = __DIR__ . '/../../storage/exports';
        if (!is_dir($dir)) mkdir($dir, 0755, true);
        return $dir;
    }

    public static function saveAuditExport(array $entries, array $columns, string $format = 'csv', ?int $expiresDays = null, ?int $createdBy = null, ?string $note = null): array
    {
        $dir = self::storagePath();
        $date = date('Ymd_His');
        $fn = 'audit_export_' . $date . '.' . ($format === 'json' ? 'ndjson' : 'csv');
        $path = $dir . DIRECTORY_SEPARATOR . $fn;

        if ($format === 'csv') {
            $out = fopen($path, 'w');
            fputcsv($out, $columns, ',', '"', '\\');
            foreach ($entries as $e) {
                $line = [];
                foreach ($columns as $c) $line[] = $e[$c] ?? '';
                fputcsv($out, $line, ',', '"', '\\');
            }
            fclose($out);
        } else {
            $out = fopen($path, 'w');
            foreach ($entries as $e) {
                $row = [];
                foreach ($columns as $c) $row[$c] = $e[$c] ?? null;
                fwrite($out, json_encode($row, JSON_UNESCAPED_SLASHES) . "\n");
            }
            fclose($out);
        }

        $expires_at = null;
        if ($expiresDays) $expires_at = date('Y-m-d H:i:s', strtotime("+{$expiresDays} days"));

        // store record
        $pdo = Database::getPdo();
        $stmt = $pdo->prepare('INSERT INTO audit_exports (filename, path, created_by, created_at, expires_at, note) VALUES (?, ?, ?, NOW(), ?, ?)');
        $stmt->execute([$fn, $path, $createdBy, $expires_at, $note]);
        $id = (int)$pdo->lastInsertId();

        return ['id' => $id, 'filename' => $fn, 'path' => $path, 'expires_at' => $expires_at];
    }

    public static function uploadToS3(array $exportRecord): bool
    {
        $bucket = env('AWS_S3_BUCKET', null);
        if (!$bucket) return false;
        $path = $exportRecord['path'];
        if (!file_exists($path)) return false;

        // Prefer using AWS SDK if available
        if (class_exists('\\Aws\\S3\\S3Client')) {
            // require vendor autoload if not already
            if (!class_exists('\Composer\\Autoload\\ClassLoader') && file_exists(__DIR__ . '/../../vendor/autoload.php')) {
                require_once __DIR__ . '/../../vendor/autoload.php';
            }

            $region = env('AWS_REGION', env('AWS_DEFAULT_REGION', 'us-east-1'));
            $options = ['version' => 'latest', 'region' => $region];
            // credentials if provided
            $key = env('AWS_ACCESS_KEY_ID', null);
            $secret = env('AWS_SECRET_ACCESS_KEY', null);
            $token = env('AWS_SESSION_TOKEN', null);
            if ($key && $secret) {
                $options['credentials'] = ['key' => $key, 'secret' => $secret, 'token' => $token];
            }

            try {
                $s3 = new \Aws\S3\S3Client($options);
                $prefix = env('AWS_S3_PREFIX', '');
                $keyName = trim($prefix . '/' . basename($path), '/');
                $result = $s3->putObject([
                    'Bucket' => $bucket,
                    'Key' => $keyName,
                    'SourceFile' => $path,
                    'ACL' => 'private',
                ]);
                $s3url = 's3://' . $bucket . '/' . $keyName;
                $pdo = Database::getPdo();
                $pdo->prepare('UPDATE audit_exports SET path = ?, filename = ? WHERE id = ?')->execute([$s3url, basename($path), $exportRecord['id']]);
                if (env('AUDIT_EXPORT_REMOVE_LOCAL_AFTER_UPLOAD', 'false') === 'true') {
                    @unlink($path);
                }
                return true;
            } catch (Exception $e) {
                return false;
            }
        }

        // Fallback to AWS CLI
        $aws = env('AWS_CLI_PATH', 'aws');
        $prefix = env('AWS_S3_PREFIX', '');
        $key = trim($prefix . '/' . basename($path), '/');
        $cmd = escapeshellcmd($aws) . ' s3 cp ' . escapeshellarg($path) . ' s3://' . escapeshellarg($bucket . '/' . $key) . ' --acl private';
        exec($cmd, $out, $code);
        if ($code !== 0) return false;
        // update database path to s3 url
        $pdo = Database::getPdo();
        $s3url = 's3://' . $bucket . '/' . $key;
        $pdo->prepare('UPDATE audit_exports SET path = ?, filename = ? WHERE id = ?')->execute([$s3url, basename($path), $exportRecord['id']]);
        // optionally remove local file
        if (env('AUDIT_EXPORT_REMOVE_LOCAL_AFTER_UPLOAD', 'false') === 'true') {
            @unlink($path);
        }
        return true;
    }

    public static function cleanupExpired(int $days = 7): int
    {
        $pdo = Database::getPdo();
        $stmt = $pdo->prepare('SELECT id, path FROM audit_exports WHERE expires_at IS NOT NULL AND expires_at < ?');
        $cut = date('Y-m-d H:i:s', strtotime('-' . $days . ' days'));
        $stmt->execute([$cut]);
        $rows = $stmt->fetchAll();
        $deleted = 0;
        foreach ($rows as $r) {
            // if path is local file
            if (strpos($r['path'], 's3://') !== 0) {
                if (file_exists($r['path'])) @unlink($r['path']);
            } else {
                // try remove from s3 via aws cli if configured
                $aws = env('AWS_CLI_PATH', 'aws');
                $cmd = escapeshellcmd($aws) . ' s3 rm ' . escapeshellarg($r['path']);
                exec($cmd, $out, $code);
            }
            $pdo->prepare('DELETE FROM audit_exports WHERE id = ?')->execute([$r['id']]);
            $deleted++;
        }
        return $deleted;
    }

    public static function getS3Url(array $exportRecord): ?string
    {
        if (empty($exportRecord['path'])) return null;
        if (strpos($exportRecord['path'], 's3://') !== 0) {
            // local file
            return $exportRecord['path'];
        }

        $bucketAndKey = substr($exportRecord['path'], 5); // remove s3://
        $parts = explode('/', $bucketAndKey, 2);
        $bucket = $parts[0];
        $key = $parts[1] ?? '';

        // Use SDK to create presigned url if available
        if (class_exists('\Aws\S3\S3Client')) {
            if (!class_exists('\Composer\Autoload\ClassLoader') && file_exists(__DIR__ . '/../../vendor/autoload.php')) {
                require_once __DIR__ . '/../../vendor/autoload.php';
            }
            $region = env('AWS_REGION', env('AWS_DEFAULT_REGION', 'us-east-1'));
            $options = ['version' => 'latest', 'region' => $region];
            $keyId = env('AWS_ACCESS_KEY_ID', null);
            $secret = env('AWS_SECRET_ACCESS_KEY', null);
            if ($keyId && $secret) {
                $options['credentials'] = ['key' => $keyId, 'secret' => $secret];
            }
            try {
                $s3 = new \Aws\S3\S3Client($options);
                $cmd = $s3->getCommand('GetObject', ['Bucket' => $bucket, 'Key' => $key]);
                $req = $s3->createPresignedRequest($cmd, '+60 minutes');
                return (string)$req->getUri();
            } catch (\Exception $e) {
                return 's3://' . $bucket . '/' . $key;
            }
        }

        return 's3://' . $bucket . '/' . $key;
    }
}

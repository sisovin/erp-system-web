<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Audit Exports - Nexus ERP</title>
  <style>
    body{font-family:system-ui,Segoe UI,Roboto,Helvetica,Arial,sans-serif;background:#f8fafc;color:#111}
    .wrap{max-width:1000px;margin:2rem auto;padding:1rem}
    table{width:100%;border-collapse:collapse;background:#fff;border-radius:8px;overflow:hidden}
    th,td{padding:0.5rem;border-bottom:1px solid #eef2f7;text-align:left;font-size:13px}
    th{background:#f1f5f9}
    .meta{color:#6b7280;font-size:12px}
  </style>
</head>
<body>
  <div class="wrap">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1rem">
      <h1>Audit Exports</h1>
      <div>
        Hello, <strong><?php echo htmlentities($user->name); ?></strong>
        &nbsp;|&nbsp; <a href="/admin">Dashboard</a>
      </div>
    </div>

    <table>
      <thead>
        <tr><th>ID</th><th>Filename</th><th>Path</th><th>Created At</th><th>Expires At</th><th>Note</th><th>Actions</th></tr>
      </thead>
      <tbody>
        <?php foreach ($rows as $r): ?>
          <tr>
            <td><?php echo htmlentities($r['id']); ?></td>
            <td><?php echo htmlentities($r['filename']); ?></td>
            <td><?php echo htmlentities($r['path']); ?></td>
            <td class="meta"><?php echo htmlentities($r['created_at']); ?></td>
            <td class="meta"><?php echo htmlentities($r['expires_at'] ?? ''); ?></td>
            <td><?php echo htmlentities($r['note'] ?? ''); ?></td>
            <td>
              <?php if (strpos($r['path'], 's3://') === 0): ?>
                <a href="/admin/exports/download?id=<?php echo $r['id']; ?>">Download (presign)</a>
              <?php else: ?>
                <a href="/admin/exports/download?id=<?php echo $r['id']; ?>">Download</a>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
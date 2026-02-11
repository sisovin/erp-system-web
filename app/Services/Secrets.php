<?php
namespace app\Services;

class Secrets
{
    public static function encrypt(string $plaintext): string
    {
        $key = env('APP_KEY', null);
        if (empty($key)) throw new \RuntimeException('APP_KEY not set');
        $keybin = hash('sha256', $key, true);
        $iv = random_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $ct = openssl_encrypt($plaintext, 'aes-256-cbc', $keybin, OPENSSL_RAW_DATA, $iv);
        return base64_encode($iv . $ct);
    }

    public static function decrypt(string $ciphertext): string
    {
        $key = env('APP_KEY', null);
        if (empty($key)) throw new \RuntimeException('APP_KEY not set');
        $keybin = hash('sha256', $key, true);
        $raw = base64_decode($ciphertext);
        $ivlen = openssl_cipher_iv_length('aes-256-cbc');
        $iv = substr($raw, 0, $ivlen);
        $ct = substr($raw, $ivlen);
        $pt = openssl_decrypt($ct, 'aes-256-cbc', $keybin, OPENSSL_RAW_DATA, $iv);
        return $pt === false ? '' : $pt;
    }
}

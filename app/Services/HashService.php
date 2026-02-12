<?php
/**
 * HashService
 * 
 * Provides secure password hashing and verification using Argon2id
 * with configurable parameters for optimal security.
 */

class HashService
{
    /**
     * Argon2id hashing options
     */
    private static $options = [
        'memory_cost' => 65536,  // 64 MB
        'time_cost' => 4,         // 4 iterations
        'threads' => 2            // 2 threads
    ];

    /**
     * Hash a password using Argon2id
     * 
     * @param string $password The plain text password
     * @param array|null $options Custom hashing options (optional)
     * @return string The hashed password
     */
    public static function make(string $password, ?array $options = null): string
    {
        $hashOptions = $options ?? self::$options;
        
        return password_hash($password, PASSWORD_ARGON2ID, $hashOptions);
    }

    /**
     * Verify a password against a hash
     * 
     * @param string $password The plain text password
     * @param string $hash The hashed password
     * @return bool True if password matches, false otherwise
     */
    public static function verify(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }

    /**
     * Check if a hash needs to be rehashed
     * 
     * @param string $hash The hashed password  
     * @param array|null $options Custom hashing options (optional)
     * @return bool True if hash needs rehashing, false otherwise
     */
    public static function needsRehash(string $hash, ?array $options = null): bool
    {
        $hashOptions = $options ?? self::$options;
        
        return password_needs_rehash($hash, PASSWORD_ARGON2ID, $hashOptions);
    }

    /**
     * Get hash information
     * 
     * @param string $hash The hashed password
     * @return array Hash information
     */
    public static function info(string $hash): array
    {
        return password_get_info($hash);
    }

    /**
     * Generate a secure random salt
     * 
     * @param int $length The length of the salt (default: 32)
     * @return string The generated salt
     */
    public static function generateSalt(int $length = 32): string
    {
        return bin2hex(random_bytes($length));
    }

    /**
     * Hash data using SHA-256
     * 
     * @param string $data The data to hash
     * @param bool $rawOutput Return raw binary data (default: false)
     * @return string The hashed data
     */
    public static function sha256(string $data, bool $rawOutput = false): string
    {
        return hash('sha256', $data, $rawOutput);
    }

    /**
     * Hash data using HMAC SHA-256
     * 
     * @param string $data The data to hash
     * @param string $key The secret key
     * @param bool $rawOutput Return raw binary data (default: false)
     * @return string The HMAC hash
     */
    public static function hmac(string $data, string $key, bool $rawOutput = false): string
    {
        return hash_hmac('sha256', $data, $key, $rawOutput);
    }

    /**
     * Generate a secure random token
     * 
     * @param int $length The length in bytes (default: 32)
     * @return string The generated token (hex encoded)
     */
    public static function randomToken(int $length = 32): string
    {
        return bin2hex(random_bytes($length));
    }

    /**
     * Constant-time string comparison to prevent timing attacks
     * 
     * @param string $known The known string
     * @param string $user The user-provided string
     * @return bool True if strings match, false otherwise
     */
    public static function equals(string $known, string $user): bool
    {
        return hash_equals($known, $user);
    }
}

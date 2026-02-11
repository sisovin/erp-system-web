<?php
/**
 * Basic User repository using PDO
 */
require_once __DIR__ . '/../Services/Database.php';
require_once __DIR__ . '/../Models/User.php';

class UserRepository
{
    protected PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getPdo();
    }

    public function findByEmail(string $email): ?User
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE email = ? LIMIT 1');
        $stmt->execute([$email]);
        $row = $stmt->fetch();
        return $row ? User::fromArray($row) : null;
    }

    public function findById(int $id): ?User
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE id = ? LIMIT 1');
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ? User::fromArray($row) : null;
    }

    public function create(array $data): ?User
    {
        $now = date('Y-m-d H:i:s');
        $stmt = $this->pdo->prepare('INSERT INTO users (name,email,password,created_at,updated_at) VALUES (?,?,?,?,?)');
        $stmt->execute([
            $data['name'] ?? null,
            $data['email'] ?? null,
            $data['password'] ?? null,
            $now,
            $now,
        ]);
        $id = (int) $this->pdo->lastInsertId();
        return $id ? $this->findById($id) : null;
    }

    public function listAll(int $limit = 100, int $offset = 0): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users ORDER BY id ASC LIMIT ? OFFSET ?');
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->bindValue(2, $offset, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        $ret = [];
        foreach ($rows as $row) {
            $ret[] = User::fromArray($row);
        }
        return $ret;
    }
}

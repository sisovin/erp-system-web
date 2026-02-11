<?php
require_once __DIR__ . '/../Repositories/UserRepository.php';
require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Core/Auth.php';

class AuthController
{
    protected UserRepository $repo;

    public function __construct()
    {
        $this->repo = new UserRepository();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function showLogin(array $params = [])
    {
        // prefer flash message if present
        $error = flash_get('error') ?? $params['error'] ?? null;
        include __DIR__ . '/../../resources/views/auth/login.php';
    }

    public function handleLogin()
    {
        // At this point CSRF should already be enforced globally by the router bootstrapping
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $this->repo->findByEmail($email);
        if (!$user) {
            flash_set('error', 'Invalid credentials');
            header('Location: /login');
            exit;
        }

        if (!password_verify($password, $user->password)) {
            flash_set('error', 'Invalid credentials');
            header('Location: /login');
            exit;
        }

        // login success
        $_SESSION['user_id'] = $user->id;
        header('Location: /admin');
        exit;
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        unset($_SESSION['user_id']);
        session_regenerate_id(true);
        header('Location: /login');
        exit;
    }
}

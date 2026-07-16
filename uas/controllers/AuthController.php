<?php
class AuthController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function index() {
        if (isLoggedIn()) {
            redirect('?page=dashboard');
        }
        include __DIR__ . '/../views/auth/login.php';
    }

    public function authenticate() {
        if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
            setFlashMessage('error', 'Invalid session token');
            redirect('?page=login');
        }
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($username) || empty($password)) {
            setFlashMessage('error', 'Username dan password wajib diisi');
            redirect('?page=login');
        }

        if (login($this->conn, $username, $password)) {
            redirect('?page=dashboard');
        } else {
            setFlashMessage('error', 'Username atau password salah');
            redirect('?page=login');
        }
    }
}

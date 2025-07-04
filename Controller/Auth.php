<?php
require_once './Model/user_model.php';

class Auth
{
    private $model;

    public function __construct()
    {
        $this->model = new user_model();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'role' => $_POST['role'],
                'availability_time' => $_POST['availability_time'] ?? null
            ];
            $result = $this->model->register($data);
            if ($result) {
                echo "<script>alert('Registrasi berhasil');window.location='?action=login';</script>";
            } else {
                echo "<script>alert('Registrasi gagal');</script>";
            }
        }

        include './View/Auth/register.php';
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $this->model->login($_POST['username']);
            if ($user && password_verify($_POST['password'], $user['password'])) {
                $_SESSION['user'] = $user;
                if ($user['role'] === 'admin') {
                    header('Location: ./index.php?action=area');
                } else {
                    header('Location: ./index.php?action=jadwal-terbuka');
                }
                exit;
            } else {
                echo "<script>alert('Username atau Password salah');</script>";
            }
        }

        include './View/Auth/login.php';
    }

    public function logout()
    {
        session_destroy();
        header('Location: ?action=login');
    }
}

<?php
require_once './Model/history_model.php';

class HistoryController
{
    private $model;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $this->model = new History();
    }

    // Admin: Lihat semua riwayat
    public function index()
    {
        $riwayats = $this->model->getAll();
        include './View/History/index.php';
    }

    // Karyawan: Lihat riwayat sendiri
    public function riwayatSaya()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?action=login");
            exit;
        }

        $user_id = $_SESSION['user']['id'];
        $riwayats = $this->model->getByUser($user_id);
        include './View/History/user.php';
    }
}

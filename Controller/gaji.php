<?php
require_once './Model/gaji_model.php';

class GajiCotroller
{
    private $model;

    public function __construct()
    {
        $this->model = new Gaji();
    }

    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        if ($_SESSION['user']['role'] !== 'karyawan') {
            header("Location: index.php?action=login");
            exit;
        }

        $userId = $_SESSION['user']['id'];
        $gajiModel = new Gaji();
        $gajis = $gajiModel->getGajiByUser($userId);

        require './View/Gaji/index.php';
    }
}

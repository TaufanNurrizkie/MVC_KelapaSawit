<?php
require_once './Model/karyawan_model.php';

class Karyawan
{
    private $model;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $this->model = new karyawan_model();
    }

    public function index()
    {
        $admins = $this->model->getAllAdmins();
        $karyawans = $this->model->getAllKaryawans();
        include './View/karyawan/index.php';
    }
}

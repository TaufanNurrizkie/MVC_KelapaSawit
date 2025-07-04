<?php
require_once './Model/jadwal_model.php';

class JadwalKerja
{
    private $model;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $this->model = new jadwal_kerja();
    }

    public function index()
    {
        $jadwals = $this->model->getAll();
        include './View/Jadwal_Kerja/index.php';
    }

    public function create()
    {
        $areas = $this->model->getAllAreas();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'area_id' => $_POST['area_id'],
                'start_day' => $_POST['start_day'],
                'finish_day' => $_POST['finish_day'],
                'is_published' => isset($_POST['is_published']) ? 1 : 0,
                'description' => $_POST['description'],
                'status' => $_POST['status']
            ];
            $this->model->create($data);
            header("Location: index.php?action=jadwal");
            exit;
        }

        include './View/Jadwal_Kerja/create.php';
    }

    public function edit($id)
    {
        $areas = $this->model->getAllAreas();
        $jadwal = $this->model->findById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id' => $id,
                'area_id' => $_POST['area_id'],
                'start_day' => $_POST['start_day'],
                'finish_day' => $_POST['finish_day'],
                'is_published' => isset($_POST['is_published']) ? 1 : 0,
                'description' => $_POST['description'],
                'status' => $_POST['status']
            ];
            $this->model->update($data);
            header("Location: index.php?action=jadwal");
            exit;
        }

        include './View/Jadwal_Kerja/edit.php';
    }

    public function delete($id)
    {
        $this->model->delete($id);
        header("Location: index.php?action=jadwal");
        exit;
    }

    public function daftarUntukKaryawan()
{
    $jadwalTersedia = $this->model->getPublished();
    include './View/Jadwal_Kerja/available.php';
}

}

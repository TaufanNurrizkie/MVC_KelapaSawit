<?php
require_once './Model/seleksi_penempatan.php';
require_once './Model/tugas_kerja.php'; // untuk memasukkan ke work_schedules

class SeleksiPenempatan
{
    private $model;
    private $workModel;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $this->model = new seleksi_penempatan();
        $this->workModel = new tugas_kerja();
    }

    // Admin: lihat semua pengajuan
    public function index()
    {
        $pengajuan = $this->model->getAllApplications();
        include './View/Seleksi_Penempatan/index.php';
    }

    // Admin: update status (terima/tolak)
    public function updateStatus($id, $status)
    {
        $app = $this->model->findById($id);
        if (!$app) return;

        $this->model->updateStatus($id, $status);

        // Jika accepted, masukkan ke work_schedules
        if ($status === 'accepted') {
            $this->workModel->assign([
                'schedule_id' => $app['schedule_id'],
                'employee_id' => $app['user_id'],
                'status' => 'diterima',
                'choice_of_role' => 'Belum ditentukan'
            ]);
        }

        header('Location: index.php?action=seleksi');
        exit;
    }

    // Karyawan: ajukan diri
    public function apply($schedule_id)
    {
        $user_id = $_SESSION['user']['id'] ?? null;
        if ($user_id) {
            $this->model->apply($user_id, $schedule_id);
        }
        header('Location: index.php?action=jadwal');
        exit;
    }
}

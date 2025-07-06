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
        $this->model->tandaiSelesaiOtomatis();
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
        $deleted = $this->model->delete($id);

        if (!$deleted) {
            echo "<script>alert('❗ Jadwal kerja tidak dapat dihapus karena sudah ada pengajuan dari karyawan.'); window.location='index.php?action=jadwal';</script>";
            return;
        }

        header("Location: index.php?action=jadwal");
        exit;
    }


    public function daftarUntukKaryawan()
    {
        $jadwalTersedia = $this->model->getPublished();

        // Ambil semua schedule_id yang sudah diajukan user
        $seleksiModel = new seleksi_penempatan();
        $user_id = $_SESSION['user']['id'];
        $appliedRows = $seleksiModel->getAppliedScheduleIds($user_id);

        // Ubah ke array of integers
        $appliedIds = array_map(
            fn($row) => (int)$row['schedule_id'],
            $appliedRows
        );

        include './View/Jadwal_Kerja/available.php';
    }


    public function apply()
    {
        $scheduleId = $_GET['schedule_id'] ?? null;
        $userId = $_SESSION['user']['id'] ?? null;

        if (!$scheduleId || !$userId) {
            header("Location: index.php?action=jadwal-terbuka");
            exit;
        }

        // cek apakah user sudah apply sebelumnya
        if ($this->model->hasUserApplied($scheduleId, $userId)) {
            // redirect kembali supaya tidak double apply
            header("Location: index.php?action=jadwal-terbuka&info=already_applied");
            exit;
        }

        // simpan apply
        $this->model->applyUser($scheduleId, $userId);

        header("Location: index.php?action=jadwal-terbuka&info=success");
        exit;
    }

    public function arsipkanJadwalSelesai()
    {
        require_once './Model/history_model.php';
        require_once './Model/tugas_kerja.php';
        require_once './Model/absensi_model.php';
        require_once './Model/role_model.php';

        $history = new History();
        $tugas = new tugas_kerja();
        $absen = new Absensi();
        $role = new Role();

        $selesai = $this->model->getSelesaiSchedules();

        foreach ($selesai as $jadwal) {
            $peserta = $tugas->getByScheduleId($jadwal['id']);

            foreach ($peserta as $p) {
                $hadir = $absen->hitungHadir($p['id']);
                $gaji = $role->getByName($p['choice_of_role']);
                $gajiHarian = $gaji ? $gaji['daily_wage'] : 0;

                $data = [
                    'user_id' => $p['employee_id'],
                    'schedule_id' => $jadwal['id'],
                    'absensi' => $hadir,
                    'notes' => $jadwal['description'],
                    'salary' => $hadir * $gajiHarian
                ];

                $history->simpanRiwayat($data);
            }

            // Opsional: tandai sudah diproses atau hapus
            // $this->model->delete($jadwal['id']); 
            // atau update status:
            // $this->model->markArchived($jadwal['id']);
        }

        echo "<script>alert('Berhasil memindahkan semua jadwal selesai ke riwayat.'); window.location='index.php?action=riwayat';</script>";
    }
}

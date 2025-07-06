<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once './Controller/Auth.php';
require_once './Controller/areaKerja.php';
require_once './Controller/jadwalKerja.php';
require_once './Controller/tugasKerja.php';
require_once './Controller/seleksiPenempatan.php';
require_once './Controller/karyawan.php';
require_once './Controller/User.php';
require_once './Controller/absensi.php';
require_once './Controller/gaji.php'; 

$karyawan = new Karyawan();
$seleksi = new SeleksiPenempatan();
$tugas = new TugasKerja();
$jadwal = new JadwalKerja();
$auth = new Auth();
$area = new AreaKerja();
$user = new UserController();
$absensi = new Absensi();
$gaji = new GajiCotroller();

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'login':
            $auth->login();
            break;
        case 'register':
            $auth->register();
            break;
        case 'logout':
            $auth->logout();
            break;

        // Area kerja
        case 'area':
            $area->index();
            break;
        case 'area-create':
            $area->create();
            break;
        case 'area-edit':
            $area->edit($_GET['id']);
            break;
        case 'area-delete':
            $area->delete($_GET['id']);
            break;

        // Jadwal kerja
        case 'jadwal':
            $jadwal->index();
            break;
        case 'jadwal-create':
            $jadwal->create();
            break;
        case 'jadwal-edit':
            $jadwal->edit($_GET['id']);
            break;
        case 'jadwal-delete':
            $jadwal->delete($_GET['id']);
            break;

        // Tugas kerja
        case 'tugas':
            $tugas->index();
            break;
        case 'tugas-create':
            $tugas->create();
            break;

        // Seleksi tugas
        case 'seleksi':
            $seleksi->index();
            break;
        case 'seleksi-accept':
            $seleksi->updateStatus($_GET['id'], 'accepted');
            break;
        case 'seleksi-reject':
            $seleksi->updateStatus($_GET['id'], 'rejected');
            break;
        case 'apply':
            $seleksi->apply($_GET['schedule_id']);
            break;
        case 'pengajuan-saya':
            $seleksi->pengajuanSaya();
            break;

        // Jadwal saya (karyawan)
        case 'jadwal-saya':
            $tugas->jadwalSaya();
            break;
        case 'jadwal-terbuka':
            $jadwal->daftarUntukKaryawan();
            break;
        case 'apply-karyawan':
            $jadwal->apply();
            break;

        // Absensi
        case 'absensi-checkin-form':
            $absensi->formCheckIn();
            break;
        case 'absensi-checkin-process':
            $absensi->processCheckIn();
            break;
        case 'absensi-checkout-form':
            $absensi->formCheckOut();
            break;
        case 'absensi-checkout-process':
            $absensi->processCheckOut();
            break;

        // Karyawan (admin)
        case 'karyawan':
            $karyawan->index();
            break;

        // Profil
        case 'profile':
            $user->index();
            break;
        case 'update-profile':
            $user->updateProfile();
            break;

        case 'gaji':
            $gaji->index();
            break;

        default:
            echo "<h3 style='color:red'>❌ Aksi tidak dikenali!</h3>";
    }
} else {
    $auth->login();
}

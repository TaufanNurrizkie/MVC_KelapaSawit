<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once './Controller/Auth.php';
require_once './Controller/areaKerja.php';
require_once './Controller/jadwalKerja.php';
require_once './Controller/tugasKerja.php';
require_once './Controller/seleksiPenempatan.php';
require_once './Controller/karyawan.php';

$karyawan = new Karyawan();
$seleksi = new SeleksiPenempatan();
$tugas = new TugasKerja();
$jadwal = new JadwalKerja();
$auth = new Auth();
$area = new AreaKerja();

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        // === AUTH ROUTES ===
        case 'login':
            $auth->login();
            break;
        case 'register':
            $auth->register();
            break;
        case 'logout':
            $auth->logout();
            break;

        // === AREA KERJA ROUTES ===
        case 'area':
            $area->index();
            break;
        case 'area-create':
            $area->create();
            break;
        case 'area-edit':
            $area = new AreaKerja();
            $area->edit($_GET['id']);
            break;
        case 'area-delete':
            $area = new AreaKerja();
            $area->delete($_GET['id']);
            break;

        // === JADWAL KERJA ROUTES ===
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

        // === TUGAS KERJA ROUTES ===
        case 'tugas':
            $tugas->index();
            break;
        case 'tugas-create':
            $tugas->create();
            break;

        // === Seleksi tugas ===
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

        // === Jadwal Saya (karyawan)===
        case 'jadwal-saya':
            $tugas->jadwalSaya();
            break;
        case 'jadwal-terbuka':
            $jadwal->daftarUntukKaryawan();
            break;

        // ===  Karyawan (admin) ===  
        case 'karyawan':
            $karyawan->index();
            break;

        // === DEFAULT: Aksi tidak dikenali ===
        default:
            echo "<h3 style='color: red'>❌ Aksi tidak dikenali!</h3>";
    }
} else {
    // DEFAULT: Arahkan ke login
    $auth->login();
}

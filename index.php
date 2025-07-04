<?php
require_once './Controller/Auth.php';
require_once './Controller/areaKerja.php';

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


        // === DEFAULT: Aksi tidak dikenali ===
        default:
            echo "<h3 style='color: red'>❌ Aksi tidak dikenali!</h3>";
    }
} else {
    // DEFAULT: Arahkan ke login
    $auth->login();
}

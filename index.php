<?php
require_once './Controller/Auth.php';

$auth = new Auth();

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
        default:
            echo "Aksi tidak dikenali.";
    }
} else {
    $auth->login(); // default ke login
}

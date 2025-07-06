<?php
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: index.php?action=login');
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Manajemen Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper d-flex">
        <?php include __DIR__ . '../../Template/sidebarAdmin.php'; ?>

        <main class="p-4 w-100">
            <h3 class="mb-3">➕ Tambah Role Pekerjaan</h3>



            <!-- ADMIN TABLE -->
            <h5 class="mb-3">📋 Daftar Admin</h5>
            <form method="POST">
                <input type="text" name="name" class="form-control mb-2" placeholder="Nama Role" required>
                <input type="number" name="daily_wage" class="form-control mb-2" placeholder="Gaji per Hari" required>
                <button class="btn btn-success">Simpan</button>
                <a href="?action=role" class="btn btn-secondary">Kembali</a>
            </form>
        </main>
    </div>
</body>

</html>
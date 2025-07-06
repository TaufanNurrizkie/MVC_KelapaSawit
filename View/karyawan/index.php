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
        <h3 class="mb-4">👤 Manajemen Data User</h3>

        <a href="index.php?action=karyawan-create" class="btn btn-success mb-4">➕ Tambah Pengguna Baru</a>

        <!-- ADMIN TABLE -->
        <h5 class="mb-3">📋 Daftar Admin</h5>
        <table class="table table-bordered">
            <thead class="table-secondary">
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($admins): ?>
                    <?php $no = 1; foreach ($admins as $a): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($a['name']) ?></td>
                            <td><?= $a['username'] ?></td>
                            <td><?= $a['email'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="4" class="text-muted text-center">Tidak ada admin.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- KARYAWAN TABLE -->
        <h5 class="">👷‍♂️ Daftar Karyawan</h5>
        <table class="table table-bordered">
            <thead class="table-success">
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Waktu Tersedia</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($karyawans): ?>
                    <?php $no = 1; foreach ($karyawans as $k): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($k['name']) ?></td>
                            <td><?= $k['username'] ?></td>
                            <td><?= $k['email'] ?></td>
                            <td><?= $k['availability_time'] ?: '-' ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5" class="text-muted text-center">Tidak ada karyawan.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</div>
</body>
</html>

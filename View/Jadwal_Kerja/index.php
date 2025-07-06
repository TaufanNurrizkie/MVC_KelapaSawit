<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: index.php?action=login');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Daftar Jadwal Kerja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="wrapper d-flex">
    <?php include __DIR__ . '../../Template/sidebarAdmin.php'; ?>

    <main class="p-4 w-100">
        <h3 class="mb-4">📅 Daftar Jadwal Kerja</h3>
        <a href="index.php?action=jadwal-create" class="btn btn-success mb-3">➕ Tambah Jadwal</a>

        <table class="table table-bordered">
            <thead class="table-success">
                <tr>
                    <th>#</th>
                    <th>Area</th>
                    <th>Mulai</th>
                    <th>Selesai</th>
                    <th>Status</th>
                    <th>Terbit</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($jadwals)): ?>
                    <?php $no = 1; foreach ($jadwals as $j): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $j['area_name'] ?></td>
                            <td><?= $j['start_day'] ?></td>
                            <td><?= $j['finish_day'] ?></td>
                            <td><?= $j['status'] ?></td>
                            <td><?= $j['is_published'] ? '✅' : '❌' ?></td>
                            <td><?= $j['description'] ?></td>
                            <td>
                                <a href="index.php?action=jadwal-edit&id=<?= $j['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="index.php?action=jadwal-delete&id=<?= $j['id'] ?>" class="btn btn-danger btn-sm"
                                   onclick="return confirm('Yakin ingin menghapus jadwal ini?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="8" class="text-center text-muted">Belum ada jadwal.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</div>
</body>
</html>

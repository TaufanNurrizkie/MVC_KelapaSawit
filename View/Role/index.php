<?php
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: index.php?action=login');
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Manajemen Role</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper d-flex">
        <?php include __DIR__ . '../../Template/sidebarAdmin.php'; ?>

        <main class="p-4 w-100">
            <h3 class="mb-4">Daftar Role Pekerjaan</h3>

            <a href="?action=role-create" class="btn btn-primary mb-3">+ Tambah Role</a>

            <!-- ADMIN TABLE -->
            <h5 class="mb-3">📋 Daftar Admin</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Role</th>
                        <th>Gaji per Hari</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($roles as $r): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $r['name'] ?></td>
                            <td>Rp <?= number_format($r['daily_wage']) ?></td>
                            <td>
                                <a href="?action=role-delete&id=<?= $r['id'] ?>" class="btn btn-sm btn-danger">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>

</html>




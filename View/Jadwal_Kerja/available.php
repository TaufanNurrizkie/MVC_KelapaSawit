<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if ($_SESSION['user']['role'] !== 'karyawan') {
    header("Location: index.php?action=login");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Jadwal Terbuka</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="wrapper d-flex">
    <?php include __DIR__ . '../../Template/sidebarKaryawan.php'; ?>

    <main class="p-4 w-100">
        <h3 class="mb-4">📢 Jadwal Kerja yang Tersedia</h3>
        <table class="table table-bordered">
            <thead class="table-success">
                <tr>
                    <th>#</th>
                    <th>Area</th>
                    <th>Deskripsi</th>
                    <th>Mulai</th>
                    <th>Selesai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($jadwalTersedia as $j): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $j['area_name'] ?></td>
                        <td><?= $j['description'] ?></td>
                        <td><?= $j['start_day'] ?></td>
                        <td><?= $j['finish_day'] ?></td>
                        <td>
                            <a href="index.php?action=apply&schedule_id=<?= $j['id'] ?>" class="btn btn-primary btn-sm">Ajukan Diri</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</div>
</body>
</html>

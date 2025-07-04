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
    <title>Jadwal Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="wrapper d-flex">


    <main class="p-4 w-100">
        <h3 class="mb-4">📅 Jadwal Kerja Saya</h3>

        <table class="table table-bordered">
            <thead class="table-success">
                <tr>
                    <th>#</th>
                    <th>Area</th>
                    <th>Deskripsi</th>
                    <th>Peran</th>
                    <th>Status</th>
                    <th>Mulai</th>
                    <th>Selesai</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($jadwalsaya)): ?>
                    <?php $no = 1; foreach ($jadwalsaya as $j): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $j['area_name'] ?></td>
                            <td><?= $j['description'] ?></td>
                            <td><?= $j['choice_of_role'] ?></td>
                            <td><?= $j['status'] ?></td>
                            <td><?= $j['start_day'] ?></td>
                            <td><?= $j['finish_day'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="7" class="text-center text-muted">Belum ada jadwal kerja.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</div>
</body>
</html>

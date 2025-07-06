<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="wrapper d-flex">
    <?php include __DIR__ . '../../Template/sidebarKaryawan.php'; ?>

    <main class="p-4 w-100">
        <h3 class="mb-4">📌 Riwayat Kerja Saya</h3>
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Jadwal</th>
                    <th>Absensi</th>
                    <th>Catatan</th>
                    <th>Gaji</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($riwayats as $r): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $r['schedule_desc'] ?></td>
                    <td><?= $r['absensi'] ?></td>
                    <td><?= $r['notes'] ?></td>
                    <td>Rp <?= number_format($r['salary']) ?></td>
                    <td><?= $r['created_at'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</div>
</body>
</html>

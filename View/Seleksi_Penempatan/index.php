<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Seleksi Pengajuan Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper d-flex">
        <?php include __DIR__ . '../../Template/sidebarAdmin.php'; ?>

        <main class="p-4 w-100">
            <h3 class="mb-4">📥 Daftar Pengajuan Karyawan</h3>
            <table class="table table-bordered">
                <thead class="table-success">
                    <tr>
                        <th>#</th>
                        <th>Nama Karyawan</th>
                        <th>Jadwal</th>
                        <th>Status</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($pengajuan as $p): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $p['user_name'] ?></td>
                            <td><?= $p['schedule_desc'] ?></td>
                            <td>
                                <?php
                                if ($p['status'] === 'pending') echo '<span class="badge bg-warning text-dark">Pending</span>';
                                elseif ($p['status'] === 'accepted') echo '<span class="badge bg-success">Diterima</span>';
                                else echo '<span class="badge bg-danger">Ditolak</span>';
                                ?>
                            </td>
                            <td><?= $p['created_at'] ?></td>
                            <td>
                                <?php if ($p['status'] === 'pending'): ?>
                                    <a href="index.php?action=seleksi-assign&id=<?= $p['id'] ?>" class="btn btn-sm btn-success">Terima</a>
                                    <a href="index.php?action=seleksi-reject&id=<?= $p['id'] ?>" class="btn btn-sm btn-danger">Tolak</a>
                                <?php else: ?>
                                    <em class="text-muted">Selesai</em>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </main>
    </div>
</body>

</html>
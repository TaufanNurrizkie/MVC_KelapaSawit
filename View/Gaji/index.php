<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Manajemen Gaji</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper d-flex">
        <?php include __DIR__ . '../../Template/sidebarAdmin.php'; ?>

        <main class="p-4 w-100">
            <h3 class="mb-4">💰 Manajemen Penggajian</h3>

            <div class="mb-3">
                <a href="index.php?action=gaji-generate-all" class="btn btn-success mb-3">Generate Otomatis</a>
            </div>

            <table class="table table-bordered table-hover">
                <thead class="table-success">
                    <tr>
                        <th>#</th>
                        <th>Nama Karyawan</th>
                        <th>Role</th>
                        <th>Hari Kerja</th>
                        <th>Upah / Hari</th>
                        <th>Total</th>
                        <th>Diminta</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($gaji) && is_array($gaji)): ?>
                        <?php $no = 1;
                        foreach ($gaji as $g): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $g['user_name'] ?></td>
                                <td><?= $g['role_name'] ?></td>
                                <td><?= $g['days_worked'] ?> hari</td>
                                <td>Rp <?= number_format($g['daily_wage']) ?></td>
                                <td>Rp <?= number_format($g['total_wage']) ?></td>
                                <td>
                                    <?= $g['requested_by_employee'] ? '<span class="badge bg-info">Diminta</span>' : '<span class="badge bg-secondary">-</span>' ?>
                                </td>
                                <td>
                                    <?= $g['is_paid'] ? '<span class="badge bg-success">Dibayar</span>' : '<span class="badge bg-warning text-dark">Belum</span>' ?>
                                </td>
                                <td>
                                    <?php if (!$g['is_paid']): ?>
                                        <a href="index.php?action=gaji-bayar&id=<?= $g['id'] ?>" class="btn btn-sm btn-success">Tandai Dibayar</a>
                                    <?php else: ?>
                                        <em class="text-muted">✓</em>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center text-muted">Belum ada data gaji.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>

</html>
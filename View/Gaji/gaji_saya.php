<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rincian Gaji Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="wrapper d-flex">
    <?php include __DIR__ . '../../Template/sidebarKaryawan.php'; ?>

    <main class="p-4 w-100">
        <h3 class="mb-4">💼 Rincian Gaji Saya</h3>

        <table class="table table-bordered table-hover">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Role</th>
                    <th>Hari Kerja</th>
                    <th>Upah / Hari</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($gajiSaya) && is_array($gajiSaya)): ?>
                    <?php $no = 1; foreach ($gajiSaya as $g): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $g['role_name'] ?></td>
                            <td><?= $g['days_worked'] ?> hari</td>
                            <td>Rp <?= number_format($g['daily_wage']) ?></td>
                            <td><strong>Rp <?= number_format($g['total_wage']) ?></strong></td>
                            <td>
                                <?php
                                    if ($g['is_paid']) echo '<span class="badge bg-success">Sudah Dibayar</span>';
                                    elseif ($g['requested_by_employee']) echo '<span class="badge bg-info">Menunggu Pencairan</span>';
                                    else echo '<span class="badge bg-secondary">Belum Diminta</span>';
                                ?>
                            </td>
                            <td>
                                <?php if (!$g['is_paid'] && !$g['requested_by_employee']): ?>
                                    <a href="index.php?action=gaji-tarik&id=<?= $g['id'] ?>" class="btn btn-sm btn-warning">Ajukan Penarikan</a>
                                <?php elseif ($g['is_paid']): ?>
                                    <em class="text-muted">✓</em>
                                <?php else: ?>
                                    <em class="text-muted">Diproses</em>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="7" class="text-center text-muted">Belum ada data gaji.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</div>
</body>
</html>

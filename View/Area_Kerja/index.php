<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../../index.php?action=login');
    exit;
}
?>




<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include __DIR__ . '../../Template/sidebarAdmin.php'; ?>


        <!-- Main Content -->
        <main>
            <h3 class="mb-4">📋 Daftar Area Kerja</h3>

            <a href="index.php?action=area-create" class="btn btn-success mb-3">➕ Tambah Area</a>

            <table class="table table-bordered">
                <thead class="table-success">
                    <tr>
                        <th>#</th>
                        <th>Nama Area</th>
                        <th>Ukuran</th>
                        <th>Jumlah Pohon</th>
                        <th>Jenis Tanah</th>
                        <th>Aksi</th> <!-- Tambahan kolom aksi -->
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($areas) && is_array($areas)): ?>
                        <?php $no = 1;
                        foreach ($areas as $a): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $a['name'] ?></td>
                                <td><?= $a['size'] ?> hektar</td>
                                <td><?= $a['quantity_of_trees'] ?></td>
                                <td><?= $a['type_of_soil'] ?></td>
                                <td>
                                    <a href="index.php?action=area-edit&id=<?= $a['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="index.php?action=area-delete&id=<?= $a['id'] ?>" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus area ini?');">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada data area kerja.</td>
                        </tr>
                    <?php endif; ?>

                </tbody>
            </table>
        </main>
    </div>
</body>

</html>
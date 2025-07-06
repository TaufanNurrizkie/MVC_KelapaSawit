<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if ($_SESSION['user']['role'] !== 'karyawan') {
    header("Location: index.php?action=login");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Status Pengajuan</title> <!-- UBAH JUDUL -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #16a34a, #22c55e);
            min-height: 100vh;
            margin: 0;
            padding: 0;
            color: #fff;
        }

        .main-content {
            background: linear-gradient(135deg, #16a34a, #22c55e);
            backdrop-filter: blur(10px);
            color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            padding: 30px;
            margin: 30px;
        }

        h3 {
            color: #d1fae5;
            font-weight: 700;
            margin-bottom: 25px;
        }

        .table {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            border-radius: 8px;
            overflow: hidden;
        }

        .table th {
            background-color: rgba(22, 163, 74, 0.8);
            color: #fff;
            border-color: rgba(255, 255, 255, 0.3);
        }

        .table td {
            vertical-align: middle;
            border-color: rgba(255, 255, 255, 0.1);
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(255, 255, 255, 0.05);
        }

        .table-striped tbody tr:nth-of-type(even) {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .text-muted {
            color: rgba(255, 255, 255, 0.6) !important;
        }

        .btn-primary {
            background-color: #16a34a;
            border-color: #15803d;
        }

        .btn-primary:hover {
            background-color: #15803d;
            border-color: #065f46;
        }

        .page-breadcrumb {
            margin: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #fff;
        }

        .breadcrumb-title {
            font-weight: 600;
            font-size: 18px;
            color: rgb(25, 185, 73);
        }

        .breadcrumb {
            background: transparent;
            padding: 0;
            margin-bottom: 0;
        }

        .breadcrumb-item a {
            color: rgb(41, 158, 26);
            text-decoration: none;
        }

        .breadcrumb-item a:hover {
            text-decoration: underline;
        }

        .breadcrumb-item.active {
            color: #fff;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="wrapper d-flex">
        <?php include __DIR__ . '../../Template/sidebarKaryawan.php'; ?>

        <main class="w-100">
            <div class="page-breadcrumb">
                <div class="breadcrumb-title pe-3">Dashboard</div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="index.php?action=jadwal-saya">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Status Pengajuan <!-- UBAH BREADCRUMB -->
                        </li>
                    </ol>
                </nav>
            </div>

            <div class="main-content">
                <h3 class="mb-4"><i class="fas fa-paper-plane me-2"></i> Status Pengajuan</h3> <!-- UBAH HEADING -->

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Area</th>
                                <th>Deskripsi</th>
                                <th>Mulai</th>
                                <th>Selesai</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($pengajuanSaya)): ?>
                                <?php $no = 1;
                                foreach ($pengajuanSaya as $p): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= htmlspecialchars($p['area_name']) ?></td>
                                        <td><?= htmlspecialchars($p['description']) ?></td>
                                        <td><?= htmlspecialchars($p['start_day']) ?></td>
                                        <td><?= htmlspecialchars($p['finish_day']) ?></td>
                                        <td>
                                            <?php
                                            $status = htmlspecialchars($p['status']);
                                            if ($status === 'pending') {
                                                echo '<span class="badge bg-warning text-dark">Pending</span>';
                                            } elseif ($status === 'accepted') {
                                                echo '<span class="badge bg-success">Diterima</span>';
                                            } elseif ($status === 'rejected') {
                                                echo '<span class="badge bg-danger">Ditolak</span>';
                                            } else {
                                                echo htmlspecialchars($status);
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted">
                                        <i class="fas fa-info-circle me-2"></i> Belum ada pengajuan.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

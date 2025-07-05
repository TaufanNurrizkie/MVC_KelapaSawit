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
    <title>Jadwal Terbuka</title>
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
        /* Breadcrumb styling */
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
            <!-- BREADCRUMB -->
            <div class="page-breadcrumb">
                <div class="breadcrumb-title pe-3">Dashboard</div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="index.php?action=jadwal-saya">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Jadwal Terbuka
                        </li>
                    </ol>
                </nav>
            </div>
            <!-- END BREADCRUMB -->

            <div class="main-content">
                <h3 class="mb-4"><i class="fas fa-calendar-plus me-2"></i> Jadwal Kerja yang Tersedia</h3>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
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
                            <?php if (!empty($jadwalTersedia)): ?>
                                <?php $no = 1; foreach ($jadwalTersedia as $j): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= htmlspecialchars($j['area_name']) ?></td>
                                        <td><?= htmlspecialchars($j['description']) ?></td>
                                        <td><?= htmlspecialchars($j['start_day']) ?></td>
                                        <td><?= htmlspecialchars($j['finish_day']) ?></td>
                                        <td>
                                            <button
                                                type="button"
                                                class="btn btn-outline-light btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#detailModal"
                                                data-id="<?= $j['id'] ?>"
                                                data-area="<?= htmlspecialchars($j['area_name']) ?>"
                                                data-description="<?= htmlspecialchars($j['description']) ?>"
                                                data-start="<?= htmlspecialchars($j['start_day']) ?>"
                                                data-finish="<?= htmlspecialchars($j['finish_day']) ?>"
                                            >
                                                <i class="fas fa-info-circle me-1"></i> Detail
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted">
                                        <i class="fas fa-info-circle me-2"></i> Belum ada jadwal tersedia.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- MODAL DETAIL -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-dark">
          <div class="modal-header bg-success text-white">
            <h5 class="modal-title" id="detailModalLabel"><i class="fas fa-info-circle me-2"></i> Detail Jadwal</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p><strong>Area:</strong> <span id="modalArea"></span></p>
            <p><strong>Deskripsi:</strong> <span id="modalDescription"></span></p>
            <p><strong>Mulai:</strong> <span id="modalStart"></span></p>
            <p><strong>Selesai:</strong> <span id="modalFinish"></span></p>
          </div>
          <div class="modal-footer">
            <a href="#" id="applyBtn" class="btn btn-primary">
                <i class="fas fa-paper-plane me-1"></i> Ajukan Diri
            </a>
            <button type="button" class="btn btn-success" data-bs-dismiss="modal">Tutup</button>
          </div>
        </div>
      </div>
    </div>

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const detailModal = document.getElementById('detailModal');
        detailModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const area = button.getAttribute('data-area');
            const description = button.getAttribute('data-description');
            const start = button.getAttribute('data-start');
            const finish = button.getAttribute('data-finish');

            document.getElementById('modalArea').textContent = area;
            document.getElementById('modalDescription').textContent = description;
            document.getElementById('modalStart').textContent = start;
            document.getElementById('modalFinish').textContent = finish;

            const applyBtn = document.getElementById('applyBtn');
            applyBtn.href = `index.php?action=apply&schedule_id=${id}`;
        });
    </script>
</body>

</html>

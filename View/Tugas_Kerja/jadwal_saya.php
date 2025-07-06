<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if ($_SESSION['user']['role'] !== 'karyawan') {
    header("Location: index.php?action=login");
    exit;
}
require_once './Model/absensi_model.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Jadwal Saya</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
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
            <!-- BREADCRUMB -->
            <div class="page-breadcrumb">
                <div class="breadcrumb-title pe-3">Dashboard</div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="index.php?action=jadwal-saya">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Jadwal Saya</li>
                    </ol>
                </nav>
            </div>

            <div class="main-content">
                <h3><i class="fas fa-calendar-check me-2"></i> Jadwal Kerja Saya</h3>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Area</th>
                            <th>Deskripsi</th>
                            <th>Peran</th>
                            <th>Status</th>
                            <th>Mulai</th>
                            <th>Selesai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($jadwalsaya)): ?>
                            <?php
                            $absenceModel = new Absence();
                            $now = new DateTime("now", new DateTimeZone("Asia/Jakarta"));
                            $no = 1;
                            foreach ($jadwalsaya as $j):
                                $hasCheckIn  = $absenceModel->hasCheckedInToday($j['id']);
                                $hasCheckOut = $absenceModel->hasCheckedOutToday($j['id']);

                                $startTime   = new DateTime($j['start_day'], new DateTimeZone("Asia/Jakarta"));
                                $finishTime  = new DateTime($j['finish_day'], new DateTimeZone("Asia/Jakarta"));
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($j['area_name']) ?></td>
                                    <td><?= htmlspecialchars($j['description']) ?></td>
                                    <td><?= htmlspecialchars($j['choice_of_role']) ?></td>
                                    <td><?= htmlspecialchars($j['status']) ?></td>
                                    <td><?= htmlspecialchars($j['start_day']) ?></td>
                                    <td><?= htmlspecialchars($j['finish_day']) ?></td>
                                    <td>
                                        <?php
                                        if (!$hasCheckIn) {
                                            $checkinLateThreshold = clone $startTime;
                                            $checkinLateThreshold->modify('+5 minutes');

                                            if ($now < $startTime) {
                                                echo '<span class="badge bg-secondary"><i class="fas fa-clock me-1"></i> Belum Waktu Check-In</span>';
                                            } elseif ($now > $finishTime) {
                                                echo '<span class="badge bg-danger"><i class="fas fa-times-circle me-1"></i> Lewat Waktu Check-In (Terlalu Lama)</span>';
                                            } elseif ($now >= $startTime && $now <= $checkinLateThreshold) {
                                                // Check-In normal
                                                echo '<a href="index.php?action=absensi-checkin-form&work_schedule_id=' . $j['id'] . '" class="btn btn-success btn-sm">
                    <i class="fas fa-sign-in-alt me-1"></i> Check-In
                  </a>';
                                            } else {
                                                // Lewat waktu check-in > 5 menit
                                                echo '<a href="index.php?action=absensi-checkin-form&work_schedule_id=' . $j['id'] . '&late=1" class="btn btn-danger btn-sm">
                    <i class="fas fa-exclamation-triangle me-1"></i> Lewat Waktu Check-In
                  </a>';
                                            }
                                        } elseif ($hasCheckIn && !$hasCheckOut) {
                                            if ($now < $finishTime) {
                                                echo '<span class="badge bg-secondary"><i class="fas fa-clock me-1"></i> Belum Waktu Check-Out</span>';
                                            } elseif ($now > $finishTime->modify('+4 hours')) {
                                                echo '<span class="badge bg-danger"><i class="fas fa-times-circle me-1"></i> Lewat Waktu Check-Out</span>';
                                            } else {
                                                echo '<a href="index.php?action=absensi-checkout-form&work_schedule_id=' . $j['id'] . '" class="btn btn-warning btn-sm">
                    <i class="fas fa-sign-out-alt me-1"></i> Check-Out
                  </a>';
                                            }
                                        } else {
                                            echo '<span class="badge bg-light text-dark"><i class="fas fa-check-circle me-1"></i> Selesai</span>';
                                        }
                                        ?>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center text-muted">
                                    <i class="fas fa-info-circle me-2"></i> Belum ada jadwal kerja.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
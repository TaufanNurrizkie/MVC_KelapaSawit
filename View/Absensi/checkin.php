<?php
if (session_status() === PHP_SESSION_NONE) session_start();

$work_schedule_id = $_GET['work_schedule_id'] ?? null;
if (!$work_schedule_id) {
    die('work_schedule_id tidak ditemukan!');
}

$checkin_time = date('Y-m-d H:i:s');
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Check-In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-success text-white">
    <div class="container mt-5 text-center">
        <h3>Check-In</h3>
        <form method="post" action="index.php?action=absensi-checkin-process">
            <input type="hidden" name="work_schedule_id" value="<?= htmlspecialchars($work_schedule_id) ?>">
            <input type="hidden" name="checkin_time" value="<?= htmlspecialchars($checkin_time) ?>">
            <button type="submit" class="btn btn-light btn-lg mt-4">
                <i class="fas fa-sign-in-alt"></i> Check-In
            </button>
        </form>
    </div>
</body>

</html>

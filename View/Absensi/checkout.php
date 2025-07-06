<?php
if (session_status() === PHP_SESSION_NONE) session_start();

$work_schedule_id = $_GET['work_schedule_id'] ?? null;
if (!$work_schedule_id) {
    die('work_schedule_id tidak ditemukan!');
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Check-Out</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-success text-white">
    <div class="container mt-5">
        <h3 class="mb-4">
            <i class="fas fa-sign-out-alt me-2"></i>
            Isi Laporan Kerja (Check-Out)
        </h3>

        <form method="post" action="index.php?action=absensi-checkout-process">
            <input type="hidden" name="work_schedule_id" value="<?= htmlspecialchars($work_schedule_id) ?>">

            <div class="mb-3">
                <label for="notes" class="form-label">Catatan</label>
                <textarea
                    name="notes"
                    id="notes"
                    class="form-control"
                    rows="3"
                    placeholder="Tuliskan catatan kerja hari ini..."></textarea>
            </div>

            <div class="mb-3">
                <label for="status_of_duty" class="form-label">Status Pelaksanaan</label>
                <select name="status_of_duty" id="status_of_duty" class="form-select">
                    <option value="1">Selesai</option>
                    <option value="0">Tidak Selesai</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label">Jumlah Output (misalnya tandan dipanen)</label>
                <input
                    type="number"
                    name="quantity"
                    id="quantity"
                    class="form-control"
                    placeholder="Masukkan jumlah output"
                    min="0"
                    step="1">
            </div>

            <button type="submit" class="btn btn-light text-success">
                <i class="fas fa-sign-out-alt me-2"></i> Check-Out
            </button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

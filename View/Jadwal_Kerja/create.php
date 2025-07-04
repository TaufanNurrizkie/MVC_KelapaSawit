<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Jadwal Kerja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="wrapper d-flex">
    <?php include __DIR__ . '../../Template/sidebarAdmin.php'; ?>

    <main class="p-4 w-100">
        <h3 class="mb-4">🗓️ Tambah Jadwal Kerja</h3>
        <form method="POST">
            <div class="mb-3">
                <label>Area</label>
                <select name="area_id" class="form-control" required>
                    <option value="">Pilih Area</option>
                    <?php foreach ($areas as $a): ?>
                        <option value="<?= $a['id'] ?>"><?= $a['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label>Mulai</label>
                <input type="datetime-local" name="start_day" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Selesai</label>
                <input type="datetime-local" name="finish_day" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Status</label>
                <input type="text" name="status" class="form-control" placeholder="Misal: Menunggu, Dikerjakan, Selesai">
            </div>
            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
            <div class="form-check mb-3">
                <input type="checkbox" name="is_published" class="form-check-input" id="publishCheck">
                <label class="form-check-label" for="publishCheck">Terbitkan jadwal</label>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="index.php?action=jadwal" class="btn btn-secondary">Kembali</a>
        </form>
    </main>
</div>
</body>
</html>

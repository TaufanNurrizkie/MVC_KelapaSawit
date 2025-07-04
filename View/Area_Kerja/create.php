<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Area Kerja</title>

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #f8fafc;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        main {
            flex: 1;
            padding: 30px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Include Sidebar -->
        <?php include __DIR__ . '../../Template/sidebarAdmin.php'; ?>

        <!-- Main Content -->
        <main>
            <h3 class="mb-4">🛠️ Tambah Area Kerja</h3>
            <form method="POST">
                <input name="name" class="form-control mb-3" placeholder="Nama atau Lokasi Area" required>
                <input type="number" name="size" class="form-control mb-3" placeholder="Dalam hektar" required>
                <input name="quantity_of_trees" class="form-control mb-3" placeholder="Jumlah Pohon" required>
                <input name="type_of_soil" class="form-control mb-3" placeholder="Jenis Tanah" required>
                <button type="submit" class="btn btn-success">Simpan Area</button>
                <a href="index.php?action=area" class="btn btn-secondary">Kembali</a>
            </form>
        </main>
    </div>
</body>
</html>

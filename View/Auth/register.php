<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register - Sistem Perkebunan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f1f8e9;
            font-family: 'Segoe UI', sans-serif;
        }
        .register-card {
            max-width: 600px;
            margin: auto;
            margin-top: 50px;
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            background-color: #fff;
            padding: 30px;
        }
        .btn-green {
            background-color: #4CAF50;
            color: white;
        }
        .btn-green:hover {
            background-color: #43a047;
        }
        .text-link {
            color: #4CAF50;
        }
    </style>
</head>
<body>
    <div class="register-card">
        <h3 class="text-center text-success mb-4">🌱 Daftar Akun Baru</h3>
        <form method="POST" action="?action=register">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" placeholder="Contoh: Ahmad Sawit" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email Aktif</label>
                    <input type="email" name="email" class="form-control" placeholder="Contoh: sawit@mail.com" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Contoh: ahmad123" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Peran</label>
                <select name="role" class="form-control" required onchange="toggleAvailability(this.value)">
                    <option value="">-- Pilih Peran --</option>
                    <option value="admin">Admin</option>
                    <option value="karyawan">Karyawan</option>
                </select>
            </div>
            <div class="mb-3" id="availability-box" style="display: none;">
                <label class="form-label">Waktu Ketersediaan (Karyawan)</label>
                <textarea name="availability_time" class="form-control" placeholder="Contoh: Senin - Jumat, 08.00 - 16.00"></textarea>
            </div>
            <button type="submit" class="btn btn-green w-100">Daftar</button>
        </form>
        <div class="mt-3 text-center">

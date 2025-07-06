<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistem Perkebunan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #e8f5e9;
            font-family: 'Segoe UI', sans-serif;
        }
        .login-card {
            max-width: 400px;
            margin: auto;
            margin-top: 100px;
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
    <div class="login-card">
        <h3 class="text-center text-success mb-4">🌴 Login Sistem Perkebunan</h3>
        <form method="POST" action="?action=login">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input name="username" id="username" class="form-control" placeholder="Masukkan username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Kata Sandi</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" required>
            </div>
            <button type="submit" class="btn btn-green w-100">Masuk</button>
        </form>
        <div class="mt-3 text-center">
            <small>Belum punya akun? <a class="text-link" href="?action=register">Daftar sekarang</a></small>
        </div>
    </div>
</body>
</html>

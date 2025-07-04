<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <!-- Gunakan CDN Bootstrap dan Font -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', Arial, sans-serif;
            background-color: #f8fafc;
            margin: 0;
        }

        .flex {
            display: flex;
        }

        #sidebar {
            width: 256px;
            transition: width 0.3s ease;
            background: linear-gradient(135deg, #4CAF50 85%, #795548 100%);
            display: flex;
            flex-direction: column;
            height: 100vh;
            position: sticky;
            top: 0;
            box-shadow: 2px 0 8px rgba(76, 175, 80, 0.08);
        }

        #sidebar.closed {
            width: 80px;
        }

        .sidebar-text {
            opacity: 1;
            visibility: visible;
            transition: opacity 0.3s;
        }

        .sidebar-text.hidden {
            opacity: 0;
            visibility: hidden;
        }

        #sidebar .header {
            padding: 20px;
            border-bottom: 2px solid #a5d6a7;
        }

        .sidebar-title {
            font-weight: 600;
            font-size: 1.3rem;
            color: #fff;
            margin-left: 10px;
        }

        nav ul {
            list-style: none;
            padding: 0;
        }

        nav li {
            margin-bottom: 10px;
        }

        nav a {
            display: flex;
            align-items: center;
            padding: 12px 18px;
            color: #fff;
            text-decoration: none;
            font-weight: 500;
            transition: 0.3s;
        }

        nav a:hover {
            background: rgba(121, 85, 72, 0.12);
            border-radius: 8px;
        }

        svg {
            width: 22px;
            height: 22px;
            margin-right: 12px;
            flex-shrink: 0;
        }

        main {
            flex-grow: 1;
            padding: 32px 24px;
            background-color: #fff;
            min-height: 100vh;
        }

        #logout-btn {
            margin: 18px;
            padding: 10px 18px;
            background-color: #795548;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 0.95rem;
            cursor: pointer;
            text-align: left;
            display: flex;
            align-items: center;
        }

        #sidebar.closed #logout-btn span {
            display: none;
        }

        #toggle-sidebar {
            background: none;
            border: none;
            cursor: pointer;
            color: white;
        }

        @media (max-width: 900px) {
            #sidebar {
                position: fixed;
                z-index: 100;
                height: 100vh;
                left: 0;
            }
        }
    </style>
</head>

<body>
    <div class="flex">
        <!-- Sidebar -->
        <aside id="sidebar">
            <div class="header d-flex align-items-center">
                <button id="toggle-sidebar" class="me-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-white" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
                <span class="sidebar-title sidebar-text">Admin Panel</span>
            </div>

            <nav>
                <ul>
                    <li>
                        <a href="index.php">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <circle cx="12" cy="12" r="10" fill="#fffde7" />
                                <path d="M12 6v6l4 2" stroke="#4CAF50" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <ellipse cx="12" cy="12" rx="6" ry="10" fill="none" stroke="#795548"
                                    stroke-width="2" />
                            </svg>
                            <span class="sidebar-text">Dashboard</span>
                        </a>
                    </li>

                </ul>
            </nav>

            <!-- Tombol Logout -->
            <a href="../../index.php?action=logout" id="logout-btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    style="width: 20px; height: 20px; margin-right: 10px;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-10V5m0 0V3m0 18v-2" />
                </svg>
                <span>Logout</span>
            </a>
        </aside>

        <!-- Konten Utama -->
        <main>
            <h2>Halo Admin 👋</h2>
            <p>Selamat datang di sistem pengelolaan kebun kelapa sawit.</p>
        </main>
    </div>

    <script>
        document.getElementById('toggle-sidebar').addEventListener('click', function () {
            const sidebar = document.getElementById('sidebar');
            const texts = document.querySelectorAll('.sidebar-text');
            sidebar.classList.toggle('closed');
            texts.forEach(text => {
                if (sidebar.classList.contains('closed')) {
                    text.classList.add('hidden');
                } else {
                    text.classList.remove('hidden');
                }
            });
        });
    </script>
</body>

</html>

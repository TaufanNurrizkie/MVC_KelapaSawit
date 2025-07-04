    <meta charset="UTF-8">
    <title>Daftar Area Kerja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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

        #sidebar {
            width: 240px;
            background: linear-gradient(135deg, #4CAF50 85%, #795548 100%);
            color: white;
            padding: 20px;
        }

        #sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 6px;
        }

        #sidebar a:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar-title {
            font-weight: bold;
            font-size: 20px;
            margin-bottom: 20px;
            display: block;
        }

        #logout-btn {
            background-color: #795548;
            border: none;
            padding: 10px;
            border-radius: 6px;
            margin-top: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: white;
        }

        main {
            flex: 1;
            padding: 30px;
        }
    </style>

<aside id="sidebar">
    <span class="sidebar-title">Admin Panel</span>

    <a href="index.php?action=area">📋 Daftar Area</a>


    <a href="index.php?action=logout" id="logout-btn">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
             style="width: 20px; height: 20px;">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-10V5m0 0V3m0 18v-2"/>
        </svg>
        <span>Logout</span>
    </a>
</aside>

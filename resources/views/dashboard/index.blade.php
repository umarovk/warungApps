<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >
    <title>Warung Dashboard</title>
    <style>
        :root {
            --primary-bg: #f4f4f4;
            --primary-text: #222;
            --card-bg: #fff;
            --card-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            --accent: #667eea;
            --header-text: #222;
            --stat-bg: rgba(255, 255, 255, 0.9);
            --stat-title: #222;
            --stat-label: #666;
        }

        body.dark-mode {
            --primary-bg: #181a20;
            --primary-text: #f4f4f4;
            --card-bg: #23262f;
            --card-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
            --accent: #764ba2;
            --header-text: #fff;
            --stat-bg: rgba(36, 37, 42, 0.95);
            --stat-title: #fff;
            --stat-label: #bbb;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--primary-bg);
            color: var(--primary-text);
            min-height: 100vh;
            padding: 20px;
            transition: background 0.3s, color 0.3s;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            color: var(--header-text);
            position: relative;
        }

        .theme-toggle {
            position: absolute;
            top: 0;
            right: 0;
            background: var(--card-bg);
            color: var(--primary-text);
            border: 1px solid #ccc;
            border-radius: 20px;
            padding: 6px 16px;
            font-size: 13px;
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
            margin: 10px;
        }

        .theme-toggle:hover {
            background: var(--accent);
            color: #fff;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .feature-card {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 25px 20px;
            text-align: center;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
            text-decoration: none;
            color: var(--primary-text);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 140px;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.2);
        }

        .feature-icon {
            width: 50px;
            height: 50px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            font-size: 24px;
        }

        .order-icon {
            background: linear-gradient(135deg, #ff6b6b, #ee5a24);
            color: white;
        }

        .menu-icon {
            background: linear-gradient(135deg, #4ecdc4, #44a08d);
            color: white;
        }

        .user-icon {
            background: linear-gradient(135deg, #45b7d1, #96c93d);
            color: white;
        }

        .setting-icon {
            background: linear-gradient(135deg, #a8edea, #fed6e3);
            color: #333;
        }

        .report-icon {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }

        .export-icon {
            background: linear-gradient(135deg, #ffffff, #d2e46c);
            color: white;
        }

        .history-icon {
            background: linear-gradient(135deg, #f093fb, #f5576c);
            color: white;
        }

        .database-icon {
            background: linear-gradient(135deg, #ffffff, #747474);
            color: white;
        }

        .feature-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .feature-desc {
            font-size: 12px;
            color: var(--stat-label);
            line-height: 1.4;
        }

        .stats-section {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 20px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .stats-title {
            color: var(--stat-title);
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
            text-align: center;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .stat-item {
            background: var(--stat-bg);
            border-radius: 15px;
            padding: 15px;
            text-align: center;
        }

        .stat-number {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary-text);
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 12px;
            color: var(--stat-label);
            font-weight: 500;
        }

        .top-menu-section {
            margin-top: 20px;
        }

        .top-menu-card {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 20px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .top-menu-title {
            color: var(--stat-title);
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 15px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .top-menu-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .top-menu-item {
            background: var(--stat-bg);
            border-radius: 12px;
            padding: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .menu-rank {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ff6b6b, #ee5a24);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
            flex-shrink: 0;
        }

        .menu-rank.rank-2 {
            background: linear-gradient(135deg, #4ecdc4, #44a08d);
        }

        .menu-rank.rank-3 {
            background: linear-gradient(135deg, #45b7d1, #96c93d);
        }

        .menu-info {
            flex: 1;
            min-width: 0;
        }

        .menu-name {
            font-size: 14px;
            font-weight: 600;
            color: var(--primary-text);
            margin-bottom: 4px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .menu-stats {
            font-size: 11px;
            color: var(--stat-label);
        }

        .no-data {
            text-align: center;
            color: rgba(255, 255, 255, 0.7);
            font-size: 14px;
            padding: 20px;
        }

        @media (max-width: 360px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .feature-card {
                min-height: 120px;
                padding: 20px 15px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }

        .button-container {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin: 20px auto 0;
        }

        .export-btn,
        .backup-btn {
            background: rgba(255, 255, 255, 0.2);
            color: var(--primary-text);
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-block;
        }

        .export-btn:hover,
        .backup-btn:hover {
            background: var(--accent);
            color: #fff;
            border-color: var(--accent);
        }

        @media (max-width: 400px) {
            .button-container {
                flex-direction: column;
                align-items: center;
            }

            .export-btn,
            .backup-btn {
                width: 100%;
                max-width: 200px;
            }
        }

        /* ===== LOGOUT BUTTON STYLES ===== */
        .logout-container {
            margin-top: 30px;
            text-align: center;
        }

        .logout-btn-bottom {
            background: linear-gradient(135deg, #f3ff6b, #ccda30);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 25px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            /* box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3); */
            position: relative;
            overflow: hidden;
        }

        .logout-btn-bottom::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .logout-btn-bottom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 107, 107, 0.4);
            color: white;
        }

        .logout-btn-bottom:hover::before {
            left: 100%;
        }

        .logout-btn-bottom:active {
            transform: translateY(0);
            box-shadow: 0 2px 10px rgba(255, 107, 107, 0.3);
        }

        /* Dark mode adjustments for logout button */
        body.dark-mode .logout-btn-bottom {
            background: linear-gradient(135deg, #fda846, #daff37);
            box-shadow: 0 4px 15px rgba(255, 71, 87, 0.3);
        }

        .logout-text {
            font-size: 16px;
            font-weight: 600;
            color: #000000;
        }

        body.dark-mode .logout-btn-bottom:hover {
            box-shadow: 0 8px 25px rgba(255, 71, 87, 0.4);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Warung Bu Saemah</h1>
            <p>Warung Bakso Nomor 1 di Banjarnegara</p>

        </div>
        <button
            class="theme-toggle"
            id="theme-toggle"
        >🌙 Dark Mode</button>
        <div class="dashboard-grid">
            <a
                href="{{ route('orders.create') }}"
                class="feature-card"
            >
                <div class="feature-icon order-icon">
                    📋
                </div>
                <div class="feature-title">Order</div>
                <div class="feature-desc">Kelola pesanan pelanggan</div>
            </a>

            <a
                href="{{ route('menus.index') }}"
                class="feature-card"
            >
                <div class="feature-icon menu-icon">
                    🍽️
                </div>
                <div class="feature-title">Tambah Menu</div>
                <div class="feature-desc">Tambah menu baru</div>
            </a>

            {{-- fitur user dan pengaturan --}}
            {{-- <a
                href="{{ route('users.index') }}"
                class="feature-card"
            >
                <div class="feature-icon user-icon">
                    👥
                </div>
                <div class="feature-title">Tambah User</div>
                <div class="feature-desc">Kelola pengguna sistem</div>
            </a>

            <a
                href="{{ route('settings.index') }}"
                class="feature-card"
            >
                <div class="feature-icon setting-icon">
                    ⚙️
                </div>
                <div class="feature-title">Pengaturan</div>
                <div class="feature-desc">Konfigurasi aplikasi</div>
            </a> --}}
        </div>


        <div class="dashboard-grid">
            <a
                href="{{ route('admin.report') }}"
                class="feature-card"
            >
                <div class="feature-icon report-icon">
                    📊
                </div>
                <div class="feature-title">Laporan</div>
                <div class="feature-desc">Lihat laporan penjualan</div>
            </a>

            <a
                href="{{ route('orders.index') }}"
                class="feature-card"
            >
                <div class="feature-icon history-icon">
                    📋
                </div>
                <div class="feature-title">Riwayat Order</div>
                <div class="feature-desc">Lihat semua pesanan</div>
            </a>
        </div>


        <div class="dashboard-grid">
            <a
                href="{{ route('orders.export.csv') }}"
                class="feature-card"
            >
                <div class="feature-icon export-icon">
                    📊
                </div>
                <div class="feature-title">Export Data</div>
                <div class="feature-desc">Lihat laporan penjualan</div>
            </a>

            <a
                href="{{ route('database.backup') }}"
                class="feature-card"
            >
                <div class="feature-icon database-icon">
                    💾
                </div>
                <div class="feature-title">Backup Database</div>
                <div class="feature-desc">Lihat semua pesanan</div>
            </a>
        </div>


        <div class="logout-container">
            <a
                href="{{ route('logout') }}"
                class="logout-btn-bottom"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            >
                <span class="logout-text">Keluar dari Sistem</span>
            </a>
        </div>

        <form
            id="logout-form"
            action="{{ route('logout') }}"
            method="POST"
            style="display: none;"
        >
            @csrf
        </form>

        <script>
            // Theme toggle logic
            const toggleBtn = document.getElementById('theme-toggle');

            function setTheme(mode) {
                if (mode === 'dark') {
                    document.body.classList.add('dark-mode');
                    toggleBtn.textContent = '☀️ Light Mode';
                } else {
                    document.body.classList.remove('dark-mode');
                    toggleBtn.textContent = '🌙 Dark Mode';
                }
            }
            // Load from localStorage
            const savedTheme = localStorage.getItem('theme-mode');
            setTheme(savedTheme === 'dark' ? 'dark' : 'light');
            toggleBtn.addEventListener('click', function() {
                const isDark = document.body.classList.toggle('dark-mode');
                localStorage.setItem('theme-mode', isDark ? 'dark' : 'light');
                setTheme(isDark ? 'dark' : 'light');
            });
        </script>
</body>

</html>

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
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            background: black;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            color: white;
            position: relative;
        }

        .logout-container {
            display: flex;
            justify-content: center;
            margin: 20px auto 0;
        }

        .logout-btn-bottom {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-block;
        }

        .logout-btn-bottom:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
        }

        .header h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .header p {
            font-size: 16px;
            opacity: 0.9;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .feature-card {
            background: white;
            border-radius: 20px;
            padding: 25px 20px;
            text-align: center;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
            text-decoration: none;
            color: #333;
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

        .feature-card:active {
            transform: translateY(-2px);
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

        .feature-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .feature-desc {
            font-size: 12px;
            color: #666;
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
            color: white;
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
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 15px;
            text-align: center;
        }

        .stat-number {
            font-size: 24px;
            font-weight: 700;
            color: #333;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 12px;
            color: #666;
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
            color: white;
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
            background: rgba(255, 255, 255, 0.9);
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
            color: #333;
            margin-bottom: 4px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .menu-stats {
            font-size: 11px;
            color: #666;
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
            color: white;
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
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
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
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Warung Bu Saemah</h1>
            <p>Warung Bakso Nomor 1 di Banjarnegara</p>
        </div>

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

        <div class="stats-section">
            <div class="stats-title">Statistik Hari Ini</div>
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">{{ $orderStats['today_orders'] }}</div>
                    <div class="stat-label">Pesanan Hari Ini</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">Rp {{ number_format($orderStats['today_revenue'] / 1000, 0) }}K</div>
                    <div class="stat-label">Pendapatan Hari Ini</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $menuCount }}</div>
                    <div class="stat-label">Menu Aktif</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $userCount }}</div>
                    <div class="stat-label">User Aktif</div>
                </div>
            </div>
        </div>

        <!-- Top Food Items -->
        <div class="top-menu-section">
            <div class="top-menu-card">
                <div class="top-menu-title">
                    <span>🍽️ Makanan Terlaris</span>
                </div>
                <div class="top-menu-list">
                    @if ($topFoodItems->isEmpty())
                        <div class="no-data">Belum ada data</div>
                    @else
                        @foreach ($topFoodItems as $index => $item)
                            <div class="top-menu-item">
                                <div class="menu-rank rank-{{ $index + 1 }}">
                                    {{ $index + 1 }}
                                </div>
                                <div class="menu-info">
                                    <div class="menu-name">{{ $item->nama }}</div>
                                    <div class="menu-stats">
                                        Terjual: {{ $item->total_sold }} | Rp
                                        {{ number_format($item->total_revenue, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <!-- Top Drink Items -->
        <div class="top-menu-section">
            <div class="top-menu-card">
                <div class="top-menu-title">
                    <span>🥤 Minuman Terlaris</span>
                </div>
                <div class="top-menu-list">
                    @if ($topDrinkItems->isEmpty())
                        <div class="no-data">Belum ada data</div>
                    @else
                        @foreach ($topDrinkItems as $index => $item)
                            <div class="top-menu-item">
                                <div class="menu-rank rank-{{ $index + 1 }}">
                                    {{ $index + 1 }}
                                </div>
                                <div class="menu-info">
                                    <div class="menu-name">{{ $item->nama }}</div>
                                    <div class="menu-stats">
                                        Terjual: {{ $item->total_sold }} | Rp
                                        {{ number_format($item->total_revenue, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

    </div>

    <div class="button-container">
        <a
            href="{{ route('orders.export.csv') }}"
            class="export-btn"
        >
            📊 Export ke CSV
        </a>
        <a
            href="{{ route('database.backup') }}"
            class="backup-btn"
        >
            💾 Backup Database
        </a>
    </div>

    <div class="logout-container">
        <a
            href="{{ route('logout') }}"
            class="logout-btn-bottom"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
        >
            🚪 Logout
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

</body>

</html>

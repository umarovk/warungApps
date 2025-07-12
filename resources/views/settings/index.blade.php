<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >
    <title>Pengaturan - Warung Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            min-height: 100vh;
        }

        .header {
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            color: #333;
            padding: 20px;
            text-align: center;
        }

        .header h1 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .back-btn {
            position: absolute;
            left: 20px;
            top: 20px;
            background: rgba(0, 0, 0, 0.1);
            border: none;
            color: #333;
            padding: 10px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 18px;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
        }

        .settings-section {
            background: white;
            border-radius: 15px;
            margin-bottom: 20px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .section-header {
            padding: 20px;
            border-bottom: 1px solid #eee;
            background: #f8f9fa;
        }

        .section-header h3 {
            font-size: 16px;
            font-weight: 600;
            color: #333;
        }

        .setting-item {
            padding: 20px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .setting-item:last-child {
            border-bottom: none;
        }

        .setting-info h4 {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 3px;
        }

        .setting-info p {
            font-size: 12px;
            color: #666;
        }

        .toggle-switch {
            position: relative;
            width: 50px;
            height: 24px;
            background: #ccc;
            border-radius: 12px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .toggle-switch.active {
            background: #4ecdc4;
        }

        .toggle-switch::after {
            content: '';
            position: absolute;
            top: 2px;
            left: 2px;
            width: 20px;
            height: 20px;
            background: white;
            border-radius: 50%;
            transition: transform 0.3s;
        }

        .toggle-switch.active::after {
            transform: translateX(26px);
        }

        .setting-value {
            font-size: 14px;
            color: #666;
            font-weight: 500;
        }

        .save-btn {
            background: linear-gradient(135deg, #a8edea, #fed6e3);
            color: #333;
            border: none;
            padding: 15px 25px;
            border-radius: 25px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            margin-top: 20px;
            box-shadow: 0 4px 15px rgba(168, 237, 234, 0.3);
        }

        .save-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(168, 237, 234, 0.4);
        }
    </style>
</head>

<body>
    <div class="header">
        <a
            href="{{ route('dashboard') }}"
            class="back-btn"
        >←</a>
        <h1>Pengaturan</h1>
        <p>Konfigurasi aplikasi warung</p>
    </div>

    <div class="container">
        <form
            action="{{ route('settings.update') }}"
            method="POST"
        >
            @csrf

            <div class="settings-section">
                <div class="section-header">
                    <h3>Umum</h3>
                </div>

                <div class="setting-item">
                    <div class="setting-info">
                        <h4>Nama Warung</h4>
                        <p>Nama yang ditampilkan di aplikasi</p>
                    </div>
                    <div class="setting-value">Warung Sederhana</div>
                </div>

                <div class="setting-item">
                    <div class="setting-info">
                        <h4>Alamat</h4>
                        <p>Alamat lokasi warung</p>
                    </div>
                    <div class="setting-value">Jl. Contoh No. 123</div>
                </div>

                <div class="setting-item">
                    <div class="setting-info">
                        <h4>Nomor Telepon</h4>
                        <p>Kontak warung</p>
                    </div>
                    <div class="setting-value">+62 812-3456-7890</div>
                </div>
            </div>

            <div class="settings-section">
                <div class="section-header">
                    <h3>Notifikasi</h3>
                </div>

                <div class="setting-item">
                    <div class="setting-info">
                        <h4>Notifikasi Order</h4>
                        <p>Dapatkan notifikasi saat ada order baru</p>
                    </div>
                    <div class="toggle-switch active"></div>
                </div>

                <div class="setting-item">
                    <div class="setting-info">
                        <h4>Notifikasi Stok</h4>
                        <p>Peringatan saat stok menipis</p>
                    </div>
                    <div class="toggle-switch"></div>
                </div>

                <div class="setting-item">
                    <div class="setting-info">
                        <h4>Notifikasi Laporan</h4>
                        <p>Laporan harian otomatis</p>
                    </div>
                    <div class="toggle-switch active"></div>
                </div>
            </div>

            <div class="settings-section">
                <div class="section-header">
                    <h3>Tampilan</h3>
                </div>

                <div class="setting-item">
                    <div class="setting-info">
                        <h4>Mode Gelap</h4>
                        <p>Tampilan gelap untuk kenyamanan mata</p>
                    </div>
                    <div class="toggle-switch"></div>
                </div>

                <div class="setting-item">
                    <div class="setting-info">
                        <h4>Ukuran Font</h4>
                        <p>Ukuran teks di aplikasi</p>
                    </div>
                    <div class="setting-value">Sedang</div>
                </div>
            </div>

            <button
                type="submit"
                class="save-btn"
            >
                Simpan Pengaturan
            </button>
        </form>
    </div>

    <script>
        // Toggle switch functionality
        document.querySelectorAll('.toggle-switch').forEach(toggle => {
            toggle.addEventListener('click', function() {
                this.classList.toggle('active');
            });
        });
    </script>
</body>

</html>

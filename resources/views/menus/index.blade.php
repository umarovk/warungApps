<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >
    <title>Kelola Menu - Warung Dashboard</title>
    <style>
        :root {
            --primary-bg: #f5f5f5;
            --primary-text: #222;
            --header-bg: linear-gradient(135deg, #4ecdc4 0%, #44a08d 100%);
            --header-text: #fff;
            --card-bg: #fff;
            --card-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            --menu-name: #333;
            --menu-desc: #666;
            --menu-price: #4ecdc4;
            --menu-image-bg: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --menu-image-color: #fff;
            --status-active-bg: #d4edda;
            --status-active-text: #155724;
            --status-inactive-bg: #f8d7da;
            --status-inactive-text: #721c24;
            --success-bg: #d4edda;
            --success-text: #155724;
            --empty-state: #666;
            --add-btn-bg: linear-gradient(135deg, #4ecdc4, #44a08d);
            --add-btn-text: #fff;
        }

        body.dark-mode {
            --primary-bg: #181a20;
            --primary-text: #f4f4f4;
            --header-bg: #23262f;
            --header-text: #fff;
            --card-bg: #23262f;
            --card-shadow: 0 2px 10px rgba(0, 0, 0, 0.25);
            --menu-name: #f4f4f4;
            --menu-desc: #bbb;
            --menu-price: #4ecdc4;
            --menu-image-bg: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            --menu-image-color: #fff;
            --status-active-bg: #2e7d32;
            --status-active-text: #d4edda;
            --status-inactive-bg: #721c24;
            --status-inactive-text: #f8d7da;
            --success-bg: #23262f;
            --success-text: #4ecdc4;
            --empty-state: #bbb;
            --add-btn-bg: linear-gradient(135deg, #764ba2, #667eea);
            --add-btn-text: #fff;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--primary-bg);
            color: var(--primary-text);
            min-height: 100vh;
            transition: background 0.3s, color 0.3s;
        }

        .header {
            background: var(--header-bg);
            color: var(--header-text);
            padding: 20px;
            text-align: center;
            position: relative;
        }

        .theme-toggle {
            position: absolute;
            top: 20px;
            right: 20px;
            background: var(--card-bg);
            color: var(--primary-text);
            border: 1px solid #ccc;
            border-radius: 20px;
            padding: 6px 16px;
            font-size: 13px;
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
            z-index: 2;
        }

        .theme-toggle:hover {
            background: #764ba2;
            color: #fff;
        }

        .back-btn {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.9);
            border: none;
            color: #333;
            padding: 10px 14px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 18px;
            font-weight: 600;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            min-height: 40px;
            transition: all 0.2s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            z-index: 1;
        }

        .back-btn:hover {
            background: #fff;
            transform: translateY(-50%) scale(1.05);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            padding-bottom: 100px;
        }

        .add-btn {
            position: fixed;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--add-btn-bg);
            color: var(--add-btn-text);
            border: none;
            padding: 18px 35px;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 8px 25px rgba(78, 205, 196, 0.4);
            z-index: 1000;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            min-width: 200px;
            text-align: center;
        }

        .add-btn:hover {
            transform: translateX(-50%) translateY(-2px);
            box-shadow: 0 12px 35px rgba(78, 205, 196, 0.5);
        }

        .add-btn:active {
            transform: translateX(-50%) translateY(0);
        }

        .menu-grid {
            display: grid;
            gap: 15px;
        }

        .menu-item {
            background: var(--card-bg);
            border-radius: 15px;
            padding: 25px;
            box-shadow: var(--card-shadow);
            display: flex;
            align-items: center;
            gap: 20px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .menu-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .menu-image {
            width: 100px;
            height: 100px;
            border-radius: 15px;
            background: var(--menu-image-bg);
            color: var(--menu-image-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            flex-shrink: 0;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .menu-item:hover .menu-image {
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        }

        .menu-info {
            flex: 1;
        }

        .menu-info h3 {
            font-size: 18px;
            font-weight: 600;
            color: var(--menu-name);
            margin-bottom: 8px;
        }

        .menu-info p {
            font-size: 15px;
            color: var(--menu-desc);
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .menu-price {
            font-size: 18px;
            font-weight: 700;
            color: var(--menu-price);
            margin-bottom: 5px;
        }

        .menu-status {
            padding: 6px 12px;
            border-radius: 15px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-active {
            background: var(--status-active-bg);
            color: var(--status-active-text);
        }

        .status-inactive {
            background: var(--status-inactive-bg);
            color: var(--status-inactive-text);
        }

        .menu-actions {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 10px;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .edit-btn,
        .delete-btn {
            background: none;
            border: none;
            font-size: 18px;
            cursor: pointer;
            padding: 5px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .edit-btn:hover {
            background: rgba(78, 205, 196, 0.1);
            transform: scale(1.1);
        }

        .delete-btn:hover {
            background: rgba(220, 53, 69, 0.1);
            transform: scale(1.1);
        }

        .success-message {
            background: var(--success-bg);
            color: var(--success-text);
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 500;
            border: 1px solid #c3e6cb;
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: var(--empty-state);
        }

        .empty-state h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .empty-state p {
            font-size: 14px;
            line-height: 1.5;
        }

        @media (max-width: 480px) {
            .menu-image {
                width: 80px;
                height: 80px;
                font-size: 28px;
            }

            .menu-item {
                padding: 20px;
                gap: 15px;
            }

            .menu-info h3 {
                font-size: 16px;
            }

            .menu-info p {
                font-size: 14px;
            }

            .menu-price {
                font-size: 16px;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <a
            href="{{ route('dashboard') }}"
            class="back-btn"
        >←</a>
        <button
            class="theme-toggle"
            id="theme-toggle"
        >🌙 Dark Mode</button>
        <h1>Kelola Menu</h1>
        <p>Daftar menu warung</p>
    </div>

    <div class="container">
        @if (session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <div class="menu-grid">
            @if (isset($menus) && count($menus) > 0)
                @foreach ($menus as $menu)
                    <div class="menu-item">
                        <div class="menu-image">
                            @if ($menu->image_url)
                                <img
                                    src="{{ $menu->image_url }}"
                                    alt="{{ $menu->nama }}"
                                    style="width: 100%; height: 100%; object-fit: cover; border-radius: 10px;"
                                >
                            @else
                                @if ($menu->kategori == 'makanan')
                                    🍽️
                                @else
                                    🥤
                                @endif
                            @endif
                        </div>
                        <div class="menu-info">
                            <h3>{{ $menu->nama }}</h3>
                            <p>{{ $menu->deskripsi ?: 'Tidak ada deskripsi' }}</p>
                            <div class="menu-price">{{ $menu->formatted_harga }}</div>
                            <small style="color: #999;">{{ $menu->kategori_label }}</small>
                        </div>
                        <div class="menu-actions">
                            <div class="menu-status status-{{ $menu->status ? 'active' : 'inactive' }}">
                                {{ $menu->status ? 'Aktif' : 'Nonaktif' }}
                            </div>
                            <div class="action-buttons">
                                <a
                                    href="{{ route('menus.edit', $menu->id) }}"
                                    class="edit-btn"
                                    title="Edit"
                                >
                                    ✏️
                                </a>
                                <button
                                    onclick="deleteMenu({{ $menu->id }}, '{{ $menu->nama }}')"
                                    class="delete-btn"
                                    title="Hapus"
                                >
                                    🗑️
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="empty-state">
                    <h3>Belum ada menu</h3>
                    <p>Mulai dengan menambahkan menu baru untuk warung Anda</p>
                </div>
            @endif
        </div>

        <a
            href="{{ route('menus.create') }}"
            class="add-btn"
        >
            + Tambah Menu Baru
        </a>
    </div>

    <script>
        function deleteMenu(id, nama) {
            if (confirm(`Apakah Anda yakin ingin menghapus menu "${nama}"?`)) {
                // Create form for delete
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/menus/${id}`;

                // Add CSRF token
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                form.appendChild(csrfToken);

                // Add method override
                const methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                methodField.value = 'DELETE';
                form.appendChild(methodField);

                // Submit form
                document.body.appendChild(form);
                form.submit();
            }
        }

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

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
            background: linear-gradient(135deg, #4ecdc4 0%, #44a08d 100%);
            color: white;
            padding: 20px;
            text-align: center;
            position: relative;
        }

        .header h1 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 5px;
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
        }

        .back-btn:hover {
            background: white;
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
            background: linear-gradient(135deg, #4ecdc4, #44a08d);
            color: white;
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
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
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
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: white;
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
            color: #333;
            margin-bottom: 8px;
        }

        .menu-info p {
            font-size: 15px;
            color: #666;
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .menu-price {
            font-size: 18px;
            font-weight: 700;
            color: #4ecdc4;
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
            background: #d4edda;
            color: #155724;
        }

        .status-inactive {
            background: #f8d7da;
            color: #721c24;
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
            background: #d4edda;
            color: #155724;
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
            color: #666;
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
    </script>
</body>

</html>

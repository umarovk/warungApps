<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >
    <title>Kelola Order - Warung Dashboard</title>
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
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
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            padding: 10px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 18px;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            padding-bottom: 100px;
        }

        .add-btn {
            background: linear-gradient(135deg, #4ecdc4, #44a08d);
            color: white;
            border: none;
            padding: 15px 25px;
            border-radius: 25px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(78, 205, 196, 0.3);
        }

        .order-list {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .order-item {
            padding: 20px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .order-info h3 {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }

        .order-info p {
            font-size: 14px;
            color: #666;
            margin-bottom: 3px;
        }

        .order-status {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-processing {
            background: #d1ecf1;
            color: #0c5460;
        }

        .status-completed {
            background: #d4edda;
            color: #155724;
        }

        .order-items-preview {
            margin-top: 8px;
        }

        .order-items-preview small {
            display: block;
            color: #666;
            font-size: 11px;
            line-height: 1.3;
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

        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 500;
            border: 1px solid #f5c6cb;
        }

        .order-actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .delete-btn {
            background: #dc3545;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .delete-btn:hover {
            background: #c82333;
            transform: scale(1.05);
        }
    </style>
</head>

<body>
    <div class="header">
        <a
            href="{{ route('dashboard') }}"
            class="back-btn"
        >←</a>
        <h1>Kelola Order</h1>
        <p>Daftar pesanan pelanggan</p>
    </div>

    <div class="container">
        @if (session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="error-message">
                {{ session('error') }}
            </div>
        @endif

        <a
            href="{{ route('orders.create') }}"
            class="add-btn"
        >
            + Tambah Order Baru
        </a>

        <div class="order-list">
            @if (isset($orders) && count($orders) > 0)
                @foreach ($orders as $order)
                    <div class="order-item">
                        <div class="order-info">
                            <h3>Order #{{ $order->id }}</h3>
                            <p>Pelanggan: {{ $order->customer_name }}</p>
                            @if ($order->table_number)
                                <p>Meja: {{ $order->table_number }}</p>
                            @endif
                            <p>Total: {{ $order->formatted_total }}</p>
                            <p>Waktu: {{ $order->created_at->format('d/m/Y H:i') }}</p>
                            <div class="order-items-preview">
                                @foreach ($order->items->take(2) as $item)
                                    <small>{{ $item->quantity }}x {{ $item->menu->nama }}</small>
                                @endforeach
                                @if ($order->items->count() > 2)
                                    <small>+{{ $order->items->count() - 2 }} item lainnya</small>
                                @endif
                            </div>
                        </div>
                        <div class="order-actions">
                            <div class="order-status status-{{ $order->status }}">
                                {{ $order->status_label }}
                            </div>
                            <button
                                onclick="deleteOrder({{ $order->id }}, '{{ $order->customer_name }}')"
                                class="delete-btn"
                                title="Hapus Order"
                            >
                                🗑️
                            </button>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="empty-state">
                    <h3>Belum ada order</h3>
                    <p>Mulai dengan menambahkan order baru untuk pelanggan Anda</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        function deleteOrder(id, customerName) {
            if (confirm(`Apakah Anda yakin ingin menghapus order untuk "${customerName}"?`)) {
                // Create form for delete
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/orders/${id}`;

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

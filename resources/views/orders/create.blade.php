<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >
    <title>Tambah Order - Warung Dashboard</title>
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
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
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
        }

        .form-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .form-input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e1e5e9;
            border-radius: 10px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        .form-input:focus {
            outline: none;
            border-color: #ff6b6b;
        }

        .menu-section {
            margin-bottom: 30px;
        }

        .category-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #ff6b6b;
        }

        .menu-grid {
            display: grid;
            gap: 15px;
        }

        .menu-item {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 15px;
            border: 2px solid transparent;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .menu-item:hover {
            border-color: #ff6b6b;
            background: white;
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.1);
        }

        .menu-item.selected {
            border-color: #ff6b6b;
            background: #fff5f5;
        }

        .menu-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 10px;
        }

        .menu-image {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
            flex-shrink: 0;
            overflow: hidden;
        }

        .menu-info {
            flex: 1;
        }

        .menu-name {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-bottom: 3px;
        }

        .menu-price {
            font-size: 14px;
            font-weight: 700;
            color: #ff6b6b;
        }

        .menu-description {
            font-size: 12px;
            color: #666;
            margin-bottom: 10px;
            line-height: 1.4;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            gap: 10px;
            justify-content: space-between;
        }

        .quantity-btn {
            background: #ff6b6b;
            color: white;
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            font-size: 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .quantity-btn:hover {
            background: #ee5a24;
            transform: scale(1.1);
        }

        .quantity-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
        }

        .quantity-input {
            width: 50px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 5px;
            font-size: 14px;
        }

        .order-summary {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            bottom: 20px;
        }

        .summary-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
            text-align: center;
        }

        .order-items {
            margin-bottom: 20px;
        }

        .order-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .item-name {
            font-size: 14px;
            color: #333;
        }

        .item-quantity {
            font-size: 12px;
            color: #666;
        }

        .item-total {
            font-size: 14px;
            font-weight: 600;
            color: #ff6b6b;
        }

        .total-section {
            border-top: 2px solid #ff6b6b;
            padding-top: 15px;
            margin-top: 15px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .total-label {
            font-size: 16px;
            font-weight: 600;
            color: #333;
        }

        .total-amount {
            font-size: 20px;
            font-weight: 700;
            color: #ff6b6b;
        }

        .submit-btn {
            background: linear-gradient(135deg, #ff6b6b, #ee5a24);
            color: white;
            border: none;
            padding: 15px 25px;
            border-radius: 25px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            margin-top: 15px;
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 107, 107, 0.4);
        }

        .submit-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .empty-cart {
            text-align: center;
            color: #666;
            padding: 20px;
        }

        @media (max-width: 480px) {
            .menu-image {
                width: 40px;
                height: 40px;
                font-size: 16px;
            }

            .menu-name {
                font-size: 14px;
            }

            .menu-price {
                font-size: 12px;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <a
            href="{{ route('orders.index') }}"
            class="back-btn"
        >←</a>
        <h1>Tambah Order</h1>
        <p>Pilih menu untuk order baru</p>
    </div>

    <div class="container">
        <div class="form-card">
            <div class="form-group">
                <label
                    for="customer_name"
                    class="form-label"
                >Nama Pelanggan *</label>
                <input
                    type="text"
                    id="customer_name"
                    name="customer_name"
                    class="form-input"
                    required
                >
            </div>

            <div class="form-group">
                <label
                    for="table_number"
                    class="form-label"
                >Nomor Meja</label>
                <input
                    type="number"
                    id="table_number"
                    name="table_number"
                    class="form-input"
                    min="1"
                    placeholder="Opsional"
                >
            </div>
        </div>

        <!-- Menu Sections -->
        @foreach ($categories as $category => $menus)
            <div class="form-card menu-section">
                <h3 class="category-title">
                    @if ($category == 'makanan')
                        🍽️ Makanan
                    @else
                        🥤 Minuman
                    @endif
                </h3>

                <div class="menu-grid">
                    @foreach ($menus as $menu)
                        <div
                            class="menu-item"
                            data-menu-id="{{ $menu->id }}"
                            data-price="{{ $menu->harga }}"
                        >
                            <div class="menu-header">
                                <div class="menu-image">
                                    @if ($menu->image_url)
                                        <img
                                            src="{{ $menu->image_url }}"
                                            alt="{{ $menu->nama }}"
                                            style="width: 100%; height: 100%; object-fit: cover;"
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
                                    <div class="menu-name">{{ $menu->nama }}</div>
                                    <div class="menu-price">{{ $menu->formatted_harga }}</div>
                                </div>
                            </div>

                            @if ($menu->deskripsi)
                                <div class="menu-description">{{ $menu->deskripsi }}</div>
                            @endif

                            <div class="quantity-control">
                                <button
                                    type="button"
                                    class="quantity-btn"
                                    onclick="decreaseQuantity({{ $menu->id }})"
                                    disabled
                                >-</button>
                                <input
                                    type="number"
                                    class="quantity-input"
                                    id="qty-{{ $menu->id }}"
                                    value="0"
                                    min="0"
                                    max="99"
                                    onchange="updateQuantity({{ $menu->id }})"
                                >
                                <button
                                    type="button"
                                    class="quantity-btn"
                                    onclick="increaseQuantity({{ $menu->id }})"
                                >+</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <!-- Order Summary -->
        <div class="order-summary">
            <h3 class="summary-title">Ringkasan Order</h3>

            <div
                class="order-items"
                id="orderItems"
            >
                <div class="empty-cart">Belum ada item yang dipilih</div>
            </div>

            <div class="total-section">
                <div class="total-row">
                    <span class="total-label">Total:</span>
                    <span
                        class="total-amount"
                        id="totalAmount"
                    >Rp 0</span>
                </div>
            </div>

            <button
                type="button"
                class="submit-btn"
                id="submitBtn"
                onclick="submitOrder()"
                disabled
            >
                Buat Order
            </button>
        </div>
    </div>

    <script>
        let orderItems = {};
        let menuData = {};

        // Initialize menu data
        @foreach ($categories as $category => $menus)
            @foreach ($menus as $menu)
                menuData[{{ $menu->id }}] = {
                    id: {{ $menu->id }},
                    name: '{{ $menu->nama }}',
                    price: {{ $menu->harga }},
                    formattedPrice: '{{ $menu->formatted_harga }}'
                };
            @endforeach
        @endforeach

        function increaseQuantity(menuId) {
            const input = document.getElementById(`qty-${menuId}`);
            const currentQty = parseInt(input.value) || 0;
            input.value = currentQty + 1;
            updateQuantity(menuId);
        }

        function decreaseQuantity(menuId) {
            const input = document.getElementById(`qty-${menuId}`);
            const currentQty = parseInt(input.value) || 0;
            if (currentQty > 0) {
                input.value = currentQty - 1;
                updateQuantity(menuId);
            }
        }

        function updateQuantity(menuId) {
            const input = document.getElementById(`qty-${menuId}`);
            const quantity = parseInt(input.value) || 0;
            const menuItem = document.querySelector(`[data-menu-id="${menuId}"]`);
            const decreaseBtn = menuItem.querySelector('.quantity-btn');

            // Update button states
            decreaseBtn.disabled = quantity <= 0;

            // Update menu item appearance
            if (quantity > 0) {
                menuItem.classList.add('selected');
                orderItems[menuId] = {
                    ...menuData[menuId],
                    quantity: quantity,
                    total: menuData[menuId].price * quantity
                };
            } else {
                menuItem.classList.remove('selected');
                delete orderItems[menuId];
            }

            updateOrderSummary();
        }

        function updateOrderSummary() {
            const orderItemsContainer = document.getElementById('orderItems');
            const totalAmountElement = document.getElementById('totalAmount');
            const submitBtn = document.getElementById('submitBtn');

            let total = 0;
            let itemsHtml = '';

            if (Object.keys(orderItems).length === 0) {
                itemsHtml = '<div class="empty-cart">Belum ada item yang dipilih</div>';
            } else {
                for (const [menuId, item] of Object.entries(orderItems)) {
                    total += item.total;
                    itemsHtml += `
                        <div class="order-item">
                            <div>
                                <div class="item-name">${item.name}</div>
                                <div class="item-quantity">${item.quantity}x @ ${item.formattedPrice}</div>
                            </div>
                            <div class="item-total">Rp ${item.total.toLocaleString()}</div>
                        </div>
                    `;
                }
            }

            orderItemsContainer.innerHTML = itemsHtml;
            totalAmountElement.textContent = `Rp ${total.toLocaleString()}`;
            submitBtn.disabled = total === 0;
        }

        function submitOrder() {
            const customerName = document.getElementById('customer_name').value.trim();
            const tableNumber = document.getElementById('table_number').value;

            if (!customerName) {
                alert('Nama pelanggan harus diisi!');
                return;
            }

            if (Object.keys(orderItems).length === 0) {
                alert('Pilih minimal satu menu!');
                return;
            }

            // Create form data
            const formData = new FormData();
            formData.append('customer_name', customerName);
            formData.append('table_number', tableNumber);
            formData.append('items', JSON.stringify(orderItems));
            formData.append('total', Object.values(orderItems).reduce((sum, item) => sum + item.total, 0));
            formData.append('_token', '{{ csrf_token() }}');

            // Submit order
            fetch('{{ route('orders.store') }}', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Order berhasil dibuat!');
                        window.location.href = '{{ route('orders.index') }}';
                    } else {
                        alert('Gagal membuat order: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat membuat order');
                });
        }
    </script>
</body>

</html>

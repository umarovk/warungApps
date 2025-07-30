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
        :root {
            --primary-bg: #f5f5f5;
            --primary-text: #222;
            --header-bg: #b9b9b9;
            --header-text: #fff;
            --card-bg: #fff;
            --card-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            --form-label: #333;
            --form-input-bg: #fff;
            --form-input-border: #e1e5e9;
            --form-input-focus: #ff6b6b;
            --menu-bg: #f8f9fa;
            --menu-border: transparent;
            --menu-hover-bg: #fff;
            --menu-hover-border: #ff6b6b;
            --menu-selected-bg: #fff5f5;
            --menu-selected-border: #ff6b6b;
            --menu-name: #333;
            --menu-price: #ff6b6b;
            --menu-desc: #666;
            --order-summary-bg: #fff;
            --order-summary-title: #333;
            --order-summary-label: #333;
            --order-summary-amount: #373737;
            --order-summary-item: #333;
            --order-summary-qty: #666;
            --submit-btn-bg: linear-gradient(135deg, #ff6b6b, #ee5a24);
            --submit-btn-text: #fff;
            --success-bg: #4CAF50;
            --success-text: #fff;
        }

        body.dark-mode {
            --primary-bg: #181a20;
            --primary-text: #f4f4f4;
            --header-bg: #23262f;
            --header-text: #fff;
            --card-bg: #23262f;
            --card-shadow: 0 2px 10px rgba(0, 0, 0, 0.25);
            --form-label: #f4f4f4;
            --form-input-bg: #23262f;
            --form-input-border: #444;
            --form-input-focus: #764ba2;
            --menu-bg: #23262f;
            --menu-border: #23262f;
            --menu-hover-bg: #23262f;
            --menu-hover-border: #764ba2;
            --menu-selected-bg: #23262f;
            --menu-selected-border: #764ba2;
            --menu-name: #f4f4f4;
            --menu-price: #ffb86b;
            --menu-desc: #bbb;
            --order-summary-bg: #23262f;
            --order-summary-title: #fff;
            --order-summary-label: #fff;
            --order-summary-amount: #ffb86b;
            --order-summary-item: #fff;
            --order-summary-qty: #bbb;
            --submit-btn-bg: linear-gradient(135deg, #764ba2, #667eea);
            --submit-btn-text: #fff;
            --success-bg: #4CAF50;
            --success-text: #fff;
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
            padding: 15px 20px;
            text-align: center;
            position: relative;
        }

        .header h1 {
            margin: 0 0 5px 0;
            font-size: 24px;
        }

        .header p {
            margin: 0;
            font-size: 14px;
            opacity: 0.9;
        }

        .theme-toggle {
            position: absolute;
            top: 15px;
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
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            padding-bottom: 40px;
        }

        .form-card {
            background: var(--card-bg);
            border-radius: 15px;
            padding: 25px;
            box-shadow: var(--card-shadow);
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: var(--form-label);
            margin-bottom: 8px;
        }

        .form-input {
            width: 100%;
            padding: 12px 15px;
            background: var(--form-input-bg);
            border: 2px solid var(--form-input-border);
            border-radius: 10px;
            font-size: 16px;
            transition: border-color 0.3s;
            color: var(--primary-text);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--form-input-focus);
        }

        .menu-section {
            margin-bottom: 30px;
        }

        .category-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--menu-name);
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #ff6b6b;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        /* Mobile Layout - Single Column */
        @media (max-width: 767px) {
            .menu-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }
        }

        /* Tablet Layout */
        @media (min-width: 768px) and (max-width: 1023px) {
            .menu-grid {
                grid-template-columns: 1fr 1fr;
                gap: 15px;
            }

            .container {
                max-width: 700px;
            }

            .form-card {
                padding: 25px;
            }

            .menu-item {
                padding: 12px;
            }

            .menu-image {
                width: 45px;
                height: 45px;
                font-size: 18px;
            }

            .menu-name {
                font-size: 15px;
            }

            .menu-price {
                font-size: 13px;
            }

            .menu-description {
                font-size: 11px;
                margin-bottom: 8px;
            }

            .quantity-btn {
                width: 28px;
                height: 28px;
                font-size: 16px;
            }

            .quantity-input {
                width: 45px;
                font-size: 13px;
            }
        }

        /* Desktop Layout */
        @media (min-width: 1024px) {
            .menu-grid {
                grid-template-columns: 1fr 1fr;
                gap: 25px;
            }

            .container {
                max-width: 1000px;
            }

            .form-card {
                padding: 30px;
            }
        }

        /* Large Desktop Layout */
        @media (min-width: 1024px) {
            .container {
                max-width: 1000px;
            }

            .menu-grid {
                gap: 25px;
            }
        }

        .menu-item {
            background: var(--menu-bg);
            border-radius: 12px;
            padding: 15px;
            border: 2px solid var(--menu-border);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .menu-item:hover {
            border-color: var(--menu-hover-border);
            background: var(--menu-hover-bg);
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.1);
        }

        .menu-item.selected {
            border-color: var(--menu-selected-border);
            background: var(--menu-selected-bg);
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
            color: var(--menu-name);
            margin-bottom: 3px;
        }

        .menu-price {
            font-size: 14px;
            font-weight: 700;
            color: var(--menu-price);
        }

        .menu-description {
            font-size: 12px;
            color: var(--menu-desc);
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
            background: var(--form-input-bg);
            color: var(--primary-text);
        }

        .order-summary {
            background: var(--order-summary-bg);
            border-radius: 15px;
            padding: 25px;
            box-shadow: var(--card-shadow);
            margin-top: 20px;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Responsive order summary for larger screens */
        @media (min-width: 768px) {
            .order-summary {
                max-width: 500px;
                padding: 30px;
            }
        }

        .summary-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--order-summary-title);
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
            color: var(--order-summary-item);
        }

        .item-quantity {
            font-size: 12px;
            color: var(--order-summary-qty);
        }

        .item-total {
            font-size: 14px;
            font-weight: 600;
            color: var(--order-summary-amount);
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
            color: var(--order-summary-label);
        }

        .total-amount {
            font-size: 20px;
            font-weight: 700;
            color: var(--order-summary-amount);
        }

        .payment-section {
            border-top: 1px solid #eee;
            padding-top: 15px;
            margin-top: 15px;
        }

        .payment-input {
            width: 95%;
            padding: 12px 15px;
            background: var(--form-input-bg);
            border: 2px solid var(--form-input-border);
            border-radius: 10px;
            font-size: 16px;
            transition: border-color 0.3s;
            color: var(--primary-text);
            margin-bottom: 10px;
        }

        .payment-input:focus {
            outline: none;
            border-color: var(--form-input-focus);
        }

        .change-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
            padding: 8px 0;
            border-top: 1px solid #eee;
        }

        .change-label {
            font-size: 14px;
            font-weight: 600;
            color: var(--order-summary-label);
        }

        .change-amount {
            font-size: 18px;
            font-weight: 700;
            color: #28a745;
        }

        .change-amount.negative {
            color: #dc3545;
        }

        .quick-payment-buttons {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
            flex-wrap: wrap;
        }

        .quick-payment-btn {
            background: linear-gradient(135deg, #4ecdc4, #44a08d);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(78, 205, 196, 0.3);
        }

        .quick-payment-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(78, 205, 196, 0.4);
        }

        .quick-payment-btn:active {
            transform: translateY(0);
        }

        .submit-btn {
            background: var(--submit-btn-bg);
            color: var(--submit-btn-text);
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

        .success-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .success-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        .success-icon {
            background: var(--success-bg);
            color: var(--success-text);
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            animation: scaleIn 0.3s ease;
        }

        @keyframes scaleIn {
            0% {
                transform: scale(0);
            }

            50% {
                transform: scale(1.2);
            }

            100% {
                transform: scale(1);
            }
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
            href="{{ route('dashboard') }}"
            class="back-btn"
        >←</a>
        <button
            class="theme-toggle"
            id="theme-toggle"
        >🌙 Dark Mode</button>
        <h1>Tambah Order</h1>
        <p>Pilih menu untuk order baru</p>
    </div>



    <div class="container">


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
                                    onfocus="if(this.value == 0) this.value='';"
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




    </div>

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

        <div class="payment-section">
            <div class="form-label">Jumlah Uang yang Dibayarkan:</div>

            <div class="quick-payment-buttons">
                {{-- <button
                    type="button"
                    class="quick-payment-btn"
                    onclick="addPayment(10000)"
                >
                    💰 2K
                </button>
                <button
                    type="button"
                    class="quick-payment-btn"
                    onclick="addPayment(20000)"
                >
                    💰 5K
                </button>
                <button
                    type="button"
                    class="quick-payment-btn"
                    onclick="addPayment(10000)"
                >
                    💰 10K
                </button> --}}
                <button
                    type="button"
                    class="quick-payment-btn"
                    onclick="addPayment(20000)"
                >
                    💰 20K
                </button>
                <button
                    type="button"
                    class="quick-payment-btn"
                    onclick="addPayment(50000)"
                >
                    💰 50K
                </button>
                <button
                    type="button"
                    class="quick-payment-btn"
                    onclick="addPayment(100000)"
                >
                    💰 100K
                </button>
            </div>

            <input
                type="number"
                class="payment-input"
                id="paymentAmount"
                placeholder="Masukkan jumlah uang"
                min="0"
                oninput="calculateChange()"
                onfocus="if(this.value == 0) this.value='';"
            >

            <div class="change-row">
                <span class="change-label">Kembalian:</span>
                <span
                    class="change-amount"
                    id="changeAmount"
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

    <!-- Success Overlay -->
    <div
        class="success-overlay"
        id="successOverlay"
    >
        <div class="success-icon">
            ✓
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

            // Recalculate change when total changes
            calculateChange();
        }

        function addPayment(amount) {
            const paymentInput = document.getElementById('paymentAmount');
            const currentPayment = parseInt(paymentInput.value) || 0;
            const newPayment = currentPayment + amount;

            paymentInput.value = newPayment;
            calculateChange();

            // Add visual feedback
            const button = event.target;
            button.style.transform = 'scale(0.95)';
            setTimeout(() => {
                button.style.transform = '';
            }, 150);
        }

        function calculateChange() {
            const totalAmountElement = document.getElementById('totalAmount');
            const paymentInput = document.getElementById('paymentAmount');
            const changeAmountElement = document.getElementById('changeAmount');

            // Get total from the global variable instead of parsing text
            let total = 0;
            for (const [menuId, item] of Object.entries(orderItems)) {
                total += item.total;
            }

            const payment = parseInt(paymentInput.value) || 0;
            const change = payment - total;

            if (payment === 0) {
                changeAmountElement.textContent = 'Rp 0';
                changeAmountElement.className = 'change-amount';
            } else if (change >= 0) {
                changeAmountElement.textContent = `Rp ${change.toLocaleString()}`;
                changeAmountElement.className = 'change-amount';
            } else {
                changeAmountElement.textContent = `Kurang Rp ${Math.abs(change).toLocaleString()}`;
                changeAmountElement.className = 'change-amount negative';
            }
        }

        function submitOrder() {
            if (Object.keys(orderItems).length === 0) {
                alert('Pilih minimal satu menu!');
                return;
            }

            // Check if payment is sufficient
            const paymentInput = document.getElementById('paymentAmount');

            let total = 0;
            for (const [menuId, item] of Object.entries(orderItems)) {
                total += item.total;
            }

            const payment = parseInt(paymentInput.value) || 0;

            if (payment < total) {
                alert('Jumlah pembayaran kurang! Silakan masukkan jumlah yang cukup.');
                paymentInput.focus();
                return;
            }

            // Create form data
            const formData = new FormData();
            formData.append('items', JSON.stringify(orderItems));
            formData.append('total', total);
            formData.append('payment_amount', payment);
            formData.append('change_amount', payment - total);
            formData.append('_token', '{{ csrf_token() }}');

            // Submit order
            fetch('{{ route('orders.store') }}', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show success overlay
                        const overlay = document.getElementById('successOverlay');
                        overlay.classList.add('show');

                        // Redirect to dashboard after 0.5 seconds
                        setTimeout(() => {
                            window.location.href = '{{ route('orders.create') }}';
                        }, 500);
                    } else {
                        alert('Gagal membuat order: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat membuat order');
                });
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

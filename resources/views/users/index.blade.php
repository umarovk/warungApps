<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >
    <title>Kelola User - Warung Dashboard</title>
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
            background: linear-gradient(135deg, #45b7d1 0%, #96c93d 100%);
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

        .add-btn {
            background: linear-gradient(135deg, #45b7d1, #96c93d);
            color: white;
            border: none;
            padding: 15px 25px;
            border-radius: 25px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(69, 183, 209, 0.3);
        }

        .user-list {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .user-item {
            padding: 20px;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-item:last-child {
            border-bottom: none;
        }

        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
            font-weight: 600;
        }

        .user-info {
            flex: 1;
        }

        .user-info h3 {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-bottom: 3px;
        }

        .user-info p {
            font-size: 14px;
            color: #666;
            margin-bottom: 3px;
        }

        .user-role {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .role-admin {
            background: #d1ecf1;
            color: #0c5460;
        }

        .role-cashier {
            background: #d4edda;
            color: #155724;
        }

        .role-waiter {
            background: #fff3cd;
            color: #856404;
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
    </style>
</head>

<body>
    <div class="header">
        <a
            href="{{ route('dashboard') }}"
            class="back-btn"
        >←</a>
        <h1>Kelola User</h1>
        <p>Daftar pengguna sistem</p>
    </div>

    <div class="container">
        <a
            href="{{ route('users.create') }}"
            class="add-btn"
        >
            + Tambah User Baru
        </a>

        <div class="user-list">
            @if (isset($users) && count($users) > 0)
                @foreach ($users as $user)
                    <div class="user-item">
                        <div class="user-avatar">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div class="user-info">
                            <h3>{{ $user->name }}</h3>
                            <p>{{ $user->email }}</p>
                            <p>Bergabung: {{ $user->created_at->format('d M Y') }}</p>
                        </div>
                        <div class="user-role role-{{ $user->role }}">
                            {{ $user->role }}
                        </div>
                    </div>
                @endforeach
            @else
                <div class="empty-state">
                    <h3>Belum ada user</h3>
                    <p>Mulai dengan menambahkan user baru untuk sistem Anda</p>
                </div>
            @endif
        </div>
    </div>
</body>

</html>

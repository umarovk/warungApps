<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >
    <title>Login - Warung Dashboard</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            background: white;
            border-radius: 20px;
            padding: 40px 30px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .login-header {
            margin-bottom: 30px;
        }

        .login-header h1 {
            font-size: 28px;
            font-weight: 700;
            color: #333;
            margin-bottom: 8px;
        }

        .login-header p {
            font-size: 16px;
            color: #666;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
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
            padding: 15px;
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-input:focus {
            outline: none;
            border-color: #4ecdc4;
            background: white;
            box-shadow: 0 0 0 3px rgba(78, 205, 196, 0.1);
        }

        .login-btn {
            width: 100%;
            background: linear-gradient(135deg, #4ecdc4, #44a08d);
            color: white;
            border: none;
            padding: 15px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(78, 205, 196, 0.4);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            border: 1px solid #f5c6cb;
        }

        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            border: 1px solid #c3e6cb;
        }

        .divider {
            margin: 25px 0;
            display: flex;
            align-items: center;
            color: #999;
            font-size: 14px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e1e5e9;
        }

        .divider::before {
            margin-right: 15px;
        }

        .divider::after {
            margin-left: 15px;
        }

        .demo-info {
            background: #e3f2fd;
            color: #1976d2;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
            font-size: 13px;
            line-height: 1.5;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 30px 20px;
            }

            .login-header h1 {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-header">
            <h1>Warung Bu Saemah</h1>
            <p>Silakan login untuk melanjutkan</p>
        </div>

        @if ($errors->any())
            <div class="error-message">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        @if (session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <form
            method="POST"
            action="{{ route('login') }}"
        >
            @csrf

            <div class="form-group">
                <label
                    for="username"
                    class="form-label"
                >Username</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    class="form-input"
                    value="{{ old('username') }}"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <label
                    for="password"
                    class="form-label"
                >Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-input"
                    required
                >
            </div>

            <button
                type="submit"
                class="login-btn"
            >
                Masuk
            </button>
        </form>

        <div class="divider">atau</div>

        <div class="demo-info">
            <strong>Demo Account:</strong><br>
            Username: admin<br>
            Password: password123
        </div>
    </div>
</body>

</html>

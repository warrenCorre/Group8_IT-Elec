<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Group 8</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            background: #1a1a1a;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 450px;
        }

        .login-card {
            background: #2d2d2d;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            animation: slideUp 0.5s ease;
            border: 1px solid #3a3a3a;
            border-top: 4px solid #4a7856;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h1 {
            font-size: 2.5rem;
            color: #ffffff;
            margin-bottom: 10px;
        }

        .login-header p {
            color: #cccccc;
            font-size: 0.95rem;
        }

        .admin-badge {
            display: inline-block;
            padding: 8px 20px;
            background: #4a7856;
            color: white;
            border-radius: 30px;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 20px;
            box-shadow: 0 4px 10px rgba(74, 120, 86, 0.3);
        }

        .admin-icon {
            font-size: 3rem;
            color: #4a7856;
            margin-bottom: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #ffffff;
            font-size: 0.95rem;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #3a3a3a;
            background: #1a1a1a;
            color: #ffffff;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: #4a7856;
            box-shadow: 0 0 0 3px rgba(74, 120, 86, 0.2);
        }

        .form-control::placeholder {
            color: #666;
        }

        .password-field {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #cccccc;
            transition: color 0.3s;
        }

        .toggle-password:hover {
            color: #4a7856;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #cccccc;
            font-size: 0.9rem;
            cursor: pointer;
        }

        .remember-me input[type="checkbox"] {
            width: 16px;
            height: 16px;
            cursor: pointer;
            accent-color: #4a7856;
            background: #1a1a1a;
        }

        .forgot-password {
            color: #4a7856;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: color 0.3s;
        }

        .forgot-password:hover {
            color: #5d8f6b;
            text-decoration: underline;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: #4a7856;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-bottom: 20px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            background: #5d8f6b;
            box-shadow: 0 10px 20px rgba(74, 120, 86, 0.3);
        }

        .alert {
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 0.95rem;
        }

        .alert-danger {
            background: #2d2d2d;
            color: #ff6b6b;
            border: 1px solid #ff6b6b;
        }

        .alert-success {
            background: #2d2d2d;
            color: #4a7856;
            border: 1px solid #4a7856;
        }

        .admin-note {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #3a3a3a;
        }

        .admin-note p {
            color: #cccccc;
            font-size: 0.85rem;
        }

        .admin-note a {
            color: #4a7856;
            text-decoration: none;
        }

        .admin-note a:hover {
            text-decoration: underline;
        }

        .back-home {
            text-align: center;
            margin-top: 20px;
        }

        .back-home a {
            color: #cccccc;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s;
        }

        .back-home a:hover {
            color: #4a7856;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="admin-badge">ADMIN PORTAL</div>
             
                <h1>Admin Login</h1>
                <p>Secure access for administrators only</p>
            </div>

            @if($errors->any())
    <div class="alert alert-danger">
        {{ $errors->first() }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                
                <div class="form-group">
                    <label class="form-label">Admin Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Enter admin email" required autofocus>
                </div>

                <div class="form-group">
                    <label class="form-label">Admin Password</label>
                    <div class="password-field">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter admin password" required>
                        <span class="toggle-password" onclick="togglePassword()">👁️</span>
                    </div>
                </div>

                <div class="remember-forgot">
                    <label class="remember-me">
                        <input type="checkbox" name="remember"> Remember me
                    </label>
                    <a href="{{ route('password.request') }}" class="forgot-password">Forgot Password?</a>
                </div>

                <button type="submit" class="btn-login">Access Admin Panel</button>
            </form>

            <div class="admin-note">
                <p>Access Denied!.</p>
                <p><a href="{{ route('login') }}">← Back to Member Login</a></p>
            </div>
        </div>

        <div class="back-home">
            <a href="{{ url('/') }}">← Back to Home</a>
        </div>
    </div>

    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            const toggle = document.querySelector('.toggle-password');
            
            if (password.type === 'password') {
                password.type = 'text';
                toggle.textContent = '🔒';
            } else {
                password.type = 'password';
                toggle.textContent = '👁️';
            }
        }

        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>
</body>
</html>
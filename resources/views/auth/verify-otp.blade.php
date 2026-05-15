<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Code - Group 8</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #1a1a1a;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .container { width: 100%; max-width: 450px; }
        .card {
            background: #2d2d2d;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            border: 1px solid #3a3a3a;
            animation: slideUp 0.5s ease;
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .card-header { text-align: center; margin-bottom: 30px; }
        .badge {
            display: inline-block; padding: 8px 20px;
            background: #4a7856; color: white;
            border-radius: 30px; font-weight: 600;
            font-size: 0.9rem; margin-bottom: 16px;
        }
        .card-header h1 { font-size: 2rem; color: #fff; margin-bottom: 8px; }
        .card-header p  { color: #ccc; font-size: 0.95rem; }
        .email-badge {
            display: inline-block; background: #1a1a1a;
            color: #4a7856; padding: 4px 12px;
            border-radius: 20px; font-size: 0.9rem;
            border: 1px solid #4a7856; margin-top: 8px;
            word-break: break-all;
        }
        .form-group { margin-bottom: 20px; }
        .form-label { display: block; margin-bottom: 8px; font-weight: 600; color: #fff; font-size: 0.95rem; }
        .otp-input {
            width: 100%; padding: 16px 15px;
            border: 2px solid #3a3a3a;
            background: #1a1a1a; color: #fff;
            border-radius: 10px; font-size: 2rem;
            font-weight: 700; letter-spacing: 0.5rem;
            text-align: center; transition: all 0.3s;
        }
        .otp-input:focus { outline: none; border-color: #4a7856; box-shadow: 0 0 0 3px rgba(74,120,86,0.2); }
        .btn-submit {
            width: 100%; padding: 14px;
            background: #4a7856; color: white;
            border: none; border-radius: 10px;
            font-size: 1.1rem; font-weight: 600;
            cursor: pointer; transition: all 0.3s;
            margin-bottom: 20px;
        }
        .btn-submit:hover { transform: translateY(-2px); background: #5d8f6b; box-shadow: 0 10px 20px rgba(74,120,86,0.3); }
        .alert { padding: 12px 15px; border-radius: 10px; margin-bottom: 20px; font-size: 0.95rem; }
        .alert-danger  { background: #2d2d2d; color: #ff6b6b; border: 1px solid #ff6b6b; }
        .alert-success { background: #2d2d2d; color: #4a7856; border: 1px solid #4a7856; }
        .error-text { color: #ff6b6b; font-size: 0.85rem; margin-top: 6px; }
        .footer-note { text-align: center; margin-top: 20px; padding-top: 20px; border-top: 1px solid #3a3a3a; }
        .footer-note a { color: #4a7856; text-decoration: none; font-size: 0.9rem; }
        .footer-note a:hover { text-decoration: underline; }
        .back-home { text-align: center; margin-top: 20px; }
        .back-home a { color: #ccc; text-decoration: none; font-size: 0.9rem; transition: color 0.3s; }
        .back-home a:hover { color: #4a7856; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="badge">VERIFY CODE</div>
                <h1>Enter Your Code</h1>
                <p>We sent a 6-digit code to:</p>
                <div class="email-badge">{{ $email }}</div>
            </div>

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('password.verify-otp.submit') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label">6-Digit Code</label>
                    <input type="text" name="code" class="otp-input"
                           maxlength="6" pattern="\d{6}"
                           placeholder="000000"
                           autofocus autocomplete="one-time-code">
                    @error('code')
                        <p class="error-text">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn-submit">Verify Code</button>
            </form>

            <div class="footer-note">
                <p style="color:#ccc; font-size:0.9rem; margin-bottom:8px;">Didn't receive the code?</p>
                <a href="{{ route('password.request') }}">Request a new code</a>
            </div>
        </div>

        <div class="back-home">
            <a href="{{ url('/') }}">← Back to Home</a>
        </div>
    </div>
</body>
</html>
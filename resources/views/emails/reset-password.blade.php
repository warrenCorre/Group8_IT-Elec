<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            background-color: #1a1a1a;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #ccc;
            padding: 40px 20px;
        }
        .container {
            max-width: 560px;
            margin: 0 auto;
            background: #2d2d2d;
            border-radius: 16px;
            border: 1px solid #3a3a3a;
            overflow: hidden;
        }
        .header {
            background: #4a7856;
            padding: 36px 40px;
            text-align: center;
        }
        .header h1 { color: #fff; font-size: 22px; font-weight: 700; }
        .header p  { color: #d4edda; font-size: 14px; margin-top: 6px; }
        .body { padding: 36px 40px; }
        .greeting { font-size: 16px; color: #eee; margin-bottom: 16px; }
        .message  { font-size: 14px; color: #aaa; line-height: 1.7; margin-bottom: 28px; }
        .otp-box {
            text-align: center;
            margin: 28px 0;
            background: #1a1a1a;
            border: 2px solid #4a7856;
            border-radius: 12px;
            padding: 24px;
        }
        .otp-label { color: #aaa; font-size: 13px; margin-bottom: 10px; }
        .otp-code  { color: #4a7856; font-size: 42px; font-weight: 800; letter-spacing: 0.5rem; }
        .otp-expiry { color: #888; font-size: 12px; margin-top: 10px; }
        .warning {
            background: #3a2a00;
            border: 1px solid #f59e0b;
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 13px;
            color: #fbbf24;
            margin-bottom: 24px;
        }
        .divider { border: none; border-top: 1px solid #3a3a3a; margin: 24px 0; }
        .footer {
            background: #1a1a1a;
            padding: 20px 40px;
            text-align: center;
            font-size: 12px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Password Reset Code</h1>
            <p>{{ config('app.name') }}</p>
        </div>

        <div class="body">
            <p class="greeting">Hello, {{ $user->name }}!</p>

            <p class="message">
                We received a request to reset the password for your account associated with
                <strong style="color:#eee;">{{ $user->email }}</strong>.
                Use the code below to reset your password.
            </p>

            <div class="otp-box">
                <p class="otp-label">Your one-time reset code:</p>
                <p class="otp-code">{{ $otp }}</p>
                <p class="otp-expiry">⏱ This code expires in <strong>1 hour</strong></p>
            </div>

            <div class="warning">
                ⚠️ If you did not request a password reset, please ignore this email. Your account is still secure.
            </div>

            <hr class="divider">

            <p style="font-size:12px; color:#666; line-height:1.6;">
                Do not share this code with anyone. Group 8 staff will never ask for your OTP.
            </p>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} {{ config('app.name') }} · Automated email — please do not reply.
        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dream Team</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body {
            background: #1a1a1a;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            color: #ffffff;
        }

        .top-nav {
            background: #2d2d2d;
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.3);
            border-bottom: 2px solid #4a7856;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-sizing: border-box;
        }

        /* NEW: Flex container for brand + nav links */
        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .brand {
            color: white;
            text-decoration: none;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .nav-links {
            display: flex;
            justify-content: flex-end;
            list-style: none;
            gap: 2rem;
            margin: 0;
            padding: 0;
        }

        .nav-item {
            color: #ffffff;
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            transition: all 0.3s;
        }

        .nav-item:hover {
            color: #4a7856;
            background: rgba(74, 120, 86, 0.1);
        }

        .main-content {
            max-width: 1000px;
            margin: 150px auto 50px;
            padding: 0 20px;
            text-align: center;
        }

        .hero-section {
            background: #2d2d2d;
            border-radius: 20px;
            padding: 50px 40px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            border: 1px solid #3a3a3a;
            animation: fadeInUp 0.8s ease;
        }

        .main-title {
            font-size: 4rem;
            color: #ffffff;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

        .sub-title {
            font-size: 2rem;
            color: #4a7856;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .description {
            color: #cccccc;
            font-size: 1.2rem;
            line-height: 1.6;
            margin-bottom: 40px;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .button-container {
            margin-top: 30px;
        }

        .submit-btn {
            display: inline-block;
            padding: 12px 40px;
            background: #4a7856;
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(74, 120, 86, 0.3);
            border: none;
            cursor: pointer;
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            background: #5d8f6b;
            box-shadow: 0 8px 25px rgba(74, 120, 86, 0.4);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .nav-links {
                gap: 1rem;
            }
            .nav-item {
                padding: 0.4rem 0.8rem;
                font-size: 0.9rem;
            }
            .main-content {
                margin-top: 120px;
            }
            .hero-section {
                padding: 30px 20px;
            }
            .main-title {
                font-size: 3rem;
            }
            .sub-title {
                font-size: 1.5rem;
            }
            .description {
                font-size: 1rem;
            }
        }

        @media (max-width: 576px) {
            .nav-links {
                flex-wrap: wrap;
                justify-content: flex-end;
            }
            .main-title {
                font-size: 2.5rem;
            }
            .sub-title {
                font-size: 1.2rem;
            }
            .submit-btn {
                padding: 10px 30px;
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>

<!-- Navbar with Group 8 brand and Login button -->
<nav class="top-nav">
    <div class="nav-container">
        <!-- Brand: Group 8 -->
        <a href="{{ url('/') }}" class="brand">Group 8</a>

        <!-- Navigation links (right side) -->
        <ul class="nav-links">
            @auth
                @if(Auth::user()->is_admin == 1)
                    <li><a href="{{ route('admin.members.index') }}" class="nav-item">Admin Dashboard</a></li>
                @else
                    <li><a href="{{ route('dashboard') }}" class="nav-item">Dashboard</a></li>
                @endif
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-item" style="background: none; border: none; cursor: pointer;">Logout</button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('home') }}" class="nav-item">Home</a></li>
                <li><a href="{{ route('members.index') }}" class="nav-item">Members</a></li>
                <li><a href="{{ route('login') }}" class="nav-item">Login</a></li>   <!-- Added Login button -->
            @endauth
        </ul>
    </div>
</nav>

<div class="main-content">
    <div class="hero-section">
        <h1 class="main-title">Group 8</h1>
        <h2 class="sub-title">IT Elective 2</h2>
        <p class="description">Welcome to our digital page. We are a team of passionate IT students,<br>making cutting-edge electronic designs in technology.</p>
        
        <div class="button-container">
            <a href="{{ url('/members') }}" class="submit-btn">See Members</a>
        </div>
    </div>  
</div>
</body>
</html>
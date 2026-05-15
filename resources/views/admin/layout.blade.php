<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        /* ONLY COLORS CHANGED - LAYOUT/STRUCTURE UNTOUCHED */
        body {
            background: #1a1a1a; /* Changed from light gray to black */
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
        }
        
        /* Admin Navigation - colors only changed */
        .admin-nav {
            background: #2d2d2d; /* Changed from gradient to dark gray */
            padding: 1rem 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.3);
            border-bottom: 2px solid #4a7856; /* Moss green accent */
        }
        
        .admin-nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .admin-nav-logo {
            color: #ffffff; /* White */
            font-size: 1.5rem;
            font-weight: bold;
            text-decoration: none;
        }
        
        .admin-nav-links {
            display: flex;
            gap: 30px;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        
        .admin-nav-link {
            color: #ffffff; /* White */
            text-decoration: none;
            font-weight: 500;
            padding: 5px 10px;
            border-radius: 5px;
            transition: all 0.3s;
        }
        
        .admin-nav-link:hover {
            color: #4a7856; /* Moss green */
            background: rgba(74, 120, 86, 0.1);
        }
        
        .admin-nav-link.active {
            color: #4a7856; /* Moss green */
            border-bottom: 2px solid #4a7856;
            background: none;
        }
        
        .logout-btn {
            background: none;
            border: 1px solid #4a7856; /* Moss green */
            color: #ffffff; /* White */
            padding: 5px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .logout-btn:hover {
            background: #4a7856; /* Moss green */
            color: white;
        }
        
        /* Main Content */
        .admin-main {
            max-width: 1200px;
            margin: 100px auto 30px;
            padding: 0 20px;
        }
        
        /* Header - colors only changed */
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            background: #2d2d2d; /* Changed from white to dark gray */
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.3);
            border: 1px solid #3a3a3a;
        }
        
        .admin-title {
            font-size: 2rem;
            color: #ffffff; /* Changed from dark to white */
            margin: 0;
        }
        
        .admin-btn {
            padding: 10px 20px;
            background: #4a7856; /* Changed from gradient to solid moss green */
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .admin-btn:hover {
            background: #5d8f6b; /* Lighter moss green */
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(74, 120, 86, 0.3);
        }
        
        .admin-btn-danger {
            background: #2d2d2d; /* Dark gray */
            border: 1px solid #ff6b6b;
            color: #ff6b6b;
        }
        
        .admin-btn-danger:hover {
            background: #ff6b6b;
            color: white;
        }
        
        .admin-btn-small {
            padding: 5px 10px;
            font-size: 0.9rem;
        }
        
        .alert-success {
            background: #1a1a1a; /* Black */
            color: #4a7856; /* Moss green */
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #4a7856;
        }
        
        /* Table - colors only changed */
        .admin-table {
            background: #2d2d2d; /* Changed from white to dark gray */
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.3);
            border: 1px solid #3a3a3a;
        }
        
        .admin-table table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .admin-table th {
            background: #1a1a1a; /* Black */
            color: #4a7856; /* Moss green */
            padding: 15px;
            text-align: left;
            font-weight: 600;
            border-bottom: 2px solid #4a7856;
        }
        
        .admin-table td {
            padding: 15px;
            border-bottom: 1px solid #3a3a3a;
            vertical-align: middle;
            color: #cccccc; /* Light gray */
        }
        
        .admin-table tr:hover {
            background: #1a1a1a; /* Black on hover */
        }
        
        .admin-table tr:hover td {
            color: #ffffff; /* White on hover */
        }
        
        .member-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #4a7856; /* Moss green border */
        }
        
        .action-buttons {
            display: flex;
            gap: 5px;
        }
        
        /* Form - colors only changed */
        .admin-form {
            background: #2d2d2d; /* Dark gray */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.3);
            border: 1px solid #3a3a3a;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #ffffff; /* White */
        }
        
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #3a3a3a;
            background: #1a1a1a; /* Black */
            color: #ffffff; /* White */
            border-radius: 5px;
            font-size: 1rem;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            outline: none;
            border-color: #4a7856; /* Moss green */
            box-shadow: 0 0 0 3px rgba(74, 120, 86, 0.2);
        }
        
        .form-control::placeholder {
            color: #666;
        }
        
        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }
        
        .current-image {
            margin: 10px 0;
            text-align: center;
        }
        
        .current-image img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #4a7856; /* Moss green */
            background: #1a1a1a;
        }
        
        .error {
            color: #ff6b6b; /* Red for errors */
            font-size: 0.9rem;
            margin-top: 5px;
        }

        /* Additional text colors for forms */
        .form-control option {
            background: #1a1a1a;
            color: #ffffff;
        }

        /* Select dropdown styling */
        select.form-control {
            background: #1a1a1a;
            color: #ffffff;
        }

        /* Checkbox and radio styling */
        input[type="checkbox"], input[type="radio"] {
            accent-color: #4a7856; /* Moss green */
        }

        /* File input styling */
        input[type="file"]::file-selector-button {
            background: #4a7856;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="file"]::file-selector-button:hover {
            background: #5d8f6b;
        }

        /* Links in forms */
        .form-link {
            color: #4a7856;
            text-decoration: none;
        }

        .form-link:hover {
            color: #5d8f6b;
            text-decoration: underline;
        }

        /* Help text */
        .form-text {
            color: #666;
            font-size: 0.85rem;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <!-- Admin Navigation - structure unchanged -->
    <nav class="admin-nav">
        <div class="admin-nav-container">
            <a href="{{ route('admin.dashboard') }}" class="admin-nav-logo">Admin Panel</a>
            <ul class="admin-nav-links">
                <li><a href="{{ route('admin.members.index') }}" class="admin-nav-link {{ request()->routeIs('admin.members.*') ? 'active' : '' }}">Members</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="logout-btn">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content - structure unchanged -->
    <main class="admin-main">
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif
        
        @yield('content')
    </main>
</body>
</html>
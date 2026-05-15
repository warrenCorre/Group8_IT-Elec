<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Group 8</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        /* ── reset ── */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background: #1a1a1a; color: #fff; min-height: 100vh; display: flex; flex-direction: column; }

        /* ── top nav ── */
        .top-nav {
            background: #2d2d2d;
            border-bottom: 1px solid #3a3a3a;
            padding: 0 30px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .nav-brand { font-size: 1.2rem; font-weight: 700; color: #4a7856; letter-spacing: 0.5px; }
        .nav-brand span { color: #fff; }
        .nav-actions { display: flex; align-items: center; gap: 12px; }
        .nav-user { color: #ccc; font-size: 0.9rem; }
        .btn-logout {
            padding: 8px 18px;
            background: transparent;
            border: 1px solid #4a7856;
            color: #4a7856;
            border-radius: 8px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-logout:hover { background: #4a7856; color: #fff; }

        /* ── sidebar ── */
        .layout { display: flex; flex: 1; }
        .sidebar {
            width: 220px;
            background: #2d2d2d;
            border-right: 1px solid #3a3a3a;
            padding: 24px 0;
            min-height: calc(100vh - 64px);
        }
        .sidebar-section { padding: 0 16px; margin-bottom: 8px; color: #666; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; }
        .sidebar a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 20px;
            color: #ccc;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }
        .sidebar a:hover, .sidebar a.active {
            background: rgba(74,120,86,0.15);
            color: #4a7856;
            border-left-color: #4a7856;
        }

        /* ── main content ── */
        .main-content { flex: 1; padding: 30px; overflow-y: auto; }
        .page-header { margin-bottom: 24px; }
        .page-header h1 { font-size: 1.8rem; font-weight: 700; color: #fff; }
        .page-header p  { color: #888; margin-top: 4px; font-size: 0.9rem; }

        /* ── flash alerts ── */
        .alert { padding: 12px 16px; border-radius: 10px; margin-bottom: 20px; font-size: 0.9rem; }
        .alert-success { background: rgba(74,120,86,0.15); border: 1px solid #4a7856; color: #4a7856; }
        .alert-danger  { background: rgba(255,107,107,0.1); border: 1px solid #ff6b6b; color: #ff6b6b; }
    </style>
</head>
<body>
    {{-- Top nav --}}
    <nav class="top-nav">
        <div class="nav-brand">Group<span>8</span> &mdash; Admin</div>
        <div class="nav-actions">
            <span class="nav-user">{{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">Logout</button>
            </form>
        </div>
    </nav>

    <div class="layout">
        {{-- Sidebar --}}
        <aside class="sidebar">
            <p class="sidebar-section">Management</p>
            <a href="{{ route('admin.members.index') }}"
               class="{{ request()->routeIs('admin.members.*') ? 'active' : '' }}">
                👥 Members
            </a>
        </aside>

        {{-- Page content --}}
        <main class="main-content">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
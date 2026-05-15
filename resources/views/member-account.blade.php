<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account - Group 8</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body {
            background: #1a1a1a;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
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

        .nav-links {
            display: flex;
            justify-content: flex-end;
            list-style: none;
            gap: 2rem;
            max-width: 1200px;
            margin: 0 0 0 auto;
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
            max-width: 800px;
            margin: 100px auto 30px;
            padding: 0 20px;
        }

        .account-card {
            background: #2d2d2d;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            border: 1px solid #3a3a3a;
        }

        .card-header {
            padding: 20px 25px;
            border-bottom: 1px solid #3a3a3a;
            background: #1a1a1a;
        }

        .card-header h1 {
            margin: 0;
            font-size: 1.5rem;
            color: #ffffff;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-header i {
            color: #4a7856;
            font-size: 1.5rem;
        }

        .card-body {
            padding: 25px;
        }

        .avatar-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4a7856 0%, #2d5a39 100%);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            border: 3px solid #4a7856;
            box-shadow: 0 10px 20px rgba(74, 120, 86, 0.3);
        }

        .avatar span {
            font-size: 2.5rem;
            font-weight: bold;
            color: white;
        }

        .avatar-name {
            color: #ffffff;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .avatar-username {
            color: #cccccc;
            font-size: 0.9rem;
            margin-top: 5px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #ffffff;
            font-size: 0.9rem;
        }

        .form-label i {
            color: #4a7856;
            margin-right: 8px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #3a3a3a;
            background: #1a1a1a;
            color: #ffffff;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.2s;
        }

        .form-control:focus {
            outline: none;
            border-color: #4a7856;
            box-shadow: 0 0 0 3px rgba(74, 120, 86, 0.2);
        }

        .row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .alert-success {
            background: #1a1a1a;
            color: #4a7856;
            padding: 12px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #4a7856;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-save {
            background: #4a7856;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-save:hover {
            background: #5d8f6b;
            transform: translateY(-2px);
        }

        .btn-edit {
            background: #2d2d2d;
            color: #4a7856;
            border: 1px solid #4a7856;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-edit:hover {
            background: #4a7856;
            color: white;
            transform: translateY(-2px);
        }

        .button-group {
            display: flex;
            gap: 15px;
            margin-top: 25px;
        }

        .info-row {
            display: flex;
            padding: 12px 0;
            border-bottom: 1px solid #3a3a3a;
        }

        .info-label {
            width: 120px;
            color: #cccccc;
            font-weight: 500;
        }

        .info-value {
            flex: 1;
            color: #ffffff;
        }

        .info-value i {
            color: #4a7856;
            margin-right: 5px;
        }

        @media (max-width: 600px) {
            .row {
                grid-template-columns: 1fr;
                gap: 15px;
            }
            
            .nav-links {
                gap: 1rem;
            }
            
            .main-content {
                margin-top: 120px;
            }
            
            .info-row {
                flex-direction: column;
                gap: 5px;
            }
            
            .info-label {
                width: auto;
            }
        }
    </style>
</head>
<body>
    <nav class="top-nav">
        <ul class="nav-links">
            <li><a href="{{ route('home') }}" class="nav-item">Home</a></li>
            <li><a href="{{ route('members.index') }}" class="nav-item">Members</a></li>
            @auth
                @if(Auth::user()->is_admin == 1)
                    <li><a href="{{ route('admin.members.index') }}" class="nav-item">Admin Dashboard</a></li>
                @else
                    <li><a href="{{ route('dashboard') }}" class="nav-item">Dashboard</a></li>
                    <li><a href="{{ route('member.account') }}" class="nav-item">My Account</a></li>
                @endif
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-item" style="background: none; border: none; cursor: pointer;">Logout</button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}" class="nav-item">Login</a></li>
            @endauth
        </ul>
    </nav>

    <div class="main-content">
        <div class="account-card">
            <div class="card-header">
                <h1>
                    <i class="bi bi-person-circle"></i>
                    My Account
                </h1>
            </div>

            <div class="card-body">
                @if(session('success'))
                    <div class="alert-success">
                        <i class="bi bi-check-circle-fill"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Avatar Section -->
                <div class="avatar-section">
                    <div class="avatar">
                        <span>{{ strtoupper(substr($user->first_name ?? $user->username, 0, 1)) }}{{ strtoupper(substr($user->last_name ?? '', 0, 1)) }}</span>
                    </div>
                    <div class="avatar-name">{{ $user->first_name }} {{ $user->last_name }}</div>
                    <div class="avatar-username">@ {{ $user->username }}</div>
                </div>

                @if(!isset($editMode) || !$editMode)
                    <!-- View Mode -->
                    <div>
                        <div class="info-row">
                            <div class="info-label"><i class="bi bi-person"></i> First Name</div>
                            <div class="info-value">{{ $user->first_name ?? 'Not set' }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label"><i class="bi bi-person"></i> Last Name</div>
                            <div class="info-value">{{ $user->last_name ?? 'Not set' }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label"><i class="bi bi-envelope"></i> Email</div>
                            <div class="info-value">{{ $user->email }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label"><i class="bi bi-person-badge"></i> Username</div>
                            <div class="info-value">{{ $user->username }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label"><i class="bi bi-building"></i> Department</div>
                            <div class="info-value">{{ $user->department ?? 'Not set' }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label"><i class="bi bi-grid-3x3"></i> Block</div>
                            <div class="info-value">{{ $user->block ?? 'Not set' }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label"><i class="bi bi-calendar"></i> Member Since</div>
                            <div class="info-value">{{ $user->created_at ? $user->created_at->format('F d, Y') : 'N/A' }}</div>
                        </div>
                        
                        <div class="button-group">
                            <a href="{{ route('member.account.edit') }}" class="btn-edit">
                                <i class="bi bi-pencil"></i> Edit Profile
                            </a>
                        </div>
                    </div>
                @else
                    <!-- Edit Mode -->
                    <form action="{{ route('member.account.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="form-group">
                                <label class="form-label"><i class="bi bi-person"></i> First Name</label>
                                <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $user->first_name) }}" required>
                                @error('first_name') <small style="color: #ff6b6b;">{{ $message }}</small> @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label"><i class="bi bi-person"></i> Last Name</label>
                                <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $user->last_name) }}" required>
                                @error('last_name') <small style="color: #ff6b6b;">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <label class="form-label"><i class="bi bi-envelope"></i> Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                                @error('email') <small style="color: #ff6b6b;">{{ $message }}</small> @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label"><i class="bi bi-person-badge"></i> Username</label>
                                <input type="text" name="username" class="form-control" value="{{ old('username', $user->username) }}" required>
                                @error('username') <small style="color: #ff6b6b;">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <label class="form-label"><i class="bi bi-building"></i> Department</label>
                                <select name="department" class="form-control">
                                    <option value="BSIT" {{ ($user->department ?? 'BSIT') == 'BSIT' ? 'selected' : '' }}>BSIT</option>
                                    <option value="BSOA" {{ ($user->department ?? '') == 'BSOA' ? 'selected' : '' }}>BSOA</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label"><i class="bi bi-grid-3x3"></i> Block</label>
                                <select name="block" class="form-control">
                                    @for($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}" {{ ($user->block ?? '1') == $i ? 'selected' : '' }}>Block {{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="button-group">
                            <button type="submit" class="btn-save">
                                <i class="bi bi-check-lg"></i> Save Changes
                            </button>
                            <a href="{{ route('member.account') }}" class="btn-edit">
                                <i class="bi bi-x-lg"></i> Cancel
                            </a>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
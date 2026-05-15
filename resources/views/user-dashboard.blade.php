<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dashboard - Group 8</title>
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

        .dashboard-card {
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

        .welcome-section {
            background: #1a1a1a;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
            text-align: center;
            border: 1px solid #3a3a3a;
        }

        .welcome-section h2 {
            color: #ffffff;
            margin: 0 0 10px 0;
        }

        .welcome-section p {
            color: #cccccc;
            margin: 0;
        }

        /* Member Card - Same style as public members page */
        .member-card {
            background: #2d2d2d;
            border-radius: 12px;
            overflow: hidden;
            padding: 20px;
            border: 1px solid #3a3a3a;
        }

        .member-photo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 10px;
            border: 3px solid #4a7856;
            display: block;
        }

        .member-info {
            text-align: center;
        }

        .member-name {
            font-size: 1.5rem;
            font-weight: bold;
            color: #ffffff;
            margin-bottom: 5px;
        }

        .member-role {
            color: #4a7856;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 15px;
        }

        .member-bio {
            background: #1a1a1a;
            color: #ffffff;
            line-height: 1.5;
            font-size: 0.85rem;
            margin-bottom: 15px;
            padding: 12px;
            border-radius: 8px;
            text-align: left;
            border: 1px solid #3a3a3a;
        }

        .member-details {
            background: #1a1a1a;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
            text-align: left;
            border: 1px solid #3a3a3a;
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
            border-bottom: 1px dashed #3a3a3a;
        }

        .detail-item:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-size: 0.75rem;
            color: #4a7856;
            text-transform: uppercase;
            font-weight: 600;
        }

        .detail-value {
            font-weight: 500;
            color: #ffffff;
            font-size: 0.85rem;
        }

        .member-skills {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            justify-content: center;
            margin-top: 10px;
        }

        .skill-tag {
            background: #4a7856;
            color: white;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 500;
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
            justify-content: center;
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
            
            .detail-item {
                flex-direction: column;
                gap: 5px;
            }
        }
    </style>
</head>
<body>
    <nav class="top-nav">
    <ul class="nav-links">
        @auth
            <li><a href="{{ route('dashboard') }}" class="nav-item">Dashboard</a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-item" style="background: none; border: none; cursor: pointer;">Logout</button>
                </form>
            </li>
        @else
            <li><a href="{{ route('home') }}" class="nav-item">Home</a></li>
            <li><a href="{{ route('members.index') }}" class="nav-item">Members</a></li>
            <li><a href="{{ route('login') }}" class="nav-item">Login</a></li>
        @endauth
    </ul>
</nav>

    <div class="main-content">
        <div class="dashboard-card">
            <div class="card-header">
                <h1>
                    <i class="bi bi-person-circle"></i>
                    My Dashboard
                </h1>
            </div>

            <div class="card-body">
                @if(session('success'))
                    <div class="alert-success">
                        <i class="bi bi-check-circle-fill"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <div class="welcome-section">
                    <h2>Welcome, {{ $user->first_name }} {{ $user->last_name }}!</h2>
                    <p>This is your personal member profile. You can view and edit your member information here.</p>
                </div>

                @if(!isset($editMode) || !$editMode)
                    <!-- View Mode - Member Card -->
                    <div class="member-card">
                        <img src="{{ asset('images/' . ($member->image ?? 'default.jpg')) }}" alt="{{ $member->name ?? $user->name }}" class="member-photo">
                        <div class="member-info">
                            <div class="member-name">{{ $member->name ?? $user->first_name . ' ' . $user->last_name }}</div>
                            <div class="member-role">{{ $member->role ?? 'Member' }}</div>
                            <div class="member-bio">{{ $member->bio ?? 'No bio provided.' }}</div>
                            
                            <div class="member-details">
                                <div class="detail-item">
                                    <span class="detail-label">Age:</span>
                                    <span class="detail-value">{{ $member->age ?? 'N/A' }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Year:</span>
                                    <span class="detail-value">{{ $member->year ?? 'N/A' }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Email:</span>
                                    <span class="detail-value">{{ $member->email ?? $user->email }}</span>
                                </div>
                            </div>
                            
                            <div class="member-skills">
                                @if(isset($member->skills) && is_array($member->skills) && count($member->skills) > 0)
                                    @foreach($member->skills as $skill)
                                        <span class="skill-tag">{{ $skill }}</span>
                                    @endforeach
                                @else
                                    <span class="skill-tag">No skills listed</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="button-group">
                        <a href="{{ route('dashboard.edit') }}" class="btn-edit">
                            <i class="bi bi-pencil"></i> Edit My Profile
                        </a>
                    </div>
                @else
                    <!-- Edit Mode -->
                    <form action="{{ route('dashboard.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="form-group">
                                <label class="form-label"><i class="bi bi-person"></i> Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $member->name ?? '') }}" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label"><i class="bi bi-tag"></i> Role</label>
                                <input type="text" name="role" class="form-control" value="{{ old('role', $member->role ?? '') }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <label class="form-label"><i class="bi bi-calendar"></i> Age</label>
                                <input type="number" name="age" class="form-control" value="{{ old('age', $member->age ?? '') }}" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label"><i class="bi bi-calendar"></i> Year</label>
                                <input type="text" name="year" class="form-control" value="{{ old('year', $member->year ?? '') }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <label class="form-label"><i class="bi bi-envelope"></i> Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $member->email ?? $user->email) }}" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label"><i class="bi bi-chat-dots"></i> Bio</label>
                                <textarea name="bio" class="form-control" rows="3">{{ old('bio', $member->bio ?? '') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label"><i class="bi bi-tags"></i> Skills (comma separated)</label>
                            <input type="text" name="skills" class="form-control" value="{{ old('skills', isset($member->skills) && is_array($member->skills) ? implode(', ', $member->skills) : '') }}" placeholder="e.g., Web Development, Leadership, Design">
                        </div>

                        <div class="form-group">
                            <label class="form-label"><i class="bi bi-image"></i> Profile Image</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                            @if($member->image ?? false)
                                <p style="color: #cccccc; margin-top: 5px;">Current: {{ $member->image }}</p>
                            @endif
                        </div>

                        <div class="button-group">
                            <button type="submit" class="btn-save">
                                <i class="bi bi-check-lg"></i> Save Changes
                            </button>
                            <a href="{{ route('dashboard') }}" class="btn-edit">
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group 8 - Members</title>
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
            max-width: 1000px;
            margin: 100px auto 50px;
            padding: 0 20px;
        }
        
        .members-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin: 20px 0;
        }
        
        .member-card {
            background: #2d2d2d;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0,0,0,0.3);
            transition: transform 0.3s;
            display: flex;
            flex-direction: column;
            padding: 15px;
            border: 1px solid #3a3a3a;
            height: auto;
        }
        
        .member-card:hover {
            transform: translateY(-2px);
            border-color: #4a7856;
        }
        
        .member-photo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 10px;
            border: 3px solid #4a7856;
        }
        
        .member-info {
            text-align: center;
            display: flex;
            flex-direction: column;
            flex: 1;
        }
        
        .member-name {
            font-size: 1.1rem;
            font-weight: bold;
            color: #ffffff;
            margin-bottom: 2px;
        }
        
        .member-role {
            color: #4a7856;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }
        
        .member-bio {
            background: #1a1a1a;
            color: #ffffff;
            line-height: 1.5;
            font-size: 0.85rem;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 6px;
            text-align: left;
            border: 1px solid #3a3a3a;
            display: block;
            overflow: visible;
            height: auto;
            min-height: 40px;
            max-height: none;
            word-wrap: break-word;
            white-space: normal;
        }
        
        .member-details {
            background: #1a1a1a;
            padding: 8px;
            border-radius: 6px;
            margin-bottom: 10px;
            text-align: left;
            border: 1px solid #3a3a3a;
        }
        
        .detail-item {
            display: flex;
            justify-content: space-between;
            padding: 3px 0;
            border-bottom: 1px dashed #3a3a3a;
        }
        
        .detail-item:last-child {
            border-bottom: none;
        }
        
        .detail-label {
            font-size: 0.7rem;
            color: #4a7856;
            text-transform: uppercase;
            font-weight: 600;
        }
        
        .detail-value {
            font-weight: 500;
            color: #ffffff;
            font-size: 0.8rem;
        }
        
        .member-skills {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            justify-content: center;
            margin-top: 10px;
        }
        
        .skill-tag {
            background: #4a7856;
            color: white;
            padding: 4px 8px;
            border-radius: 15px;
            font-size: 0.7rem;
            font-weight: 500;
            display: inline-block;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        
        .back-btn {
            display: inline-block;
            padding: 6px 15px;
            background: #2d2d2d;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 500;
            font-size: 0.85rem;
            transition: transform 0.3s;
            border: 1px solid #4a7856;
        }
        
        .back-btn:hover {
            transform: translateY(-2px);
            background: #4a7856;
            border-color: #4a7856;
        }
        
        .no-members {
            text-align: center;
            padding: 20px;
            background: #2d2d2d;
            border-radius: 6px;
            grid-column: 1/-1;
            color: #cccccc;
            border: 1px solid #3a3a3a;
        }

        @media (max-width: 900px) {
            .members-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .members-grid {
                grid-template-columns: 1fr;
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
        }

        @media (max-width: 576px) {
            .nav-links {
                flex-wrap: wrap;
                justify-content: flex-end;
            }
        }
    </style>
</head>
<body>
    <nav class="top-nav">
        <ul class="nav-links">
            @auth
                @if(Auth::user()->is_admin == 1)
                    <li><a href="{{ route('admin.members.index') }}" class="nav-item">Admin Dashboard</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-item" style="background: none; border: none; cursor: pointer;">Logout</button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('home') }}" class="nav-item">Home</a></li>
                    <li><a href="{{ route('members.index') }}" class="nav-item">Members</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-item" style="background: none; border: none; cursor: pointer;">Logout</button>
                        </form>
                    </li>
                @endif
            @else
                <li><a href="{{ route('login') }}" class="nav-item"></a></li>
            @endauth
        </ul>
    </nav>

    <div class="main-content">
        <div class="members-grid">
            @forelse($members as $member)
            <div class="member-card">
                <img src="{{ asset('images/' . ($member->image ?? 'default.jpg')) }}" alt="{{ $member->name }}" class="member-photo">
                <div class="member-info">
                    <div class="member-name">{{ $member->name }}</div>
                    <div class="member-role">{{ $member->role }}</div>
                    <div class="member-bio">{{ $member->bio }}</div>
                    
                    <div class="member-details">
                        <div class="detail-item">
                            <span class="detail-label">Age:</span>
                            <span class="detail-value">{{ $member->age }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Year:</span>
                            <span class="detail-value">{{ $member->year }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Email:</span>
                            <span class="detail-value">{{ $member->email }}</span>
                        </div>
                    </div>
                    
                    <div class="member-skills">
                        @if(is_array($member->skills) && count($member->skills) > 0)
                            @foreach($member->skills as $skill)
                                <span class="skill-tag">{{ $skill }}</span>
                            @endforeach
                        @else
                            <span class="skill-tag">No skills listed</span>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="no-members">
                <p>No members found. Please add members in the admin panel.</p>
            </div>
            @endforelse
        </div>

        <div style="text-align: center; margin-top: 20px;">
            <a href="{{ url('/') }}" class="back-btn">Back to Home</a>
        </div>
    </div>
</body>
</html>
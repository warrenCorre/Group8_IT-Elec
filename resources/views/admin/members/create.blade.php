<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Member - Admin</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        /* ONLY COLORS CHANGED - LAYOUT/STRUCTURE UNTOUCHED */
        body {
            background: #1a1a1a; /* Changed from light gray to black */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        .admin-container {
            max-width: 800px;
            margin: 100px auto 30px;
            padding: 0 20px;
        }

        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            background: #2d2d2d; /* Changed from white to dark gray */
            padding: 20px;
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
            background: #5d8f6b; /* Lighter moss green on hover */
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(74, 120, 86, 0.3);
        }

        .admin-btn-secondary {
            background: #2d2d2d; /* Dark gray */
            border: 1px solid #4a7856; /* Moss green border */
            color: #ffffff;
        }

        .admin-btn-secondary:hover {
            background: #4a7856;
            color: white;
        }

        .admin-form {
            background: #2d2d2d; /* Changed from white to dark gray */
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
            color: #ffffff; /* Changed from dark to white */
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #3a3a3a;
            background: #1a1a1a; /* Black background */
            color: #ffffff; /* White text */
            border-radius: 5px;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: #4a7856; /* Moss green focus */
            box-shadow: 0 0 0 3px rgba(74, 120, 86, 0.2);
        }

        .form-control::placeholder {
            color: #666;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        .alert-danger {
            background: #2d2d2d;
            color: #ff6b6b;
            padding: 10px;
            border-radius: 5px;
            margin-top: 5px;
            font-size: 0.9rem;
            border: 1px solid #ff6b6b;
        }

        /* Navigation styling - matching site theme */
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

        .logout-form {
            display: inline;
        }

        .logout-btn {
            background: none;
            border: 1px solid #4a7856;
            color: #ffffff;
            font-weight: 500;
            cursor: pointer;
            font-size: 1rem;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            transition: all 0.3s;
        }

        .logout-btn:hover {
            background: #4a7856;
            color: white;
        }

        /* File input styling */
        input[type="file"].form-control {
            padding: 8px;
            background: #1a1a1a;
            color: #cccccc;
        }

        input[type="file"].form-control::file-selector-button {
            background: #4a7856;
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 4px;
            margin-right: 10px;
            cursor: pointer;
        }

        input[type="file"].form-control::file-selector-button:hover {
            background: #5d8f6b;
        }

        /* Small helper text */
        .form-text {
            color: #666;
            font-size: 0.85rem;
            margin-top: 5px;
            display: block;
        }

        /* Responsive - UNCHANGED */
        @media (max-width: 768px) {
            .admin-header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
            
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
    <!-- Top Navigation - structure unchanged -->
    <nav class="top-nav">
        <ul class="nav-links">
            <li><a href="{{ route('home') }}" class="nav-item">Home</a></li>
            <li><a href="{{ route('members.index') }}" class="nav-item">Members</a></li>
            <li><a href="{{ route('admin.dashboard') }}" class="nav-item">Admin</a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </li>
        </ul>
    </nav>

    <div class="admin-container">
        <div class="admin-header">
            <h1 class="admin-title">Add New Member</h1>
            <a href="{{ route('admin.members.index') }}" class="admin-btn admin-btn-secondary">Back to List</a>
        </div>

        <div class="admin-form">
            <form action="{{ route('admin.members.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label class="form-label">Name *</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    @error('name') <div class="alert-danger">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Role *</label>
                    <input type="text" name="role" class="form-control" value="{{ old('role') }}" required>
                    @error('role') <div class="alert-danger">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Age *</label>
                    <input type="number" name="age" class="form-control" value="{{ old('age') }}" required>
                    @error('age') <div class="alert-danger">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Year *</label>
                    <input type="text" name="year" class="form-control" value="{{ old('year') }}" required>
                    @error('year') <div class="alert-danger">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Email *</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    @error('email') <div class="alert-danger">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Bio *</label>
                    <textarea name="bio" class="form-control" required>{{ old('bio') }}</textarea>
                    @error('bio') <div class="alert-danger">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Skills (comma separated)</label>
                    <input type="text" name="skills" class="form-control" value="{{ old('skills') }}" placeholder="e.g., Web Development, Leadership, Design">
                    <small class="form-text">Separate multiple skills with commas</small>
                    @error('skills') <div class="alert-danger">{{ $message }}</div> @enderror
                </div>

               

                <div class="form-group">
                    <label class="form-label">Profile Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <small class="form-text">Accepted formats: jpeg, png, jpg, gif (Max: 2MB)</small>
                    @error('image') <div class="alert-danger">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="admin-btn">Create Member</button>
            </form>
        </div>
    </div>
</body>
</html>
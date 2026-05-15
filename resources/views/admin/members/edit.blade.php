@extends('admin.layout')

@section('title', 'Edit Member')

@section('content')
<style>
/* ONLY COLORS CHANGED - LAYOUT/STRUCTURE/FUNCTIONALITY UNTOUCHED */

/* Alert danger styling */
.alert-danger {
    background: #2d2d2d;
    color: #ff6b6b;
    padding: 8px 12px;
    border-radius: 4px;
    margin-top: 5px;
    border: 1px solid #ff6b6b;
    font-size: 0.9rem;
}

/* Small text styling */
small {
    color: #666 !important;
}

/* Current image container */
.current-image {
    margin: 15px 0;
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

.current-image p {
    color: #cccccc !important; /* Light gray */
    margin-top: 10px;
}

/* Image preview */
#preview {
    border: 3px solid #4a7856 !important; /* Moss green */
}

#imagePreview p {
    color: #cccccc !important;
}

/* No image placeholder */
.current-image div[style*="background: #ddd"] {
    background: #2d2d2d !important;
    border: 2px dashed #4a7856;
    color: #cccccc !important;
}

/* Button overrides - only colors changed */
.admin-btn[style*="background: #6c757d"] {
    background: #2d2d2d !important;
    border: 1px solid #4a7856 !important;
    color: #ffffff !important;
}

.admin-btn[style*="background: #6c757d"]:hover {
    background: #4a7856 !important;
    border-color: #4a7856 !important;
}

/* Change Photo button */
.admin-btn-danger[onclick*="document.getElementById('image').click()"] {
    background: #2d2d2d;
    border: 1px solid #4a7856;
    color: #4a7856;
}

.admin-btn-danger[onclick*="document.getElementById('image').click()"]:hover {
    background: #4a7856;
    color: white;
}

/* Add Photo button */
.admin-btn[onclick*="document.getElementById('image').click()"] {
    background: #4a7856;
    color: white;
    border: none;
}

.admin-btn[onclick*="document.getElementById('image').click()"]:hover {
    background: #5d8f6b;
}

/* Keep current image checkbox */
#keepCurrentImage {
    accent-color: #4a7856; /* Moss green */
    margin-right: 8px;
}

.form-label input[type="checkbox"] {
    width: auto;
    margin-right: 5px;
}

/* Update Member button */
button[type="submit"].admin-btn {
    background: #4a7856;
    color: white;
    border: none;
    padding: 12px 30px;
    font-size: 1.1rem;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s;
}

button[type="submit"].admin-btn:hover {
    background: #5d8f6b;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(74, 120, 86, 0.3);
}

/* File input styling */
input[type="file"].form-control {
    padding: 8px;
    background: #1a1a1a;
    color: #cccccc;
    border: 1px solid #3a3a3a;
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

/* Focus states */
.form-control:focus {
    border-color: #4a7856 !important;
    box-shadow: 0 0 0 3px rgba(74, 120, 86, 0.2) !important;
    outline: none;
}
</style>

<div class="admin-header">
    <h1 class="admin-title">Edit Member: {{ $member->name }}</h1>
    <a href="{{ route('admin.members.index') }}" class="admin-btn" style="background: #2d2d2d; border: 1px solid #4a7856; color: #ffffff;">Back to List</a>
</div>

<div class="admin-form">
    <form action="{{ route('admin.members.update', $member) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <!-- Name Field -->
        <div class="form-group">
            <label class="form-label">Name *</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $member->name) }}" required>
            @error('name') <div class="alert-danger">{{ $message }}</div> @enderror
        </div>

        <!-- Role Field -->
        <div class="form-group">
            <label class="form-label">Role *</label>
            <input type="text" name="role" class="form-control" value="{{ old('role', $member->role) }}" required>
            @error('role') <div class="alert-danger">{{ $message }}</div> @enderror
        </div>

        <!-- Age Field -->
        <div class="form-group">
            <label class="form-label">Age *</label>
            <input type="number" name="age" class="form-control" value="{{ old('age', $member->age) }}" required>
            @error('age') <div class="alert-danger">{{ $message }}</div> @enderror
        </div>

        <!-- Year Field -->
        <div class="form-group">
            <label class="form-label">Year *</label>
            <input type="text" name="year" class="form-control" value="{{ old('year', $member->year) }}" required>
            @error('year') <div class="alert-danger">{{ $message }}</div> @enderror
        </div>

        <!-- Email Field -->
        <div class="form-group">
            <label class="form-label">Email *</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $member->email) }}" required>
            @error('email') <div class="alert-danger">{{ $message }}</div> @enderror
        </div>

        <!-- Bio Field -->
        <div class="form-group">
            <label class="form-label">Bio *</label>
            <textarea name="bio" class="form-control" rows="5" required>{{ old('bio', $member->bio) }}</textarea>
            @error('bio') <div class="alert-danger">{{ $message }}</div> @enderror
        </div>

        <!-- Skills Field -->
        <div class="form-group">
            <label class="form-label">Skills (comma separated)</label>
            <input type="text" name="skills" class="form-control" 
                   value="{{ old('skills', is_array($member->skills) ? implode(', ', $member->skills) : $member->skills) }}" 
                   placeholder="e.g., Full-Stack Dev, Team Leadership, Project Management">
            <small style="color: #666; display: block; margin-top: 5px;">Separate multiple skills with commas (e.g., Web Dev, Team Leadership, PHP)</small>
            @error('skills') <div class="alert-danger">{{ $message }}</div> @enderror
        </div>

        <!-- Display Order Field -->
        

        <!-- Current Profile Image -->
        <div class="form-group">
            <label class="form-label">Current Profile Image</label>
            @if($member->image)
                <div class="current-image" id="currentImageContainer">
                    <img src="{{ asset('images/' . $member->image) }}" alt="{{ $member->name }}" id="currentImage">
                    <p style="margin-top: 10px; color: #cccccc;">Filename: {{ $member->image }}</p>
                    <button type="button" class="admin-btn admin-btn-danger" style="margin-top: 10px; padding: 5px 15px; font-size: 0.9rem; background: #2d2d2d; border: 1px solid #4a7856; color: #4a7856;" onclick="document.getElementById('image').click();">Change Photo</button>
                </div>
            @else
                <div class="current-image" id="currentImageContainer">
                    <div style="width: 150px; height: 150px; background: #2d2d2d; border: 2px dashed #4a7856; border-radius: 50%; margin: 0 auto; display: flex; align-items: center; justify-content: center; color: #cccccc;">
                        No Image
                    </div>
                    <button type="button" class="admin-btn" style="margin-top: 10px; padding: 5px 15px; font-size: 0.9rem; background: #4a7856; color: white; border: none;" onclick="document.getElementById('image').click();">Add Photo</button>
                </div>
            @endif
        </div>

        <!-- New Image Upload (hidden by default, shown when button clicked) -->
        <div class="form-group" id="newImageSection" style="display: none;">
            <label class="form-label">New Profile Image</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*" onchange="previewImage(event)">
            <small style="color: #666; display: block; margin-top: 5px;">Accepted formats: jpeg, png, jpg, gif (Max: 10MB)</small>
            @error('image') <div class="alert-danger">{{ $message }}</div> @enderror
            
            <!-- Image Preview -->
            <div id="imagePreview" style="margin-top: 15px; text-align: center; display: none;">
                <img id="preview" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 3px solid #4a7856;">
                <p style="margin-top: 5px; color: #cccccc; font-size: 0.9rem;">New Image Preview</p>
            </div>
        </div>

        <!-- Keep Current Image Option -->
        <div class="form-group" id="keepCurrentSection">
            <label class="form-label">
                <input type="checkbox" name="keep_current_image" id="keepCurrentImage" value="1" checked onchange="toggleImageUpload()" style="accent-color: #4a7856;">
                Keep current image
            </label>
        </div>

        <!-- Submit Button -->
        <div class="form-group" style="margin-top: 30px;">
            <button type="submit" class="admin-btn" style="padding: 12px 30px; font-size: 1.1rem; background: #4a7856; color: white; border: none;">Update Member</button>
        </div>
    </form>
</div>

<script>
    function toggleImageUpload() {
        const keepCurrent = document.getElementById('keepCurrentImage');
        const newImageSection = document.getElementById('newImageSection');
        const currentImageContainer = document.getElementById('currentImageContainer');
        
        if (keepCurrent.checked) {
            newImageSection.style.display = 'none';
            if (currentImageContainer) currentImageContainer.style.display = 'block';
        } else {
            newImageSection.style.display = 'block';
            if (currentImageContainer) currentImageContainer.style.display = 'none';
            document.getElementById('image').click();
        }
    }
    
    function previewImage(event) {
        const preview = document.getElementById('preview');
        const imagePreview = document.getElementById('imagePreview');
        const file = event.target.files[0];
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                imagePreview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    }
    
    // Initialize - make sure keep current is checked by default
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('keepCurrentImage').checked = true;
        document.getElementById('newImageSection').style.display = 'none';
    });
</script>
@endsection
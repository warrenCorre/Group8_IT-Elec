@extends('admin.layout')

@section('title', 'Manage Members')

@section('content')
<style>
/* ONLY COLORS CHANGED - LAYOUT/STRUCTURE UNTOUCHED */
.admin-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    background: #2d2d2d; /* Changed from white/light to dark gray */
    padding: 20px 30px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.3);
    border: 1px solid #3a3a3a; /* Added subtle border */
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
    margin: 0 2px;
}

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
    background: #1a1a1a; /* Darker black for headers */
    color: #4a7856; /* Moss green text */
    padding: 15px;
    text-align: left;
    font-weight: 600;
    border-bottom: 2px solid #4a7856;
}

.admin-table td {
    padding: 15px;
    border-bottom: 1px solid #3a3a3a;
    vertical-align: middle;
    color: #cccccc; /* Light gray text */
}

.admin-table tr:hover {
    background: #1a1a1a; /* Darker on hover */
}

.admin-table tr:hover td {
    color: #ffffff; /* White text on hover */
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

/* Success message - colors only */
.alert-success {
    background: #1a1a1a;
    color: #4a7856;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
    border: 1px solid #4a7856;
}

/* Table text colors */
.admin-table td strong {
    color: #ffffff; /* White for member names */
}

/* No skills text - changed to match theme */
.admin-table td span[style*="color: #999"] {
    color: #666 !important;
}

/* Empty state text */
.admin-table td[colspan] {
    color: #666 !important;
}

/* Responsive - UNCHANGED */
@media (max-width: 768px) {
    .admin-header {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
    
    .admin-table {
        overflow-x: auto;
    }
    
    .admin-table table {
        min-width: 800px;
    }
}
</style>

<div class="admin-header">
    <h1 class="admin-title">Manage Members</h1>
    <a href="{{ route('admin.members.create') }}" class="admin-btn">+ Add New Member</a>
</div>

@if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif

<div class="admin-table">
    <table>
        <thead>
            <tr>
                <th>Order</th>
                <th>Image</th>
                <th>Name</th>
                <th>Role</th>
                <th>Age</th>
                <th>Email</th>
                <th>Skills</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($members as $member)
            <tr>
                <td>{{ $member->member_order }}</td>
                <td>
                    @if($member->image)
                        <img src="{{ asset('images/' . $member->image) }}" alt="{{ $member->name }}" class="member-image">
                    @else
                        <img src="{{ asset('images/default.jpg') }}" alt="Default" class="member-image" style="opacity: 0.7;">
                    @endif
                </td>
                <td><strong>{{ $member->name }}</strong></td>
                <td>{{ $member->role }}</td>
                <td>{{ $member->age }}</td>
                <td>{{ $member->email }}</td>
                <td>
                    @if(is_array($member->skills) && count($member->skills) > 0)
                        <span style="color: #4a7856;">{{ implode(', ', array_slice($member->skills, 0, 2)) }}</span>
                        @if(count($member->skills) > 2) 
                            <span style="color: #4a7856;">...</span>
                        @endif
                    @else
                        <span style="color: #666;">No skills</span>
                    @endif
                </td>
                <td>
                    <div class="action-buttons">
                        <a href="{{ route('admin.members.edit', $member) }}" class="admin-btn admin-btn-small">Edit</a>
                        <form action="{{ route('admin.members.destroy', $member) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="admin-btn admin-btn-danger admin-btn-small" onclick="return confirm('Delete {{ $member->name }}?')">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align: center; padding: 50px; color: #666;">
                    No members found. Click "Add New Member" to create one.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of members (Admin Dashboard)
     */
    public function index()
    {
        $members = Member::orderBy('member_order')->get();
        return view('admin.members.index', compact('members'));
    }

    /**
     * Show form to create new member
     */
    public function create()
    {
        return view('admin.members.create');
    }

    /**
     * Store a new member
     */
   public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'role' => 'required|string|max:255',
        'age' => 'required|integer|min:1|max:100',
        'year' => 'required|string|max:50',
        'email' => 'required|email|unique:members',
        'bio' => 'required|string',
        'skills' => 'nullable|string',
        'member_order' => 'integer|nullable',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $data = [
        'name' => $request->name,
        'role' => $request->role,
        'age' => $request->age,
        'year' => $request->year,
        'email' => $request->email,
        'bio' => $request->bio,
        'member_order' => $request->member_order ?? 0,
    ];
    
    // Handle skills
    if ($request->has('skills') && $request->skills) {
        $skillsArray = array_map('trim', explode(',', $request->skills));
        $skillsArray = array_filter($skillsArray);
        $data['skills'] = array_values($skillsArray);
    } else {
        $data['skills'] = [];
    }

    // Handle image upload
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('images'), $imageName);
        $data['image'] = $imageName;
    }

    Member::create($data);

    return redirect()->route('admin.members.index')
        ->with('success', 'Member created successfully.');
}

    /**
     * Show form to edit member
     */
    public function edit(Member $member)
    {
        return view('admin.members.edit', compact('member'));
    }

    /**
     * Update member
     */
  public function update(Request $request, Member $member)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'role' => 'required|string|max:255',
        'age' => 'required|integer|min:1|max:100',
        'year' => 'required|string|max:50',
        'email' => 'required|email|unique:members,email,' . $member->id,
        'bio' => 'required|string',
        'skills' => 'nullable|string',
        'member_order' => 'integer|nullable',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $data = [
        'name' => $request->name,
        'role' => $request->role,
        'age' => $request->age,
        'year' => $request->year,
        'email' => $request->email,
        'bio' => $request->bio,
        'member_order' => $request->member_order ?? 0,
    ];
    
    // Handle skills - convert comma-separated string to array
    if ($request->has('skills') && $request->skills) {
        // Clean up the skills string
        $skillsString = $request->skills;
        
        // Remove brackets if present (in case it's sent as array string)
        $skillsString = trim($skillsString, '[]');
        
        // Split by comma and clean up
        $skillsArray = array_map('trim', explode(',', $skillsString));
        
        // Remove quotes if present
        $skillsArray = array_map(function($skill) {
            return trim($skill, '"\'');
        }, $skillsArray);
        
        // Remove empty values
        $skillsArray = array_filter($skillsArray);
        
        $data['skills'] = array_values($skillsArray);
    } else {
        $data['skills'] = [];
    }

    // Handle image upload
    if ($request->hasFile('image')) {
        // Delete old image
        if ($member->image && file_exists(public_path('images/' . $member->image))) {
            unlink(public_path('images/' . $member->image));
        }
        
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('images'), $imageName);
        $data['image'] = $imageName;
    }

    $member->update($data);

    return redirect()->route('admin.members.index')
        ->with('success', 'Member updated successfully.');
}

    /**
     * Delete member
     */
    public function destroy(Member $member)
    {
        // Delete image
        if ($member->image && file_exists(public_path('images/' . $member->image))) {
            unlink(public_path('images/' . $member->image));
        }

        $member->delete();

        return redirect()->route('admin.members.index')
            ->with('success', 'Member deleted successfully.');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user   = Auth::user();
        $member = Member::where('email', $user->email)->first();

        return view('user-dashboard', compact('user', 'member'));
    }

    public function edit()
    {
        $user     = Auth::user();
        $member   = Member::where('email', $user->email)->first();
        $editMode = true;

        return view('user-dashboard', compact('user', 'member', 'editMode'));
    }

    public function update(Request $request)
    {
        $user   = Auth::user();
        $member = Member::where('email', $user->email)->first();

        $request->validate([
            'name'         => 'required|string|max:255',
            'role'         => 'required|string|max:255',
            'age'          => 'required|integer|min:1|max:100',
            'year'         => 'required|string|max:50',
            'email'        => 'required|email|unique:members,email,' . ($member ? $member->id : 'NULL'),
            'bio'          => 'required|string',
            'skills'       => 'nullable|string',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'name'  => $request->name,
            'role'  => $request->role,
            'age'   => $request->age,
            'year'  => $request->year,
            'email' => $request->email,
            'bio'   => $request->bio,
        ];

        // Parse skills
        if ($request->filled('skills')) {
            $raw    = trim($request->skills, '[]');
            $skills = array_map(fn($s) => trim($s, " \"'"), explode(',', $raw));
            $data['skills'] = array_values(array_filter($skills));
        } else {
            $data['skills'] = [];
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if it's not one of the seed images
            if ($member && $member->image) {
                $oldPath = public_path('images/' . $member->image);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            $image     = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        if ($member) {
            $member->update($data);
        } else {
            $data['member_order'] = 99;
            Member::create($data);
        }

        return redirect()->route('dashboard')
            ->with('success', 'Your profile has been updated successfully!');
    }
}
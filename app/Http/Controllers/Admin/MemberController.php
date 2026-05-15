<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::orderBy('member_order')->get();
        return view('admin.members.index', compact('members'));
    }

    public function create()
    {
        return view('admin.members.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'role'         => 'required|string|max:255',
            'age'          => 'required|integer|min:1|max:100',
            'year'         => 'required|string|max:50',
            'email'        => 'required|email|unique:members',
            'bio'          => 'required|string',
            'skills'       => 'nullable|string',
            'member_order' => 'nullable|integer',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'name'         => $request->name,
            'role'         => $request->role,
            'age'          => $request->age,
            'year'         => $request->year,
            'email'        => $request->email,
            'bio'          => $request->bio,
            'member_order' => $request->member_order ?? 0,
            'skills'       => $this->parseSkills($request->skills),
        ];

        if ($request->hasFile('image')) {
            $image     = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        Member::create($data);

        return redirect()->route('admin.members.index')
            ->with('success', 'Member created successfully.');
    }

    public function edit(Member $member)
    {
        return view('admin.members.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'role'         => 'required|string|max:255',
            'age'          => 'required|integer|min:1|max:100',
            'year'         => 'required|string|max:50',
            'email'        => 'required|email|unique:members,email,' . $member->id,
            'bio'          => 'required|string',
            'skills'       => 'nullable|string',
            'member_order' => 'nullable|integer',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'name'         => $request->name,
            'role'         => $request->role,
            'age'          => $request->age,
            'year'         => $request->year,
            'email'        => $request->email,
            'bio'          => $request->bio,
            'member_order' => $request->member_order ?? $member->member_order,
            'skills'       => $this->parseSkills($request->skills),
        ];

        if ($request->hasFile('image')) {
            // Delete old image file if it exists
            if ($member->image && file_exists(public_path('images/' . $member->image))) {
                unlink(public_path('images/' . $member->image));
            }
            // Also check old path without subdirectory
            if ($member->image && file_exists(public_path('images/' . $member->image))) {
                unlink(public_path('images/' . $member->image));
            }

            $image     = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        $member->update($data);

        return redirect()->route('admin.members.index')
            ->with('success', 'Member updated successfully.');
    }

    public function destroy(Member $member)
    {
        if ($member->image && file_exists(public_path('images/' . $member->image))) {
            unlink(public_path('images/' . $member->image));
        }
        if ($member->image && file_exists(public_path('images/' . $member->image))) {
            unlink(public_path('images/' . $member->image));
        }

        $member->delete();

        return redirect()->route('admin.members.index')
            ->with('success', 'Member deleted successfully.');
    }

    // ─── helpers ────────────────────────────────────────────────

    private function parseSkills(?string $raw): array
    {
        if (!$raw) {
            return [];
        }
        // Strip surrounding brackets in case front-end sent "[PHP, Laravel]"
        $raw    = trim($raw, '[]');
        $skills = array_map(function ($s) {
            return trim($s, " \"'");
        }, explode(',', $raw));

        return array_values(array_filter($skills));
    }
}
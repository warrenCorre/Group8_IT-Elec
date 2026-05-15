<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberAccountController extends Controller
{
    // Removed __construct method - middleware is handled in routes/web.php

    public function index()
    {
        $user = Auth::user();
        return view('member-account', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        $editMode = true;
        return view('member-account', compact('user', 'editMode'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'department' => 'nullable|string|max:100',
            'block' => 'nullable|string|max:10',
        ]);

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'username' => $request->username,
            'department' => $request->department,
            'block' => $request->block,
        ]);

        return redirect()->route('member.account')
            ->with('success', 'Your account has been updated successfully!');
    }
}
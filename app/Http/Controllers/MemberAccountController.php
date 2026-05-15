<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MemberAccountController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        return view('member-account', compact('user'));
    }

    public function edit()
    {
        $user     = User::findOrFail(Auth::id());
        $editMode = true;
        return view('member-account', compact('user', 'editMode'));
    }

    public function update(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email,' . $user->id,
            'username'   => 'required|string|max:255|unique:users,username,' . $user->id,
            'department' => 'nullable|string|max:100',
            'block'      => 'nullable|string|max:10',
        ]);

        $user->update([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'name'       => $request->first_name . ' ' . $request->last_name,
            'email'      => $request->email,
            'username'   => $request->username,
            'department' => $request->department,
            'block'      => $request->block,
        ]);

        return redirect()->route('member.account')
            ->with('success', 'Your account has been updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|string|min:8|confirmed',
        ]);

        $user = User::findOrFail(Auth::id());

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->update(['password' => Hash::make($request->password)]);

        return redirect()->route('member.account')
            ->with('success', 'Password updated successfully.');
    }
}
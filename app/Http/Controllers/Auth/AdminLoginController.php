<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    /**
     * Show the admin login form.
     */
    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    /**
     * Handle an admin login request.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            // Check if user is admin
            if (Auth::user()->is_admin == 1) {
                $request->session()->regenerate();
                return redirect()->route('admin.members.index')
                    ->with('success', 'Welcome to the Admin Portal!');
            }
            
            // If not admin, logout and show error
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            return back()->withErrors([
                'email' => '❌ Unauthorized: This portal is for ADMINISTRATORS only.',
            ])->onlyInput('email');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
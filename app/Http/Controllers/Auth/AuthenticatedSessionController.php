<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    protected $maxAttempts = 3;          // maximum failed attempts
    protected $lockoutMinutes = 1;       // lockout duration

    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Use email + IP as unique key (more secure than just IP)
        $key = 'login_attempts_' . ($request->input('email') ?: $request->ip());

        // Check if the account is currently locked
        if (session()->has($key . '_locked_until')) {
            $lockedUntil = session($key . '_locked_until');
            if (now()->lessThan($lockedUntil)) {
                $secondsLeft = $lockedUntil->diffInSeconds(now());
                return back()->withErrors([
                    'email' => "Too many failed attempts. Please try again in {$secondsLeft} seconds.",
                ])->onlyInput('email');
            } else {
                // Lock expired – clean up
                session()->forget($key);
                session()->forget($key . '_locked_until');
            }
        }

        // Get current attempt count
        $attempts = session($key, 0);

        // If max attempts reached, lock the account
        if ($attempts >= $this->maxAttempts) {
            $lockedUntil = now()->addMinutes($this->lockoutMinutes);
            session([$key . '_locked_until' => $lockedUntil]);
            return back()->withErrors([
                'email' => "Too many failed attempts. Account locked for {$this->lockoutMinutes} minute(s).",
            ])->onlyInput('email');
        }

        // Attempt to authenticate
        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            // Successful login – clear the attempt counter
            session()->forget($key);
            session()->forget($key . '_locked_until');
            $request->session()->regenerate();

            // ✅ If user is admin, redirect them to the dedicated admin login page
            if (Auth::user()->is_admin == 1) {
                // Log them out immediately and send to admin login with error
                Auth::logout();
                return redirect()->route('admin.login.form')
                    ->with('error', '❌ Admins must log in through the Admin Portal.');
            }

            // Regular user goes to member dashboard
            return redirect()->route('dashboard');
        }

        // Failed login: increment attempts
        session([$key => $attempts + 1]);
        $remaining = $this->maxAttempts - ($attempts + 1);
        $remainingMsg = $remaining > 0 ? " You have {$remaining} attempt(s) remaining." : '';

        return back()->withErrors([
            'email' => 'Invalid credentials.' . $remainingMsg,
        ])->onlyInput('email');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
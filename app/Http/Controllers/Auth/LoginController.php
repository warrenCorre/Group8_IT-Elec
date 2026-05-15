<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;

class LoginController extends Controller
{
    /**
     * Maximum failed attempts before lockout.
     */
    protected int $maxAttempts = 3;

    /**
     * Lockout duration in minutes.
     */
    protected int $lockoutMinutes = 15;

    // ── Member login ────────────────────────────────────────────

    public function showMemberLoginForm()
    {
        return view('auth.login');
    }

    public function memberLogin(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if ($user) {
            // Block admins from member portal
            if ($user->is_admin) {
                return back()->withErrors([
                    'email' => 'Admins must use the Admin Portal to log in.',
                ])->onlyInput('email');
            }

            // Check lockout
            if ($user->locked_until && Carbon::now()->lessThan($user->locked_until)) {
                $remaining = max(1, (int) ceil(Carbon::now()->diffInMinutes($user->locked_until, false)));
                return back()->withErrors([
                    'email' => "Your account is temporarily locked due to too many failed attempts. Try again in {$remaining} minute(s), or use \"Forgot Password\" to reset your password.",
                ])->onlyInput('email');
            }

            // Expired lockout — reset counters
            if ($user->locked_until && Carbon::now()->greaterThanOrEqualTo($user->locked_until)) {
                $user->failed_login_attempts = 0;
                $user->locked_until          = null;
                $user->save();
            }
        }

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            if ($user) {
                $user->failed_login_attempts = 0;
                $user->locked_until          = null;
                $user->save();
            }

            return redirect()->route('dashboard');
        }

        // Track failed attempt
        if ($user) {
            $user->failed_login_attempts = ($user->failed_login_attempts ?? 0) + 1;

            if ($user->failed_login_attempts >= $this->maxAttempts) {
                $user->locked_until          = Carbon::now()->addMinutes($this->lockoutMinutes);
                $user->failed_login_attempts = 0;
                $user->save();

                return back()->withErrors([
                    'email' => "Too many failed attempts. Your account has been locked for {$this->lockoutMinutes} minutes. You can also use \"Forgot Password\" to reset your password.",
                ])->onlyInput('email');
            }

            $user->save();
            $attemptsLeft = $this->maxAttempts - $user->failed_login_attempts;

            return back()->withErrors([
                'email' => "Incorrect credentials. You have {$attemptsLeft} attempt(s) remaining before your account is temporarily locked.",
            ])->onlyInput('email');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // ── Admin login ──────────────────────────────────────────────

    public function showAdminLoginForm()
    {
        return view('auth.admin-login');
    }

    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if ($user) {
            // Check lockout for admins too
            if ($user->locked_until && Carbon::now()->lessThan($user->locked_until)) {
                $remaining = max(1, (int) ceil(Carbon::now()->diffInMinutes($user->locked_until, false)));
                return back()->withErrors([
                    'email' => "Account locked. Try again in {$remaining} minute(s), or use \"Forgot Password\".",
                ])->onlyInput('email');
            }

            if ($user->locked_until && Carbon::now()->greaterThanOrEqualTo($user->locked_until)) {
                $user->failed_login_attempts = 0;
                $user->locked_until          = null;
                $user->save();
            }
        }

        if (Auth::attempt($credentials)) {
            if (Auth::user()->is_admin == 1) {
                $request->session()->regenerate();

                if ($user) {
                    $user->failed_login_attempts = 0;
                    $user->locked_until          = null;
                    $user->save();
                }

                return redirect()->route('admin.members.index')
                    ->with('success', 'Welcome to the Admin Portal!');
            }

            // Logged in but not admin — boot them out
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()->withErrors([
                'email' => 'Unauthorized: This portal is for ADMINISTRATORS only.',
            ])->onlyInput('email');
        }

        // Track failed attempt
        if ($user) {
            $user->failed_login_attempts = ($user->failed_login_attempts ?? 0) + 1;

            if ($user->failed_login_attempts >= $this->maxAttempts) {
                $user->locked_until          = Carbon::now()->addMinutes($this->lockoutMinutes);
                $user->failed_login_attempts = 0;
                $user->save();

                return back()->withErrors([
                    'email' => "Too many failed attempts. Account locked for {$this->lockoutMinutes} minutes.",
                ])->onlyInput('email');
            }

            $user->save();
            $attemptsLeft = $this->maxAttempts - $user->failed_login_attempts;

            return back()->withErrors([
                'email' => "Incorrect credentials. {$attemptsLeft} attempt(s) remaining.",
            ])->onlyInput('email');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // ── Logout ──────────────────────────────────────────────────

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
<?php

use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\MemberAccountController;
use Illuminate\Support\Facades\Route;

// ─────────────────────────────────────────────
// PUBLIC ROUTES — no login required
// ─────────────────────────────────────────────
Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/members', function () {
    $members = App\Models\Member::orderBy('member_order')->get();
    return view('members', compact('members'));
})->name('members.index');

// ─────────────────────────────────────────────
// MEMBER AUTH — guest only
// ─────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login',  [LoginController::class, 'showMemberLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'memberLogin'])->name('login.submit');

    // Forgot password — 3-step OTP flow
    Route::get( '/forgot-password',        [ForgotPasswordController::class, 'showForgotForm'])   ->name('password.request');
    Route::post('/forgot-password',        [ForgotPasswordController::class, 'sendOtp'])           ->name('password.email');
    Route::get( '/verify-otp',             [ForgotPasswordController::class, 'showVerifyOtpForm']) ->name('password.verify-otp');
    Route::post('/verify-otp',             [ForgotPasswordController::class, 'verifyOtp'])         ->name('password.verify-otp.submit');
    Route::get( '/reset-password',         [ForgotPasswordController::class, 'showResetForm'])     ->name('password.reset-form');
    Route::post('/reset-password',         [ForgotPasswordController::class, 'resetPassword'])     ->name('password.update');
});

// ─────────────────────────────────────────────
// ADMIN AUTH — separate login, guest only
// ─────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware('guest')->group(function () {
    Route::get( '/login', [LoginController::class, 'showAdminLoginForm'])->name('login.form');
    Route::post('/login', [LoginController::class, 'adminLogin'])        ->name('login.submit');
});

// ─────────────────────────────────────────────
// LOGOUT — auth required
// ─────────────────────────────────────────────
Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ─────────────────────────────────────────────
// MEMBER AREA — regular users only (is_admin = 0)
// ─────────────────────────────────────────────
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/dashboard',      [UserDashboardController::class, 'index']) ->name('dashboard');
    Route::get('/dashboard/edit', [UserDashboardController::class, 'edit'])  ->name('dashboard.edit');
    Route::put('/dashboard',      [UserDashboardController::class, 'update'])->name('dashboard.update');

    Route::get('/member-account',            [MemberAccountController::class, 'index'])         ->name('member.account');
    Route::get('/member-account/edit',       [MemberAccountController::class, 'edit'])          ->name('member.account.edit');
    Route::put('/member-account',            [MemberAccountController::class, 'update'])        ->name('member.account.update');
    Route::post('/member-account/password',  [MemberAccountController::class, 'updatePassword'])->name('member.account.password');
});

// ─────────────────────────────────────────────
// ADMIN AREA — admin only (is_admin = 1)
// ─────────────────────────────────────────────
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('admin.members.index');
    })->name('dashboard');

    Route::get(   '/members',               [MemberController::class, 'index'])  ->name('members.index');
    Route::get(   '/members/create',        [MemberController::class, 'create']) ->name('members.create');
    Route::post(  '/members',               [MemberController::class, 'store'])  ->name('members.store');
    Route::get(   '/members/{member}/edit', [MemberController::class, 'edit'])   ->name('members.edit');
    Route::put(   '/members/{member}',      [MemberController::class, 'update']) ->name('members.update');
    Route::delete('/members/{member}',      [MemberController::class, 'destroy'])->name('members.destroy');
});
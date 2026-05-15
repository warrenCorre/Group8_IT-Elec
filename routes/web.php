<?php

use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Route;

// ✅ PUBLIC ROUTES - accessible to everyone (NO LOGIN REQUIRED)
Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/members', function () {
    $members = App\Models\Member::orderBy('member_order')->get();
    return view('members', compact('members'));
})->name('members.index');

// ✅ Common login route (member login)
Route::get('/login', function () {
    return view('auth/login');
})->name('login');

// ✅ Register route (optional)
Route::get('/register', function () {
    return view('auth/register');
})->name('register');

// ✅ ADMIN LOGIN ROUTES (separate from member login)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [App\Http\Controllers\Auth\AdminLoginController::class, 'showLoginForm'])
        ->name('login.form')
        ->middleware('guest');
    Route::post('/login', [App\Http\Controllers\Auth\AdminLoginController::class, 'login'])
        ->name('login.submit')
        ->middleware('guest');
});

// ✅ PROTECTED ROUTES - for regular users ONLY (REQUIRES LOGIN)
Route::middleware(['auth', 'user'])->group(function () {
    // Dashboard - shows only logged-in user's member card
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/edit', [UserDashboardController::class, 'edit'])->name('dashboard.edit');
    Route::put('/dashboard', [UserDashboardController::class, 'update'])->name('dashboard.update');
    
    // Member Account Routes
    Route::get('/member-account', [App\Http\Controllers\MemberAccountController::class, 'index'])->name('member.account');
    Route::get('/member-account/edit', [App\Http\Controllers\MemberAccountController::class, 'edit'])->name('member.account.edit');
    Route::put('/member-account', [App\Http\Controllers\MemberAccountController::class, 'update'])->name('member.account.update');
});

// ✅ ADMIN PROTECTED ROUTES - for admin only
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function() {
        return redirect()->route('admin.members.index');
    })->name('dashboard');
    
    Route::get('/members', [MemberController::class, 'index'])->name('members.index');
    Route::get('/members/create', [MemberController::class, 'create'])->name('members.create');
    Route::post('/members', [MemberController::class, 'store'])->name('members.store');
    Route::get('/members/{member}/edit', [MemberController::class, 'edit'])->name('members.edit');
    Route::put('/members/{member}', [MemberController::class, 'update'])->name('members.update');
    Route::delete('/members/{member}', [MemberController::class, 'destroy'])->name('members.destroy');
});

require __DIR__.'/auth.php';
<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ApartmentAdminController;
use App\Http\Controllers\Admin\EnquiryAdminController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

// ── Public routes ──────────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/apartments', [ApartmentController::class, 'index'])->name('apartments.index');
Route::get('/apartments/{apartment}', [ApartmentController::class, 'show'])->name('apartments.show');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// ── Auth routes ────────────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // ── Profile routes ──
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar');
    Route::delete('/profile/avatar', [ProfileController::class, 'removeAvatar'])->name('profile.avatar.remove');
    Route::get('/profile/password', [ProfileController::class, 'editPassword'])->name('profile.password');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
});

// ── Admin routes ───────────────────────────────────────────────────────────
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', AdminMiddleware::class])
    ->group(function () {

        // Dashboard
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

        // Apartments CRUD
        Route::resource('apartments', ApartmentAdminController::class)
            ->except(['show']);

        // Enquiries
        Route::get('enquiries', [EnquiryAdminController::class, 'index'])->name('enquiries.index');
        Route::get('enquiries/{enquiry}', [EnquiryAdminController::class, 'show'])->name('enquiries.show');
        Route::patch('enquiries/{enquiry}/replied', [EnquiryAdminController::class, 'markReplied'])->name('enquiries.replied');
        Route::delete('enquiries/{enquiry}', [EnquiryAdminController::class, 'destroy'])->name('enquiries.destroy');

        // Users
        Route::get('users', [UserAdminController::class, 'index'])->name('users.index');
        Route::patch('users/{user}/toggle-admin', [UserAdminController::class, 'toggleAdmin'])->name('users.toggle-admin');
        Route::delete('users/{user}', [UserAdminController::class, 'destroy'])->name('users.destroy');
    });

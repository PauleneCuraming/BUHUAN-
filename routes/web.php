<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController; 
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Resident\DashboardController;
use App\Http\Controllers\Resident\ServiceController;
use App\Http\Controllers\Admin\DocumentRequestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Resident\ProfileController as ResidentProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('guest')->group(function () {
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.update');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/users/pending', [App\Http\Controllers\Admin\UserController::class, 'pending'])->name('admin.users.pending');
    Route::post('/users/{user}/approve', [App\Http\Controllers\Admin\UserController::class, 'approve'])->name('admin.users.approve');
    Route::post('/users/{user}/reject', [App\Http\Controllers\Admin\UserController::class, 'reject'])->name('admin.users.reject');
    Route::get('/users/{user}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/users/{user}/view-id', [App\Http\Controllers\Admin\UserController::class, 'viewId'])->name('admin.users.view-id');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/settings/system-name', [AdminController::class, 'updateSystemName'])->name('admin.settings.updateSystemName');
    Route::post('/settings/availability', [AdminController::class, 'updateAvailability'])->name('admin.settings.updateAvailability');
    Route::post('/settings/admin-account', [AdminController::class, 'updateAdminAccount'])->name('admin.settings.updateAdminAccount');
    Route::post('/concerns/{id}/status', [AdminController::class, 'updateConcernStatus'])->name('admin.concerns.updateStatus');
    Route::post('/appointments/{id}/status', [AdminController::class, 'updateAppointmentStatus'])->name('admin.appointments.updateStatus');
});

// Resident routes (authenticated, verified)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/resident/dashboard', [DashboardController::class, 'index'])->name('resident.dashboard');
    Route::post('/resident/submit-document', [ServiceController::class, 'submitDocument'])->name('resident.submit.document');
    Route::post('/resident/submit-appointment', [ServiceController::class, 'submitAppointment'])->name('resident.submit.appointment');
    Route::post('/resident/update-profile', [ProfileController::class, 'update'])->name('resident.update.profile');
    Route::post('/resident/update-password', [ProfileController::class, 'updatePassword'])->name('resident.update.password');
    Route::post('/resident/notifications/mark-read', [ProfileController::class, 'markNotificationsRead'])->name('resident.notifications.markRead');
});

// Main dashboard redirect
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('resident.dashboard'); // use named route so data is loaded
})->middleware(['auth', 'verified'])->name('dashboard');

// Pending registration page
Route::get('/register/pending', function () {
    return view('auth.pending');
})->name('register.pending');

Route::patch('/admin/document-requests/{id}/status', [DocumentRequestController::class, 'updateStatus'])
    ->name('admin.documents.updateStatus');


// Single logout route
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

require __DIR__.'/auth.php';
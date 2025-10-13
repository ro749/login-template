<?php

use Illuminate\Support\Facades\Route;
use Ro749\LoginTemplate\Controllers\LoginController;

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::get('/logout', function () {
    auth()->logout();
    return redirect('/');
});

Route::middleware('auth:'.config('overrides.login.guard'))->group(function () {
    Route::get('/reset-password', [LoginController::class, 'reset_password'])->name('reset-password-view');
});

Route::middleware('admin')->group(function () {
    Route::get('/admin/register-user', [LoginController::class, 'register_user']);
    Route::get('/admin/users', [LoginController::class, 'users']);
    Route::post('/admin/reset-password', [LoginController::class, 'reset_password_admin'])->name('reset-password');
});

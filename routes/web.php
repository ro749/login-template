<?php

use Illuminate\Support\Facades\Route;
use Ro749\LoginTemplate\Controllers\LoginController;

Route::middleware(['web'])->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::get('/logout', function () {
        auth()->logout();
        return redirect('/');
    })->name('logout');

    Route::middleware('auth:'.config('overrides.login.guard'))->group(function () {
        Route::get('/reset-password', [LoginController::class, 'reset_password'])->name('reset-password-view');
    });

    Route::middleware('admin')->group(function () {
        Route::get('/admin/register-' . substr(config('overrides.login.table'), 0, -1), [LoginController::class, 'register_user'])->name('register-user');
        Route::get('/admin/'.config('overrides.login.table'), [LoginController::class, 'users'])->name('users');
        Route::post('/admin/reset-password', [LoginController::class, 'reset_password_admin'])->name('reset-password');
    });
});
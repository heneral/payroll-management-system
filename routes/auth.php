<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('guest')->group(function () {
    // Login routes
    Route::get('login', function () {
        return Inertia::render('Auth/Login');
    })->name('login');
    Route::post('login', [\Laravel\Fortify\Http\Controllers\AuthenticatedSessionController::class, 'store']);

    // Register routes
    Route::get('register', function () {
        return Inertia::render('Auth/Register');
    })->name('register');
    Route::post('register', [\Laravel\Fortify\Http\Controllers\RegisteredUserController::class, 'store']);

    // Forgot password routes
    Route::get('forgot-password', function () {
        return Inertia::render('Auth/ForgotPassword');
    })->name('password.request');
    Route::post('forgot-password', [\Laravel\Fortify\Http\Controllers\PasswordResetLinkController::class, 'store'])->name('password.email');

    // Reset password routes
    Route::get('reset-password/{token}', function ($token) {
        return Inertia::render('Auth/ResetPassword', [
            'token' => $token,
        ]);
    })->name('password.reset');
    Route::post('reset-password', [\Laravel\Fortify\Http\Controllers\NewPasswordController::class, 'store'])->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [\Laravel\Fortify\Http\Controllers\AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});



<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PayslipController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Test route
Route::get('/test-employees', function () {
    $employees = \App\Models\Employee::select('id', 'employee_id', 'first_name', 'last_name', 'email', 'phone', 'position', 'base_salary', 'status')->get();
    return Inertia::render('Employees/Index', [
        'employees' => $employees->toArray(),
    ]);
});

// Test employees without auth
Route::get('/employees-test', [\App\Http\Controllers\EmployeeController::class, 'index']);

// Auth Routes (Fortify provides these)
require __DIR__ . '/auth.php';

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Employee Management
    Route::resource('employees', EmployeeController::class);

    // Attendance
    Route::resource('attendance', AttendanceController::class);

    // Payroll
    Route::resource('payroll', PayrollController::class);

    // Payslips
    Route::resource('payslips', PayslipController::class);
});


<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Attendance;
use App\Models\Payroll;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEmployees = Employee::count();
        $activeEmployees = Employee::where('status', 'active')->count();
        $presentToday = Attendance::where('date', today())
            ->where('status', 'present')
            ->count();
        $totalPayrolled = Payroll::sum('net_pay') ?? 0;
        
        $recentAttendance = Attendance::with('employee')
            ->orderBy('date', 'desc')
            ->limit(5)
            ->get();

        return Inertia::render('Dashboard', [
            'stats' => [
                'totalEmployees' => $totalEmployees,
                'activeEmployees' => $activeEmployees,
                'presentToday' => $presentToday,
                'totalPayrolled' => $totalPayrolled,
            ],
            'recentAttendance' => $recentAttendance,
        ]);
    }
}

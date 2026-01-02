<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Attendance/Index', [
            'attendance' => Attendance::with('employee')->orderBy('date', 'desc')->get(),
            'employees' => Employee::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Attendance/Form', [
            'employees' => Employee::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date|unique:attendances,date,NULL,id,employee_id,' . $request->employee_id,
            'check_in' => 'nullable|date_format:H:i',
            'check_out' => 'nullable|date_format:H:i',
            'status' => 'required|in:present,absent,late,half-day,on-leave',
            'notes' => 'nullable|string',
        ]);

        Attendance::create($validated);

        return redirect()->route('attendance.index')->with('success', 'Attendance recorded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        return Inertia::render('Attendance/Show', [
            'record' => $attendance->load('employee'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        return Inertia::render('Attendance/Form', [
            'record' => $attendance,
            'employees' => Employee::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date|unique:attendances,date,' . $attendance->id . ',id,employee_id,' . $attendance->employee_id,
            'check_in' => 'nullable|date_format:H:i',
            'check_out' => 'nullable|date_format:H:i',
            'status' => 'required|in:present,absent,late,half-day,on-leave',
            'notes' => 'nullable|string',
        ]);

        $attendance->update($validated);

        return redirect()->route('attendance.index')->with('success', 'Attendance updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return redirect()->route('attendance.index')->with('success', 'Attendance deleted successfully.');
    }
}

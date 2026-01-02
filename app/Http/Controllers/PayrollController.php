<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\Employee;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Payroll/Index', [
            'payroll' => Payroll::with('employee')->orderBy('period_start', 'desc')->get(),
            'employees' => Employee::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Payroll/Create', [
            'employees' => Employee::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Payroll::create($request->validate([
            'employee_id' => 'required|exists:employees,id',
            'period_start' => 'required|date',
            'period_end' => 'required|date',
            'basic_salary' => 'required|numeric',
            'gross_pay' => 'required|numeric',
            'net_pay' => 'required|numeric',
            'status' => 'required|in:pending,processed,paid',
        ]));

        return redirect()->route('payroll.index')->with('success', 'Payroll created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Inertia::render('payroll/Show', [
            'payroll' => Payroll::with('employee')->findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return Inertia::render('payroll/Edit', [
            'payroll' => Payroll::findOrFail($id),
            'employees' => Employee::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Payroll::findOrFail($id)->update($request->validate([
            'employee_id' => 'required|exists:employees,id',
            'period_start' => 'required|date',
            'period_end' => 'required|date',
            'basic_salary' => 'required|numeric',
            'gross_pay' => 'required|numeric',
            'net_pay' => 'required|numeric',
            'status' => 'required|in:pending,processed,paid',
        ]));

        return redirect()->route('payroll.index')->with('success', 'Payroll updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Payroll::findOrFail($id)->delete();
        return redirect()->route('payroll.index')->with('success', 'Payroll deleted successfully');
    }
}

<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Attendance;
use App\Models\Payroll;
use App\Models\Allowance;
use App\Models\Deduction;
use Illuminate\Database\Seeder;

class PayrollSystemSeeder extends Seeder
{
    public function run(): void
    {
        // Create employees
        $employees = [
            [
                'employee_id' => 'EMP001',
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john@example.com',
                'phone' => '1234567890',
                'position' => 'Software Engineer',
                'base_salary' => 75000,
                'hire_date' => '2023-01-15',
                'status' => 'active',
            ],
            [
                'employee_id' => 'EMP002',
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'email' => 'jane@example.com',
                'phone' => '0987654321',
                'position' => 'Project Manager',
                'base_salary' => 85000,
                'hire_date' => '2023-03-20',
                'status' => 'active',
            ],
            [
                'employee_id' => 'EMP003',
                'first_name' => 'Michael',
                'last_name' => 'Johnson',
                'email' => 'michael@example.com',
                'phone' => '5555555555',
                'position' => 'HR Manager',
                'base_salary' => 70000,
                'hire_date' => '2023-02-10',
                'status' => 'active',
            ],
            [
                'employee_id' => 'EMP004',
                'first_name' => 'Sarah',
                'last_name' => 'Williams',
                'email' => 'sarah@example.com',
                'phone' => '4444444444',
                'position' => 'Accountant',
                'base_salary' => 65000,
                'hire_date' => '2023-04-05',
                'status' => 'active',
            ],
            [
                'employee_id' => 'EMP005',
                'first_name' => 'David',
                'last_name' => 'Brown',
                'email' => 'david@example.com',
                'phone' => '3333333333',
                'position' => 'Sales Executive',
                'base_salary' => 60000,
                'hire_date' => '2023-05-12',
                'status' => 'active',
            ],
        ];

        foreach ($employees as $empData) {
            Employee::create($empData);
        }

        // Create attendance records for the current month
        $now = now();
        $employees = Employee::all();
        
        foreach ($employees as $employee) {
            for ($day = 1; $day <= 5; $day++) {
                Attendance::create([
                    'employee_id' => $employee->id,
                    'date' => $now->copy()->day($day),
                    'check_in' => '09:00',
                    'check_out' => '17:00',
                    'status' => 'present',
                    'notes' => null,
                ]);
            }
        }

        // Create payroll records
        foreach ($employees as $employee) {
            $payroll = Payroll::create([
                'employee_id' => $employee->id,
                'period_start' => now()->startOfMonth(),
                'period_end' => now()->endOfMonth(),
                'base_salary' => $employee->base_salary,
                'total_allowances' => 0,
                'total_deductions' => 0,
                'gross_pay' => $employee->base_salary,
                'net_pay' => $employee->base_salary,
                'status' => 'draft',
            ]);

            // Add allowances
            $allowanceAmount = $employee->base_salary * 0.1; // 10% allowance
            Allowance::create([
                'payroll_id' => $payroll->id,
                'type' => 'Performance Bonus',
                'amount' => $allowanceAmount,
            ]);

            // Add deductions
            $deductionAmount = $employee->base_salary * 0.05; // 5% deduction
            Deduction::create([
                'payroll_id' => $payroll->id,
                'type' => 'Tax',
                'amount' => $deductionAmount,
            ]);

            // Update payroll totals
            $totalAllowances = Allowance::where('payroll_id', $payroll->id)->sum('amount');
            $totalDeductions = Deduction::where('payroll_id', $payroll->id)->sum('amount');
            $grossPay = $employee->base_salary + $totalAllowances;
            $netPay = $grossPay - $totalDeductions;

            $payroll->update([
                'total_allowances' => $totalAllowances,
                'total_deductions' => $totalDeductions,
                'gross_pay' => $grossPay,
                'net_pay' => $netPay,
                'status' => 'approved',
            ]);
        }
    }
}

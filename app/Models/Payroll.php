<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $fillable = ['employee_id', 'period_start', 'period_end', 'base_salary', 'total_allowances', 'total_deductions', 'gross_pay', 'net_pay', 'status'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function allowances()
    {
        return $this->hasMany(Allowance::class);
    }

    public function deductions()
    {
        return $this->hasMany(Deduction::class);
    }

    public function payslip()
    {
        return $this->hasOne(Payslip::class);
    }
}


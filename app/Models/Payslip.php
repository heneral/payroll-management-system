<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payslip extends Model
{
    protected $fillable = ['payroll_id', 'payslip_number', 'gross_pay', 'net_pay', 'status'];

    public function payroll()
    {
        return $this->belongsTo(Payroll::class);
    }
}


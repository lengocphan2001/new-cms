<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'salary_id',
        'allowance',
        'allowances',
        'product_salary',
        'deductions',
        'total_salary',
    ];

    /**
     * Get the salary that owns the salary detail.
     */
    public function salary()
    {
        return $this->belongsTo(Salary::class);
    }
}

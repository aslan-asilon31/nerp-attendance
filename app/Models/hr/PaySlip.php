<?php

namespace App\Models\hr;

use Illuminate\Database\Eloquent\Model;

class PaySlip extends Model
{
    use HasFactory;

    protected $table = 'hr_pay_slips';

    // Guarded fields
    protected $guarded = ['id'];

    // Relationship with Employee
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}

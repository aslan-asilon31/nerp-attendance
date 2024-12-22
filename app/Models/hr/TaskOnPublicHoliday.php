<?php

namespace App\Models\hr;

use Illuminate\Database\Eloquent\Model;

class TaskOnPublicHoliday extends Model
{
    use HasFactory;

    protected $table = 'hr_task_on_public_holidays';

    // Guarded fields
    protected $guarded = ['id'];

    // Relationship with Employee
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}

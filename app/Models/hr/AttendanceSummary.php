<?php

namespace App\Models\hr;

use Illuminate\Database\Eloquent\Model;

class AttendanceSummary extends Model
{
    use HasFactory;

    protected $table = 'hr_attendance_summaries';

    // Guarded fields
    protected $guarded = ['id'];

    // Relationship with Employee
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}

<?php

namespace App\Models\hr;

use Illuminate\Database\Eloquent\Model;

class RecordOutOfOfficeTask extends Model
{
    use HasFactory;

    protected $table = 'hr_record_out_of_office_tasks';

    // Guarded fields
    protected $guarded = ['id'];

    // Relationship with Employee
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}

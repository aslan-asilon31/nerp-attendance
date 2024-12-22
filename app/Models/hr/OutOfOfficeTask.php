<?php

namespace App\Models\hr;

use Illuminate\Database\Eloquent\Model;

class OutOfOfficeTask extends Model
{

    use HasFactory;

    protected $table = 'hr_out_of_office_tasks';

    // Guarded array (protect 'id' from mass-assignment)
    protected $guarded = ['id'];

    // Relationship with Employee
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

}

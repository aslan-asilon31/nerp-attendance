<?php

namespace App\Models\hr;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $table = 'hr_leaves';

    // Use guarded to protect certain attributes from mass-assignment
    protected $guarded = ['id'];

    // Relationship with Employee
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}

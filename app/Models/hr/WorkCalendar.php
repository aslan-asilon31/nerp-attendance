<?php

namespace App\Models\hr;

use Illuminate\Database\Eloquent\Model;

class WorkCalendar extends Model
{
    use HasFactory;

    protected $table = 'hr_work_calendars';

    // Guarded fields
    protected $guarded = ['id'];
}

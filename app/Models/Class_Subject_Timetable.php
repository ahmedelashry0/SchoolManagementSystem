<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Class_Subject_Timetable extends Model
{
    use HasFactory;

    protected $fillable = ['class_id', 'subject_id', 'week_id', 'room_number' , 'start_time' , 'end_time'];

    public function class()
    {
        return $this->belongsTo(Classroom::class, 'class_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function week()
    {
        return $this->belongsTo(Week::class, 'week_id');
    }

}

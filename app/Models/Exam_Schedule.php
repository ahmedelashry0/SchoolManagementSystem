<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam_Schedule extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['exam_id', 'class_id', 'subject_id', 'exam_date', 'start_time', 'end_time', 'room_number', 'created_by' , 'full_mark' , 'pass_mark'];

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }

    public function class()
    {
        return $this->belongsTo(Classroom::class, 'class_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }



}

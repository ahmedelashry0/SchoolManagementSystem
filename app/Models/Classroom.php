<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classroom extends Model
{
    use HasFactory , softDeletes;

    protected $fillable = [
        'name',
        'status',
        'created_by',
    ];

    protected $enum_status = [
        'active',
        'inactive',
    ];

    public function user() //relationship with user (CreatedBy)
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function subject() //relationship with subject
    {
        return $this->belongsToMany(Subject::class, 'class_subject', 'class_id', 'subject_id')
            ->withPivot(['status' , 'created_by'])
            ->withTimestamps()
            ->withTrashed();
    }

    public function student() //relationship with student
    {
        return $this->hasMany(User::class, 'class_id');
    }

    public function teachers() //relationship with teacher
    {
        return $this->belongsToMany(User::class, 'class_teachers', 'class_id', 'teacher_id')
            ->withPivot(['status'])
            ->withTimestamps()
            ->withTrashed();
    }

    public function ClassSubjects()
    {
        return $this->hasMany(ClassSubject::class, 'class_id');
    }
    public function getEnumStatus()
    {
        return $this->enum_status;
    }


    public function timetables()
    {
        return $this->hasMany(Class_Subject_Timetable::class, 'class_id');
    }

    public function exams()
    {
        return $this->hasMany(Exam_Schedule::class, 'class_id');
    }
}

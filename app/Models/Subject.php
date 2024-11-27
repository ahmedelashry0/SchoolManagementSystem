<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'status', 'created_by'];

    protected $enum_status = ['active', 'inactive'];
    protected $enum_type = ['theory', 'practical'];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function class()
    {
        return $this->belongsToMany(Classroom::class, 'class_subject', 'subject_id', 'class_id')
            ->with('status' , 'created_by'  )
            ->withTimestamps()
            ->withTrashed();
    }

    public function getEnumStatus()
    {
        return $this->enum_status;
    }

    public function getEnumType()
    {
        return $this->enum_type;
    }

    public function timetables()
    {
        return $this->hasMany(Class_Subject_Timetable::class, 'subject_id');
    }
}

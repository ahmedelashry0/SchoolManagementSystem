<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassTeacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'teacher_id',
    ];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class , 'class_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class);
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassSubject extends Model
{
    use HasFactory , softDeletes;

    protected $table = 'class_subject';

    protected $fillable = [
        'class_id',
        'subject_id',
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
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function classroom() //relationship with classroom
    {
        return $this->belongsTo(Classroom::class, 'class_id');
    }

    public function getEnumStatus()
    {
        return $this->enum_status;
    }

}

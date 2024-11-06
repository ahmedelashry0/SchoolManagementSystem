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

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'class_id');
    }

    public function getEnumStatus()
    {
        return $this->enum_status;
    }
}

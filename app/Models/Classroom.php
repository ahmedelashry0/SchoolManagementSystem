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

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getEnumStatus()
    {
        return $this->enum_status;
    }
}

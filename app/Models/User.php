<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, softDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $enum_status = ['active', 'inactive'];
    protected $enum_marital_status = ['single', 'married', 'divorced', 'widowed'];

    public function subjects()
    {
        return $this->hasManyThrough(Subject::class, ClassSubject::class, 'class_id', 'id', 'class_id', 'subject_id');
    }
    public function classroom()
    {
        return $this->hasMany(Classroom::class, 'created_by');
    }

    public function student_class()
    {
        return $this->belongsTo(Classroom::class, 'class_id');
    }

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id')->where('user_type', 'parent');
    }

    public function students()
    {
        return $this->hasMany(User::class, 'parent_id')->where('user_type', 'student');
    }
    public function getEnumStatus()
    {
        return $this->enum_status;
    }

    public function getEnumMaritalStatus()
    {
        return $this->enum_marital_status;
    }
}

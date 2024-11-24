<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use App\Models\ClassTeacher;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherDashboardController extends Controller
{
    public function my_classes()
    {
        $header_title = 'My Classes';
        $teacher_id = auth()->id();
        $classesSubjects = ClassTeacher::with(['classroom.classSubjects.subject'])
            ->where('teacher_id', $teacher_id)
            ->paginate(6);
        return view('teacher.my_classes' , compact('header_title' , 'classesSubjects'));
    }
}

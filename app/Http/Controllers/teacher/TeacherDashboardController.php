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

    public function my_students()
    {
        $header_title = 'My Students';
        $teacher_id = auth()->id();
//        $students = User::whereHas('student_class', function ($query) use ($teacher_id) {
//            $query->whereHas('teachers', function ($query) use ($teacher_id) {
//                $query->where('teacher_id', $teacher_id);
//            });
//        })
//            ->with('student_class')
//            ->paginate(6);
        $students = ClassTeacher::with(['classroom.student'])
            ->where('teacher_id', $teacher_id)
            ->paginate(6);
        return view('teacher.my_students' , compact('header_title' , 'students'));
    }
}

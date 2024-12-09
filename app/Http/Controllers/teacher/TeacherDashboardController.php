<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use App\Models\Class_Subject_Timetable;
use App\Models\ClassTeacher;
use App\Models\Exam_Schedule;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherDashboardController extends Controller
{
    public function my_classes()
    {
        $header_title = 'My Classes';
        $teacher_id = auth()->id();
        $classesSubjects = ClassTeacher::with([
            'classroom.classSubjects.subject',
            'classroom.classSubjects.timetables.week'
        ])->where('teacher_id', $teacher_id)
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

    public function my_timetable($class_id , $subject_id)
    {
        $header_title = 'My Timetable';
        $timetables = Class_Subject_Timetable::with(['class' , 'subject' , 'week'])->where('class_id', $class_id)
            ->where('subject_id', $subject_id)->get();
        return view('teacher.my_timetable' , compact('header_title' , 'timetables'));
    }

    public function my_exams()
    {
        $header_title = 'My Exams';
        $teacher_id = auth()->id();

        // Fetch classes taught by the teacher and their related exam schedules
        $classes = ClassTeacher::where('teacher_id', $teacher_id)
            ->with([
                'classroom.exams.subject', // Classroom's exams and related subjects
                'classroom.exams.exam'    // Exam details
            ])
            ->get();
//        dd($classes);
        return view('teacher.my_exams', compact('header_title', 'classes'));
    }


}

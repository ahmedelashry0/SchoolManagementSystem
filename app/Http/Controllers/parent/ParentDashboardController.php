<?php

namespace App\Http\Controllers\parent;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ParentDashboardController extends Controller
{
    public function my_students()
    {
        $header_title = 'My Students';
        $parent = auth()->user();
        $students = $parent->students()->paginate(10);
        return view('parent.my_students', compact('parent' , 'students', 'header_title'));
    }

    public function my_students_subjects($id)
    {
        $header_title = 'My Students Subjects';
        $student = User::find($id);
        $subjects = $student->subjects()->paginate(6);
        return view('parent.my_students_subjects', compact('student' , 'subjects', 'header_title'));
    }

    public function my_students_subjects_timetable($id)
    {
        $header_title = 'My Students Subjects Timetable';

        $student = User::with(['student_class.subject.timetables' => function ($query) use ($id) {
                $query->where('class_id', function ($subquery) use ($id) {
                    $subquery->select('class_id')
                        ->from('users')
                        ->where('id', $id);
                });

        }],['student_class.subject.timetables.week'])
            ->findOrFail($id);

        return view('parent.my_students_subjects_timetable', compact('student', 'header_title' ));
    }

    public function my_students_exams($id)
    {
        $header_title = 'My Students Exams';
        $student = User::find($id);
        $exams = $student->student_class->exams()->paginate(6);
        return view('parent.my_students_exams', compact('student' , 'exams', 'header_title'));
    }

}

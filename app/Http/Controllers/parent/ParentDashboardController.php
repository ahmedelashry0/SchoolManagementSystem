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

        // Fetch the student with their class, subjects, and timetables
        $student = User::with(['student_class.classSubjects.subject.timetables.week'])
            ->findOrFail($id);

        return view('parent.my_students_subjects_timetable', compact('student', 'header_title'));
    }

}

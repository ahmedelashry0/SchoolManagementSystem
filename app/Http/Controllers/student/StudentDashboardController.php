<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function my_subjects()
    {
        $user = Auth::user();
        $header_title = 'My Subjects';
        $subjects = $user->subjects()->paginate(6);
        return view('student.my_subjects', compact('subjects' , 'header_title'));
    }

    public function my_timetable()
    {
        $user_id = Auth::user()->id;
        $header_title = 'My Timetable';
        $timetables = User::with('student_class.subject.timetables.week')->find($user_id);
//        dd($timetables);
        return view('student.my_timetable', compact('timetables' , 'header_title'));
    }
}

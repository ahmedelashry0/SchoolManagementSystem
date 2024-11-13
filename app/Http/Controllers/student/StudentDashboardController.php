<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
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
}

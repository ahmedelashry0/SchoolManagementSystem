<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $header_title = 'Dashboard';

        if (Auth::user()->user_type == 'admin') {
            return view('admin.dashboard', compact('header_title'));
        } else if (Auth::user()->user_type == 'teacher') {
            return view('teacher.dashboard', compact('header_title'));
        } else if (Auth::user()->user_type == 'parent') {
            return view('parent.dashboard', compact('header_title'));
        } else if (Auth::user()->user_type == 'student') {
            return view('student.dashboard', compact('header_title'));
        }
    }
}

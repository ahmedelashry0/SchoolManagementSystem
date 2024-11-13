<?php

namespace App\Http\Controllers\parent;

use App\Http\Controllers\Controller;
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
}

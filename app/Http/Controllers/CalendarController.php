<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function my_calendar()
    {
        $header_title = 'My Calendar';
        $user_id = Auth::user()->id;
        $header_title = 'My Timetable';
        $timetables = User::with(['student_class.subject.timetables' => function ($query) use ($user_id) {
            $query->where('class_id', function ($query) use ($user_id) {
                $query->select('class_id')
                    ->from('users')
                    ->where('id', $user_id);
            });

        }],'student_class.subject.timetables.week')->find($user_id);
//        dd($timetables);
        return view('student.my_calendar', compact('header_title' , 'timetables'));
    }
}

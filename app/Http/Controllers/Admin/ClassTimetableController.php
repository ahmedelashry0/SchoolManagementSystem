<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Class_Subject_Timetable;
use App\Models\Classroom;
use App\Models\Subject;
use App\Models\Week;
use Illuminate\Http\Request;

class ClassTimetableController extends Controller
{
    public function index(Request $request)
    {
        $header_title = 'Class Timetable';
        $classes = Classroom::all();

        // If a class is selected, fetch only its subjects
        if ($request->has('class_id')) {
            $selectedClass = Classroom::findOrFail($request->class_id);
            $subjects = $selectedClass->subject; // Assuming you have a subjects() relationship defined
        } else {
            $subjects = Subject::all();
        }

        $weeks = Week::all();
        return view('admin.class_timetable.list', compact('header_title', 'classes', 'subjects', 'weeks'));
    }

    public function getSubjectsByClass($classId)
    {
        $class = Classroom::findOrFail($classId);

        // Retrieve subjects with pivot details
        $subjects = $class->subject->map(function ($subject) {
            return [
                'id' => $subject->id,
                'name' => $subject->name,
            ];
        });

        return response()->json($subjects);
    }

    public function getTimetable($classId, $subjectId)
    {
        $timetable = Class_Subject_Timetable::where('class_id', $classId)
            ->where('subject_id', $subjectId)
            ->get();

        // Return data in a format compatible with the frontend
        return response()->json($timetable);
    }


    public function add(Request $request)
    {
//        dd($request->all());
//        $request->validate([
//            'class_id' => 'required|exists:classrooms,id',
//            'subject_id' => 'required|exists:subjects,id',
//            'week_id' => 'required|exists:weeks,id',
//            'room_number' => 'required|string',
//        ]);

        Class_Subject_Timetable::where('class_id', $request->class_id)
            ->where('subject_id', $request->subject_id)
            ->delete();
        foreach ($request->timetable as $timetable) {
            if ( !empty($timetable['week_id']) && !empty($timetable['start_time']) && !empty($timetable['end_time']) && !empty($timetable['room_number'])) {
                Class_Subject_Timetable::create([
                    'class_id' => $request->class_id,
                    'subject_id' => $request->subject_id,
                    'week_id' => $timetable['week_id'],
                    'start_time' => $timetable['start_time'],
                    'end_time' => $timetable['end_time'],
                    'room_number' => $timetable['room_number'],
                ]);
            }
        }
        return redirect()->back()->with('success', 'Class timetable added successfully');
    }
}

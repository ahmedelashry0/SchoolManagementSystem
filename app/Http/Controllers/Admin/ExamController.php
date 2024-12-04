<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Exam;
use App\Models\Exam_Schedule;
use App\Models\Subject;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function list()
    {
        $header_title = 'Exam List';
        $exams = Exam::paginate(6);
        return view('admin.exam.list' , compact('header_title', 'exams'));
    }

    public function add()
    {
        $header_title = 'Add Exam';
        return view('admin.exam.add', compact('header_title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'note' => 'required',
        ]);

        $exam = Exam::create([
            'name' => $request->name,
            'note' => $request->note,
            'created_by' => auth()->user()->id,
        ]);

        return redirect()->route('admin.exam.list')->with('success', 'Exam added successfully');
    }

    public function edit($id)
    {
        $header_title = 'Edit Exam';
        $exam = Exam::findOrFail($id);
        return view('admin.exam.edit', compact('header_title', 'exam'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'note' => 'required',
        ]);

        $exam = Exam::findOrFail($id);
        $exam->update([
            'name' => $request->name,
            'note' => $request->note,
        ]);

        return redirect()->route('admin.exam.list')->with('success', 'Exam updated successfully');
    }

    public function delete($id)
    {
        $exam = Exam::findOrFail($id);
        $exam->delete();
        return redirect()->route('admin.exam.list')->with('success', 'Exam deleted successfully');
    }

    //exam schedule

    public function schedule(Request $request)
    {
        $header_title = 'Exam Schedule';
        $exams = Exam::all();
        $classes = Classroom::all();

        if ($request->class_id && $request->exam_id) {
            $class_id = $request->class_id;
            $exam_id = $request->exam_id;
            $subjects = Subject::whereHas('class', function ($query) use ($class_id) {
                $query->where('class_id', $class_id);
            })->get();
            $schedules = Exam_Schedule::where('class_id', $class_id)->where('exam_id', $exam_id)->get()->keyBy('subject_id');
        } else {
            $subjects = [];
            $class_id = null;
            $exam_id = null;
            $schedules = [];
        }

//        dd($schedules);
        return view('admin.exam.schedule', compact('header_title', 'exams'  , 'classes' , 'subjects', 'class_id', 'exam_id' , 'schedules'));
    }

    public function schedule_store(Request $request)
    {
//        dd($request->all());
        $data = $request->input('schedule');

        $validSchedules = array_filter($data, function ($schedule) {
            return !empty($schedule['exam_date']) &&
                !empty($schedule['start_time']) &&
                !empty($schedule['end_time']) &&
                !empty($schedule['room_number']) &&
                !empty($schedule['full_marks']) &&
                !empty($schedule['passing_marks']);
        });
//        dd($validSchedules);
        foreach ($validSchedules as $subject_id => $schedule) {
            Exam_Schedule::updateOrCreate([
                'exam_id' => $request->exam_id,
                'class_id' => $request->class_id,
                'subject_id' => $subject_id,
            ],[
                'exam_id' => $request->exam_id,
                'class_id' => $request->class_id,
                'subject_id' => $subject_id,
                'exam_date' => $schedule['exam_date'],
                'start_time' => $schedule['start_time'],
                'end_time' => $schedule['end_time'],
                'room_number' => $schedule['room_number'],
                'full_mark' => $schedule['full_marks'],
                'pass_mark' => $schedule['passing_marks'],
                'created_by' => auth()->user()->id,
            ]);
        }

        return redirect()->route('admin.exam_schedule')->with('success', 'Exam scheduled successfully');
    }
}

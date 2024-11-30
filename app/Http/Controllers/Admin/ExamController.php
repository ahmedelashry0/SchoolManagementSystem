<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
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
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function subject_list(Request $request)
    {
        $header_title = 'Subjects';
        $query = Subject::orderBy('id', 'desc');

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('date')) {
            $query->where('created_at', 'like', '%' . $request->date . '%');
        }
        $subjects = $query->paginate(6);
        return view('admin.subject.list' , compact('header_title','subjects'));
    }

    public function subject_add()
    {
        $header_title = 'Add Subject';
        return view('admin.subject.add' , compact('header_title'));
    }

    public function subject_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        $subject = new Subject();
        $subject->name = $request->name;
        $subject->status = $request->status;
        $subject->type = $request->type;
        $subject->created_by = auth()->user()->id;
        $subject->save();
        return redirect()->route('admin.subject.list')->with('success', 'Subject added successfully');
    }

    public function subject_edit($id)
    {
        $header_title = 'Edit Subject';
        $subject = Subject::findOrFail($id);
        return view('admin.subject.edit', compact('subject' , 'header_title'));
    }

    public function subject_update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'status' => 'required',
        ]);

        $subject = Subject::findOrFail($id);
        $subject->name = $request->name;
        $subject->status = $request->status;
        $subject->type = $request->type;
        $subject->save();

        return redirect()->route('admin.subject.list')->with('success', 'Subject updated successfully');
    }

    public function subject_delete($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        return redirect()->route('admin.subject.list');
    }
}

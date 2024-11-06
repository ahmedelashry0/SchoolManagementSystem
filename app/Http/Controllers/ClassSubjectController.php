<?php

namespace App\Http\Controllers;

use App\Http\Requests\admin\StoreUpdateAssignRequest;
use App\Models\Classroom;
use App\Models\ClassSubject;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class ClassSubjectController extends Controller
{
    public function list(Request $request)
    {
        $header_title = 'Class Subjects';

        $query = ClassSubject::query();

        if ($request->filled('className')) {
            $query->whereHas('classroom', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->className . '%');
            });
        }

        if ($request->filled('subjectName')) {
            $query->whereHas('subject', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->subjectName . '%');
            });
        }

        if ($request->filled('creator')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', $request->creator);
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $classSubjects = $query->orderBy('id', 'desc')->paginate(6);

        return view('admin.class_subject.list', compact('header_title', 'classSubjects'));
    }


    public function assign()
    {
        $header_title = 'Assign Subject';
        $classrooms = Classroom::where('status', 'active')->get();
        $subjects = Subject::where('status', 'active')->get();
        return view('admin.class_subject.assign', compact('header_title', 'classrooms' , 'subjects'));
    }

    public function assign_store(StoreUpdateAssignRequest $request)
    {
        $classroom = Classroom::findOrFail($request->classroom);

        $syncData = array_fill_keys($request->subjects, [
            'status' => $request->status,
            'created_by' => auth()->id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $classroom->subject()->sync($syncData);

        return redirect()
            ->route('admin.class_subject.list')
            ->with('success', 'Class and subjects assigned successfully.');
    }

    public function edit($id)
    {
        $header_title = 'Edit Class Subject';
        $classSubject = ClassSubject::findOrFail($id);
        $assigned_subjects = $classSubject->classroom->subject->pluck('id')->toArray();
        $classrooms = Classroom::where('status', 'active')->get();
        $subjects = Subject::where('status', 'active')->get();
        return view('admin.class_subject.edit', compact('header_title', 'classSubject' , 'classrooms' , 'subjects' , 'assigned_subjects'));
    }

    public function edit_single($id)
    {
        $header_title = 'Edit Class Subject';
        $classSubject = ClassSubject::findOrFail($id);
        $classrooms = Classroom::where('status', 'active')->get();
        $subjects = Subject::where('status', 'active')->get();
        return view('admin.class_subject.edit_single', compact('header_title', 'classSubject' , 'classrooms' , 'subjects' ));
    }

    public function update(StoreUpdateAssignRequest $request, $id)
    {
        $classroom = Classroom::findOrFail($request->classroom);

        $syncData = array_fill_keys($request->subjects, [
            'status' => $request->status,
            'created_by' => auth()->id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $classroom->subject()->sync($syncData);

        return redirect()
            ->route('admin.class_subject.list')
            ->with('success', 'Class and subjects assigned successfully.');
    }

    public function update_single(Request $request, $id)
    {
        $request->validate([
            'classroom' => 'required',
            'subject' => 'required',
            'status' => 'required',
        ]);
        $classSubject = ClassSubject::findOrFail($id);
        $classSubject->class_id = $request->classroom;
        $classSubject->subject_id = $request->subject;
        $classSubject->status = $request->status;
        $classSubject->save();
        return redirect()
            ->route('admin.class_subject.list')
            ->with('success', 'Class and subjects assigned successfully.');
    }

    public function delete($id)
    {
        $classSubject = ClassSubject::findOrFail($id);
        $classSubject->delete();
        return redirect()
            ->route('admin.class_subject.list')
            ->with('success', 'Class and subjects unassigned successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\User;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function class_list(Request $request)
    {
        $header_title = 'Class List';
        $query = Classroom::orderBy('id', 'desc');

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date')) {
            $query->where('created_at', 'like', '%' . $request->date . '%');
        }
        $classes = $query->paginate(6);
        return view('admin.class.list', compact('header_title', 'classes'));
    }

    public function class_add()
    {
        $header_title = 'Add Class';
        return view('admin.class.add', compact('header_title'));
    }

    public function class_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required|in:active,inactive',
        ]);
        $class = Classroom::create([
            'name' => $request->name,
            'status' => $request->status,
            'created_by' => auth()->user()->id,
        ]);

        return redirect()->route('admin.class.list')->with('success', 'Class added successfully');
    }

    public function class_edit($id)
    {
        $header_title = 'Edit Class';
        $class = Classroom::findOrFail($id);
        return view('admin.class.edit', compact('header_title', 'class'));
    }

    public function class_update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);
        $class = Classroom::findOrFail($id);
        $class->name = $request->name;
        $class->status = $request->status;
        $class->save();
        return redirect()->route('admin.class.list')->with('success', 'Class updated successfully');
    }

    public function class_delete($id)
    {
        Classroom::findOrFail($id)->delete();
        return redirect()->route('admin.class.list')->with('success', 'Class deleted successfully');
    }
}

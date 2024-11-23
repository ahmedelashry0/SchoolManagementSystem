<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\ClassTeacher;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\Filter;

class ClassTeacherController extends Controller
{
    use Filter;
    public function list(Request $request)
    {
        $header_title = 'Class Teachers';
        $properties = [
            'class_id' => '=',
            'teacher_id' => '=',
            'status' => '=',
            'created_at' => 'like',
        ];
        $query = $this->filter(ClassTeacher::class, 'id', $request, $properties, 'desc');
        $classTeachers = $query->paginate(6);
        $classes = Classroom::where('status', 'active')->get();
        $teachers = User::where('user_type', 'teacher')->get();
        return view('admin.class_teacher.list', compact('classTeachers' , 'header_title' , 'classes' , 'teachers'));
    }

    public function assign()
    {
        $header_title = 'Assign Teacher';
        $teachers = User::where('user_type', 'teacher')->get();
        $classrooms = Classroom::where('status', 'active')->get();
        return view('admin.class_teacher.assign', compact('header_title' , 'teachers' , 'classrooms'));
    }

    public function assign_store(Request $request)
    {
        $request->validate([
            'classroom' => 'required|exists:classrooms,id',
            'teachers' => 'required|array',
            'teachers.*' => 'exists:users,id',
            'status' => 'required|in:active,inactive',
        ]);

        $classroom = Classroom::findOrFail($request->classroom);

        $syncData = array_fill_keys($request->teachers, [
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $classroom->teachers()->sync($syncData);
        return redirect()->route('admin.class_teacher.list')->with('success', 'Teacher assigned successfully');
    }

    public function edit($id)
    {
        $header_title = 'Edit Class Teacher';
        $classTeacher = ClassTeacher::findOrFail($id);
        $assigned_teachers = $classTeacher->classroom->teachers->pluck('id')->toArray();
        $classrooms = Classroom::where('status', 'active')->get();
        $teachers = User::where('user_type', 'teacher')->get();
        return view('admin.class_teacher.edit', compact('header_title', 'classTeacher' , 'classrooms' , 'teachers' , 'assigned_teachers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'classroom' => 'required|exists:classrooms,id',
            'teachers' => 'required|array',
            'teachers.*' => 'exists:users,id',
            'status' => 'required|in:active,inactive',
        ]);

        $classroom = Classroom::findOrFail($request->classroom);

        $syncData = array_fill_keys($request->teachers, [
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $classroom->teachers()->sync($syncData);
        return redirect()->route('admin.class_teacher.list')->with('success', 'Teacher assigned successfully');
    }

    public function delete($id)
    {
        $classTeacher = ClassTeacher::findOrFail($id);
        $classTeacher->delete();
        return redirect()->route('admin.class_teacher.list')->with('success', 'Teacher unassigned successfully');
    }
}

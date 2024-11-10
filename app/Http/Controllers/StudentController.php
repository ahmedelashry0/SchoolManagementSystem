<?php

namespace App\Http\Controllers;

use App\Http\Requests\admin\StoreStudentRequest;
use App\Models\Classroom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Traits\Image;
use App\Traits\Filter;

class StudentController extends Controller
{
    use Image , Filter;
    public function student_list(Request $request)
    {
        $header_title = 'Student List';
        $properties = [
            'users.name' => 'like',
            'last_name' => 'like',
            'admission_number' => 'like',
            'roll_number' => 'like',
            'class_id' => '=',
            'gender' => '=',
            'date_of_birth' => '=',
            'religion' => 'like',
            'phone_number' => 'like',
            'admission_date' => '=',
            'blood_group' => 'like',
            'height' => '=',
            'weight' => '=',
            'email' => 'like',
            'status' => '=',
        ];
        $studentQuery = $this->filter(User::class, 'id' ,$request , $properties , 'desc');
        $students = $studentQuery->where('user_type', 'student')
            ->join('classrooms', 'users.class_id', '=', 'classrooms.id')
            ->select('users.*', 'classrooms.name as class_name')
            ->paginate(6);
        return view('admin.student.list', compact('header_title' , 'students'));
    }

    public function student_add()
    {
        $header_title = 'Add Student';
        $classes = Classroom::where('status', 'active')->get();
        return view('admin.student.add', compact('header_title' , 'classes'));
    }

    public function student_store(Request $request)
    {
        $student = new User();
        $path = $this->storeImage($request, 'profile_picture', 'profile_pictures');
        $student->image = $path ?? $student->image;
        $student->name = $request->input('name');
        $student->last_name = $request->input('last_name');
        $student->admission_number = $request->input('admission_number');
        $student->roll_number = $request->input('roll_number');
        $student->class_id = $request->input('class_id');
        $student->gender = $request->input('gender');
        $student->date_of_birth = $request->input('date_of_birth');
        $student->religion = $request->input('religion');
        $student->phone_number = $request->input('phone_number');
        $student->admission_date = $request->input('admission_date');
        $student->blood_group = $request->input('blood_type');
        $student->height = $request->input('height');
        $student->weight = $request->input('weight');
        $student->status = $request->input('status');
        $student->email = $request->input('email');
        $student->password = Hash::make($request->input('password'));
        $student->user_type = 'student';

        $student->save();
        return redirect()->route('admin.student.list')->with('success', 'Student added successfully');
    }

    public function student_edit($id)
    {
        $header_title = 'Edit Student';
        $student = User::find($id);
        $classes = Classroom::where('status', 'active')->get();
        return view('admin.student.edit', compact('header_title' , 'student', 'classes'));
    }

    public function student_update(Request $request, $id)
    {
        $student = User::find($id);
        $student->image = $this->updateImage($request, 'profile_picture', 'profile_pictures' , $student->image);
        $student->name = $request->input('name') ?? $student->name;
        $student->last_name = $request->input('last_name') ?? $student->last_name;
        $student->admission_number = $request->input('admission_number') ?? $student->admission_number;
        $student->roll_number = $request->input('roll_number')  ?? $student->roll_number;
        $student->class_id = $request->input('class_id') ?? $student->class_id;
        $student->gender = $request->input('gender') ?? $student->gender;
        $student->date_of_birth = $request->input('date_of_birth') ?? $student->date_of_birth;
        $student->religion = $request->input('religion') ?? $student->religion;
        $student->phone_number = $request->input('phone_number') ?? $student->phone_number;
        $student->admission_date = $request->input('admission_date') ?? $student->admission_date;
        $student->blood_group = $request->input('blood_type') ?? $student->blood_group;
        $student->height = $request->input('height') ?? $student->height;
        $student->weight = $request->input('weight') ?? $student->weight;
        $student->status = $request->input('status') ?? $student->status;
        $student->email = $request->input('email') ?? $student->email;
        if ($request->input('password')) {
            $student->password = Hash::make($request->input('password'));
        }
        $student->save();
        return redirect()->route('admin.student.list')->with('success', 'Student updated successfully');
    }

    public function student_delete($id)
    {
        $student = User::find($id);
        $student->delete();
        return redirect()->route('admin.student.list')->with('success', 'Student deleted successfully');
    }
}

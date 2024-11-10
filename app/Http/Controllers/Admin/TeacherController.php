<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\StoreTeacherRequest;
use App\Models\User;
use App\Traits\Filter;
use App\Traits\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    use Image, Filter;

    public function teacher_list(Request $request)
    {
        $header_title = 'Teacher List';
        $properties = [
            'name' => 'like',
            'last_name' => 'like',
            'email' => 'like',
            'phone_number' => 'like',
            'address' => 'like',
            'permanent_address' => 'like',
            'gender' => '=',
            'date_of_birth' => '=',
            'date_of_joining' => '=',
            'marital_status' => '=',
            'qualification' => 'like',
            'work_experience' => 'like',
            'status' => '=',
        ];
        $teacherQuery =$this->filter(User::class, 'id', $request, $properties, 'desc');

        $teachers = $teacherQuery->where('user_type', 'teacher')->paginate(6);
        return view('admin.teacher.list', compact('header_title', 'teachers'));
    }

    public function teacher_add()
    {
        $header_title = 'Add Teacher';
        return view('admin.teacher.add', compact('header_title'));
    }

    public function teacher_store(StoreTeacherRequest $request)
    {
        $teacher = new User();
        $path = $this->storeImage($request, 'profile_picture', 'profile_pictures');
        $teacher->image = $path ?? $teacher->image;
        $teacher->name = $request->input('name');
        $teacher->last_name = $request->input('last_name');
        $teacher->address = $request->input('address');
        $teacher->permanent_address = $request->input('permanent_address');
        $teacher->gender = $request->input('gender');
        $teacher->date_of_birth = $request->input('date_of_birth');
        $teacher->admission_date = $request->input('date_of_joining');
        $teacher->marital_status = $request->input('marital_status');
        $teacher->qualification = $request->input('qualification');
        $teacher->work_experience = $request->input('work_experience');
        $teacher->note = $request->input('note');
        $teacher->phone_number = $request->input('phone_number');
        $teacher->status = $request->input('status');
        $teacher->email = $request->input('email');
        $teacher->password = Hash::make($request->input('password'));
        $teacher->user_type = 'teacher';

        $teacher->save();
        return redirect()->route('admin.teacher.list')->with('success', 'Teacher Added Successfully');
    }

    public function teacher_edit($id)
    {
        $header_title = 'Edit Teacher';
        $teacher = User::find($id);
        return view('admin.teacher.edit', compact('header_title', 'teacher'));
    }

    public function teacher_update(StoreTeacherRequest $request, $id)
    {
        $teacher = User::find($id);
        $path = $this->UpdateImage($request, 'profile_picture', 'profile_pictures', $teacher->image);
        $teacher->image = $path ?? $teacher->image;
        $teacher->name = $request->input('name') ?? $teacher->name;
        $teacher->last_name = $request->input('last_name') ?? $teacher->last_name;
        $teacher->address = $request->input('address') ?? $teacher->address;
        $teacher->permanent_address = $request->input('permanent_address') ?? $teacher->permanent_address;
        $teacher->gender = $request->input('gender') ?? $teacher;
        $teacher->date_of_birth = $request->input('date_of_birth') ?? $teacher->date_of_birth;
        $teacher->admission_date = $request->input('date_of_joining') ?? $teacher->admission_date;
        $teacher->marital_status = $request->input('marital_status') ?? $teacher->marital_status;
        $teacher->qualification = $request->input('qualification') ?? $teacher->qualification;
        $teacher->work_experience = $request->input('work_experience') ?? $teacher->work_experience;
        $teacher->note = $request->input('note') ?? $teacher->note;
        $teacher->phone_number = $request->input('phone_number') ?? $teacher->phone_number;
        $teacher->status = $request->input('status') ?? $teacher->status;
        $teacher->email = $request->input('email') ?? $teacher->email;
        $teacher->password = Hash::make($request->input('password')) ?? $teacher->password;

        $teacher->save();
        return redirect()->route('admin.teacher.list')->with('success', 'Teacher Updated Successfully');
    }

    public function teacher_delete($id)
    {
        $teacher = User::find($id);
        $teacher->delete();
        return redirect()->route('admin.teacher.list')->with('success', 'Teacher Deleted Successfully');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\Filter;
use App\Traits\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ParentController extends Controller
{
    use Image, Filter;
    public function parent_list(Request $request)
    {
        $header_title = 'Parent List';
        $properties = [
            'users.name' => 'like',
            'last_name' => 'like',
            'email' => 'like',
            'phone_number' => 'like',
            'address' => 'like',
            'status' => '=',
            'occupation' => 'like',
            'gender' => '=',
        ];
        $parentsQuery = $this->filter(User::class, 'id', $request, $properties, 'desc');
        $parents = $parentsQuery->where('user_type', 'parent')->paginate(6);
        return view('admin.parent.list', compact('header_title' , 'parents'));
    }

    public function parent_add()
    {
        $header_title = 'Add Parent';
        return view('admin.parent.add', compact('header_title'));
    }

    public function parent_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'phone_number' => 'required',
            'address' => 'required',
            'status' => 'required',
            'occupation' => 'required',
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = new User();
        $path = $this->storeImage($request, 'profile_picture', 'profile_pictures');
        $user->image = $path ?? $user->image;
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->gender = $request->gender;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        $user->status = $request->status;
        $user->occupation = $request->occupation;
        $user->user_type = 'parent';
        $user->save();

        return redirect()->route('admin.parent.list')->with('success', 'Parent added successfully');
    }

    public function parent_edit($id)
    {
        $header_title = 'Edit Parent';
        $parent = User::find($id);
        return view('admin.parent.edit', compact('header_title', 'parent'));
    }

    public function parent_update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'phone_number' => 'required',
            'address' => 'required',
            'status' => 'required',
            'occupation' => 'required',
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = User::find($id);
        $path = $this->updateImage($request, 'profile_picture', 'profile_pictures' , $user->image);
        $user->image = $path ?? $user->image;
        $user->name = $request->name ?? $user->name;
        $user->last_name = $request->last_name ?? $user->last_name;
        $user->email = $request->email ?? $user->email;
        $user->phone_number = $request->phone_number ?? $user->phone_number;
        $user->address = $request->address ?? $user->address;
        $user->gender = $request->gender ?? $user->gender;
        $user->status = $request->status ?? $user->status;
        $user->occupation = $request->occupation ?? $user->occupation;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('admin.parent.list')->with('success', 'Parent updated successfully');
    }

    public function parent_delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('admin.parent.list')->with('success', 'Parent deleted successfully');
    }

    public function my_students(Request $request , $id)
    {
        $header_title = 'My Students';
        $properties = [
            'users.name' => 'like',
            'last_name' => 'like',
            'email' => 'like',
            'student_id' => '=',
        ];
        $studentsQuery = $this->filter(User::class, 'id', $request, $properties, 'desc');
        $students = $studentsQuery->where('user_type', 'student')->paginate(6 , ['*'], 'students');
        $parent_students = User::where('parent_id' , $id)->paginate(6, ['*'], 'parent_students');
        $parent = User::find($id);
        return view('admin.parent.my_students', compact('header_title', 'students' , 'parent' , 'parent_students'));
    }

    public function assign_student_parent($student_id, $parent_id)
    {
        $student = User::find($student_id);
        $student->parent_id = $parent_id;
        $student->save();
        return redirect()->route('admin.parent.my_students', $parent_id)->with('success', 'Student assigned to parent successfully');
    }

    public function delete_student_parent($id)
    {
        $student = User::find($id);
        $student->parent_id = null;
        $student->save();
        return redirect()->back()->with('success', 'Student removed from parent successfully');
    }
}

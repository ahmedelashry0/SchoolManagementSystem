<?php

namespace App\Http\Controllers;

use App\Traits\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use Image;

    public function change_password()
    {
        $header_title = 'Change Password';
        return view('profile.change_password', compact('header_title'));
    }

    public function update_password(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => [
                'required',
                'min:6',
                'confirmed',
                function ($attribute, $value, $fail) use ($request) {
                    if (\Hash::check($value, auth()->user()->password)) {
                        $fail('The new password cannot be the same as the old password.');
                    }
                },
            ],
        ]);
        $user = auth()->user();

        if (\Hash::check($request->old_password, $user->password)) {
            $user->password = \Hash::make($request->password);
            $user->save();
            return redirect()->back()->with('success', 'Password updated successfully');
        } elseif (\Hash::check($request->old_password, $request->password)) {
            return redirect()->back()->with('error', 'Old password is incorrect');
        } else {
            return redirect()->back()->with('error', 'Old password is incorrect');
        }
    }

    public function profile()
    {
        $header_title = 'Profile';
        $user = auth()->user();
        if ($user->user_type == 'student') {
            return view('profile.student_profile', compact('header_title', 'user'));
        }
        elseif ($user->user_type == 'teacher') {
            return view('profile.teacher_profile', compact('header_title', 'user'));
        }
        elseif ($user->user_type == 'parent') {
            return view('profile.parent_profile', compact('header_title', 'user'));
        }
        elseif ($user->user_type == 'admin') {
            return view('profile.admin_profile', compact('header_title', 'user'));
        }
    }

    public function update_profile(Request $request)
    {
//        $request->validate([
//            'name' => 'required',
//            'email' => 'required|email',
//            'phone' => 'required',
//        ]);

        $user = auth()->user();
        $user->name = $request->name ?? $user->name;

        $user->email = $request->email ?? $user->email;

        $user->phone_number = $request->phone_number ?? $user->phone;
        $path = $this->UpdateImage($request, 'profile_picture', 'profile_pictures', $user->image);
        $user->image = $path ?? $user->image;

        $user->last_name = $request->input('last_name');

        if ($request->has('address')) {
            $user->address = $request->input('address');
        }
        if ($request->has('permanent_address')) {
            $user->permanent_address = $request->input('permanent_address');
        }
        if ($request->has('gender')) {
            $user->gender = $request->input('gender');
        }
        if ($request->has('date_of_birth')) {
            $user->date_of_birth = $request->input('date_of_birth');
        }
        if ($request->has('date_of_joining')) {
            $user->admission_date = $request->input('date_of_joining');
        }
        if ($request->has('marital_status')) {
            $user->marital_status = $request->input('marital_status');
        }
        if ($request->has('qualification')) {
            $user->qualification = $request->input('qualification');
        }
        if ($request->has('occupation')) {
            $user->occupation = $request->input('occupation');
        }
        if ($request->has('work_experience')) {
            $user->work_experience = $request->input('work_experience');
        }
        if ($request->has('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        if ($request->has('religion')) {
            $user->religion = $request->input('religion');
        }
        if ($request->has('height')) {
            $user->height = $request->input('height');
        }
        if ($request->has('weight')) {
            $user->weight = $request->input('weight');
        }
        if ($request->has('blood_type')) {
            $user->blood_group = $request->input('blood_type');
        }
        $user->save();
        return redirect()->back()->with('success', 'Profile updated successfully');
    }
}

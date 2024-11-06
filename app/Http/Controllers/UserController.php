<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function change_password()
    {
        $header_title = 'Change Password';
        return view('profile.change_password', compact('header_title' ));
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
        }elseif (\Hash::check($request->old_password, $request->password)){
            return redirect()->back()->with('error', 'Old password is incorrect');
        }
        else {
            return redirect()->back()->with('error', 'Old password is incorrect');
        }
    }
}

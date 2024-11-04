<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isNull;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return $this->checkUser_type();
        }
        else {
            return view('auth.login');
        }
    }

    public function AuthLogin(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password') , $request->filled('remember'))) {
            return $this->checkUser_type();
        }
        else {
            return redirect()->back()->with('error', 'Invalid login credentials');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function forgot_password()
    {
        return view('auth.forgot-password');
    }

    public function send_forgot_password(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();
//        dd($user);
        if ($user !== null) {
            $user->remember_token= Str::random(30);
            $user->save();
            Mail::to($user->email)->send(new ForgotPasswordMail($user));
            return redirect()->back()->with('success', 'Password reset link sent to your email');
        }
        else {
            return redirect()->back()->with('error', 'Email not found');
        }
    }

    public function reset_password($token)
    {
        $user = User::where('remember_token', $token)->first();
        if ($user !== null) {
            return view('auth.reset-password', ['user' => $user]);
        }
        else {
            abort(404);
        }
    }

    public function update_password(Request $request, $token)
    {
        $user = User::where('remember_token', $token)->first();
        if ($user !== null) {
            $validated = $request->validate([
                'password' => 'required|confirmed|min:6',
            ]);
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->save();
            return redirect()->route('login')->with('success', 'Password reset successful');
        }
        else {
            abort(404);
        }
    }


    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function checkUser_type(): \Illuminate\Http\RedirectResponse
    {
        if (Auth::user()->user_type == 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            if (Auth::user()->user_type == 'teacher') {
                return redirect()->route('teacher.dashboard');
            } else {
                if (Auth::user()->user_type == 'parent') {
                    return redirect()->route('parent.dashboard');
                } else {
                    if (Auth::user()->user_type == 'student') {
                        return redirect()->route('student.dashboard');
                    } else {
                        return redirect()->route('login');
                    }
                }
            }
        }
    }
}

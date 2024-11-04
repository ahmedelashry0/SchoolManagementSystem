<?php

namespace App\Http\Controllers;

use App\Http\Requests\admin\StoreAdminRequest;
use App\Http\Requests\admin\UpdateAdminRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function list(Request $request)
    {
        $header_title = 'Admin List';
        $query = User::where('user_type', 'admin')->orderBy('id' , 'desc');
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('date')) {
            $query->where('created_at', 'like', '%' . $request->date . '%');
        }

        $admins = $query->paginate(6);
        return view('admin.admin.list', compact('header_title' , 'admins'));
    }

    public function add()
    {
        $header_title = 'Add Admin';
        return view('admin.admin.add', compact('header_title'));
    }

    public function store(StoreAdminRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => 'admin',
        ]);
        return redirect()->route('admin.list')->with('success', 'Admin added successfully');
    }

    public function edit($id)
    {
        $header_title = 'Edit Admin';
        $admin = User::findOrFail($id);
        return view('admin.admin.edit', compact('header_title' , 'admin'));
    }

    public function update(UpdateAdminRequest $request, $id)
    {
        $admin = User::findOrFail($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        if ($request->password) {
            $admin->password = Hash::make($request->password);
        }
        $admin->save();
        return redirect()->route('admin.list')->with('success', 'Admin updated successfully');
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.list')->with('success', 'Admin deleted successfully');
    }
}

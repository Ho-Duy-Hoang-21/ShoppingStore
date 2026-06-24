<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class ListUserController extends Controller
{
    public function listUser()
    {
        $user = User::paginate(10);
        
        $levels = [
            1 => 'Admin',
            0 => 'Member',
        ];
        return view('admin.user.list-user', compact('user','levels'));
    }

    public function delete($id)
    {
        $user = User::find($id);

        $user->delete();

        return redirect()->route('list-user');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        $levels = [
            1 => 'Admin',
            0 => 'Member',
        ];

        return view('admin.user.edit-listuser', compact('user', 'levels'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'level' => 'required|integer',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->level = $request->level;

        // Chỉ update password nếu user nhập mới
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('list-user')->with('success', 'Cập nhật user thành công!');
    }
}

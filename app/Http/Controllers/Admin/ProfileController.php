<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Country;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function GetUsers()
    {
        $countries = Country::all();
        $user = Auth::guard('admin')->user();
        return view('admin.user.page-profile', compact('countries', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $userId = Auth::guard('admin')->id();
        $user = User::findOrFail($userId);

        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($userId),
            ],
            'password'   => 'nullable|string|min:6',
            'phone'      => 'nullable|string|max:20',
            'address'    => 'nullable|string|max:255',
            'id_country' => 'nullable|exists:country,id',
            'avatar'     => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $data = $request->except(['avatar', '_token']);

        $file = $request->file('avatar');

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']); // không update password nếu để trống
        }

        // Xử lý avatar
        if ($file) {
            $avatarName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('admin/upload/avatar/'), $avatarName);
            $data['avatar'] = $avatarName;
        }

        if ($user->update($data)) {
            return redirect()->back()->with('success', 'Update Profile Success');
        }

        return redirect()->back()->withErrors('Update Profile Errors');
    }

    // ... các method khác giữ nguyên
}
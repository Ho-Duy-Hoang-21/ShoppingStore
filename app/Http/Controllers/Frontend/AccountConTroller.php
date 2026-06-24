<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Country;

class AccountConTroller extends Controller
{
    public function showAccount()
    {
        $countries = Country::all();
        $user = Auth::guard('web')->user();
        return view('frontend.account.account', compact('countries', 'user'));
    }

    public function updateAccount(Request $request)
    {
        $userId = Auth::guard('web')->id();
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
            'id_country' => 'nullable',
            'avatar'     => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $data = $request->except(['avatar', '_token']);

        $file = $request->file('avatar');

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        // Xử lý avatar
        if ($file) {
            $avatarName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('admin/assets/images/upload/avatar'), $avatarName);
            $data['avatar'] = $avatarName;
        }

        if ($user->update($data)) {
            return redirect()->back()->with('success', 'Update Profile Success');
        }

        return redirect()->back()->withErrors('Update Profile Errors');
    }
}
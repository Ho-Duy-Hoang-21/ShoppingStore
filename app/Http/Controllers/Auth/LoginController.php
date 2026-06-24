<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\MemberLoginRequest;

class LoginController extends Controller
{
    // ==================== FRONTEND ====================

    public function showLoginForm()
    {
        if (Auth::guard('web')->check()) {
            return redirect('/');
        }
        return view('auth.login');
    }

    public function login(MemberLoginRequest $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'level' => 0,
        ];

        if (Auth::guard('web')->attempt($credentials, $request->boolean('remember_me'))) {
            $request->session()->regenerate();
            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không chính xác.',
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        // Nếu admin vẫn đang đăng nhập trên session này thì không hủy toàn bộ session
        if (!Auth::guard('admin')->check()) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        } else {
            $request->session()->regenerate();
        }

        return redirect()->route('login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // ==================== ADMIN ====================

    public function showAdminLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.loginAdmin');
    }

    public function adminLogin(MemberLoginRequest $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'level' => 1,
        ];

        if (Auth::guard('admin')->attempt($credentials, $request->boolean('remember_me'))) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không chính xác.',
        ])->withInput($request->only('email'));
    }

    public function adminLogout(Request $request)
    {
        Auth::guard('admin')->logout();

        // Nếu member vẫn đang đăng nhập trên session này thì không hủy toàn bộ session
        if (!Auth::guard('web')->check()) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        } else {
            $request->session()->regenerate();
        }

        return redirect()->route('admin.login');
    }
}
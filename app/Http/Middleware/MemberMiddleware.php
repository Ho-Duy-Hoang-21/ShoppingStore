<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Dùng guard 'web' cho frontend
        if (!Auth::guard('web')->check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập.');
        }

        return $next($request);
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminLoginRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    public function login(AdminLoginRequest $request)
    {
        $admin = Admin::where('email', $request->email)->first();
    
        if ($admin && $admin->is_banned) {
            return back()->withErrors([
                'email' => "تم حظرك من قبل الإدارة. يرجى الاتصال بنا لمعرفة التفاصيل.",
            ]);
        }
        $key = 'admin-login:' . $request->ip();
    
        if (RateLimiter::tooManyAttempts($key, 5)) {
            return back()->withErrors([
                'email' => "تم حظرك مؤقتًا بعد عدة محاولات خاطئة. حاول بعد 15 دقيقة.",
            ]);
        }
    
        RateLimiter::hit($key, 900); //15 minutes
    
        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            RateLimiter::clear($key);
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }
    
        return back()->withErrors(['email' => 'بيانات الدخول غير صحيحة']);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}

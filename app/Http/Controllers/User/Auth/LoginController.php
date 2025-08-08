<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class LoginController extends Controller
{

    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('user.home');
        }
        return view('user.auth.login');
    }       
    public function login(UserLoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
    
        if ($user && $user->is_banned) {
            return back()->withErrors([
                'email' => "تم حظرك من قبل الإدارة. يرجى الاتصال بنا لمعرفة التفاصيل.",
            ]);
        }
        $key = 'user-login:' . $request->ip();
    
        if (RateLimiter::tooManyAttempts($key, 5)) {
            return back()->withErrors([
                'email' => "تم حظرك مؤقتًا بعد عدة محاولات خاطئة. حاول بعد 15 دقيقة.",
            ]);
        }
    
        RateLimiter::hit($key, 900); //15 minutes
    
        if (Auth::attempt($request->only('email', 'password'))) {
            RateLimiter::clear($key); 
            $request->session()->regenerate();
            return redirect()->route('user.home');
        }
    
        return back()->withErrors(['email' => 'بيانات الدخول غير صحيحة']);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        return redirect('/login')->with('success', 'تم تسجيل الخروج بنجاح');
    }
}

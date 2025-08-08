<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\UserRegisterRequest;

class RegisterController extends Controller
{

    public function showRegisterForm()
    {
        return view('user.auth.register');
    }
    public function register(UserRegisterRequest $request)
    {
        $user = User::create($request->validated());
        Auth::login($user);
        return redirect()->route('user.home')->with('success', 'تم إنشاء الحساب وتسجيل الدخول بنجاح');
    }
}

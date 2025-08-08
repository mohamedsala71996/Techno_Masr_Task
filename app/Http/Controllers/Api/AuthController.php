<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Resources\LoginResource;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ApiResponse;

    public function login(LoginRequest $request): JsonResponse
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return $this->errorResponse('بيانات الدخول غير صحيحة', 401);
        }

        $user = Auth::user();
        
        if ($user->is_banned) {
            Auth::logout();
            return $this->errorResponse('تم حظر هذا الحساب', 403);
        }

        $token = $user->createToken('api_token')->plainTextToken;

        return $this->successResponse(
            new LoginResource([
                'token' => $token,
                'user' => $user
            ]),
            'تم تسجيل الدخول بنجاح'
        );
    }
}

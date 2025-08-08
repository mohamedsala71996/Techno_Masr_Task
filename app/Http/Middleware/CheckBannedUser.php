<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckBannedUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            if ($user->is_banned) {
                Auth::logout();
                
                return redirect()->route('login')->withErrors([
                    'email' => 'تم حظر حسابك من قبل الإدارة. يرجى الاتصال بنا لمعرفة التفاصيل.'
                ]);
            }
        }

        return $next($request);
    }
} 
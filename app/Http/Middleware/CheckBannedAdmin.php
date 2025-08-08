<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckBannedAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('admin')->check()) {
            $admin = Auth::guard('admin')->user();
            
            if ($admin->is_banned) {
                Auth::guard('admin')->logout();
                return redirect()->route('admin.login')->withErrors([
                    'email' => 'تم حظر حسابك من قبل الإدارة. يرجى الاتصال بنا لمعرفة التفاصيل.'
                ]);
            }
        }

        return $next($request);
    }
} 
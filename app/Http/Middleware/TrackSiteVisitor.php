<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\SiteVisitor;

class TrackSiteVisitor
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $ip = $request->ip();
        $userAgent = $request->userAgent();

        // Only log if this combination is not already present today
        $exists = SiteVisitor::where('ip_address', $ip)
            ->where('user_agent', $userAgent)
            ->whereDate('created_at', now()->toDateString())
            ->exists();

        if (!$exists) {
            SiteVisitor::create([
                'ip_address' => $ip,
                'user_agent' => $userAgent,
                'content' => $request->fullUrl(),
            ]);
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use App\Models\AuditLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuditLoggerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        try {
            AuditLog::create([
                'user_id' => Auth::check() ? Auth::id() : null,
                'action' => $request->method() . ' ' . $request->path(),
                'ip_address' => $request->ip(),
                'route' => optional($request->route())->getName(),
                'description' => [
                    'input' => $request->except(['password','_token']),
                    'status' => $response->getStatusCode(),
                ],
            ]);

        } catch (\Exception $ex) {
            // fail silently
        }

        return $response;
    }
}

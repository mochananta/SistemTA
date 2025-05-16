<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if ($user && in_array($user->role, ['admin_sistem', 'admin_kua'])) {
            return $next($request);
        }
    
        abort(403, 'Unauthorized'); // atau redirect('/') jika ingin arahkan ke halaman utama
    }
}

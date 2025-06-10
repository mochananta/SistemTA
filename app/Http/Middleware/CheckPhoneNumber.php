<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPhoneNumber
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && (is_null(Auth::user()->nohp) || Auth::user()->nohp === '')) {
            return redirect()->route('profile.edit')->with('warning_nhp', true);
        }

        return $next($request);
    }
}

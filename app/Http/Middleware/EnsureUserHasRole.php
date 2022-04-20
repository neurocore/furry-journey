<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if ($request === null || $request->user() === null) {
            return redirect(RouteServiceProvider::HOME);
        }

        if (!$request->user()->hasRole($role)) {
            return redirect(RouteServiceProvider::HOME);
        }

        return $next($request);
    }
}

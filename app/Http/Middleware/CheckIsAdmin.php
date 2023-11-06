<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

class CheckIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Gate::allows('is-admin')) {
            return $next($request);
        }

        return redirect('/login');
    }
}

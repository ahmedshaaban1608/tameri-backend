<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
<<<<<<< HEAD
=======
use Illuminate\Support\Facades\Gate;
>>>>>>> 1f682ffedea6c16c0fa8147030eed27803c76230
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
<<<<<<< HEAD
    // public function handle( $request, Closure $next)
    // {
    //     if (auth()->check() && auth()->user()->role === 'admin') {
    //         return $next($request);
    //     }
        
    //     return redirect('/'); 
    // }
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->isAdmin()) {
            return $next($request);
        }

        return redirect('/home'); 
    }

=======
    public function handle(Request $request, Closure $next): Response
    {
        if (Gate::allows('is-admin')) {
            return $next($request);
        }
        return abort(403, 'You are not allowed');
    }
>>>>>>> 1f682ffedea6c16c0fa8147030eed27803c76230
}

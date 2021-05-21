<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckIfBlocked
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->bloqueado==1) {
			$message = 'A sua conta foi bloqueada, por favor contacte um administrador';
			auth()->logout();
			return redirect()->route('login')->withMessage($message);
        }

        return $next($request);
    }
}

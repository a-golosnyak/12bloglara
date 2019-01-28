<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
//        echo "Middleware выполняется";

        if (Auth::guard($guard)->check()) {
            $response = $next($request);        // echo "Пользователь аутентифицирован";
            return $response;
        }

        abort(403);
    }
}

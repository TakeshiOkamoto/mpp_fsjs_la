<?php

namespace App\Http\Middleware;

use Closure;

class LoginMiddleware
{
    public function handle($request, Closure $next)
    {
        // 未ログイン
        if(!session()->has('name')){
            return redirect(url('login'));
        }

        return $next($request);
    }
}
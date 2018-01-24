<?php

namespace App\Http\Middleware;

use Closure;
class Admin
{
    public function handle($request, Closure $next, $guard = null)
    {
//        session(['admin'=>null]);
        if(!session('user')){
            return redirect('admin/login');
        };
        return $next($request);
    }
}

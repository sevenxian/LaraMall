<?php

namespace App\Http\Middleware\Admin;

use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // 判断用户是否认证
        if (!\Auth::guard($guard)->check()) {

//            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure,Auth;

class CheckAuthLogout
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
        if (Auth::guard('customer')->check()) {
            return redirect("/")->with('error','Bạn đã đăng nhập');
        } else {
            return $next($request);
           
        }
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class SessionCheckLanguage
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
        $request->session()->forget('locale');
        if(Session::get('locale') == null){
            Session::put('locale', app()->getLocale());
        }
        return $next($request);
    }
}

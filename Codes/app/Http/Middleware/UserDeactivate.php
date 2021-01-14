<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class UserDeactivate
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
        if (Auth::check()) {

            if(Auth::guard('web')->check() && (auth()->user()->status!='active' || auth()->user()->banned==1))
            {
                Auth::logout();

                return redirect()->route('login')->withSuccess(_t(__('message.you_deactivated')));
            }
            
        }

        return $next($request);
    }
}

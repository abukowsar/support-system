<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
class XSS
{
    public function handle(Request $request, Closure $next)
    {   
        if(setActive('admin/mail/mailable')!='active' && setActive('admin/mail/template')!='active' && setActive('admin/headfootupdate')!='active'){
            purifyInputData($request);
        }

        $response = $next($request);

        return $response;
    }
}

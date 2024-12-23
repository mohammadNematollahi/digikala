<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ACL
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next , $role , $permission = null)
    {
        if(!$request->user()->hasRoles($role) && $permission == null){
            return abort(403);
        }

        if($request->user()->cannot($permission)){
            return abort(403);
        }

        return $next($request);
    }
}

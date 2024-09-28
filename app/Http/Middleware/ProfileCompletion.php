<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Controllers\Customer\SaleProcess\ProfileCompletionController;

class ProfileCompletion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if($user->first_name == null || $user->last_name == null || $user->national_code == null){

            return redirect()->route("customer.sale-process.profile-completion");
        }
        
        if($user->mobile != null && $user->email == null && $user->mobile_verified_at == null){

            return redirect()->route("customer.sale-process.profile-completion");
        }

        if($user->email != null && $user->mobile == null && $user->email_verified_at == null){

            return redirect()->route("customer.sale-process.profile-completion");
        }

        return $next($request);
    }
}

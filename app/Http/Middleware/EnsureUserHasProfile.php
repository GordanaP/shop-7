<?php

namespace App\Http\Middleware;

use Closure;
use App\Facades\ShoppingCart;
use Illuminate\Support\Facades\Auth;

class EnsureUserHasProfile
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
        if(Auth::user()->customer) {
            return $next($request);
        } else {
            return redirect()->route('users.customers.create', Auth::user());
        }
    }
}

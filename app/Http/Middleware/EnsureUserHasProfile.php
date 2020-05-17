<?php

namespace App\Http\Middleware;

use Closure;
use App\Facades\ShoppingCart;

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
        if($request->user->customer) {
            return $next($request);
        } else {
            return redirect()->route('users.customers.create', $request->user);
        }
    }
}

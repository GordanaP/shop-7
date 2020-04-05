<?php

namespace App\Http\Middleware;

use Closure;
use App\Facades\ShoppingCart;

class EnsureCartIsNotEmpty
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
        if(ShoppingCart::isNotEmpty()) {
            return $next($request);
        } else {
            return redirect()->route('welcome');
        }
    }
}

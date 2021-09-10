<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureIsShopOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $shop = $request->route('shop');
        if(Auth::user()->type=='owner' && Auth::user()->shop->id==$shop->id) {
            return $next($request);
        }
        return redirect()->back();
    }
}

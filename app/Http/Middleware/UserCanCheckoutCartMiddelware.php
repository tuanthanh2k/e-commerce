<?php

namespace App\Http\Middleware;

use App\Models\Cart;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserCanCheckoutCartMiddelware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $cart = app(Cart::class)->firtOrCreateBy(auth()->user()->id);
        if ($cart->products->count() > 0) {
            return $next($request);
        } else {
            abort(404, 'KHông có sản phẩm nào trong giỏ hàng');
        }
    }
}

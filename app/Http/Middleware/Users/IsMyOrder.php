<?php

namespace App\Http\Middleware\Users;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Order;

class IsMyOrder
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        $order = Order::findOrFail($request->id);
        
        if ($order->user_id != $user->id) {
            if ($request->ajax())
                    return response(['message' => 'Not your order'], 403);
                else 
                    return redirect()->back()->withErrors('Not your order');
        }

        return $next($request);
    }
}

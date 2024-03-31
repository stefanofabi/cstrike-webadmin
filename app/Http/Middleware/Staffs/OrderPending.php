<?php

namespace App\Http\Middleware\Staffs;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Order;

class OrderPending
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $order = Order::findOrFail($request->id);
        
        if ($order->status != 'Pending')
            return redirect()->back()->withErrors('The order is not pending');

        return $next($request);
    }
}

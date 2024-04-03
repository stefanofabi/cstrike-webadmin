<?php

namespace App\Http\Middleware\Users;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

use App\Models\Order;

use Lang;

class OneModificationPerMonth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $order = Order::findOrFail($request->id);

        if (empty($order->last_change)) {
            return $next($request);
        }

        if ($order->auth == $request->auth) {
            return $next($request);
        }

        $now = Carbon::now();
        $lastChange = Carbon::parse($order->last_change);

        // Calcula la diferencia en días entre la fecha actual y last_change
        $diffInDays = $lastChange->diffInDays($now);
        
        if ($diffInDays <= 30) {
            return response()->json(['message' => Lang::get('orders.one_modification_per_month')], 400);
        }

        return $next($request);
    }
}

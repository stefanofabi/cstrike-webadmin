<?php

namespace App\Http\Middleware\Staffs;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Administrator;

class HavePurchaseOrder
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $administrator = Administrator::findOrFail($request->id);

        if (! empty($administrator->order_id)) {
            return redirect()->back()->withErrors('The manager was created by a purchase order');
        }

        return $next($request);
    }
}

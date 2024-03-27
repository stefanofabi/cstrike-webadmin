<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdministratorAssociate
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
        $user = auth()->user();

        $administrators = $user->administrators->where('status', 'Active');
        
        if ($administrators->isEmpty()) {
            return redirect()->back()->withErrors('Have not active administrators');
        }

        return $next($request);
    }
}

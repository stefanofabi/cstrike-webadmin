<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdministratorWithServerAccess
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

        $administrator = auth()->user()->administrator;

        if (! $administrator) {
            return back();
        }

        $privileges = $administrator->privileges;

        foreach ($request->servers as $server) {
            if ($privileges->contains('server_id', $server)) {
                return $next($request);
            }
        }

        return back();
    }
}

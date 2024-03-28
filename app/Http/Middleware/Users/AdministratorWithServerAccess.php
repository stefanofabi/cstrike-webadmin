<?php

namespace App\Http\Middleware\Users;

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
        $user = auth()->user();

        $servers = $user->administrators->where('status', 'Active')->pluck('server_id');

        foreach ($request->servers as $server) {
            if (! $servers->contains($server)) {
                if ($request->ajax())
                    return response(['message' => 'Not access to this server'], 500);
                else 
                    return redirect()->back()->withErrors('Not access to this server');
            }
        }

        return $next($request);
    }
}

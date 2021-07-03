<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdministratorWithBan
{
    
    const FLAG_BAN = "d";

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

        $administrator = $user->administrator;

        if (! $administrator) {
            return back();
        }

        $rank = $administrator->rank;

        if (strpos($rank->access_flags, self::FLAG_BAN) == false) {
            return back();
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware\Users;

use Closure;
use Illuminate\Http\Request;

use App\Models\Administrator;

class IsMyAdministrator
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

        $administrator = Administrator::findOrFail($request->id);
        
        if ($administrator->user_id != $user->id) {
            if ($request->ajax())
                    return response(['message' => 'Not your administrator'], 403);
                else 
                    return redirect()->back()->withErrors('Not your administrator');
        }

        return $next($request);
    }
}

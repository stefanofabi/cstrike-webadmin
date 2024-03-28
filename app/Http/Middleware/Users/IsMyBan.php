<?php

namespace App\Http\Middleware\Users;

use Closure;
use Illuminate\Http\Request;

use App\Models\Ban;
use Lang;

class IsMyBan
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

        $ban = Ban::findOrFail($request->id);

        $administrator =$ban->administrator;
        
        if ($user->id != $administrator->user_id) {
            return response(['message' => Lang::get('forms.failed_transaction')], 500);
        }

        return $next($request);
    }
}

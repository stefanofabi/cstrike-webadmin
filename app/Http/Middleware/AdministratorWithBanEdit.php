<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Models\Ban;
use Lang;

class AdministratorWithBanEdit
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

        $ban = Ban::findOrFail($request->id);

        $administrator = auth()->user()->administrator;
        
        if ($administrator->id != $ban->administrator_id) {
            return response(['message' => Lang::get('forms.failed_transaction')], 500);
        }

        return $next($request);
    }
}

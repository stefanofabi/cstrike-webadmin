<?php

namespace App\Http\Middleware\Users;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Administrator;

class AdminWithHigherImmunity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $request->validate([
            'servers' => 'required|array',          
        ]);

        $user = auth()->user();

        $my_administrators = $user->administrators->where('status', 'Active');

        foreach($my_administrators as $administrator) {
            $administrators = Administrator::where('server_id', $administrator->server_id)
            ->join('ranks', 'administrators.rank_id', '=', 'ranks.id')
            ->where('ranks.immunity', '>', $administrator->rank->immunity)
            ->where(function($query) use ($request) {
                        $query->where('auth', $request->steam_id)
                        ->orWhere('auth', $request->ip);
            })
            ->get();

            if ($administrators->isNotEmpty())
                return redirect()->back()->withErrors('You cannot block an admin with higher immunity');
        }

        return $next($request);
    }
}

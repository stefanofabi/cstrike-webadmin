<?php

namespace App\Http\Middleware\Users;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

use App\Models\Administrator;

class AccessToBan
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

        foreach ($request->servers as $server) {
            $administrators = Administrator::where('user_id', $user->id)->where('server_id', $server)->get();

            $canBan = false;

            foreach ($administrators as $administrator) {
                if (Str::contains($administrator->rank->access_flags, 'd')) {
                    $canBan = true;
                }
            }

            if (! $canBan) {
                    return redirect()->back()->withErrors('You do not have access to ban on this server');
            }
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Server;

use Lang;

class ProfileController extends Controller
{
    //

    /**
     * Show the form for view my administrator.
     *
     * @return \Illuminate\Http\Response
     */
    public function myAdministrator()
    {
        //

        $administrator = auth()->user()->administrator;

        $servers = Server::orderBy('ip', 'ASC')->get();
        
        return view('users.profile.my_administrator')
            ->with('administrator', $administrator)
            ->with('servers', $servers);
    }
}

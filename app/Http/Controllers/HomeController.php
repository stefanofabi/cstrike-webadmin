<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat; 
use App\Models\Server;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $chat_messages = Chat::orderBy('date', 'DESC')->get();

        $servers = Server::orderBy('ip', 'ASC')->get();

        return view('welcome')
            ->with('chat_messages', $chat_messages)
            ->with('servers', $servers);
    }

    public function user_staff() 
    {
        return view('staffs.home');
    }

    public function user_home() 
    {
        return view('users.home');
    }
}

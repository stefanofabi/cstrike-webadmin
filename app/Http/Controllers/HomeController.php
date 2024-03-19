<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Chat; 
use App\Models\Server;
use App\Models\User;
use App\Models\Package;
use App\Models\Rank;

use Lang;

class HomeController extends Controller
{
    const LIMIT_CHAT_MESSAGE = 25;

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $chat_messages = Chat::orderBy('date', 'DESC')->get();

        $servers = Server::orderBy('ip', 'ASC')->limit(self::LIMIT_CHAT_MESSAGE)->get();

        $staffs = User::permission('is_staff')->get();

        return view('welcome')
            ->with('chat_messages', $chat_messages)
            ->with('servers', $servers)
            ->with('staffs', $staffs);
    }

    public function user_staff() 
    {
        return view('staffs.home');
    }

    public function user_home() 
    {
        return view('users.home');
    }

    /**
     * Show the form for buy a new administrator.
     *
     * @return \Illuminate\Http\Response
     */
    public function buyAdministrator()
    {
        //  

        $packages = Package::OrderBy('name', 'ASC')->get();

        $ranks = Rank::OrderBy('name', 'ASC')->get();

        $flags = [
            [
                'name' => Lang::get('ranks.immunity'), 
                'letter' => 'a',
            ], [
                'name' => Lang::get('ranks.reserved_slot'), 
                'letter' => 'b'
            ], [
                'name' => Lang::get('ranks.kick'), 
                'letter' => 'c'
            ], [
                'name' => Lang::get('ranks.ban'), 
                'letter' => 'd'
            ], [
                'name' => Lang::get('ranks.slay_slap'), 
                'letter' => 'e'
            ], [
                'name' => Lang::get('ranks.change_map'), 
                'letter' => 'f'
            ], [
                'name' => Lang::get('ranks.execute_cfg'), 
                'letter' => 'h'
            ], [
                'name' => Lang::get('ranks.top_chat'), 
                'letter' => 'i'
            ], [
                'name' => Lang::get('ranks.generate_votes'), 
                'letter' => 'j'
            ], [
                'name' => Lang::get('ranks.change_password'), 
                'letter' => 'k'
            ], [
                'name' => Lang::get('ranks.flag_u'), 
                'letter' => 'u'
            ],
        ];

        return view('buy_administrator')
            ->with('packages', $packages)
            ->with('ranks', $ranks)
            ->with('flags', $flags);
    }
}

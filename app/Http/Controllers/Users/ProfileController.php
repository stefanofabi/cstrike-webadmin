<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Rank;

use Lang;

class ProfileController extends Controller
{
    //

    /**
     * Show the form for buy a new administrator.
     *
     * @return \Illuminate\Http\Response
     */
    public function buyAdministrator()
    {
        //  

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

        return view('users.profile.buy_administrator')
            ->with('ranks', $ranks)
            ->with('flags', $flags);
    }

    /**
     * Show the form for view my administrator.
     *
     * @return \Illuminate\Http\Response
     */
    public function myAdministrator()
    {
        //

        $administrator = auth()->user()->administrator;

        return view('users.profile.my_administrator')
            ->with('administrator', $administrator);
    }
}

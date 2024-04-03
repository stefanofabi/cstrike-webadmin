<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Ban;

class ApiController extends Controller
{
    //

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showBan($id)
    {
        //

        $ban = Ban::findOrFail($id);
    
        return view('api.bans.show')
            ->with('ban', $ban);    
    }
}

<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use  App\Http\Controllers\Controller;

use App\Models\Administrator;
use App\Models\Rank;
use App\Models\Server;

use Lang;

class AdministratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $administrators = Administrator::orderBy('expiration', 'ASC')->get();
        
        $ranks = Rank::orderBy('name', 'ASC')->get();

        return view('staff.administrators.index')
            ->with('administrators', $administrators)
            ->with('ranks', $ranks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $ranks = Rank::orderBy('name', 'ASC')->get();

        $servers = Server::orderBy('name', 'ASC')->get();

        return view('staff/administrators/create')
            ->with('ranks', $ranks)
            ->with('servers', $servers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $administrator = new Administrator($request->all());

        if (! $administrator->save()) {
            return back()->withErrors(Lang::get('forms.failed_transaction'));
        } 

        return redirect()->action([AdministratorController::class,'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //

        return Administrator::findOrFail($request->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        
        $administrator = Administrator::findOrFail($id);

        if (! $administrator->delete($id)) {
            return back()->withErrors(Lang::get('forms.failed_transaction'));
        }

        return redirect()->action([AdministratorController::class,'index']);
    }
}
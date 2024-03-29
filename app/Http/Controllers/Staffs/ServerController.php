<?php

namespace App\Http\Controllers\Staffs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException; 
use Carbon\Carbon;

use App\Models\Server;
use App\Models\GameChat;

use Lang; 

class ServerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $servers = Server::orderBy('ip', 'ASC')->get();

        return view('staffs/servers/index')
            ->with('servers', $servers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('staffs/servers/create');
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

        $request->validate([
            'name' => 'required|string',

            // regex for ip:port
            'ip' => 'required|string|regex:/([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3})\:?([0-9]{1,5})?/',
        ]);

        $server = new Server($request->all());
        
        try {
            if (! $server->save()) {
                return back()->withErrors(Lang::get('forms.failed_transaction'))->withInput($request->all());
            }
        } catch (QueryException $exception) {
            return back()->withErrors(Lang::get('servers.repeated_ip_name'))->withInput($request->all());
        }
        

        return redirect()->action([ServerController::class, 'index']);
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
        try {
            $server = Server::findOrFail($request->id);
        } catch (ModelNotFoundException $exception) {
            return response(['message' => Lang::get('errors.model_not_found')], 500);
        }

        return $server;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //

        $request->validate([
            'name' => 'required|string',

            // regex for ip:port
            'ip' => 'required|string|regex:/([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3})\:?([0-9]{1,5})?/',
        ]);

        try {
            $server = Server::findOrFail($request->id);

            $updated = $server->update([
                'name' => $request->name, 
                'ip' => $request->ip, 
                'ranking_url' => $request->ranking_url
            ]);

            if (! $updated) {
                return response(['message' => Lang::get('forms.failed_transaction')], 500);
            }
        } catch (QueryException $exception) {
            return response(['message' => Lang::get('forms.failed_transaction')], 500);
        } catch (ModelNotFoundException $exception) {
            return response(['message' => Lang::get('errors.model_not_found')], 500);
        }
        

        return response(['message' => Lang::get('servers.success_updated_server')], 200);
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

        $server = Server::findOrFail($id);

        if (! $server->delete()) {
            return back()->withErrors(Lang::get('forms.failed_transaction'));
        }
        
        return redirect()->action([ServerController::class, 'index']);
    }

    public function seeGameChat(Request $request) 
    {
        try {
            $server = Server::findOrFail($request->id);
        } catch (ModelNotFoundException $exception) {
            return response(['message' => Lang::get('errors.model_not_found')], 500);
        }

        return $server->gameChats()->orderBy('date', 'DESC')->take(500)->get();
    }
}

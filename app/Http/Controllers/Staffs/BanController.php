<?php

namespace App\Http\Controllers\Staffs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

use App\Models\Ban;
use App\Models\Server;

use Lang;

class BanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $servers = Server::orderBy('name', 'ASC')->get();

        return view('staffs/bans/index') 
            ->with('servers', $servers);
    }

    /**
     * Load bans
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function load(Request $request)
    {
        //

        $servers = Server::orderBy('name', 'ASC')->get();

        $bans = Ban::where('server_id', $request->server_id)->orderBy('expiration', 'ASC')->get();

        return view('staffs.bans.index') 
            ->with('servers', $servers)
            ->with('bans', $bans)
            ->with('server_id', $request->server_id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $servers = Server::orderBy('name', 'ASC')->get();

        return view('staffs.bans.create')
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

        $request->validate([
            'name' => 'required|string',
            'steam_id' => 'string|nullable',
            
            // regex for ip:port
            'ip' => 'string|regex:/([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3})\:?([0-9]{1,5})?/|nullable',

            'expiration' => 'date|nullable',
            'reason' => 'required|string',
            'private_notes' => 'string|nullable',
            'administrator_id' => 'numeric|nullable',
            'servers' => 'required',
                      
        ]);

        if (empty($request->steam_id) && empty($request->ip)) {
            return back()->withErrors(Lang::get('bans.incomplete_prohibition_data'))->withInput($request->all());
        }
        
        DB::beginTransaction();

        try {
            foreach ($request->servers as $server) {
                $ban = new Ban(
                    [
                        'name' => $request->name ,
                        'steam_id' => $request->steam_id,
                        'ip' => $request->ip,
                        'expiration' => $request->expiration,
                        'reason' => $request->reason,
                        'private_notes' => $request->private_notes,
                        'server_id' => $server
                    ]
                );
    
                $ban->save();
            }   

            DB::commit();

        } catch (QueryException $exception) {
            DB::rollBack();
            
            return back()->withErrors(Lang::get('forms.failed_transaction'))->withInput($request->all());
        }

        return redirect()->action([BanController::class, 'index']);
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
    public function edit($id)
    {
        //
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

        $ban = Ban::findOrFail($id);
        $server_id = $ban->server_id;
        
        if (! $ban->delete()) {
            return back()->withErrors(Lang::get('forms.failed_transaction'));
        }

        $servers = Server::orderBy('name', 'ASC')->get();

        $bans = Ban::where('server_id', $server_id)->orderBy('expiration', 'ASC')->get();

        return view('staffs.bans.index') 
            ->with('servers', $servers)
            ->with('bans', $bans)
            ->with('server_id', $server_id);
    }
}

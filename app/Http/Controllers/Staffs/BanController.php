<?php

namespace App\Http\Controllers\Staffs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException; 

use App\Models\Ban;
use App\Models\Server;
use App\Models\Player;
use App\Models\Administrator;

use Lang;

class BanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        $servers = Server::orderBy('name', 'ASC')->get();

        $bans = Ban::where('server_id', $request->input('server'))->orderBy('expiration', 'DESC')->get();

        $server = Server::find($request->input('server'));

        $administrator = Administrator::find($request->administrator);

        return view('staffs.bans.index') 
            ->with('servers', $servers)
            ->with('bans', $bans)
            ->with('server', $server)
            ->with('administrator', $administrator);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($player_id = null)
    {
        //

        $player = Player::find($player_id);

        $servers = Server::orderBy('name', 'ASC')->get();

        return view('staffs.bans.create')
            ->with('servers', $servers)
            ->with('player', $player);
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
            'ip' => 'string|nullable',
            'expiration' => 'date|nullable',
            'reason' => 'required|string',
            'private_notes' => 'string|nullable',
            'servers' => 'required|array',          
        ]);

        if (empty($request->steam_id) && empty($request->ip)) {
            return back()->withErrors(Lang::get('bans.incomplete_prohibition_data'))->withInput($request->all());
        }

        if (!empty($request->steam_id) && strpos($request->steam_id, "LAN") !== false) {
            return back()->withErrors(Lang::get('bans.steam_id_not_valid'))->withInput($request->except('steam_id'));
        }

        if ($this->playerAdminWithImmunity($request->name, $request->steam_id, $request->ip)) {
            return back()->withErrors(Lang::get('bans.admin_immunity'))->withInput($request->all());
        }

        DB::beginTransaction();

        try {
            // not neccesary json decode
            foreach ($request->servers as $server) {
                $ban = new Ban();
                $ban->name = $request->name;
                $ban->steam_id = $request->steam_id;
                $ban->ip = $request->ip;
                $ban->expiration = $request->expiration;
                $ban->reason = $request->reason;
                $ban->private_notes = $request->private_notes;
                $ban->server_id = $server;
    
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //

        try {
            $ban = Ban::findOrFail($request->id);
        } catch (ModelNotFoundException $exception) {
            return response(['message' => Lang::get('errors.model_not_found')], 500);
        }

        return response()->json([
            'ban' => $ban,
            'server' => $ban->server,
            'administrator' => $ban->administrator,
        ], 200);
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
            'steam_id' => 'string|nullable',
            'ip' => 'string|nullable',
            'expiration' => 'date|nullable',
            'reason' => 'required|string',
            'private_notes' => 'string|nullable',
        ]);

        if (empty($request->steam_id) && empty($request->ip)) {
            return response(['message' => Lang::get('bans.incomplete_prohibition_data')], 422);
        }

        if (!empty($request->steam_id) && strpos($request->steam_id, "LAN") !== false) {
            return response(['message' => Lang::get('bans.steam_id_not_valid')], 422);
        }

        if ($this->playerAdminWithImmunity($request->name, $request->steam_id, $request->ip)) {
            return response(['message' => Lang::get('bans.admin_immunity')], 422);
        }

        try {
            $ban = Ban::findOrFail($request->id);

            $ban->name = $request->name;
            $ban->steam_id = $request->steam_id;
            $ban->ip = $request->ip;
            $ban->expiration = $request->expiration;
            $ban->reason = $request->reason;
            $ban->private_notes = $request->private_notes;
            
            if (! $ban->save()) {
                return response(['message' => Lang::get('forms.failed_transaction')], 500);
            }
            
        } catch (ModelNotFoundException $exception) {
            return response(['message' => Lang::get('errors.model_not_found')], 500);
        }

        return response(['message' => Lang::get('bans.success_updated_ban')], 200);
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

        return redirect()->action([BanController::class, 'index'], ['server_id' => $server_id]);
    }

    private function playerAdminWithImmunity($name, $steam_id, $ip) {
        return DB::table('administrators')
            ->join('ranks', 'ranks.id', '=', 'administrators.rank_id')
            ->where(function ($query) use ($name, $steam_id, $ip) {
                $query->orWhere('administrators.auth', $name)
                    ->orWhere('administrators.auth', $steam_id)
                    ->orWhere('administrators.auth', $ip);
            })
            ->where('ranks.access_flags', 'like', '%a%')
            ->count();
    }
}

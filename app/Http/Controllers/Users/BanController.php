<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException; 

use App\Models\Ban;
use App\Models\Player;
use App\Models\Administrator;
use App\Models\Server;

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
        $user = auth()->user();

        $servers = Administrator::select('servers.id', 'servers.name', 'servers.ip')
            ->join('servers', 'administrators.server_id', '=', 'servers.id')
            ->where('administrators.user_id', $user->id)
            ->where('administrators.status', 'Active')
            ->groupBy('servers.id', 'servers.name', 'servers.ip')
            ->get();

        $bans = Ban::select('bans.id', 'bans.date', 'bans.name', 'bans.steam_id', 'bans.ip', 'bans.expiration')
            ->where('bans.server_id', $request->server_id)
            ->join('administrators', 'bans.administrator_id', '=', 'administrators.id')
            ->where('administrators.user_id', $user->id)
            ->where('administrators.status', 'Active')
            ->orderBy('bans.expiration', 'DESC')
            ->get();

        $server = Server::find($request->server_id);

        return view('users.bans.index') 
            ->with('servers', $servers)
            ->with('bans', $bans)
            ->with('server', $server);
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

        $user = auth()->user();

        $servers = Administrator::select('servers.id', 'servers.name', 'servers.ip')
            ->join('servers', 'servers.id', '=', 'administrators.server_id')
            ->where('administrators.user_id', $user->id)
            ->where('administrators.status', 'Active')
            ->groupBy('servers.id', 'servers.name', 'servers.ip')
            ->orderBy('servers.name', 'ASC')
            ->get();
            

        return view('users.bans.create')
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
            'servers' => 'required',          
        ]);

        if (empty($request->steam_id) && empty($request->ip)) {
            return back()->withErrors(Lang::get('bans.incomplete_prohibition_data'))->withInput($request->all());
        }

        if ($this->playerAdminWithImmunity($request->name, $request->steam_id, $request->ip)) {
            return back()->withErrors(Lang::get('bans.admin_immunity'))->withInput($request->all());
        }

        if (!empty($request->steam_id) && strpos($request->steam_id, "STEAM_ID_LAN") !== false) {
            return back()->withErrors(Lang::get('bans.steam_id_not_valid'))->withInput($request->except('steam_id'));
        }

        DB::beginTransaction();

        try {
            $user = auth()->user();
            $administrators = $user->administrators->where('status', 'Active');

            // not neccesary json decode
            foreach ($request->servers as $server) {
                $ban = new Ban(
                    [
                        'name' => $request->name ,
                        'steam_id' => $request->steam_id,
                        'ip' => $request->ip,
                        'expiration' => $request->expiration,
                        'reason' => $request->reason,
                        'private_notes' => $request->private_notes,
                        'administrator_id' => $administrators->where('server_id', $server)->first()->id,
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

        return $ban;
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
            'administrator_id' => 'numeric|nullable',
            'server_id' => 'required|numeric|min:1',
        ]);

        if (empty($request->steam_id) && empty($request->ip)) {
            return response(['message' => Lang::get('bans.incomplete_prohibition_data')], 500);
        }

        if ($this->playerAdminWithImmunity($request->name, $request->steam_id, $request->ip)) {
            return back()->withErrors(Lang::get('bans.admin_immunity'))->withInput($request->all());
        }

        $updated = Ban::where('id', $request->id)
            ->update(
                [
                    'name' => $request->name,
                    'steam_id' => $request->steam_id,
                    'ip' => $request->ip,
                    'expiration' => $request->expiration,
                    'reason' => $request->reason,
                    'private_notes' => $request->private_notes,
                    'server_id' => $request->server_id,
                ]
            );
            
        if (! $updated) {
            return response(['message' => Lang::get('forms.failed_transaction')], 500);
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

        if (! $ban->delete()) {
            return back()->withErrors(Lang::get('forms.failed_transaction'));
        }

        return redirect()->action([BanController::class,'index']);
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

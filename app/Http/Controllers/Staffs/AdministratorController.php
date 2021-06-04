<?php

namespace App\Http\Controllers\Staffs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

use App\Models\Administrator;
use App\Models\Rank;
use App\Models\Server;
use App\Models\Privilege;

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

        $servers = Server::orderBy('name', 'ASC')->get();

        return view('staffs.administrators.index')
            ->with('administrators', $administrators)
            ->with('ranks', $ranks)
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

        $ranks = Rank::orderBy('name', 'ASC')->get();

        $servers = Server::orderBy('name', 'ASC')->get();

        return view('staffs.administrators.create')
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
        
        $request->validate([
            'name' => 'required|string',
            'auth' => 'required|string',
            'password' => 'string|nullable',
            'account_flags' => 'required|array',
            'servers' => 'required|array',
            'rank_id' => 'required|string',
            'expiration' => 'required|date',           
        ]);

        DB::beginTransaction();

        try {

            $administrator = new Administrator(
                [
                    'name' => $request->name,
                    'auth' => $request->auth,
                    'password' => $request->password,
                    'account_flags' => implode($request->account_flags),
                    'expiration' => $request->expiration,
                    'rank_id' => $request->rank_id,
                ]
            );

            $administrator->save();

            foreach ($request->servers as $server) {
                $server_privilege = new Privilege(
                    [
                        'administrator_id' => $administrator->id,
                        'server_id' => $server
                    ]
                );

                $server_privilege->save();
            }

            DB::commit();
        } catch(QueryException $exception) {
            DB::rollBack();

            return back()->withErrors(Lang::get('forms.failed_transaction'))->withInput($request->except('password'));
        }
        
        return redirect()->action([AdministratorController::class, 'index']);
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
        
        $administrator = Administrator::findOrFail($request->id);

        return response()->json([
            'administrator' => $administrator,
            'privileges' => $administrator->privileges,
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
            'auth' => 'required|string',
            'password' => 'string|nullable',
            'account_flags' => 'required',
            'servers' => 'required',
            'rank_id' => 'required|string',
            'expiration' => 'required|date',           
        ]);

        $administrator = Administrator::findOrFail($request->id);

        DB::beginTransaction();

        try {
    
            $administrator->name = $request->name;
            $administrator->auth = $request->auth;
            $administrator->password = $request->password;
            
            $account_flags = json_decode($request->account_flags);
            $flags = "";
 
            foreach ($account_flags as $account_flag) {
                $flags .= "$account_flag->value";
            }

            $administrator->account_flags = $flags;
            $administrator->expiration = $request->expiration;
            $administrator->rank_id = $request->rank_id;

            $administrator->save();

            Privilege::where('administrator_id', $administrator->id)->delete();

            $servers = json_decode($request->servers);

            
            foreach ($servers as $server) {
                $server_privilege = new Privilege(
                    [
                        'administrator_id' => $administrator->id,
                        'server_id' => $server->value,
                    ]
                );

                $server_privilege->save();
            }

            DB::commit();

        } catch (QueryException $exception) {
            DB::rollBack();

            return response(['message' => Lang::get('forms.failed_transaction')], 500);
        }
        
        return response(['message' => Lang::get('forms.success_updated_administrator')], 200);
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
        
        try {
            $success = Administrator::where('id', $id)->delete();

            if (! $success) {
                return back()->withErrors(Lang::get('forms.failed_transaction'));
            }
        } catch (QueryException $exception) {
            return back()->withErrors(Lang::get('forms.failed_transaction'));
        }
        
        return redirect()->action([AdministratorController::class,'index']);
    }
}
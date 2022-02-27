<?php

namespace App\Http\Controllers\Staffs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException; 

use App\Models\Administrator;
use App\Models\Rank;
use App\Models\Server;
use App\Models\Privilege;
use App\Models\User;

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
            'expiration' => 'date|nullable', 
            'user_id' => 'numeric|nullable|min:1',
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
                    'user_id' => $request->user_id,
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
        
        try {
            $administrator = Administrator::findOrFail($request->id);
        } catch (ModelNotFoundException $exception) {
            return response(['message' => Lang::get('errors.model_not_found')], 500);
        }

        return response()->json([
            'administrator' => $administrator,
            'privileges' => $administrator->privileges,
            'user' => $administrator->user,
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
            'expiration' => 'date|nullable',        
            'user_id' => 'numeric|nullable|min:1', 
        ]);

        DB::beginTransaction();

        try {

            $administrator = Administrator::findOrFail($request->id);

            $account_flags = json_decode($request->account_flags);
            $flags = "";
 
            foreach ($account_flags as $account_flag) {
                $flags .= "$account_flag->value";
            }

            $administrator->update([
                'name' => $request->name,
                'auth' => $request->auth,
                'password' => $request->password,
                'account_flags' => $flags,
                'expiration' => $request->expiration,
                'rank_id' => $request->rank_id,
                'user_id' => $request->user_id,
            ]);

            Privilege::where('administrator_id', $request->id)->delete();

            $servers = json_decode($request->servers);

            foreach ($servers as $server) {
                $server_privilege = new Privilege(
                    [
                        'administrator_id' => $request->id,
                        'server_id' => $server->value,
                    ]
                );

                $server_privilege->save();
            }

            DB::commit();

        } catch (QueryException $exception) {
            DB::rollBack();

            return response(['message' => $exception->getMessage()], 500);
        } catch (ModelNotFoundException $exception) {
            
            return response(['message' => Lang::get('errors.model_not_found')], 500);
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
        
        $administrator = Administrator::findOrFail($id);

        if (! $administrator->delete()) {
            return back()->withErrors(Lang::get('forms.failed_transaction'));
        }
        
        return redirect()->action([AdministratorController::class,'index']);
    }

    /**
     * List all users who do not have an associated administrator account
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function load_users(Request $request)
    {
        //
        
        $users = User::select('users.id', 'users.email as label')
            ->role('user')
            ->leftJoin('administrators', 'users.id', '=', 'administrators.user_id')
            ->where(function ($query) use ($request) {
                if (! empty($request->filter)) {
                    $query->orWhere("users.name", "like", "%$request->filter%")
                        ->orWhere("users.email", "like", "%$request->filter%");
                }
            })
            ->whereNull('administrators.user_id')
            ->get();

        if ($users->isEmpty()) {
            return [
                'id' => '',
                'label' => Lang::get('administrators.not_exist_or_already_associated'),
            ];
        }

        return $users;
    }
}
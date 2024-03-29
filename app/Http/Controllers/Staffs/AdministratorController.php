<?php

namespace App\Http\Controllers\Staffs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException; 
use Carbon\Carbon;

use App\Models\Administrator;
use App\Models\Rank;
use App\Models\Server;
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

        $users = User::permission('is_user')->orderBy('name', 'ASC')->get();

        return view('staffs.administrators.index')
            ->with('administrators', $administrators)
            ->with('ranks', $ranks)
            ->with('servers', $servers)
            ->with('users', $users);
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

        $users = User::permission('is_user')->orderBy('name', 'ASC')->get();

        return view('staffs.administrators.create')
            ->with('ranks', $ranks)
            ->with('servers', $servers)
            ->with('users', $users);
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
            'expiration' => 'date|nullable',
        ]);

        DB::beginTransaction();

        try {

            foreach ($request->servers as $server) {

                $administrator = new Administrator();

                $administrator->name = $request->name;
                $administrator->auth = $request->auth;
                $administrator->password = $request->password;
                $administrator->account_flags = implode($request->account_flags);
                $administrator->rank_id = $request->rank_id;
                $administrator->server_id = $server;
                $administrator->expiration = $request->expiration;
                $administrator->status = 'Active';
                $administrator->user_id = $request->user_id;
                    
                $administrator->save();
            }

            DB::commit();
        } catch(QueryException $exception) {
            DB::rollBack();

            return redirect()->back()->withErrors(Lang::get('forms.failed_transaction'))->withInput($request->except('password'));
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
            'expiration' => 'date|nullable',
        ]);

        $administrator = Administrator::findOrFail($request->id);

        $account_flags = json_decode($request->account_flags);
        $flags = "";
 
        foreach ($account_flags as $account_flag) {
            $flags .= "$account_flag->value";
        }
            
        $administrator->name = $request->name;
        $administrator->auth = $request->auth;
        $administrator->password = $request->password;
        $administrator->account_flags = $flags;
        $administrator->rank_id = $request->rank_id;
        $administrator->server_id = $request->server_id;
        $administrator->expiration = $request->expiration;
        $administrator->status = $request->status;
        $administrator->suspended = ($request->status == 'Suspended') ? Carbon::now() : null;

        if (! $administrator->save()) {
            return response(['message' => $exception->getMessage()], 500);
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
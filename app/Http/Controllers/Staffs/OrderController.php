<?php

namespace App\Http\Controllers\Staffs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException; 
use Carbon\Carbon;

use App\Models\Order;
use App\Models\Package;
use App\Models\User;
use App\Models\Administrator;

use Lang;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //

        $orders = Order::orderBy('date', 'DESC')->get();

        $packages = Package::has('privileges')->orderBy('name', 'ASC')->get();

        $order = Order::find($request->order);

        return view('staffs.orders.index')
            ->with('orders', $orders)
            ->with('packages', $packages)
            ->with('order', $order);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $packages = Package::has('privileges')->orderBy('name', 'ASC')->get();

        $users = User::permission('is_user')->orderBy('name', 'ASC')->get();

        return view('staffs.orders.create')
            ->with('packages', $packages)
            ->with('users', $users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'auth' => 'required|string',
            'password' => 'required|string',
        ]);

        $package = Package::findOrFail($request->package_id);

        $order = new Order($request->all());
        $order->user_id = $request->user_id;
        $order->status = "Pending";
        $order->price = (empty($request->price)) ? $package->price : $request->price;
        

        if (! $order->save())
            return back()->withErrors(Lang::get('forms.failed_transaction'))->withInput($request->except('password'));

        return redirect()->action([OrderController::class, 'index']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        //

        try {
            $order = Order::findOrFail($request->id);
        } catch (ModelNotFoundException $exception) {
            return response(['message' => Lang::get('errors.model_not_found')], 500);
        }

        return response()->json([
            'order' => $order,
            'user' => $order->user,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //

        $request->validate([
            'auth' => 'required|string',
            'password' => 'string|nullable',
            'price' => 'required|numeric', 
        ]);

        $order = Order::findOrFail($request->id);
        
        if (! $order->update($request->all()))
            return response(['message' => Lang::get('forms.failed_transaction')], 500);


        return $order;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $order = Order::findOrFail($id);

        if (! $order->delete()) {
            return back()->withErrors(Lang::get('forms.failed_transaction'));
        }
        
        return redirect()->action([OrderController::class,'index']);
    }

    /**
     * Activate order and register administrators.
     */
    public function activate(string $id)
    {
        //

        DB::beginTransaction();

        try {
            $order = Order::findOrFail($id);

            $package = $order->package;

            foreach ($package->privileges as $privilege) {
                $administrator = new Administrator([
                    'name' => $order->user->name,
                    'auth' => $order->auth,
                    'password' => $order->password,
                    'account_flags' => 'ab',
                    'rank_id' => $privilege->rank_id,
                    'server_id' => $privilege->server_id,
                    'order_id' => $order->id
                ]);

                $administrator->save();
            }

            $now = Carbon::now();
            $order->expiration = $now->addMonth();
            $order->status = 'Activated';
            $order->save();
            
            DB::commit();
        } catch(QueryException $exception) {
            DB::rollBack();
            
            return back()->withErrors(Lang::get('forms.failed_transaction'));
        }

        return redirect()->action([OrderController::class, 'index']);
    }
}

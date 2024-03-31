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
        $order->package_id = $request->package_id;
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
        ]);

        DB::beginTransaction();

        try {
            $order = Order::findOrFail($request->id);

            $order->auth = $request->auth;
            $order->password = $request->password;
            $order->package_id = $request->package_id;
            $order->expiration = $request->expiration;
            $order->price = $request->price;
            $order->save();

            Administrator::where('order_id', $order->id)->update([
                'name' => $order->user->name,
                'auth' => $order->auth,
                'password' => $order->password,
                'expiration' => $order->expiration,
                'account_flags' => 'ab'
            ]);
            
            DB::commit();
        } catch(QueryException $exception) {
            DB::rollBack();
            
            return response(['message' => Lang::get('forms.failed_transaction')], 500);
        }

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

            $newExpiration = Carbon::now()->addMonth();

            foreach ($package->privileges as $privilege) {
                $administrator = new Administrator([
                    'order_id' => $order->id
                ]);

                $administrator = new Administrator();

                $administrator->name = $order->user->name;
                $administrator->auth = $order->auth;
                $administrator->password = $order->password;
                $administrator->account_flags = 'ab';
                $administrator->expiration = $newExpiration;
                $administrator->status = 'Active';
                $administrator->rank_id = $privilege->rank_id;
                $administrator->server_id = $privilege->server_id;
                $administrator->user_id = $order->user->id;
                $administrator->order_id = $order->id;
                
                $administrator->save();
            }
            
            $order->expiration = $newExpiration;
            $order->status = 'Active';
            $order->save();
            
            DB::commit();
        } catch(QueryException $exception) {
            DB::rollBack();
            
            return back()->withErrors(Lang::get('forms.failed_transaction'));
        }

        return redirect()->action([OrderController::class, 'index']);
    }

    /**
     * Cancel order and administrators.
     */
    public function cancel(string $id)
    {
        //

        DB::beginTransaction();

        try {
            $order = Order::findOrFail($id);

            foreach ($order->administrators as $administrator) {
                $administrator->status = 'Cancelled';
                $administrator->save();
            }
            
            $order->status = 'Cancelled';
            $order->save();
            
            DB::commit();
        } catch(QueryException $exception) {
            DB::rollBack();
            
            return back()->withErrors(Lang::get('forms.failed_transaction'));
        }

        return redirect()->action([OrderController::class, 'index']);
    }

    /**
     * Renew order and administrators.
     */
    public function renew(string $id)
    {
        //

        DB::beginTransaction();

        try {
            $order = Order::findOrFail($id);

            foreach ($order->administrators as $administrator) {
                $newExpiration = Carbon::parse($administrator->expiration)->addMonth();

                $administrator->status = 'Active';
                $administrator->expiration = $newExpiration;
                $administrator->save();
            }
            
            $newExpiration = Carbon::parse($order->expiration)->addMonth();
            $order->status = 'Active';
            $order->expiration = $newExpiration;
            $order->save();
            
            DB::commit();
        } catch(QueryException $exception) {
            DB::rollBack();
            
            return back()->withErrors(Lang::get('forms.failed_transaction'));
        }

        return redirect()->action([OrderController::class, 'index']);
    }
}

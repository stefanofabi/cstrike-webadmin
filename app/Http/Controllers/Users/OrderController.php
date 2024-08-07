<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException; 

// Payments
use MP;

use App\Models\Order;
use App\Models\Package;
use App\Models\Administrator;

use Lang;
use Exception;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $user = auth()->user();

        $orders = Order::where('user_id', $user->id)->orderBy('date', 'DESC')->get(); 

        $order = Order::find($request->order);

        return view('users.orders.index')
            ->with('orders', $orders)
            ->with('order', $order);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $packages = Package::where('retired', false)->has('privileges')->orderBy('name', 'ASC')->get();

        $package = Package::find($request->package);

        if ($package->retired) {
            $package = null;
        }

        return view('users.orders.create')
            -> with('packages', $packages)
            ->with('package', $package);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'auth' => 'required|string|min:4|max:32|regex:/^[a-zA-Z\s]+$/',
            'password' => 'required|string|min:4|max:20|regex:/^[a-zA-Z0-9]+$/',
        ]);

        $package = Package::findOrFail($request->package_id);

        if ($package->retired)
            return redirect()->back()->withErrors(Lang::get('orders.package_is_not_available_for_purchase'))->withInput($request->except('password'));

        $user = auth()->user();
        
        $order = new Order();
        $order->date = Carbon::now();
        $order->auth = $request->auth;
        $order->password = $request->password;
        $order->package_id = $request->package_id;
        $order->user_id = $user->id;
        $order->price = $package->price;
        $order->status = "Pending";

        if (! $order->save())
            return redirect()->back()->withErrors(Lang::get('forms.failed_transaction'))->withInput($request->except('password'));

        return redirect()->route('users/orders/pay', ['id' => $order->id]);
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
            return response(['message' => Lang::get('errors.model_not_found')], 404);
        }

        return response()->json([
            'order' => $order,
            'package' => $order->package,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //

        $request->validate([
            'auth' => 'required|string|min:4|max:32|regex:/^[a-zA-Z\s]+$/',
            'password' => 'required|string|min:4|max:20|regex:/^[a-zA-Z0-9]+$/',
        ]);

        $user = auth()->user();

        DB::beginTransaction();

        try {
            $order = Order::findOrFail($request->id);

            if ($order->auth != $request->auth) {
                $order->last_change = Carbon::now();
            }
            
            $order->auth = $request->auth;
            $order->password = $request->password;
            
            $order->save();

            $order->administrators()->update([
                'auth' => $request->auth,
                'password' => $request->password
            ]);

            DB::commit();
        } catch (ModelNotFoundException $exception) {
            return response(['message' => Lang::get('errors.model_not_found')], 404);
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
    }

    public function pay(string $id) 
    {
        $order = Order::findOrFail($id);

        // create payment link with mercadopago.com
        $mercadopago = $this->createOrderWithMercadoPago($order);

        return view('users.orders.pay')
            ->with('order', $order)
            ->with('mercadopago', $mercadopago);
    }


    private function createOrderWithMercadoPago(Order $order) 
    {
        $preferenceData = [
            'external_reference' => $order->id,
            'items' => [
                [
                    'id' => $order->id,
                    'title' => $order->package->name,
                    'quantity' => 1,
                    'currency_id' => 'ARS',
                    'unit_price' => $order->price
                ]
            ],
            'back_urls' => [
                'success' => route('users/orders/index', ['order' => $order->id]),
                'failure' => route('users/orders/index', ['order' => $order->id]),
                'pending' => route('users/orders/index', ['order' => $order->id]),
            ],
            'auto_return' => 'approved',
            //'notification_url' => route('mercadopago.webhook'),
        ];

        try {
            $mp = MP::create_preference($preferenceData);
        } catch (Exception $e) {

            return null;
        }

        return $mp['response'];
    }
}

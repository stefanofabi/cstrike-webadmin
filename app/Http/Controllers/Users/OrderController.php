<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Package;

use Lang;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $orders = Order::orderBy('date', 'DESC')->where('user_id', auth()->user()->id)->get(); 

        return view('users.orders.index')
            ->with('orders', $orders);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $packages = Package::has('privileges')->orderBy('name', 'ASC')->get();

        $package = Package::find($request->package);

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
            'auth' => 'required|string|min:4|max:32|regex:/^[a-zA-Z]+$/',
            'password' => 'required|string|min:4|max:20|regex:/^[a-zA-Z0-9]+$/',
        ]);

        $package = Package::findOrFail($request->package_id);

        $order = new Order();
        $order->auth = $request->auth;
        $order->password = $request->password;
        $order->package_id = $request->package_id;
        $order->user_id = auth()->user()->id;
        $order->price = $package->price;
        $order->status = "Pending";

        if (! $order->save())
            return redirect()->back()->withErrors(Lang::get('forms.failed_transaction'))->withInput($request->except('password'));

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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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

        return view('users.orders.pay')
            ->with('order', $order);
    }
}

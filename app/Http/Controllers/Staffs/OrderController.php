<?php

namespace App\Http\Controllers\Staffs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException; 

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

        $orders = Order::orderBy('date', 'DESC')->get();

        $packages = Package::orderBy('name', 'ASC')->get();

        return view('staffs.orders.index')
            ->with('orders', $orders)
            ->with('packages', $packages);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
}

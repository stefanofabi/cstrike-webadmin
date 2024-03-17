<?php

namespace App\Http\Controllers\Staffs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Privilege;

use Lang;

class PrivilegeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

        $privilege = new Privilege($request->all());

        if (! $privilege->save())
            return response(['message' => Lang::get('forms.failed_transaction')], 500);

        return $privilege;
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
    public function destroy(Request $request)
    {
        //

        $privilege = Privilege::findOrFail($request->id);

        if (! $privilege->delete()) {
            return response(['message' => Lang::get('forms.failed_transaction')], 500);
        }
        
        return response(['message' => Lang::get('forms.well_done')], 200);
    }
}

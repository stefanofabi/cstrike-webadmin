<?php

namespace App\Http\Controllers\Staffs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Package;
use App\Models\Rank;
use App\Models\Server;

use Lang;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $packages = Package::orderBy('name', 'ASC')->get();

        $ranks = Rank::orderBy('name', 'ASC')->get();

        $servers = Server::orderBy('name', 'ASC')->get();

        return view('staffs.packages.index')
            ->with('packages', $packages)
            ->with('ranks', $ranks)
            ->with('servers', $servers);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('staffs.packages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',

        ]);

        $package = new Package($request->all());

        if (! $package->save())
            return back()->withErrors(Lang::get('forms.failed_transaction'))->withInput($request->all());

        return redirect()->action([PackageController::class, 'index']);
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

        $package = Package::findOrFail($request->id);

        return $package;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //

        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',

        ]);

        $package = Package::findOrFail($request->id);

        if (! $package->update($request->all()))
            return response(['message' => Lang::get('forms.failed_transaction')], 500);

        return $package;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $package = Package::findOrFail($id);

        if (! $package->delete()) {
            return back()->withErrors(Lang::get('forms.failed_transaction'));
        }
        
        return redirect()->action([PackageController::class,'index']);
    }

    public function getPrivileges(Request $request) 
    {
        $package = Package::findOrFail($request->id);

        $privileges = array();

        foreach ($package->privileges as $privilege) {
            $privileges[] = [
                'id' => $privilege->id,
                'server' => $privilege->server->name,
                'rank' => $privilege->rank->name
            ];
        }

        return $privileges;
    }

}

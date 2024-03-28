<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException; 

use App\Models\Administrator;

use Lang;

class AdministratorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $administrators = auth()->user()->administrators;

        return view('users.administrators.index')
            ->with('administrators', $administrators);
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
            $administrator = Administrator::findOrFail($request->id);
        } catch (ModelNotFoundException $exception) {
            return response(['message' => Lang::get('errors.model_not_found')], 500);
        }

        return response()->json([
            'administrator' => $administrator,
            'rank' => $administrator->rank,
            'server' => $administrator->server
        ], 200);
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
}

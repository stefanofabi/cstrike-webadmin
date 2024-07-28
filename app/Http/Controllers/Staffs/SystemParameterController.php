<?php

namespace App\Http\Controllers\Staffs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\SystemParameter;

use Lang;
use Session;

class SystemParameterController extends Controller
{
    public function index(Request $request)
    {
        //

        $parameters = SystemParameter::get();

        return view('staffs.system_parameters.index')
            ->with('parameters', $parameters);
    }

    public function edit(Request $request)
    {
        try {
            $parameter = SystemParameter::findOrFail($request->id);
        } catch (ModelNotFoundException $exception) {
            return response(['message' => Lang::get('errors.model_not_found')], 500);
        }

        return response()->json($parameter, 200);
    }

    public function update(Request $request) 
    {
        $request->validate([
            'value' => 'required|string',

        ]);

        $parameter = SystemParameter::findOrFail($request->id);

        if (! $parameter->update($request->all()))
            return response(['message' => Lang::get('forms.failed_transaction')], 500);

        return $parameter;
    }
}
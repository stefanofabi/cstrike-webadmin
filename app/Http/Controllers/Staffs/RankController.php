<?php

namespace App\Http\Controllers\Staffs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException; 

use App\Models\Rank;

use Lang; 

class RankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $ranks = Rank::OrderBy('name', 'ASC')->get();
        
        return view('staffs.ranks.index')
            ->with('ranks', $ranks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('staffs.ranks.create');
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
            'price' => 'required|numeric|min:0',      
            'access_flags' => 'required|array',   
        ]);

        $rank = new Rank(
            [
                'name' => $request->name,
                'price' => $request->price,
                'access_flags' => implode($request->access_flags),
            ]
        );

        if (! $rank->save()) {
            return back()->withErrors(Lang::get('forms.failed_transaction'))->withInput($request->all());
        }

        return redirect()->action([RankController::class, 'index']);
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
            $rank = Rank::findOrFail($request->id);
        } catch (ModelNotFoundException $exception) {
            return response(['message' => Lang::get('errors.model_not_found')], 500);
        }

        return $rank;
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
            'id' => 'required|numeric|min:1',
            'name' => 'required|string',
            'price' => 'required|numeric|min:0',      
            'access_flags' => 'required',   
        ]);

        try {

            $access_flags = json_decode($request->access_flags);
            $flags = "";
    
            foreach ($access_flags as $access_flag) {
                $flags .= "$access_flag->value";
            }
            
            $updated = Rank::where('id', $request->id)->update(
                [
                    'name' => $request->name,
                    'price' => $request->price,
                    'access_flags' => $flags
                ]
            );
        
            if (! $updated) {
                return response(['message' => Lang::get('forms.failed_transaction')], 500);
            }
        } catch (QueryException) {
            return response(['message' => Lang::get('forms.failed_transaction')], 500);
        }

        return response(['message' => Lang::get('ranks.success_updated_rank')], 200);
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

        try {
            $success = Rank::where('id', $id)->delete();

            if (! $success) {
                return back()->withErrors(Lang::get('forms.failed_transaction'));
            }
        } catch (QueryException $exception) {
            return back()->withErrors(Lang::get('forms.failed_transaction'));
        }

        return redirect()->action([RankController::class,'index']);
    }
}

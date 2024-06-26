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

        $ranks = Rank::OrderBy('immunity', 'DESC')->get();
        
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
            'color' => 'required',
            'immunity' => 'required|numeric|min:0|max:100',
        ]);

        $rank = new Rank(
            [
                'name' => $request->name,
                'price' => $request->price,
                'access_flags' => implode($request->access_flags),
                'color' => $request->color,
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
            return response(['message' => Lang::get('errors.model_not_found')], 404);
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
            'color' => 'required',
            'immunity' => 'required|numeric|min:0|max:100',
        ]);
        
        try {

            $rank = Rank::findOrFail($request->id);

            $access_flags = json_decode($request->access_flags);
            $flags = "";
    
            foreach ($access_flags as $access_flag) {
                $flags .= "$access_flag->value";
            }
            
            $updated = $rank->update(
                [
                    'name' => $request->name,
                    'price' => $request->price,
                    'access_flags' => $flags,
                    'color' => $request->color,
                    'immunity' => $request->immunity,
                ]
            );
        
            if (! $updated) {
                return response(['message' => Lang::get('forms.failed_transaction')], 500);
            }
        } catch (QueryException $exception) {
            return response(['message' => Lang::get('forms.failed_transaction')], 500);
        } catch (ModelNotFoundException $exception) {
            return response(['message' => Lang::get('errors.model_not_found')], 404);
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

        $rank = Rank::findOrFail($id);

        if (! $rank->delete()) {
            return back()->withErrors(Lang::get('forms.failed_transaction'));
        }

        return redirect()->action([RankController::class,'index']);
    }
}

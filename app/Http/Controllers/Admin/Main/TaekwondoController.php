<?php

namespace App\Http\Controllers\Admin\Main;

use App\Models\Taekwondo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaekwondoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.main.taekwondo.index')->with('taekwondo',Taekwondo::orderBy('created_at','desc')->first());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());
        $validator = \Validator::make($request->all(), [
            'taekwondo' => 'required',
            'india_taekwondo' => 'required',
            'world_taekwondo' => 'required',
            'asian_taekwondo_union' => 'required',
            'taekwondo_sport' => 'required',
            'kyorogi' => 'required',
            'poomsae' => 'required',
            'para_taekwondo' => 'required'

        ]);
        if ($validator->fails()) {
            // dd("in if");
            return  redirect()->back()
                        ->withErrors($validator)
                        ->withInput()
                        ->with('autofocus', true);
        }

        $taekwondo= new Taekwondo;
        $taekwondo->taekwondo= $request->input('taekwondo');
        $taekwondo->india_taekwondo=$request->input('india_taekwondo');
        $taekwondo->world_taekwondo=$request->input('world_taekwondo');
        $taekwondo->asian_taekwondo_union=$request->input('asian_taekwondo_union');
        $taekwondo->taekwondo_sport=$request->input('taekwondo_sport');
        $taekwondo->kyorogi=$request->input('kyorogi');
        $taekwondo->poomsae=$request->input('poomsae');
        $taekwondo->para_taekwondo=$request->input('para_taekwondo');

        $taekwondo->save();

        return redirect(route('admin.taekwondo.index'))->with('success','taekwondo Added Successfully');

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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    //   dd($request->all());
   
        $validator = \Validator::make($request->all(), [
            'taekwondo' => 'required',
            'india_taekwondo' => 'required',
            'world_taekwondo' => 'required',
            'asian_taekwondo_union' => 'required',
            'taekwondo_sport' => 'required',
            'kyorogi' => 'required',
            'poomsae' => 'required',
            'para_taekwondo' => 'required'

          
        ]);
        if ($validator->fails()) {
            // dd("in if");
            return  redirect()->back()
                        ->withErrors($validator)
                        ->withInput()
                        ->with('autofocus', true);
        }

        // dd($description);
        $taekwondo = Taekwondo::find($id);
        // dd($taekwondo->id);
        $taekwondo->taekwondo= $request->input('taekwondo');
        $taekwondo->india_taekwondo=$request->input('india_taekwondo');
        $taekwondo->world_taekwondo=$request->input('world_taekwondo');
        $taekwondo->asian_taekwondo_union=$request->input('asian_taekwondo_union');
        $taekwondo->taekwondo_sport=$request->input('taekwondo_sport');
        $taekwondo->kyorogi=$request->input('kyorogi');
        $taekwondo->poomsae=$request->input('poomsae');
        $taekwondo->para_taekwondo=$request->input('para_taekwondo');

        $taekwondo->save();
        return redirect(route('admin.taekwondo.index'))->with('success','taekwondo Updated Successfully');

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
    }
}

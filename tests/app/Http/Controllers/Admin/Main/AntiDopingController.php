<?php

namespace App\Http\Controllers\Admin\Main;

use App\Models\AntiDoping;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AntiDopingController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.main.antidoping.index')->with('antidoping',AntiDoping::orderBy('created_at','desc')->first());
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
        $validator = \Validator::make($request->all(), [
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            // dd("in if");
            return  redirect()->back()
                        ->withErrors($validator)
                        ->withInput()
                        ->with('autofocus', true);
        }

        $antidoping=new AntiDoping;
        $antidoping->description=$request->input('description');

        // $description = str_replace(' ', '', $request->input('description'));


        // if($description == ""){
        //     return redirect()->back()->with('error','Description cannot be empty')->withInput();

        // }else{
        //     $antidoping->description=$request->input('description');
        // } 

        $antidoping->save();

        return redirect(route('admin.antidoping.index'))->with('success','AntiDoping Added Successfully');

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

        $validator = \Validator::make($request->all(), [
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            // dd("in if");
            return  redirect()->back()
                        ->withErrors($validator)
                        ->withInput()
                        ->with('autofocus', true);
        }
        $antidoping= AntiDoping::find($id);
        $antidoping->description=$request->input('description');


        // $description = str_replace(' ', '', $request->input('description'));
        // if($description == ""){
        //     return redirect()->back()->with('error','Description cannot be empty')->withInput();

        // }else{
        //     $antidoping->description=$request->input('description');
        // } 
        $antidoping->save();
        return redirect(route('admin.antidoping.index'))->with('success','AntiDoping Updated Successfully');

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

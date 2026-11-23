<?php

namespace App\Http\Controllers\Admin\Association;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\AssociationPresidentMessage;
use App\Models\Association;


class PresidentMessageController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($assoc_id)
    {
        return view('pages.admin.association.presidentMessage.index')->with('assoc_id',$assoc_id)->with('president_msg',AssociationPresidentMessage::orderBy('created_at','desc')->where('assoc_id','=',$assoc_id)->first());
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

        $taekwondo=new AssociationPresidentMessage;
        $taekwondo->description=$request->input('description');


        // $description = str_replace(' ', '', $request->input('description'));


        // if($description == ""){
        //     return redirect()->back()->with('error','President description cannot be empty')->withInput();
        // }else{
        // }

        $taekwondo->save();

        return redirect(route('assoc_admin.president_message.index'))->with('success','President Message Added Successfully');

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
    public function update(Request $request, $president_id)
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
        $taekwondo= AssociationPresidentMessage::find($president_id);
        $taekwondo->description=$request->input('description');

        // $description = str_replace(' ', '', $request->input('description'));

        // if($description == ""){
        //     return redirect()->back()->with('error','President description cannot be empty')->withInput();

        // }else{
        //     $taekwondo->description=$request->input('description');
        // }
        $taekwondo->save();

        return redirect()->back()->with('success','President Message Added Successfully');

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

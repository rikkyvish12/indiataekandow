<?php

namespace App\Http\Controllers\Admin\Association;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\AssociationSecretaryMessage;

class SecretaryMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($assoc_id)
    {
        return view('pages.admin.association.secretaryMessage.index')->with('assoc_id',$assoc_id)->with('secretory_msg',AssociationSecretaryMessage::orderBy('created_at','desc')->where('assoc_id','=',$assoc_id)->first());
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

        $taekwondo=new AssociationSecretaryMessage;
        // $description = str_replace(' ', '', $request->input('description'));


        // if($description == ""){
        //     return redirect()->back()->with('error','Secretary description cannot be empty')->withInput();

        // }else{
            $taekwondo->description=$request->input('description');
        // }
        $taekwondo->save();

        return redirect(route('assoc_admin.secretary_message.index'))->with('success','Secretary Message Added Successfully');

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
    public function update(Request $request,$assoc_id, $secretory_id)
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
        $taekwondo= AssociationSecretaryMessage::find($secretory_id);
        $taekwondo->description=$request->input('description');        
        $taekwondo->save();

        return redirect(route('assoc_admin.secretary_message_index',$assoc_id))->with('success','Secretary Message Added Successfully');

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

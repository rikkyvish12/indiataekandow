<?php

namespace App\Http\Controllers\Admin\Association;

use auth;
use App\Models\AssociationProfile;
use App\Models\AssociationType;
use App\Models\Association;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($assoc_id)
    {
       return view('pages.admin.association.profile.edit')->with('assoc_id',$assoc_id)->with('assoc_profile',AssociationProfile::where('assoc_id','=',$assoc_id)->first());
       
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
        //
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
    public function update(Request $request,$assoc_id)
    {
        $validator = \Validator::make($request->all(), [
            'description' =>'required',            
            'address' =>'required',            
            'number' =>'required',
            'email' =>'required',         
          
        ]);
        if ($validator->fails()) {
            // dd("in if");
            return  redirect()->back()
                        ->withErrors($validator)
                        ->withInput()
                        ->with('autofocus', true);
        }

        $destination_path = NULL;

            $assoc_profile=AssociationProfile::where('assoc_id','=',$assoc_id)->first();
            $assoc = Association::where('id','=',$assoc_id)->first();
            $assoc_type = AssociationType::where('id','=',$assoc->assoc_type_id )->value('name');
            $final_assoc_type=str_replace('_association', '', $assoc_type);
            $destination_path= 'storage/association/'. $final_assoc_type.'/'.$assoc_id.'/logo/';   
        // if($request->hasFile('logo'))
        // {
        //     $logo = 'logo'.'.'.request()->logo->getClientOriginalExtension();
        //     request()->logo->move($destination_path, $logo);
        //     $assoc_profile->logo='/'.$destination_path.$logo;
        // }

        $assoc_profile->email=$request->input('email');
        $assoc_profile->number=$request->input('number');
        $assoc_profile->facebook=$request->input('facebook');
        $assoc_profile->instagram=$request->input('instagram');
        $assoc_profile->address=$request->input('address');
        $assoc_profile->description=$request->input('description');
        $assoc_profile->send_to_email=$request->input('send_to_email');
        $assoc_profile->send_to_email_2=$request->input('send_to_email_2');
        $assoc_profile->save();
        return redirect()->back()->with('success','Association Profile Updated Successfully');
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

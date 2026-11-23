<?php

namespace App\Http\Controllers\Admin\Events;

use auth;
use App\Models\EventProfile;
use App\Models\AssociationType;

use App\Models\Events;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($event_id)
    {
    // dd($event_id);
        // dd(EventProfile::where('event_id','=',$event_id)->first());
       return view('pages.admin.event.profile.index')->with('event_id',$event_id)->with('event_profile',EventProfile::where('event_id','=',$event_id)->first());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($event_id)
    {
        return view('pages.admin.event.profile.create')->with('event_id',$event_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $event_id)
    {
        $validator = \Validator::make($request->all(), [
            'number' =>'required',
            'description' =>'required',
            'address' =>'required',
            'email' =>'required',
          
        ]);
        if ($validator->fails()) {
            // dd("in if");
            return  redirect()->back()
                        ->withErrors($validator)
                        ->withInput()
                        ->with('autofocus', true);

        }
        $get_event = Events::where('id',$event_id)->first();

        $destination_path =NULL;

           if($get_event->assoc_id != NULL){
               
               $assoc_type = AssociationType::where('id','=',$get_event->assoc_id )->value('name');
               

               $final_assoc_type=str_replace('_association', '', $assoc_type);
               $destination_path = 'storage/events/association/'. $final_assoc_type.'/'.$get_event->assoc_id.'/'.$event_id.'/profile/logo/';           
           }else{
               $destination_path = 'storage/events/main/'.$event_id.'/profile/logo/';

           }

        $event_profile=new EventProfile;
        // if($request->hasFile('logo'))
        // {
        //     $logo ='logo.'.request()->logo->getClientOriginalExtension();
        //     request()->logo->move($destination_path, $logo);
        //     $event_profile->logo='/'.$destination_path.$logo;
        // }

        $event_profile->email=$request->input('email');
        $event_profile->number=$request->input('number');

        $event_profile->event_id=$event_id;
        // $event_profile->event_name=$get_event->title;


        if($request->has('facebook'))
        $event_profile->facebook=$request->input('facebook');

        if($request->has('instagram'))
        $event_profile->instagram=$request->input('instagram');      

        $event_profile->address=$request->input('address');
        $event_profile->description=$request->input('description');
        $event_profile->save();

       
        return 
        redirect(route('event_admin.profile_index',$event_id))
                    ->with('success','Event Profile Created Successfully')
                    ->with('event_id',$event_id);                    
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
    public function edit($event_id,$id)
    {
        return view('pages.admin.event.profile.edit')->with('event_id',$event_id)->with('event_profile',EventProfile::where('id',$id)->first());;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $event_id,$id)
    {
        $validator = \Validator::make($request->all(), [
            
            'number' =>'required',
            'description' =>'required',
            'address' =>'required',
            'email' =>'required',
          
        ]);
        if ($validator->fails()) {
            // dd("in if");
            return  redirect()->back()
                        ->withErrors($validator)
                        ->withInput()
                        ->with('autofocus', true);

        }

            $event_profile=EventProfile::where('event_id',$event_id)->first();

            $get_event = Events::where('id',$event_id)->first();

           $destination_path =NULL;

           if($get_event->assoc_id != NULL){
               $assoc_type = AssociationType::where('id','=',$get_event->assoc_id )->value('name');
               

               $final_assoc_type=str_replace('_association', '', $assoc_type);
               $destination_path = 'storage/events/association/'. $final_assoc_type.'/'.$get_event->assoc_id.'/'.$event_id.'/profile/logo/';           
           }else{
               $destination_path = 'storage/events/main/'.$event_id.'/profile/logo/';

           }

        // if($request->hasFile('logo'))
        // {
        //     $logo ='logo.'.request()->logo->getClientOriginalExtension();
        //     request()->logo->move($destination_path, $logo);
        //     $event_profile->logo='/'.$destination_path.$logo;
        // }

        $event_profile->email=$request->input('email');
        $event_profile->number=$request->input('number');

        if($request->has('facebook'))
        $event_profile->facebook=$request->input('facebook');

        if($request->has('instagram'))
        $event_profile->instagram=$request->input('instagram');     
        $event_profile->address=$request->input('address');
        $event_profile->description=$request->input('description');
        $event_profile->save();
        return 
        redirect(route('event_admin.profile_index',$event_id))
                    ->with('success','Event Profile Updated Successfully')
                    ->with('event_id',$event_id);   
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

<?php

namespace App\Http\Controllers\Admin\Association;

use App\Models\User;
use App\Models\AssociationEvent;
use App\Models\Events;
use App\Models\Association;
use App\Models\EventProfile;
use App\Models\AssociationType;
use Illuminate\Http\Request;
use App\Models\DefaultEvents;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EventController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($assoc_id)
    {
        return view('pages.admin.association.event.index')->with('assoc_id',$assoc_id)->with('events',Events::orderBy('created_at','desc')->where('assoc_id','=',$assoc_id)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($assoc_id)
    {
        $users = User::where('role','event')->get();
        // dd($users);
        return view('pages.admin.association.event.create')->with('assoc_id',$assoc_id)->with('users',$users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$assoc_id)
     {
        // dd($request->all());
        // dd($assoc_id);
       // $state_id = Association::where('id',$assoc_id)->value('state_id');
       $validator = \Validator::make($request->all(), [
        'title' => 'required',
        'location' => 'required',
        'date' => 'required',
        'intro' => 'required',            
        'coverImage' =>'required|dimensions:min_width=345,min_height=245,max_width=355,max_height=255',
        'national_event'=>'required_if:event_presentation,1',  
        'external_link'=>'required_if:event_presentation,3',
        'event_managing_user_type'  => 'required_if:event_presentation,2',                 
        'existing_users' => 'required_if:event_managing_user_type,1',
        'full_name' =>'required_if:event_managing_user_type,2',
        'email' =>'required_if:event_managing_user_type,2|unique:users,email',
        'password' =>'required_if:event_managing_user_type,2'
       
    ]);
    if ($validator->fails()) {
        // dd("in if");
        return  redirect()->back()
                    ->withErrors($validator)
                    ->withInput($request->except('password'))
                    ->with('autofocus', true);
    }

        $assoc_type= NULL;
        $event_present = $request->input('event_presentation');
        $event=new Events;
        $event->title=$request->input('title');
        $event->assoc_id=$assoc_id;
        $event->location=$request->input('location');
        $event->date=$request->input('date');
        $event->intro=$request->input('intro');
        $event->event_presentation=$event_present;
        $event->save();

        $event = Events::find($event->id);
        $destination_path = NULL;
        // $assoc_type = AssociationType::where('id','=',$assoc_id )->value('name');
        // $final_assoc_type=str_replace('_association', '', $assoc_type);

            $assoc = Association::where('id','=',$assoc_id)->first();
            $assoc_type = AssociationType::where('id','=',$assoc->assoc_type_id )->value('name');
            $final_assoc_type=str_replace('_association', '', $assoc_type);
            $destination_path = 'storage/events/association/'.$final_assoc_type.'/'.$assoc_id.'/'.$event->id.'/coverImage/';   

        

        
        if($request->hasFile('coverImage'))      {
            
            $coverImage = 'cover_image.'.request()->coverImage->getClientOriginalExtension();

            request()->coverImage->move($destination_path, $coverImage);
            $event->coverImage= '/'.$destination_path.$coverImage;
        }
        // if($final_assoc_type ==="state")
        // $event->eventType_id='4';
        // elseif($final_assoc_type ==="district")
        // $event->eventType_id='5';
        // elseif($final_assoc_type ==="")
        // $event->eventType_id='4';





       // $event->link="events/".                    //links = new website, link = within same site, or else external link.
       if($event_present == 1){
        $event->content=$request->input('national_event');

        // $national_event = str_replace(' ', '', $request->input('national_event'));


        //     if($national_event == ""){
        //         return redirect()->back()->with('error','Event description cannot be empty')->withInput($request->except('password'));

        //     }else{
        //         $event->content=$request->input('national_event');
        //     }
       }elseif($event_present == 2){

        if($request->input('event_managing_user_type') == 1){
            $selected_user_id = $request->input('existing_users');
            $all_admin_id = User::where('role','admin')->pluck('id');
            $all_admin_id = substr($all_admin_id, 1, -1);
            if(Auth::user()->id != $selected_user_id){
                $all_admin_id = Auth::user()->id.",".$all_admin_id.",".$selected_user_id;
             }else{
                 $all_admin_id = $all_admin_id.",".$selected_user_id;
             }
                         $event->user_access = $all_admin_id;

            $event_profile=new EventProfile;
            $event_profile->event_id = $event->id;
            // $event_profile->event_name=$request->input('title');
            $event_profile->email=NULL;
            $event_profile->save();

        }elseif($request->input('event_managing_user_type') == 2){

          
            $user=new User;
            $user->name=$request->input('full_name');
            $user->email=$request->input('email');
            $user->role='event';
            $user->password= Hash::make($request->input('password'));
            $user->save();
            $all_admin_id = User::where('role','admin')->pluck('id');
            $all_admin_id = substr($all_admin_id, 1, -1);
            $all_admin_id =  Auth::user()->id.','.$all_admin_id.",".$user->id;
            $event->user_access = $all_admin_id;

            $event_profile=new EventProfile;
            $event_profile->event_id = $event->id;
            // $event_profile->event_name=$request->input('title');
            $event_profile->email=NULL;
            $event_profile->save();
         
        }




        }else{
            $event->link=$request->input('external_link');
        }

         $event->save();
         $event_default=new DefaultEvents;
         $event_default->event_id = $event->id;
        //  $event_default->event_name=$request->input('title');
         $event_default->save();




    //     $event=new Events;
    //     $event->title=$request->input('title');
    //     $event->state_name=Auth::user()->name;
    //     $event->location=$request->input('location');
    //     $event->date=$request->input('date');
    //     $event->intro=$request->input('intro');
    //     $event->link='NA';
    //     if($request->hasFile('coverImage'))
    //     {
    //         $coverImage = time().'.'.request()->coverImage->getClientOriginalExtension();
    //         request()->coverImage->move('national_event_coverImage/', $coverImage);
    //         $event->coverImage='/national_event_coverImage/'.$coverImage;
    //     }
    //     $event->eventType_id='4';

    //     $event->save();

    //     $user=new User;
    //     $user->name=$request->input('title');
    //     $user->email=$request->input('email');
    //     $user->role='event';
    //     $user->password= Hash::make($request->input('password'));
    //     $user->save();

    //     $event_profile=new EventProfile;
    //     $event_profile->event_name=$request->input('title');
    //     $event_profile->email=$request->input('email');
    //     $event_profile->save();

    //     $event_default=new DefaultEvents;
    //     $event_default->event_name=$request->input('title');
    //     $event_default->save();


        return redirect(route('assoc_admin.event_index',$assoc_id))->with('success','Event Created Successfully');

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
    public function edit($assoc_id,$id)
    {
        $users = User::where('role','event')->get();
        // dd($users);
        $event= Events::find($id);
        if($event->user_access){
            $user_array = explode(',', $event->user_access);
            // dd($user_array);
            if(count($user_array) == 2)
            $event['user_id'] =  $user_array[1];
            else
            $event['user_id'] =  $user_array[2];



        }
// dd($event);
        return view('pages.admin.association.event.edit')->with('assoc_id',$assoc_id)->with(['event'=>$event,'users'=>$users]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$assoc_id, $id)
    {
        $validator = \Validator::make($request->all(), [
            'title' => 'required',
            'location' => 'required',
            'date' => 'required',
            'intro' => 'required',            
            'coverImage' =>'dimensions:min_width=345,min_height=245,max_width=355,max_height=255',
            'national_event'=>'required_if:event_presentation,1',  
            'external_link'=>'required_if:event_presentation,3',
            'event_managing_user_type'  => 'required_if:event_presentation,2',                 
            'existing_users' => 'required_if:event_managing_user_type,1',
            'full_name' =>'required_if:event_managing_user_type,2',
            'email' =>'required_if:event_managing_user_type,2|unique:users,email',
            'password' =>'required_if:event_managing_user_type,2'
           
        ]);
        if ($validator->fails()) {
            // dd("in if");
            return  redirect()->back()
                        ->withErrors($validator)
                        ->withInput($request->except('password'))
                        ->with('autofocus', true);
        }


        $event= Events::find($id);
        $event_present = $request->input('event_presentation');
        $assoc_type =NULL;
        $event->title=$request->input('title');
        $event->location=$request->input('location');
        $event->date=$request->input('date');
        $event->intro=$request->input('intro');
        $event->event_presentation=$event_present;
        $event->save();

        $event = Events::find($id);

            $assoc = Association::where('id','=',$assoc_id)->first();
            $assoc_type = AssociationType::where('id','=',$assoc->assoc_type_id )->value('name');
            $final_assoc_type=str_replace('_association', '', $assoc_type);
            $final_assoc_type=str_replace('_association', '', $assoc_type);
            $destination_path = 'storage/events/association/'.$final_assoc_type.'/'.$assoc_id.'/'.$id.'/coverImage/';   


        if($request->hasFile('coverImage'))
        {        

            $coverImage = 'cover_image.'.request()->coverImage->getClientOriginalExtension();
            request()->coverImage->move($destination_path, $coverImage);
            $event->coverImage='/'.$destination_path.$coverImage;
        }
        // $event->eventType_id='4';


       // $event->link="events/".                    //links = new website, link = within same site, or else external link.
       if($event_present == 1){
              $event->content=$request->input('national_event');

            //  $national_event = str_replace(' ', '', $request->input('national_event'));


            // if($national_event == ""){
            //     return redirect()->back()->with('error','Event presentation within main description cannot be empty')->withInput($request->except('password'));

            // }else{
            //     $event->content=$request->input('national_event');
            //     $event->user_access = NULL;
            //     $event->link=NULL;
            // }


       }elseif($event_present == 2){

        if($request->input('event_managing_user_type') == 1){
            $selected_user_id = $request->input('existing_users');
            $all_admin_id = User::where('role','admin')->pluck('id');
            $all_admin_id = substr($all_admin_id, 1, -1);
            // $all_admin_id = Auth::user()->id.",".$all_admin_id.",".$selected_user_id;
            if(Auth::user()->id != $selected_user_id){
                $all_admin_id = Auth::user()->id.",".$all_admin_id.",".$selected_user_id;
             }else{
                 $all_admin_id = $all_admin_id.",".$selected_user_id;
             }
                
            $event->user_access = $all_admin_id;
            $event->content=NULL;
            $event->link=NULL;

            $event_profile=new EventProfile;
            $event_profile->event_id = $event->id;
            // $event_profile->event_name=$request->input('title');
            $event_profile->email=NULL;
            $event_profile->save();
        }
        elseif($request->input('event_managing_user_type') == 2){
        
            $user=new User;
            $user->name=$request->input('full_name');
            $user->email=$request->input('email');
            $user->role='event';
            $user->password= Hash::make($request->input('password'));
            $user->save();
            $all_admin_id = User::where('role','admin')->pluck('id');
            $all_admin_id = substr($all_admin_id, 1, -1);
            $all_admin_id = Auth::user()->id.','.$all_admin_id.",".$user->id;
            $event->user_access = $all_admin_id;
            $event->content=NULL;
            $event->link=NULL;


            $event_profile=new EventProfile;
            $event_profile->event_id = $event->id;
            // $event_profile->event_name=$request->input('title');
            $event_profile->email=NULL;
            $event_profile->save();
         
        }
       }
       else{
            $event->link=$request->input('external_link');
            $event->user_access = NULL;
            $event->content=NULL;
        }

        $event->save();

        $event_default=new DefaultEvents;
        $event_default->event_id = $event->id;
        $event_default->save();
        return redirect(route('assoc_admin.event_index',$assoc_id))->with('success','Event Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($assoc_id,$id)
    {
        $event= Events::find($id);
        
        // $user=User::where('name','=',$event->title)->first();
        //$event_profile= EventProfile::where('event_name','=',$event->title)->first();
        //$event_default= DefaultEvents::where('event_name','=',$event->title)->first();

        // $user->delete();
      //  $event_profile->delete();
      //  $event_default->delete();
        $destination_path =NULL;
        $assoc = Association::where('id','=',$assoc_id)->first();
        $assoc_type = AssociationType::where('id','=',$assoc_id)->value('name');
        $final_assoc_type=str_replace('_association', '', $assoc_type);
        $destination_path = 'storage/events/association/'.$final_assoc_type.'/'.$assoc_id.'/'.$id; 
        // dd($destination_path);  
        if(\File::exists($destination_path))
        {
         \File::deleteDirectory($destination_path);
        }

        $event->delete();

        return redirect()->back()->with('success','Event Deleted Successfully');

    }
}


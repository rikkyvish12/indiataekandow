<?php

namespace App\Http\Controllers\Admin\Main;

use App\Models\User;
use App\Models\Events;
use App\Models\EventProfile;
use Illuminate\Http\Request;
use App\Models\DefaultEvents;
use App\Models\AssociationType;
use App\Models\Album;
use App\Models\ImageGallery;
use App\Models\VideoAlbum;
use App\Models\VideoGallery;
use App\Models\NewsEvents;
use App\Models\EventResults;
use App\Models\ImportantPDFEvents;
use App\Models\EventSlider;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class NationalEventController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Events::orderBy('created_at','desc')->where('eventType_id','=','2')->get();
        foreach( $events as  $event ){
            if($event['user_access'] != NULL){                
                $user_array = explode(',', $event['user_access']);
                $user_id =  $user_array[1];
                $get_user_name= User::where('id','=',$user_id)->pluck('name')[0];
                $event['user_name']= $get_user_name;
            }
            
        }

            
            
        
        return view('pages.admin.main.national_event.index')->with('events',$events);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('role','event')->get();
        return view('pages.admin.main.national_event.create')->with('users',$users);
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
        // $('#national_event').prop('disabled',false)
        // $('#existing_users').prop('disabled',true)
        // $('#event_managing_user_type').prop('disabled',true)
        // $('#full_name').prop('disabled',true)
        // $('#email').prop('disabled',true)
        // $('#password').prop('disabled',true)
        // $('#external_link').prop('disabled',true)

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
        
        
        $event_present = $request->input('event_presentation');
        $event=new Events;
        $event->title=$request->input('title');
        $event->location=$request->input('location');
        $event->date=$request->input('date');
        $event->intro=$request->input('intro');
        $event->event_presentation=$event_present;
        $event->save();
        $event = Events::find($event->id);

        if($request->hasFile('coverImage'))
        {
            $coverImage = 'cover_img.'.request()->coverImage->getClientOriginalExtension();

            request()->coverImage->move('storage/events/main/'.$event->id.'/coverImage/', $coverImage);
            $event->coverImage='/storage/events/main/'.$event->id.'/coverImage/'.$coverImage;
        }
        $event->eventType_id='2';


       // $event->link="events/".                    //links = new website, link = within same site, or else external link.
       if($event_present == 1){
            //  $national_event = str_replace(' ', '', $request->input('national_event'));


            // if($national_event == ""){
            //     return redirect()->back()->with('error','Event presentation within main description cannot be empty')->withInput($request->except('password'));

            // }else{
            //     $event->content=$request->input('national_event');
            // }

            $event->content=$request->input('national_event');


       }elseif($event_present == 2){

        if($request->input('event_managing_user_type') == 1){
            $selected_user_id = $request->input('existing_users');
            $all_admin_id = User::where('role','admin')->pluck('id');
            $all_admin_id = substr($all_admin_id, 1, -1);
            $all_admin_id = $all_admin_id.",".$selected_user_id;
            $event->user_access = $all_admin_id;

            $event_profile=new EventProfile;
            $event_profile->event_id = $event->id;
            // $event_profile->event_name=$request->input('title');
            $event_profile->email=NULL;
            $event_profile->save();
        }
        elseif($request->input('event_managing_user_type') == 2){
            $exist = User::where('email','=', $request->input('email'))->exists();
            if($exist){
                return redirect()->back()->with('error','User with specified email-ID already exist')->withInput($request->except('password'));

            }else{
            $user=new User;
            $user->name=$request->input('full_name');
            $user->email=$request->input('email');
            $user->role='event';
            $user->password= Hash::make($request->input('password'));
            $user->save();
            $all_admin_id = User::where('role','admin')->pluck('id');
            $all_admin_id = substr($all_admin_id, 1, -1);
            $all_admin_id = $all_admin_id.",".$user->id;
            $event->user_access = $all_admin_id;


            $event_profile=new EventProfile;
            $event_profile->event_id = $event->id;
            // $event_profile->event_name=$request->input('title');
            $event_profile->email=NULL;
            $event_profile->save();
         }
        }
       }
       else{
            $event->link=$request->input('external_link');
        }

        $event->save();

        $event_default=new DefaultEvents;
        $event_default->event_id = $event->id;
        // $event_default->event_name=$request->input('title');
        $event_default->save();


        return redirect(route('admin.national_event.index'))->with('success','Event Created Successfully');

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
        $users = User::where('role','event')->get();
        $event= Events::find($id);
        if($event->user_access){
            $user_array = explode(',', $event->user_access);
            $event['user_id'] =  $user_array[1];

        }

    //   dd($event);
        return view('pages.admin.main.national_event.edit')->with(['event'=>$event,'users'=>$users]);
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

        // $event->title=$request->input('title');
        // $event->location=$request->input('location');
        // $event->date=$request->input('date');
        // $event->intro=$request->input('intro');
        // $event->content=$request->input('national_event');
        // $event->link='NA';
        // if($request->hasFile('coverImage'))
        // {
        //     $coverImage = time().'.'.request()->coverImage->getClientOriginalExtension();
        //     request()->coverImage->move('national_event_coverImage/', $coverImage);
        //     $event->coverImage='/national_event_coverImage/'.$coverImage;
        // }
        // $event->eventType='national_event';

        // $event->save();

        // return redirect(route('admin.national_event.index'))->with('success','Event Updated Successfully');

        $event->title=$request->input('title');
        $event->location=$request->input('location');
        $event->date=$request->input('date');
        $event->intro=$request->input('intro');
        $event->event_presentation=$event_present;
        $event->save();

        $event = Events::find($id);
        if($request->hasFile('coverImage'))
        {
            $coverImage = 'cover_img.'.request()->coverImage->getClientOriginalExtension();
            request()->coverImage->move('storage/events/main/'.$id.'/coverImage/', $coverImage);
            $event->coverImage='/storage/events/main/'.$id.'/coverImage/'.$coverImage;
        }
        $event->eventType_id='2';


       // $event->link="events/".                    //links = new website, link = within same site, or else external link.
       if($event_present == 1){
            //  $national_event = str_replace(' ', '', $request->input('national_event'));


            // if($national_event == ""){
            //     return redirect()->back()->with('error','Event presentation within main description cannot be empty')->withInput($request->except('password'));

            // }else{
               
            // }
            $event->content=$request->input('national_event');
            $event->user_access = NULL;
            $event->link=NULL;


       }elseif($event_present == 2){

        if($request->input('event_managing_user_type') == 1){
            $selected_user_id = $request->input('existing_users');
            $all_admin_id = User::where('role','admin')->pluck('id');
            $all_admin_id = substr($all_admin_id, 1, -1);
            $all_admin_id = $all_admin_id.",".$selected_user_id;
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
            $exist = User::where('email','=', $request->input('email'))->exists();
            if($exist){
                return redirect()->back()->with('error','User with specified email-ID already exist')->withInput($request->except('password'));

            }else{
            $user=new User;
            $user->name=$request->input('full_name');
            $user->email=$request->input('email');
            $user->role='event';
            $user->password= Hash::make($request->input('password'));
            $user->save();
            $all_admin_id = User::where('role','admin')->pluck('id');
            $all_admin_id = substr($all_admin_id, 1, -1);
            $all_admin_id = $all_admin_id.",".$user->id;
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
       }
       else{
            $event->link=$request->input('external_link');
            $event->user_access = NULL;
            $event->content=NULL;
        }

        $event->save();

        $event_default=new DefaultEvents;
        $event_default->event_id = $event->id;
        // $event_default->event_name=$request->input('title');
        $event_default->save();


        return redirect(route('admin.national_event.index'))->with('success','Event Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            $event= Events::find($id);
        // $user=User::where('name','=',$event->title)->first();

            NewsEvents::where('event_id','=',$id)->delete();
            
            ImportantPDFEvents::where('event_id','=',$id)->delete();

            EventResults::where('event_id','=',$id)->delete();

            DefaultEvents::where('event_id','=',$id)->delete(); 

            EventProfile::where('event_id','=',$id)->delete();

            EventSlider::where('event_id','=',$id)->delete();

           $get_image_albums =  Album::where('event_id','=',$id)->get();
            foreach ($get_image_albums as $album) {  
                ImageGallery::where('album_id','=',$album['id'])->delete(); 
            }
            Album::where('event_id','=',$id)->delete();

            $get_video_albums =  VideoAlbum::where('event_id','=',$id)->get();
            foreach ($get_video_albums as $video_album) {  
                VideoGallery::where('album_id','=',$video_album['id'])->delete(); 
            }
            VideoAlbum::where('event_id','=',$id)->delete();

            $path ="storage/events/main/".$id;
            if(\File::exists($path))
            {
                \File::deleteDirectory($path);
            }

            $event->delete();

        return redirect(route('admin.national_event.index'))->with('success','Event Deleted Successfully');

    }
}

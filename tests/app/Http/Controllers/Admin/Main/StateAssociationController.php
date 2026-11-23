<?php

namespace App\Http\Controllers\Admin\Main;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\States;
use App\Models\Events;
use App\Models\EventProfile;
use App\Models\DefaultEvents;
use App\Models\Association;
use App\Models\AssociationType;
use App\Models\AssociationAlbum;
use App\Models\AssociationImageGallery;
use App\Models\AssociationCommittee;
use App\Models\AssociationCommitteeMember;
use App\Models\DefaultAssociation;
use App\Models\AssociationVideo;
use App\Models\AssociationVideoAlbum;
use App\Models\AssociationSlider;
use App\Models\AssociationPatrons;
use App\Models\AssociationNews;
use App\Models\AssociationGovernance;
use App\Models\AssociationDocuments;
use App\Models\AssociationProfile;
use App\Models\AssociationSecretaryMessage;
use App\Models\AssociationPresidentMessage;
use App\Models\EventAlbum;
use App\Models\EventImageGallery;
use App\Models\EventsVideoAlbum;
use App\Models\EventsVideo;
use App\Models\NewsEvents;
use App\Models\EventResults;
use App\Models\ImportantPDFEvents;
use App\Models\EventSlider;


class StateAssociationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.main.association.index')->with([
            'association'=>Association::where('assoc_type_id','=','1')->get(),
            'title'=>'State Association',
            'url'=>'state_association'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('role','association')->get();
        $states = States::get();
        $existing_states = Association::where('assoc_type_id','1')->pluck('state_id');
       
        return view('pages.admin.main.association.create')->with('existing_states',$existing_states)->with('states',$states)->with('users',$users)->with(['title'=>'State Association','url'=>'state_association']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $presidentDescription = $request->input('presidentDescription');
         // $secretaryDescription = $request->input('secretaryDescription');
        //  dd($request->all());
         $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'state_id' => 'required',
             'logo' => 'required|dimensions:min_width=345,min_height=245,max_width=355,max_height=255',
             'presidentName' =>'required',
             'presidentEmail' =>'required|email',
             'presidentDescription' =>'required',
             'presidentPhoto' => 'required|dimensions:min_width=345,min_height=245,max_width=355,max_height=255',
             'secretaryName' =>'required',
             'secretaryDescription' =>'required',
             'secretaryEmail' =>'required|email',
             'secretaryPhoto' =>'required|dimensions:min_width=345,min_height=245,max_width=355,max_height=255',  
             'description' =>'required',
             'managing_user_type' =>'required',
             'existing_users' => 'required_if:managing_user_type,1',
             'username' =>'required_if:managing_user_type,2',
             'email' =>'required_if:managing_user_type,2|unique:users,email',
             'password' =>'required_if:managing_user_type,2'

        ]);

        if ($validator->fails()) {
            // dd("in if");
            return  redirect()->back()
                        ->withErrors($validator)
                        ->withInput($request->except('password'))
                        ->with('autofocus', true);
        }
try{

        $association=new Association;
        $association->type='state_association';
        $association->assoc_type_id='1';
        $association->name=$request->input('name');
        $association->presidentName=$request->input('presidentName');
        $association->presidentDescription=$request->input('presidentDescription');
        $association->presidentEmail=$request->input('presidentEmail');
        $association->secretaryName=$request->input('secretaryName');
        $association->secretaryDescription=$request->input('secretaryDescription');
        $association->secretaryEmail=$request->input('secretaryEmail');
        $association->description=$request->input('description');
        $association->state_id=$request->input('state_id');

        if($request->input('managing_user_type') == 1){
            $selected_user_id = $request->input('existing_users');
            $all_admin_id = User::where('role','admin')->pluck('id');
            $all_admin_id = substr($all_admin_id, 1, -1);
            if(Auth::user()->id != $selected_user_id){
                $all_admin_id = Auth::user()->id.",".$all_admin_id.",".$selected_user_id;
             }else{
                 $all_admin_id = $all_admin_id.",".$selected_user_id;
             }
                         $association->user_access = $all_admin_id;
        }
        elseif($request->input('managing_user_type') == 2){

           
                $user=new User;
                $user->name=$request->input('username');
                $user->email=$request->input('email');
                $user->role='association';
                $user->password= Hash::make($request->input('password'));
                $user->save();
                $all_admin_id = User::where('role','admin')->pluck('id');
                $all_admin_id = substr($all_admin_id, 1, -1);
                $all_admin_id = Auth::user()->id.",".$all_admin_id.",".$user->id;
                $association->user_access = $all_admin_id;
                $association->save();

            
         }

         $association->save();

         $association = Association::find($association->id);

        if($request->hasFile('logo'))
        {
            $logo = 'logo.'.request()->logo->getClientOriginalExtension();
            request()->logo->move('storage/association/state/'.$association->id.'/logo/', $logo);
            $association->logo='/storage/association/state/'.$association->id.'/logo/'.$logo;
        }
        if($request->hasFile('presidentPhoto'))
        {
            $presidentPhoto = 'president.'.request()->presidentPhoto->getClientOriginalExtension();
            request()->presidentPhoto->move('storage/association/state/'.$association->id.'/president/', $presidentPhoto);
            $association->presidentPhoto='/storage/association/state/'.$association->id.'/president/'.$presidentPhoto;
        }
        if($request->hasFile('secretaryPhoto'))
        {
            $secretaryPhoto = 'secretory.'.request()->secretaryPhoto->getClientOriginalExtension();
            request()->secretaryPhoto->move('storage/association/state/'.$association->id.'/secretary/',$secretaryPhoto);
            $association->secretaryPhoto='/storage/association/state/'.$association->id.'/secretary/'.$secretaryPhoto;
        }
        $association->save();

        $assoc_profile=new AssociationProfile;
        $assoc_profile->assoc_id=$association->id;
        $assoc_profile->email=$request->input('presidentEmail');
        $assoc_profile->save();

        $assoc_default=new DefaultAssociation;
        $assoc_default->logo=$association->logo;
        $assoc_default->assoc_id=$association->id;
        $assoc_default->save();

        $assoc_president_message=new AssociationPresidentMessage;
        $assoc_president_message->assoc_id=$association->id;
        $assoc_president_message->save();

        $assoc_secretary_message=new AssociationSecretaryMessage;
        $assoc_secretary_message->assoc_id=$association->id;
        $assoc_secretary_message->save();




        return redirect(route('admin.state_association.index'))->with('success','State Association Added Successfully');
    } catch (\Exception $e) {
        echo $e->getMessage();
        }

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
        $users = User::where('role','state')->get();
        $states = States::get();
        $existing_states = Association::where('assoc_type_id','1')->pluck('state_id');

        return view('pages.admin.main.association.edit')
        ->with(['association'=>Association::find($id)])->with('existing_states',$existing_states)->with('states',$states)->with('users',$users)->with(['title'=>'State Association','url'=>'state_association']);
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
           // $presidentDescription = $request->input('presidentDescription');
         // $secretaryDescription = $request->input('secretaryDescription');
         $validator = \Validator::make($request->all(), [
            'name' => 'required',
             'logo' => 'dimensions:min_width=345,min_height=245,max_width=355,max_height=255',
             'presidentName' =>'required',
             'presidentEmail' =>'required|email',
             'presidentDescription' =>'required',
             'presidentPhoto' => 'dimensions:min_width=345,min_height=245,max_width=355,max_height=255',
             'secretaryName' =>'required',
             'secretaryDescription' =>'required',
             'secretaryEmail' =>'required|email',
             'secretaryPhoto' =>'dimensions:min_width=345,min_height=245,max_width=355,max_height=255',
             'description' =>'required'
             

        ]);

        if ($validator->fails()) {
            // dd("in if");
            return  redirect()->back()
                        ->withErrors($validator)
                        ->withInput($request->except('password'))
                        ->with('autofocus', true);
        }

try{
        $association= Association::find($id);
        $association->type='state_association';
        $association->name=$request->input('name');
        $association->presidentName=$request->input('presidentName');
        $association->presidentDescription=$request->input('presidentDescription');
        // $presidentDescription = str_replace(' ', '', $request->input('presidentDescription'));

        // if($presidentDescription == ""){
        //     return redirect()->back()->with('error','President description cannot be empty')->withInput();

        // }else{
        //     $association->presidentDescription=$request->input('presidentDescription');
        // }
          // $association->presidentDescription = str_replace(',', '<br />', $presidentDescription);
          $association->presidentEmail=$request->input('presidentEmail');
          $association->secretaryName=$request->input('secretaryName');
          $association->secretaryDescription=$request->input('secretaryDescription');
        // $secretaryDescription = str_replace(' ', '', $request->input('secretaryDescription'));


        // if($secretaryDescription == ""){
        //     return redirect()->back()->with('error','Secretary description cannot be empty')->withInput();

        // }else{
        //     $association->secretaryDescription=$request->input('secretaryDescription');
        // }
          // $association->secretaryDescription = str_replace(',', '<br />', $secretaryDescription);;
        $association->secretaryEmail=$request->input('secretaryEmail');
        $association->description=$request->input('description');

        // $description = str_replace(' ', '', $request->input('description'));


        // if($description == ""){
        //     return redirect()->back()->with('error',' Association description cannot be empty')->withInput();

        // }else{
        //     $association->description=$request->input('description');
        // }


        if($request->hasFile('logo'))
        {
            $logo = time().'.'.request()->logo->getClientOriginalExtension();
            request()->logo->move('storage/association/state/'.$association->id.'/logo/', $logo);
            $association->logo='/storage/association/state/'.$association->id.'/logo/'.$logo;
        }
        if($request->hasFile('presidentPhoto'))
        {
            $presidentPhoto = time().'.'.request()->presidentPhoto->getClientOriginalExtension();
            request()->presidentPhoto->move('storage/association/state/'.$association->id.'/president/', $presidentPhoto);
            $association->presidentPhoto='/storage/association/state/'.$association->id.'/president/'.$presidentPhoto;
        }
        if($request->hasFile('secretaryPhoto'))
        {
            $secretaryPhoto = time().'.'.request()->secretaryPhoto->getClientOriginalExtension();
          request()->secretaryPhoto->move('storage/association/state/'.$association->id.'/secretary/',$secretaryPhoto);
            $association->secretaryPhoto='/storage/association/state/'.$association->id.'/secretary/'.$secretaryPhoto;
        }


        $association->save();

        return redirect(route('admin.state_association.index'))->with('success','State Association Updated Successfully');
    } catch (\Exception $e) {
        echo $e->getMessage();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    try{
        $association= Association::find($id);
      
        $assoc_type = AssociationType::where('id','=',$association->assoc_type_id )->value('name');

        $final_assoc_type = str_replace('_association', '', $assoc_type);
    
        $path =NULL;
                
        $user=User::where('name','=',$association->name)->first();
        
        AssociationProfile::where('assoc_id','=',$id)->delete();

        DefaultAssociation::where('assoc_id','=',$id)->delete();

        AssociationPresidentMessage::where('assoc_id','=',$id)->delete();
        
        AssociationSecretaryMessage::where('assoc_id','=',$id)->delete();

        AssociationNews::where('assoc_id','=',$id)->delete();

        AssociationPatrons::where('assoc_id','=',$id)->delete(); 

        AssociationGovernance::where('assoc_id','=',$id)->delete(); 

        AssociationDocuments::where('assoc_id','=',$id)->delete(); 

        AssociationSlider::where('assoc_id','=',$id)->delete(); 
        // $assoc_profile->delete();

        // $state_default->delete();

        // $state_president_messsage->delete();

        // $state_secretary_messsage->delete();

       
        // if($get_assoc_news){
        //     $get_assoc_news->each->delete(); 
        // }
        
        // if($get_assoc_patrons){
        //     $get_assoc_patrons->each->delete(); 
        // }
      
        // if($get_assoc_governances){
        //     $get_assoc_governances->each->delete(); 
        // }
        
        // if($get_assoc_documents){
        //     $get_assoc_documents->each->delete(); 
        // }

        // if($get_assoc_sliders){
        //     $get_assoc_sliders->each->delete(); 
        // }
        $get_assoc_events= Events::where('assoc_id','=',$id)->get();
            if($get_assoc_events){
                foreach ($get_assoc_events as $event) {    
                                    
                    NewsEvents::where('event_id','=',$event['id'])->delete();
                    
                    ImportantPDFEvents::where('event_id','=',$event['id'])->delete();

                    EventResults::where('event_id','=',$event['id'])->delete();

                    DefaultEvents::where('event_id','=',$event['id'])->delete(); 

                    EventProfile::where('event_id','=',$event['id'])->delete();

                    EventSlider::where('event_id','=',$event['id'])->delete();
                

                    // if($get_events_default){
                    //     $get_events_default->each->delete(); 
                    // }

                    // if($get_events_results){
                    //     $get_events_results->each->delete(); 
                    // }

                    // if($get_events_profile){
                    //     $get_events_profile->each->delete(); 
                    // }

                    // if($get_events_news){
                    //     $get_events_news->each->delete(); 
                    // }

                    // if($get_events_sliders){
                    //     $get_events_sliders->each->delete(); 
                    // }

                    // if($get_events_imp_pdf){
                    //     $get_events_imp_pdf->each->delete(); 
                    // }
            }
            Events::where('assoc_id','=',$id)->delete();
            }
     
      $get_assoc_albums = AssociationAlbum::where('assoc_id','=',$id)->get();
        foreach($get_assoc_albums as $assoc_album ){
          
                AssociationImageGallery::where('album_id','=',$assoc_album['id'])->delete();
                // if($get_album_images){
                //     $get_album_images->each->delete(); 
                // }        
        }

        AssociationAlbum::where('assoc_id','=',$id)->delete();

        $get_assoc_committees=AssociationCommittee::where('assoc_id','=',$id)->get();

        foreach($get_assoc_committees as $committee ){
           AssociationCommitteeMember::where('committee_id','=',$committee['id'])->delete();
                // if($get_committe_members){
                //     $get_committe_members->each->delete(); 
                // }
        }

        AssociationCommittee::where('assoc_id','=',$id)->delete();

        $get_video_album = AssociationVideoAlbum::where('assoc_id','=',$id)->get();

        foreach($get_video_album as $assoc_video_album ){               
                    $get_album_videos = AssociationVideo::where('album_id','=',$assoc_video_album['id'])->delete(); 
                            // if($get_album_videos){
                            //     $get_album_videos->each->delete(); 
                            // }               
        
        }
        AssociationVideoAlbum::where('assoc_id','=',$id)->delete();

        $get_events_path =  'storage/events/association/'.$final_assoc_type.'/'.$id;


        if(\File::exists($get_events_path))
        {
            \File::deleteDirectory($get_events_path);
        }


        $main_dir_path = 'storage/association/'.$final_assoc_type.'/'.$id;

        if(\File::exists($main_dir_path))
        {
            \File::deleteDirectory($main_dir_path);
        }

       $association->delete();
     

       return redirect()->back()->with('success','State Association Deleted Successfully');

        
    }catch(\Exception $e){
        // do task when error
         echo $e->getMessage();
      }
      

    }
}

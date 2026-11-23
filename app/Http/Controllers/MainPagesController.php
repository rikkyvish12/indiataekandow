<?php

namespace App\Http\Controllers;
use DB;
use App\Models\News;
use App\Models\Album;
use App\Models\Awards;
use App\Models\Events;
use App\Models\Slider;
use App\Models\Patrons;
use App\Models\States;
use App\Models\Districts;
use App\Models\Documents;
use App\Models\Results;
use App\Models\Education;
use App\Models\AssociationNews;
use App\Models\AntiDoping;
use App\Models\Department;
use App\Models\Governance;
use App\Models\HallOfFame;
use App\Models\Management;
use App\Models\NewsEvents;
use App\Models\Taekwondo;
use App\Models\AssociationAlbum;
use App\Models\AssociationVideo;
use App\Models\VideoAlbum;
use App\Models\Association;
use App\Models\EventSlider;
use App\Models\EventsVideo;
use App\Models\Secretariat;
use App\Models\AssociationSlider;
use App\Models\DefaultAssociation;
use App\Models\EventProfile;
use App\Models\MainProfile;
use App\Models\EventResults;
use App\Models\ImageGallery;
use App\Models\AssociationPatrons;
use App\Models\AssociationProfile;
use App\Models\VideoGallery;
use Illuminate\Http\Request;
use App\Models\DefaultEvents;
use App\Models\MemberProfile;
use App\Models\AssociationCommittee;
use App\Models\AssociationEvent;
use App\Models\AssociationDocuments;
use App\Models\Committee;
use App\Models\CommitteeMember;
use App\Models\AssociationGovernance;
use App\Models\AssociationVideoAlbum;
use App\Models\EventsVideoAlbum;
use App\Models\PresidentMessage;
use App\Models\EventImageGallery;
use App\Models\AssociationImageGallery;
use App\Models\AssociationType;
use App\Models\ImportantPDFEvents;
use App\Models\RulesAndRegulations;
use App\Models\AssociationCommitteeMember;
use App\Models\AssociationPresidentMessage;
use App\Models\AssociationSecretaryMessage;
use App\Models\JoinTFI;
use App\Models\ContactUs;
use Carbon\Carbon;


use App\Http\Traits\SocialMediaTrait;
use App\Http\Traits\MailRouter;


class MainPagesController extends Controller
{
    use SocialMediaTrait; // use SocialMediaTrait trait to get the header repeated data
    use MailRouter;
    public function index()
    {
        return view('pages.main.index')->with([
            'sliders'=>Slider::orderBy('position','asc')->get(),
            'news'=>News::orderBy('Date','desc')->get(),
            'images'=>Album::where('parent_id',0)->orderBy('timestamp','asc')->get(),
            'default'=>DefaultAssociation::get(),
            'videos'=>VideoAlbum::orderBy('timestamp','asc')->get(),
            'athlete'=>MemberProfile::orderBy('created_at','desc')->where('type','=','athlete')->get()

        ]);
    }


     public function taekwondo(){
          return view('pages.main.about.taekwondo')->with(
            [
                'taekwondo'=>Taekwondo::orderBy('created_at','desc')->first(),
            ]
        );
    }
    public function founding_president_message()
    {
        $msg=PresidentMessage::orderBy('created_at','desc')->first();
        return view('pages.main.about.organisation.founding_president_message')->with('msg',$msg);
    }

    public function governance()
    {
        return view('pages.main.about.organisation.governance')->with('governance',Governance::orderBy('position','asc')->get());
    }
    public function secretariat()
    {
        $msg=Secretariat::orderBy('created_at','desc')->first();
        return view('pages.main.about.organisation.secretariat')->with('msg',$msg);
    }

    public function management()
    {
        return view('pages.main.about.organisation.management')->with('management',Management::orderBy('position','asc')->get());
    }
    public function department()
    {
        return view('pages.main.about.organisation.department')->with('department',Department::orderBy('position','asc')->get());
    }
    public function patronsandadviser()
    {
        return view('pages.main.about.organisation.patronsandadviser')->with('patrons',Patrons::orderBy('position','asc')->get());
    }
    public function committee_commission()
    {
        $committees = Committee::get();
        return view('pages.main.about.committee_commission.index')->with('committees',$committees);
    }
 public function committee_commission_detail($commitee_id,$committee_name)
    {
        
        $members=CommitteeMember::where('committee_id','=',$commitee_id)->get();
        // dd($members);
        $title = ucwords(str_replace('_', ' ', $committee_name));
        return view('pages.main.about.committee_commission.detail')->with(['title'=>$title,'members'=> $members]);
    }

    public function documentationanddownloads()
    {

        return view('pages.main.about.documentationanddownloads')->with([
                'documents'=>Documents::orderBy('name')->where('type','=','DOCUMENTS')->get(),
                'audit'=>Documents::orderBy('name')->where('type','=','AUDIT & ACCOUNTING')->get(),
                'forms'=>Documents::orderBy('name')->where('type','=','FORMS & CIRCULARS')->get(),
        ]);
    }

      // rulesandregulations
      public function rulesandregulations()
      {
          $rnr=RulesAndRegulations::orderBy('created_at','desc')->get();
          return view('pages.main.rulesandregulations.index')->with('rnr',$rnr);
      }
      public function rulesandregulationsDetails($rulename)
      {

          $rnr=RulesAndRegulations::where('name','=',$rulename)->first();

          $title = ucwords(str_replace('_', ' ', $rulename));
          return view('pages.main.rulesandregulations.detail')->with(['title'=>$title,'rnr'=>$rnr]);
      }


    // Events
    public function events($event_type)
    {
        // $events=Events::where('eventType','=',ucwords(str_replace('_', ' ', substr($event_type, 0, -1))))->get();
        $event_type_id = DB::table('event_type')->where('event_type','=',$event_type)->value('id');

        $events = Events::where('eventType_id','=',$event_type_id)->orderBy('Date','desc')->get();
        //  dd($events);
        $title = ucwords(str_replace('_', ' ', $event_type));

        $path= url('/').'/events/'.$title;

        $shareComponent  =  $this->socialMedia($path);

        return view('pages.main.events.index')->with(['title'=>$title,'events'=>$events,
                                                    'shareComponent'=>$shareComponent
                                                 ]);
    }

    public function events_details($id,$title_in)
    {
        // dd($id);

        // $events=Events::where('id','=',ucwords(str_replace('_', ' ', substr($event_type, 0, -1))))->get();

        $events=Events::where('id','=',$id)->first();

        $event_type = DB::table('event_type')->where('id','=',$events->eventType_id)->pluck('event_type')[0];
         //  dd($events);
        // $title_in = Events::where('id','=',$id)->pluck('title');

        $title = ucwords(str_replace('_', ' ', $event_type));

                return view('pages.main.events.event_details')->with(['title'=>$title,'events'=>$events]);
    }

    public function news_letter()
    {
        return view('pages.main.media.news_letter');
    }


    public function international_news()
    {
        $news = News::where('type','=','international_news')->get();

        $title = ucwords(str_replace('_', ' ', 'international_news'));

        return view('pages.main.media.news.index')->with(['title'=>$title,'news'=>$news]);
    }

    public function national_news()
    {

        $news =  News::where('type','=','national_news')->get();
        $title = ucwords(str_replace('_', ' ', 'national_news'));



        return view('pages.main.media.news.index')->with(['title'=>$title,'news'=>$news]);

    }
    public function national_news_details($id,$title_in)
    {
        $news=News::where('id','=',$id)->first();

        $title = ucwords(str_replace('_', ' ', 'nataional_news'));
        $path= url('/').'/national_news/'.$id.'/'.$title_in;

        $shareComponent  =  $this->socialMedia($path);

        return view('pages.main.media.news.details')->with(['title'=>$title,'news'=>$news,'shareComponent'=>$shareComponent]);

    }

    public function image_album(){
        $album=Album::where('parent_id',0)->where('status',1)->orderBy('timestamp','desc')->get();
        return view('pages.main.media.photo.index')->with('album',$album);
    }
    public function alblum_folder($album_id){
        $gallery=ImageGallery::orderBy('created_at','desc')->where('album_name','=',$album_name)->paginate(9);
        $title = ucwords(str_replace('_', ' ', $album_name));
        $path= url('/').'/image_gallery/'.$title;

        $shareComponent  =  $this->socialMedia($path);
        return view('pages.main.media.photo.details')->with(['title'=>$title,'gallery'=>$gallery,'shareComponent'=>$shareComponent]);
    }
    public function image_gallery(Request $request,$album_id,$album_name){
        $nested = Album::where('id',$album_id)->value('nested');
        $parent_album_id = $album_id;
        $folder_id = $request->input('folder_id');
        $sub_folder_count = 0; // this is written for future purpose
        $is_folder = 0;
        $first_image =array();
        
        if(isset($folder_id)){
            $album_id = $folder_id;
            $is_folder = 1;
            $child_folders = Album::orderBy('created_at','desc')->where('parent_id','=',$folder_id)->get();
            if(sizeof($child_folders)>0){
                $album_id = $folder_id;
                $nested = 1;
            }else{
                $nested = 0;
            }
        }
 
        if($nested){
            $folders=Album::orderBy('created_at','desc')->where('parent_id','=',$album_id)->get();
            $title = ucwords(str_replace('_', ' ', $album_name));
            $path= url('/').'/image_gallery/'.$title;
            $shareComponent  =  $this->socialMedia($path);
        //    dd($folders);
         
        foreach($folders as $folder){
            $get_path= DB::table('image_galleries')->where('album_id','=',$folder['id'])->latest()->first();
           
            $folder['first_image_path'] =$get_path->image_path;
            // array_push($first_image,$get_path->image_path);
        }

        //    dd($folders);

            return view('pages.main.media.photo.details')->with(['first_image' => $first_image,'nested'=>$nested,'album_name'=>$album_name,'is_folder'=>$is_folder,'title'=>$title,'folders'=>$folders,'shareComponent'=>$shareComponent]);
        }else{
            $gallery=ImageGallery::orderBy('created_at','desc')->where('album_id','=',$album_id)->paginate(9);
            $title = ucwords(str_replace('_', ' ', $album_name));
            $path= url('/').'/image_gallery/'.$title;
            $shareComponent  =  $this->socialMedia($path);
            
            return view('pages.main.media.photo.details')->with(['parent_album_id'=>$parent_album_id,'album_id'=>$album_id,'album_name'=>$album_name,'is_folder'=>$is_folder,'nested'=>$nested,'title'=>$title,'gallery'=>$gallery,'shareComponent'=>$shareComponent]);
        }
       
    }
    public function video_album(){
        $album=VideoAlbum::orderBy('timestamp','asc')->get();
        return view('pages.main.media.video.index')->with('album',$album);
    }
    public function video_gallery($album_id,$album_name){
        $gallery=VideoGallery::orderBy('created_at','desc')->where('album_id','=',$album_id)->get();

        $title = ucwords(str_replace('_', ' ', $album_name));
        $path= url('/').'/video_gallery/'.$album_id.'/'.$title;
        $shareComponentVideoLink =

        $shareComponent  =  $this->socialMedia($path);
        return view('pages.main.media.video.details')->with(['title'=>$title,'gallery'=>$gallery,'shareComponent'=>$shareComponent,'shareComponentVideoLink'=>$shareComponentVideoLink]);
    }

    public function awardsandhonorured()
    {
        $awards=Awards::orderBy('created_at','desc')->get();
        return view('pages.main.tfitent.awardsandhonorured.index')->with(['title'=>'Be a volunteer with India Taekwondo','awards'=>$awards]);
    }
    public function awardsandhonorureddetails($awardname)
    {
        $title = ucwords(str_replace('_', ' ', $awardname));
        $awards=Awards::where('title','=',$title)->first();
        return view('pages.main.tfitent.awardsandhonorured.details')->with(['title'=>$title,'award'=>$awards]);
    }

    public function halloffame()
    {
        $awards=HallOfFame::orderBy('created_at','desc')->get();
        return view('pages.main.tfitent.halloffame.index')->with(['title'=>'Get Newsletters','awards'=>$awards]);

    }
    public function halloffamedetails($awardname)
    {
        $title = ucwords(str_replace('_', ' ', $awardname));
        $awards=HallOfFame::where('title','=',$title)->first();
        return view('pages.main.tfitent.halloffame.details')->with(['title'=>$title,'award'=>$awards]);
    }

    public function antidoping()
    {
        $title = ucwords(str_replace('_', ' ', 'Event near me?'));
        $antidoping=AntiDoping::orderBy('created_at','desc')->first();
        return view('pages.main.tfitent.antidoping.index')->with(['antidoping'=>$antidoping,'title'=>$title]);
    }


    public function education()
    {
        // $title = ucwords(str_replace('_', ' ', $educationName));
        // $antidoping=Education::orderBy('created_at','desc')->where('title','=',$educationName)->first();
        return view('pages.main.tfitent.education.index');
    }

    //---------------------------------------JOIN TFI FORMS FUNCTION START -------------------------------------//

    public function individual()
    {
        return view('pages.main.jointfi.individual')->with('states',States::get());
    }

    public function sponsor()
    {
        return view('pages.main.jointfi.sponsor')->with('states',States::get());
    }
    public function acadmey()
    {
        return view('pages.main.jointfi.acadmey')->with('states',States::get());
    }

    public function districtTFI()
    {
        return view('pages.main.jointfi.district_tfi')->with('states',States::get())->with('districts',Districts::where('states_id','=','15')->get());
    }

    public function asAstateAssoc()
    {
        return view('pages.main.jointfi.as_a_state_assoc')->with('states',States::get())->with('districts',Districts::where('states_id','=','15')->get());
    }
    public function volunteer()
    {
        return view('pages.main.jointfi.volunteer')->with('states',States::get());
    }

    public function sendEmail(Request $request)
    {
            // dd($request->all());

        $send_array =array();
        $form_name = $request->input('form_name');
        $full_name = $request->input('full_name');
        $final= [];
        $email_exist =  JoinTFI::where('email', $request->input('email'))->exists();
        $contact_exist =  JoinTFI::where('contact', $request->input('contact'))->exists();


            if($email_exist &&  $contact_exist){
                $final['status'] ="exist";
                $final['email'] = $request->input('email');
                $final['contact'] =$request->input('contact');

            }else{
                $create_tfi = new JoinTFI;

                if($request->has('form_name'))
                $create_tfi->type_name =  $form_name;

                if($request->has('full_name'))
                $create_tfi->full_name = $full_name;

                if($request->has('full_name_club'))
                $create_tfi->full_name_club = $request->input('full_name_club'); 
                
                if($request->has('address'))
                $create_tfi->address = $request->input('address');

                if($request->has('state'))
                $create_tfi->state = $request->input('state');

                if($request->has('district'))
                $create_tfi->district = $request->input('district');

                if($request->has('contact'))
                $create_tfi->contact = $request->input('contact');
                
                if($request->has('email'))
                $create_tfi->email = $request->input('email');

                if($request->has('identity'))
                $create_tfi->identity = $request->input('identity');

                if($request->has('designation'))
                $create_tfi->designation = $request->input('designation');

                if($request->has('org_name'))
                $create_tfi->org_name = $request->input('org_name');

                if($request->has('website'))
                $create_tfi->website = $request->input('website');

                if($request->has('message'))
                $create_tfi->message = $request->input('message');

                if($request->has('social_media'))
                $create_tfi->social_media = $request->input('social_media');       
                
                $create_tfi->created_at = Carbon::now(); 
                
                $create_tfi->save();   

                $input_array =  array($request->all());
                
                $profile = MainProfile::orderBy('created_at','desc')->first();
            
                if($profile->send_to_email_2)
                    $send_array = [$profile->send_to_email,$profile->send_to_email_2];
                else
                    $send_array = [$profile->send_to_email];


                

                
            $this->sendTFIEmail($input_array,$form_name,$send_array,$full_name);
            
            $final['status'] ="success";
            $final['form_name'] =$form_name;
            $final['full_name'] =$full_name;

            }

        

     return json_encode($final);
        
        
       
    }

    public function contactUsController(Request $request)
    {
            // dd($request->all());

        $send_array =array();
        $email_exist = null;
        $contact_exist =null;
        $assoc_name =null;
        $profile= null;
        $type = $request->input('type');
        $full_name = $request->input('full_name');
        $final= [];
            // if($type ==="assoc"){
            //     $email_exist =  ContactUs::where('assoc_id','=',$request->input('assoc_id'))->where('email', $request->input('email'))->exists();
            //     $contact_exist =  ContactUs::where('assoc_id','=',$request->input('assoc_id'))->where('contact', $request->input('contact'))->exists();
            // }else{
            //     $email_exist =  ContactUs::where('email', $request->input('email'))->exists();
            //     $contact_exist =  ContactUs::where('contact', $request->input('contact'))->exists();
            // }
        


            // if($email_exist &&  $contact_exist){
            //     $final['status'] ="exist";
            //     $final['email'] = $request->input('email');
            //     $final['contact'] =$request->input('contact');

            // }else{
                $create_contact = new ContactUs;

               
                if($request->has('full_name'))
                $create_contact->full_name = $full_name;
              
                if($request->has('contact'))
                $create_contact->contact = $request->input('contact');
                
                if($request->has('email'))
                $create_contact->email = $request->input('email');

                if($request->has('subject'))
                $create_contact->subject = $request->input('subject');             

                if($request->has('message'))
                $create_contact->message = $request->input('message');   
                
                if($request->has('assoc_id'))
                $create_contact->assoc_id = $request->input('assoc_id');
                
                $create_contact->created_at = Carbon::now(); 
                
                $create_contact->save();   

                $input_array =  array($request->all());

                if($type ==="main") {
                    $profile = MainProfile::orderBy('created_at','desc')->first();            

                }else{
                    
                    $profile = AssociationProfile::orderBy('created_at','desc')->where('id','=',$request->input('assoc_id'))->first();
                    $assoc_name = Association::where('id','=',$request->input('assoc_id'))->value('type');
                    

                }
                // dd($profile);
            if($profile->send_to_email_2)
                $send_array = [$profile->send_to_email,$profile->send_to_email_2];
            else
                $send_array = [$profile->send_to_email];

                $this->contactUs($input_array,$type,$send_array,$full_name,$assoc_name); 


            
            $final['status'] ="success";
            $final['type'] =$type;
            $final['full_name'] =$full_name;

            

            // }

     return json_encode($final);
        
        
       
    }
    //---------------------------------------JOIN TFI FORMS FUNCTION END -------------------------------------//
    // public function JoinTFI(){

    //     return view('pages.main.create_tfi');
    // }

    public function contact()
    {
        return view('pages.main.contact');
    }
    public function contactUpload(Request $request)
    {
        // dd($request->input('contactName'));
        return view('pages.main.contact')->with('success','We have recieved your message and will contact you soon');
    }
    public function association($associationType)
    {
        $title = ucwords(str_replace('_', ' ', $associationType));

        $type = substr($title, 0, -1);
        $member_type_id = AssociationType::where('name','=',$associationType)->value('id');
        $associations = Association::orderBy('name')->where('assoc_type_id','=',$member_type_id)->get();
        // dd($associations);
        return view('pages.main.about.members.association')->with(['title'=>$title,'type'=>$associationType,'associations'=>$associations]);
    }

    public function associationDetails($associationType,$associationName)
    {
        $associations = Association::where('name','=',$associationName)->first();
        // dd($associations);
        $title = ucwords(str_replace('_', ' ', $associationType));
        return view('pages.main.about.members.detail')->with(
            [
                'title'=>$title,
                'type'=>$associationType,
                'name'=>$associationName,
                'association'=>$associations,
            ]
        );
    }


    public function athlete_ranking()
    {
        return view('pages.main.tfitent.ranking')->with('athlete',MemberProfile::orderBy('created_at','desc')->where('type','=','athlete')->get());
    }
    public function memberprofile($type)
    {
        return view('pages.main.tfitent.memberprofile')->with(
            [
            'member'=>MemberProfile::orderBy('created_at','desc')->where('type','=',$type)->get(),
            'title'=>ucwords($type)
            ]
           );
    }

    public function results()
    {
       $results=  Results::orderBy('created_at','desc')->get();
        foreach($results as $value){
            $value['event_name'] = Events::where('id','=',$value['event_id'])->value('title');
        }
        return view('pages.main.events.results')->with('results',$results);

    }

    public function event_main($event_type,$event_name)
    {

        return view('events.index')->with([
            'event_type'=>$event_type,
            'event_name'=>$event_name,
            'event'=>Events::where('title','=',$event_name)->first(),
            'event_profile'=>EventProfile::where('event_name','=',$event_name)->first(),
            'slider'=>EventSlider::orderBy('position','asc')->where('event_name','=',$event_name)->get(),
            'news'=>NewsEvents::orderBy('date','asc')->where('event_name','=',$event_name)->get(),
            'pdf'=>ImportantPDFEvents::where('event_name','=',$event_name)->get(),
            'default'=>DefaultEvents::where('event_name','=',$event_name)->first(),
            'image'=>Album::orderBy('timestamp','asc')->where('event_name','=',$event_name)->get(),
            'video'=>EventsVideoAlbum::orderBy('timestamp','asc')->where('event_name','=',$event_name)->get()
        ]);
    }
    public function event_albums($event_type,$event_name)
    {
        return view('events.image')->with([
            'event_type'=>$event_type,
            'event_name'=>$event_name,
            'event'=>Events::where('title','=',$event_name)->first(),
            'event_profile'=>EventProfile::where('event_name','=',$event_name)->first(),
            'slider'=>EventSlider::orderBy('position','asc')->where('event_name','=',$event_name)->get(),
            'news'=>NewsEvents::orderBy('date','asc')->where('event_name','=',$event_name)->get(),
            'pdf'=>ImportantPDFEvents::where('event_name','=',$event_name)->get(),
            'default'=>DefaultEvents::where('event_name','=',$event_name)->first(),
            'image'=>Album::orderBy('timestamp','asc')->where('event_name','=',$event_name)->get(),
            'video'=>EventsVideoAlbum::orderBy('timestamp','asc')->where('event_name','=',$event_name)->get(),
        ]);
    }
    public function event_image_gallery($event_type,$event_name,$album_name)
    {
        return view('events.gallery')->with([
            'event_type'=>$event_type,
            'event_name'=>$event_name,
            'event'=>Events::where('title','=',$event_name)->first(),
            'event_profile'=>EventProfile::where('event_name','=',$event_name)->first(),
            'slider'=>EventSlider::orderBy('position','asc')->where('event_name','=',$event_name)->get(),
            'news'=>NewsEvents::orderBy('date','asc')->where('event_name','=',$event_name)->get(),
            'pdf'=>ImportantPDFEvents::where('event_name','=',$event_name)->get(),
            'default'=>DefaultEvents::where('event_name','=',$event_name)->first(),
            'image'=>Album::orderBy('timestamp','asc')->where('event_name','=',$event_name)->get(),
            'gallery'=>EventImageGallery::orderBy('created_at','asc')->where('album_name','=',$album_name)->where('event_name','=',$event_name)->get(),
            'video'=>EventsVideoAlbum::orderBy('timestamp','asc')->where('event_name','=',$event_name)->get(),
        ]);
    }
    public function event_video_albums($event_type,$event_name)
    {
        return view('events.video')->with([
            'event_type'=>$event_type,
            'event_name'=>$event_name,
            'event'=>Events::where('title','=',$event_name)->first(),
            'event_profile'=>EventProfile::where('event_name','=',$event_name)->first(),
            'slider'=>EventSlider::orderBy('position','asc')->where('event_name','=',$event_name)->get(),
            'news'=>NewsEvents::orderBy('date','asc')->where('event_name','=',$event_name)->get(),
            'pdf'=>ImportantPDFEvents::where('event_name','=',$event_name)->get(),
            'default'=>DefaultEvents::where('event_name','=',$event_name)->first(),
            'image'=>Album::orderBy('timestamp','asc')->where('event_name','=',$event_name)->get(),
            'video'=>EventsVideoAlbum::orderBy('timestamp','asc')->where('event_name','=',$event_name)->get(),
        ]);
    }
    public function event_video_gallery($event_type,$event_name,$album_name)
    {
        return view('events.video_gallery')->with([
            'event_type'=>$event_type,
            'event_name'=>$event_name,
            'album_name'=>$album_name,
            'event'=>Events::where('title','=',$event_name)->first(),
            'event_profile'=>EventProfile::where('event_name','=',$event_name)->first(),
            'slider'=>EventSlider::orderBy('position','asc')->where('event_name','=',$event_name)->get(),
            'news'=>NewsEvents::orderBy('date','asc')->where('event_name','=',$event_name)->get(),
            'pdf'=>ImportantPDFEvents::where('event_name','=',$event_name)->get(),
            'default'=>DefaultEvents::where('event_name','=',$event_name)->first(),
            'image'=>Album::orderBy('timestamp','asc')->where('event_name','=',$event_name)->get(),
            'gallery'=>EventsVideo::orderBy('created_at','asc')->where('album_name','=',$album_name)->where('event_name','=',$event_name)->get(),
            'video'=>EventsVideoAlbum::orderBy('timestamp','asc')->where('event_name','=',$event_name)->get(),
        ]);
    }

    public function event_news($event_type,$event_name)
    {
        return view('events.news')->with([
            'event_type'=>$event_type,
            'event_name'=>$event_name,
            'event'=>Events::where('title','=',$event_name)->first(),
            'event_profile'=>EventProfile::where('event_name','=',$event_name)->first(),
            'slider'=>EventSlider::orderBy('position','asc')->where('event_name','=',$event_name)->get(),
            'news'=>NewsEvents::orderBy('date','asc')->where('event_name','=',$event_name)->get(),
            'pdf'=>ImportantPDFEvents::where('event_name','=',$event_name)->get(),
            'default'=>DefaultEvents::where('event_name','=',$event_name)->first(),
            'image'=>Album::orderBy('timestamp','asc')->where('event_name','=',$event_name)->get(),
            'video'=>EventsVideoAlbum::orderBy('timestamp','asc')->where('event_name','=',$event_name)->get(),
        ]);
    }
    public function event_results($event_type,$event_name)
    {
        return view('events.results')->with([
            'event_type'=>$event_type,
            'event_name'=>$event_name,
            'event'=>Events::where('title','=',$event_name)->first(),
            'event_profile'=>EventProfile::where('event_name','=',$event_name)->first(),
            'slider'=>EventSlider::orderBy('position','asc')->where('event_name','=',$event_name)->get(),
            'news'=>NewsEvents::orderBy('date','asc')->where('event_name','=',$event_name)->get(),
            'pdf'=>ImportantPDFEvents::where('event_name','=',$event_name)->get(),
            'default'=>DefaultEvents::where('event_name','=',$event_name)->first(),
            'image'=>Album::orderBy('timestamp','asc')->where('event_name','=',$event_name)->get(),
            'video'=>EventsVideoAlbum::orderBy('timestamp','asc')->where('event_name','=',$event_name)->get(),
            'results'=>EventResults::orderBy('date','asc')->where('event_name','=',$event_name)->get(),
        ]);
    }




    public function state_main($state_name)
    {
        return view('state.index')->with([
            'committee'=>AssociationCommittee::where('state_name','=',$state_name)->get(),
            'state_name'=>$state_name,
            'slider'=>AssociationSlider::orderBy('position','asc')->where('state_name','=',$state_name)->get(),
            'state_profile'=>AssociationProfile::where('state_name','=',$state_name)->first(),
            'news'=>AssociationNews::where('state_name','=',$state_name)->get(),
            'default'=>DefaultAssociation::where('state_name','=',$state_name)->first(),
            'image'=>AssociationAlbum::orderBy('timestamp','asc')->where('state_name','=',$state_name)->get(),
            'video'=>AssociationVideoAlbum::orderBy('timestamp','asc')->where('state_name','=',$state_name)->get(),

        ]);
    }
    public function state_president_message($state_name)
    {
        return view('state.president_message')->with([
            'committee'=>AssociationCommittee::where('state_name','=',$state_name)->get(),
            'state_name'=>$state_name,
            'title'=>' President Message',
            'slider'=>AssociationSlider::orderBy('position','asc')->where('state_name','=',$state_name)->get(),
            'state_profile'=>AssociationProfile::where('state_name','=',$state_name)->first(),
            'news'=>AssociationNews::where('state_name','=',$state_name)->get(),
            'default'=>DefaultAssociation::where('state_name','=',$state_name)->first(),
            'image'=>AssociationAlbum::orderBy('timestamp','asc')->where('state_name','=',$state_name)->get(),
            'video'=>AssociationVideoAlbum::orderBy('timestamp','asc')->where('state_name','=',$state_name)->get(),
            'context'=>AssociationPresidentMessage::where('state_name','=',$state_name)->first(),

        ]);
    }
    public function state_secretary_message($state_name)
    {
        return view('state.president_message')->with([
            'committee'=>AssociationCommittee::where('state_name','=',$state_name)->get(),
            'state_name'=>$state_name,
            'title'=>' Secretary Message',
            'slider'=>AssociationSlider::orderBy('position','asc')->where('state_name','=',$state_name)->get(),
            'state_profile'=>AssociationProfile::where('state_name','=',$state_name)->first(),
            'news'=>AssociationNews::where('state_name','=',$state_name)->get(),
            'default'=>DefaultAssociation::where('state_name','=',$state_name)->first(),
            'image'=>AssociationAlbum::orderBy('timestamp','asc')->where('state_name','=',$state_name)->get(),
            'video'=>AssociationVideoAlbum::orderBy('timestamp','asc')->where('state_name','=',$state_name)->get(),
            'context'=>AssociationSecretaryMessage::where('state_name','=',$state_name)->first(),

        ]);
    }
    public function state_governacne($state_name)
    {
        return view('state.governance')->with([
            'committee'=>AssociationCommittee::where('state_name','=',$state_name)->get(),
            'state_name'=>$state_name,
            'title'=>'Governance',
            'slider'=>AssociationSlider::orderBy('position','asc')->where('state_name','=',$state_name)->get(),
            'state_profile'=>AssociationProfile::where('state_name','=',$state_name)->first(),
            'news'=>AssociationNews::where('state_name','=',$state_name)->get(),
            'default'=>DefaultAssociation::where('state_name','=',$state_name)->first(),
            'image'=>AssociationAlbum::orderBy('timestamp','asc')->where('state_name','=',$state_name)->get(),
            'video'=>AssociationVideoAlbum::orderBy('timestamp','asc')->where('state_name','=',$state_name)->get(),
            'context'=>AssociationSecretaryMessage::where('state_name','=',$state_name)->first(),
            'member'=>AssociationGovernance::where('state_name','=',$state_name)->get(),

        ]);
    }
    public function state_patrons($state_name)
    {
        return view('state.governance')->with([
            'committee'=>AssociationCommittee::where('state_name','=',$state_name)->get(),
            'state_name'=>$state_name,
            'title'=>'Patrons and Adviser',
            'slider'=>AssociationSlider::orderBy('position','asc')->where('state_name','=',$state_name)->get(),
            'state_profile'=>AssociationProfile::where('state_name','=',$state_name)->first(),
            'news'=>AssociationNews::where('state_name','=',$state_name)->get(),
            'default'=>DefaultAssociation::where('state_name','=',$state_name)->first(),
            'image'=>AssociationAlbum::orderBy('timestamp','asc')->where('state_name','=',$state_name)->get(),
            'video'=>AssociationVideoAlbum::orderBy('timestamp','asc')->where('state_name','=',$state_name)->get(),
            'context'=>AssociationSecretaryMessage::where('state_name','=',$state_name)->first(),
            'member'=>AssociationPatrons::where('state_name','=',$state_name)->get(),

        ]);
    }
    public function state_committee($state_name,$committee_name)
    {
        return view('state.governance')->with([
            'committee'=>AssociationCommittee::where('state_name','=',$state_name)->get(),
            'member'=>AssociationCommitteeMember::where('state_name','=',$state_name)->where('committee','=',$committee_name)->get(),
            'state_name'=>$state_name,
            'title'=>$committee_name,
            'slider'=>AssociationSlider::orderBy('position','asc')->where('state_name','=',$state_name)->get(),
            'state_profile'=>AssociationProfile::where('state_name','=',$state_name)->first(),
            'news'=>AssociationNews::where('state_name','=',$state_name)->get(),
            'default'=>DefaultAssociation::where('state_name','=',$state_name)->first(),
            'image'=>AssociationAlbum::orderBy('timestamp','asc')->where('state_name','=',$state_name)->get(),
            'video'=>AssociationVideoAlbum::orderBy('timestamp','asc')->where('state_name','=',$state_name)->get(),
            'context'=>AssociationSecretaryMessage::where('state_name','=',$state_name)->first(),
            'member'=>AssociationPatrons::where('state_name','=',$state_name)->get(),

        ]);
    }
    public function state_documents($state_name)
    {
        return view('state.documents')->with([
            'committee'=>AssociationCommittee::where('state_name','=',$state_name)->get(),
            'audit'=>AssociationDocuments::where('state_name','=',$state_name)->where('type','=','AUDIT & ACCOUNTING')->get(),
            'forms'=>AssociationDocuments::where('state_name','=',$state_name)->where('type','=','FORMS & CIRCULARS')->get(),
            'documents'=>AssociationDocuments::where('state_name','=',$state_name)->where('type','=','DOCUMENTS')->get(),
            'state_name'=>$state_name,
            'title'=>'Documents and Downloads',
            'slider'=>AssociationSlider::orderBy('position','asc')->where('state_name','=',$state_name)->get(),
            'state_profile'=>AssociationProfile::where('state_name','=',$state_name)->first(),
            'news'=>AssociationNews::where('state_name','=',$state_name)->get(),
            'default'=>DefaultAssociation::where('state_name','=',$state_name)->first(),
            'image'=>AssociationAlbum::orderBy('timestamp','asc')->where('state_name','=',$state_name)->get(),
            'video'=>AssociationVideoAlbum::orderBy('timestamp','asc')->where('state_name','=',$state_name)->get(),
            'context'=>AssociationSecretaryMessage::where('state_name','=',$state_name)->first(),
            'member'=>AssociationPatrons::where('state_name','=',$state_name)->get(),
        ]);
    }
    public function state_contact($state_name)
    {
        return view('state.contact')->with([
            'committee'=>AssociationCommittee::where('state_name','=',$state_name)->get(),
            'audit'=>AssociationDocuments::where('state_name','=',$state_name)->where('type','=','AUDIT & ACCOUNTING')->get(),
            'forms'=>AssociationDocuments::where('state_name','=',$state_name)->where('type','=','FORMS & CIRCULARS')->get(),
            'documents'=>AssociationDocuments::where('state_name','=',$state_name)->where('type','=','DOCUMENTS')->get(),
            'state_name'=>$state_name,
            'title'=>'Documents and Downloads',
            'slider'=>AssociationSlider::orderBy('position','asc')->where('state_name','=',$state_name)->get(),
            'state_profile'=>AssociationProfile::where('state_name','=',$state_name)->first(),
            'news'=>AssociationNews::where('state_name','=',$state_name)->get(),
            'default'=>DefaultAssociation::where('state_name','=',$state_name)->first(),
            'image'=>AssociationAlbum::orderBy('timestamp','asc')->where('state_name','=',$state_name)->get(),
            'video'=>AssociationVideoAlbum::orderBy('timestamp','asc')->where('state_name','=',$state_name)->get(),
            'context'=>AssociationSecretaryMessage::where('state_name','=',$state_name)->first(),
            'member'=>AssociationPatrons::where('state_name','=',$state_name)->get(),
        ]);
    }
    public function state_news($state_name)
    {
        return view('state.news')->with([
            'committee'=>AssociationCommittee::where('state_name','=',$state_name)->get(),
            'audit'=>AssociationDocuments::where('state_name','=',$state_name)->where('type','=','AUDIT & ACCOUNTING')->get(),
            'forms'=>AssociationDocuments::where('state_name','=',$state_name)->where('type','=','FORMS & CIRCULARS')->get(),
            'documents'=>AssociationDocuments::where('state_name','=',$state_name)->where('type','=','DOCUMENTS')->get(),
            'state_name'=>$state_name,
            'title'=>'Documents and Downloads',
            'slider'=>AssociationSlider::orderBy('position','asc')->where('state_name','=',$state_name)->get(),
            'state_profile'=>AssociationProfile::where('state_name','=',$state_name)->first(),
            'news'=>AssociationNews::where('state_name','=',$state_name)->get(),
            'default'=>DefaultAssociation::where('state_name','=',$state_name)->first(),
            'image'=>AssociationAlbum::orderBy('timestamp','asc')->where('state_name','=',$state_name)->get(),
            'video'=>AssociationVideoAlbum::orderBy('timestamp','asc')->where('state_name','=',$state_name)->get(),
            'context'=>AssociationSecretaryMessage::where('state_name','=',$state_name)->first(),
            'member'=>AssociationPatrons::where('state_name','=',$state_name)->get(),
        ]);
    }
    public function state_image_album($state_name)
    {
        return view('state.image_album')->with([
            'committee'=>AssociationCommittee::where('state_name','=',$state_name)->get(),
            'state_name'=>$state_name,
            'title'=>'Image Albums',
            'slider'=>AssociationSlider::orderBy('position','asc')->where('state_name','=',$state_name)->get(),
            'state_profile'=>AssociationProfile::where('state_name','=',$state_name)->first(),
            'news'=>AssociationNews::where('state_name','=',$state_name)->get(),
            'default'=>DefaultAssociation::where('state_name','=',$state_name)->first(),
            'image'=>AssociationAlbum::orderBy('timestamp','asc')->where('state_name','=',$state_name)->get(),
            'video'=>AssociationVideoAlbum::orderBy('timestamp','asc')->where('state_name','=',$state_name)->get(),
            'context'=>AssociationSecretaryMessage::where('state_name','=',$state_name)->first(),
            'member'=>AssociationPatrons::where('state_name','=',$state_name)->get(),
        ]);
    }
    public function state_image_gallery($state_name,$album_name)
    {
        return view('state.image_gallery')->with([
            'committee'=>AssociationCommittee::where('state_name','=',$state_name)->get(),
            'state_name'=>$state_name,
            'gallery'=>AssociationImageGallery::where('album_name','=',$album_name)->where('state_name','=',$state_name)->get(),
            'title'=>$album_name,
            'slider'=>AssociationSlider::orderBy('position','asc')->where('state_name','=',$state_name)->get(),
            'state_profile'=>AssociationProfile::where('state_name','=',$state_name)->first(),
            'news'=>AssociationNews::where('state_name','=',$state_name)->get(),
            'default'=>DefaultAssociation::where('state_name','=',$state_name)->first(),
            'image'=>AssociationAlbum::orderBy('timestamp','asc')->where('state_name','=',$state_name)->get(),
            'video'=>AssociationVideoAlbum::orderBy('timestamp','asc')->where('state_name','=',$state_name)->get(),
            'context'=>AssociationSecretaryMessage::where('state_name','=',$state_name)->first(),
            'member'=>AssociationPatrons::where('state_name','=',$state_name)->get(),
        ]);
    }

    public function state_video_album($state_name)
    {
        return view('state.video_album')->with([
            'committee'=>AssociationCommittee::where('state_name','=',$state_name)->get(),
            'state_name'=>$state_name,
            'title'=>'Image Albums',
            'slider'=>AssociationSlider::orderBy('position','asc')->where('state_name','=',$state_name)->get(),
            'state_profile'=>AssociationProfile::where('state_name','=',$state_name)->first(),
            'news'=>AssociationNews::where('state_name','=',$state_name)->get(),
            'default'=>DefaultAssociation::where('state_name','=',$state_name)->first(),
            'image'=>AssociationAlbum::orderBy('timestamp','asc')->where('state_name','=',$state_name)->get(),
            'video'=>AssociationVideoAlbum::orderBy('timestamp','asc')->where('state_name','=',$state_name)->get(),
            'context'=>AssociationSecretaryMessage::where('state_name','=',$state_name)->first(),
            'member'=>AssociationPatrons::where('state_name','=',$state_name)->get(),
        ]);
    }

    public function state_video_gallery($state_name,$album_name)
    {
        return view('state.video_gallery')->with([
            'committee'=>AssociationCommittee::where('state_name','=',$state_name)->get(),
            'state_name'=>$state_name,
            'gallery'=>AssociationVideo::where('album_name','=',$album_name)->where('state_name','=',$state_name)->get(),
            'title'=>$album_name,
            'slider'=>AssociationSlider::orderBy('position','asc')->where('state_name','=',$state_name)->get(),
            'state_profile'=>AssociationProfile::where('state_name','=',$state_name)->first(),
            'news'=>AssociationNews::where('state_name','=',$state_name)->get(),
            'default'=>DefaultAssociation::where('state_name','=',$state_name)->first(),
            'image'=>AssociationAlbum::orderBy('timestamp','asc')->where('state_name','=',$state_name)->get(),
            'video'=>AssociationVideoAlbum::orderBy('timestamp','asc')->where('state_name','=',$state_name)->get(),
            'context'=>AssociationSecretaryMessage::where('state_name','=',$state_name)->first(),
            'member'=>AssociationPatrons::where('state_name','=',$state_name)->get(),
        ]);
    }
    public function state_district($state_name)
    {
        return view('state.district')->with([
            'committee'=>AssociationCommittee::where('state_name','=',$state_name)->get(),
            'association'=>Association::where('type','=','district_association')->where('state_name','=',$state_name)->get(),
            'audit'=>AssociationDocuments::where('state_name','=',$state_name)->where('type','=','AUDIT & ACCOUNTING')->get(),
            'forms'=>AssociationDocuments::where('state_name','=',$state_name)->where('type','=','FORMS & CIRCULARS')->get(),
            'documents'=>AssociationDocuments::where('state_name','=',$state_name)->where('type','=','DOCUMENTS')->get(),
            'state_name'=>$state_name,
            'title'=>'Documents and Downloads',
            'slider'=>AssociationSlider::orderBy('position','asc')->where('state_name','=',$state_name)->get(),
            'state_profile'=>AssociationProfile::where('state_name','=',$state_name)->first(),
            'news'=>AssociationNews::where('state_name','=',$state_name)->get(),
            'default'=>DefaultAssociation::where('state_name','=',$state_name)->first(),
            'image'=>AssociationAlbum::orderBy('timestamp','asc')->where('state_name','=',$state_name)->get(),
            'video'=>AssociationVideoAlbum::orderBy('timestamp','asc')->where('state_name','=',$state_name)->get(),
            'context'=>AssociationSecretaryMessage::where('state_name','=',$state_name)->first(),
            'member'=>AssociationPatrons::where('state_name','=',$state_name)->get(),
        ]);
    }
    public function state_other($state_name)
    {
        return view('state.other')->with([
            'committee'=>AssociationCommittee::where('state_name','=',$state_name)->get(),
            'association'=>Association::where('type','=','other_association')->where('state_name','=',$state_name)->get(),
            'audit'=>AssociationDocuments::where('state_name','=',$state_name)->where('type','=','AUDIT & ACCOUNTING')->get(),
            'forms'=>AssociationDocuments::where('state_name','=',$state_name)->where('type','=','FORMS & CIRCULARS')->get(),
            'documents'=>AssociationDocuments::where('state_name','=',$state_name)->where('type','=','DOCUMENTS')->get(),
            'state_name'=>$state_name,
            'title'=>'Documents and Downloads',
            'slider'=>AssociationSlider::orderBy('position','asc')->where('state_name','=',$state_name)->get(),
            'state_profile'=>AssociationProfile::where('state_name','=',$state_name)->first(),
            'news'=>AssociationNews::where('state_name','=',$state_name)->get(),
            'default'=>DefaultAssociation::where('state_name','=',$state_name)->first(),
            'image'=>AssociationAlbum::orderBy('timestamp','asc')->where('state_name','=',$state_name)->get(),
            'video'=>AssociationVideoAlbum::orderBy('timestamp','asc')->where('state_name','=',$state_name)->get(),
            'context'=>AssociationSecretaryMessage::where('state_name','=',$state_name)->first(),
            'member'=>AssociationPatrons::where('state_name','=',$state_name)->get(),
        ]);
    }
    public function state_events($state_name)
    {
        return view('state.event')->with([
            'committee'=>AssociationCommittee::where('state_name','=',$state_name)->get(),
            'association'=>Association::where('type','=','other_association')->where('state_name','=',$state_name)->get(),
            'audit'=>AssociationDocuments::where('state_name','=',$state_name)->where('type','=','AUDIT & ACCOUNTING')->get(),
            'forms'=>AssociationDocuments::where('state_name','=',$state_name)->where('type','=','FORMS & CIRCULARS')->get(),
            'documents'=>AssociationDocuments::where('state_name','=',$state_name)->where('type','=','DOCUMENTS')->get(),
            'event'=>AssociationEvent::where('eventType','=','state_event')->get(),
            'state_name'=>$state_name,
            'title'=>'Documents and Downloads',
            'slider'=>AssociationSlider::orderBy('position','asc')->where('state_name','=',$state_name)->get(),
            'state_profile'=>AssociationProfile::where('state_name','=',$state_name)->first(),
            'news'=>AssociationNews::where('state_name','=',$state_name)->get(),
            'default'=>DefaultAssociation::where('state_name','=',$state_name)->first(),
            'image'=>AssociationAlbum::orderBy('timestamp','asc')->where('state_name','=',$state_name)->get(),
            'video'=>AssociationVideoAlbum::orderBy('timestamp','asc')->where('state_name','=',$state_name)->get(),
            'context'=>AssociationSecretaryMessage::where('state_name','=',$state_name)->first(),
            'member'=>AssociationPatrons::where('state_name','=',$state_name)->get(),
        ]);
    }


}

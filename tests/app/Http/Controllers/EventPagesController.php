<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Events;
use App\Models\EventAlbum;
use App\Models\EventSlider;
use App\Models\EventsVideo;
use App\Models\EventProfile;
use App\Models\EventResults;
use App\Models\News;
use App\Models\Slider;
use App\Models\Results;
use App\Models\NewsEvents;
use Illuminate\Http\Request;
use App\Models\DefaultEvents;
use App\Models\ImportantPDFEvents;
use App\Models\Album;
use App\Models\ImageGallery;
use App\Models\VideoAlbum;
use App\Models\VideoGallery;
use App\Models\AssociationVideoAlbum;
use App\Models\AssociationVideo;
use App\Models\AssociationAlbum;
use App\Models\AssociationImageGallery;

// use App\Models\Awards;
// use App\Models\Patrons;
// use App\Models\Documents;
// use App\Models\Education;
// use App\Models\StateNews;
// use App\Models\AntiDoping;
// use App\Models\Department;
// use App\Models\Governance;
// use App\Models\HallOfFame;
// use App\Models\Management;
// use App\Models\Taekwondo;
// use App\Models\StateAlbum;
// use App\Models\StateVideo;
// use App\Models\Association;
// use App\Models\Secretariat;
// use App\Models\StateSlider;
// use App\Models\DefaultState;
// use App\Models\StatePatrons;
// use App\Models\StateProfile;
// use App\Models\VideoGallery;
// use App\Models\MemberProfile;
// use App\Models\StateCommittee;
// use App\Models\StateEvent;
// use App\Models\StateDocuments;
// use App\Models\CommitteeMember;
// use App\Models\StateGovernance;
// use App\Models\StateVideoAlbum;
// use App\Models\PresidentMessage;
// use App\Models\StateImageGallery;
// use App\Models\RulesAndRegulations;
// use App\Models\StateCommitteeMember;
// use App\Models\StatePresidentMessage;
// use App\Models\StateSecretaryMessage;

use App\Http\Traits\SocialMediaTrait;

class EventPagesController extends Controller
{
    use SocialMediaTrait; // use SocialMediaTrait trait to get the header repeated data

    public function event_main($id,$event_name)
    {
       
        $event = Events::where('id','=',$id)->first();
     //   $event_type = DB::table('event_type')->where('id','=',$event->eventType_id)->pluck('event_type')[0];
     if($event->assoc_id != null){
        $album=AssociationAlbum::orderBy('created_at','asc')->where('parent_id',0)->where('event_id','=',$id)->get();
        $video_album = AssociationVideoAlbum::orderBy('timestamp','asc')->where('event_id','=',$id)->get();
        

    }else{
        $album=Album::orderBy('created_at','asc')->where('parent_id',0)->where('event_id','=',$id)->get();
        $video_album = VideoAlbum::orderBy('timestamp','asc')->where('event_id','=',$id)->get();
    }
        return view('pages.events.index')->with([
            'page_name'=>'home',
             'event_name'=>$event_name,
            'event'=>$event,
            'event_profile'=>EventProfile::where('event_id','=',$id)->first(),
            'slider'=>EventSlider::orderBy('position','asc')->where('event_id','=',$id)->get(),
            'news'=>NewsEvents::orderBy('date','asc')->where('event_id','=',$id)->get(),
            'pdf'=>ImportantPDFEvents::where('event_id','=',$id)->get(),
            'default'=>DefaultEvents::where('event_id','=',$id)->first(),
            'album'=>$album,
            'video'=>$video_album,
            'result'=>EventResults::orderBy('created_at','desc')->where('event_id','=',$id)->take(3)->get()
        ]);
    }
    public function event_albums($event_id,$event_name)
    {
        $event = Events::where('id','=',$event_id)->first();
        if($event->assoc_id != null){
            $album=AssociationAlbum::orderBy('timestamp','asc')->where('parent_id',0)->where('event_id','=',$event_id)->get();
        }else{
            $album=Album::orderBy('timestamp','asc')->where('parent_id',0)->where('event_id','=',$event_id)->get();
  
        }
      //  $event_type = DB::table('event_type')->where('id','=',$event->eventType_id)->pluck('event_type')[0];
        return view('pages.events.photo_albums')->with([
        //    'event_type'=>$event_type,
            'page_name'=>'media',
            'event_name'=>$event_name,
            'event'=>$event,
            'event_id'=>$event_id,
            'event_profile'=>EventProfile::where('event_id','=',$event_id)->first(),
          //  'slider'=>EventSlider::orderBy('position','asc')->where('event_name','=',$event_name)->get(),
         //   'news'=>NewsEvents::orderBy('date','asc')->where('event_name','=',$event_name)->get(),
          //  'pdf'=>ImportantPDFEvents::where('event_name','=',$event_name)->get(),
            'default'=>DefaultEvents::where('event_id','=',$event_id)->first(),
            'album'=>$album,
           // 'video'=>EventsVideoAlbum::orderBy('timestamp','asc')->where('event_name','=',$event_name)->get(),
        ]);
    }
    public function event_image_gallery(Request $request,$event_id,$event_name,$album_id,$album_name)
    {
        $event = Events::where('id','=',$event_id)->first();       
    //    $event_type = DB::table('event_type')->where('id','=',$event->eventType_id)->pluck('event_type')[0];
        $parent_album_id = $album_id;
        $is_folder = 0;
        if($event->assoc_id != null){
            $nested = AssociationAlbum::where('id',$album_id)->value('nested');
        }else{
            $nested = Album::where('id',$album_id)->value('nested');
        }
        $folder_id = $request->input('folder_id');
        $sub_folder_count = 0;                                       // this is written for future purpose
        if(isset($folder_id)){
            $album_id = $folder_id;
            $is_folder = 1;
            if($event->assoc_id != null){
                $child_folders = AssociationAlbum::orderBy('created_at','desc')->where('parent_id','=',$folder_id)->get();
            }else{
                $child_folders = Album::orderBy('created_at','desc')->where('parent_id','=',$folder_id)->get();
            }
            if(sizeof($child_folders)>0){
                $album_id = $folder_id;
                $nested = 1;
            }else{
                $nested = 0;
            }
        }

        if($nested){
           
            if($event->assoc_id != null){
                $folders=AssociationAlbum::orderBy('created_at','desc')->where('parent_id','=',$album_id)->get();
                $album=AssociationAlbum::orderBy('timestamp','asc')->where('parent_id',0)->where('event_id','=',$event_id)->get();
                foreach($folders as $folder){
                    $get_path= DB::table('assoc_image_galleries')->where('album_id','=',$folder['id'])->latest()->first();
                   
                    $folder['first_image_path'] =$get_path->image_path;
                    // array_push($first_image,$get_path->image_path);
                }
            }else{
                $folders=Album::orderBy('created_at','desc')->where('parent_id','=',$album_id)->get();
                $album=Album::orderBy('timestamp','asc')->where('parent_id',0)->where('event_id','=',$event_id)->get();
                foreach($folders as $folder){
                    $get_path= DB::table('image_galleries')->where('album_id','=',$folder['id'])->latest()->first();
                   
                    $folder['first_image_path'] =$get_path->image_path;
                    // array_push($first_image,$get_path->image_path);
                }
            }
            
            return view('pages.events.photo_gallery')->with([
          //      'event_type'=>$event_type,
                'page_name'=>'media',
                'event_name'=>$event->title,
                'event'=>$event,
                'event_profile'=>EventProfile::where('event_id','=',$event_id)->first(),
                'default'=>DefaultEvents::where('event_id','=',$event_id)->first(),
                'album'=>$album,
                'nested'=>$nested,
                'folders'=>$folders,
                'event_id'=>$event_id,
                'parent_album_id'=>$parent_album_id,
                'album_name'=>$album_name,
                'is_folder'=>$is_folder
            ]);
        }else{
            if($event->assoc_id != null){
               $image_gallery = AssociationImageGallery::orderBy('created_at','asc')->where('album_id','=',$album_id)->get();
            }else{
                $image_gallery = ImageGallery::orderBy('created_at','asc')->where('album_id','=',$album_id)->get();
            }
            return view('pages.events.photo_gallery')->with([
          //      'event_type'=>$event_type,
                'page_name'=>'media',
                'event_name'=>$event->title,
                'event'=>$event,
                'event_profile'=>EventProfile::where('event_id','=',$event_id)->first(),
                'default'=>DefaultEvents::where('event_id','=',$event_id)->first(),
                'gallery'=>$image_gallery,
                'nested'=>$nested,
                'event_id'=>$event_id,
                'parent_album_id'=>$parent_album_id,
                'album_name'=>$album_name,
                'is_folder'=>$is_folder
            ]);
        }







        // $event = Events::where('id','=',$event_id)->first();       
        // $event_type = DB::table('event_type')->where('id','=',$event->eventType_id)->pluck('event_type')[0];
        // return view('pages.events.gallery')->with([
        //     'event_type'=>$event_type,
        //     'event_name'=>$event->title,
        //     'event'=>$event,
        //     'event_profile'=>EventProfile::where('event_id','=',$event_id)->first(),
        //   //  'slider'=>EventSlider::orderBy('position','asc')->where('event_name','=',$event_name)->get(),
        //    // 'news'=>NewsEvents::orderBy('date','asc')->where('event_name','=',$event_name)->get(),
        //    // 'pdf'=>ImportantPDFEvents::where('event_name','=',$event_name)->get(),
        //     'default'=>DefaultEvents::where('event_id','=',$event_id)->first(),
        //     'album'=>EventAlbum::orderBy('timestamp','asc')->where('event_id','=',$event_id)->get(),
        //     'gallery'=>EventImageGallery::orderBy('created_at','asc')->where('album_id','=',$album_id)->where('event_id','=',$event_id)->get(),
        //    // 'video'=>EventsVideoAlbum::orderBy('timestamp','asc')->where('event_name','=',$event_name)->get(),
        // ]);
    }
    public function event_video_albums($event_id,$event_name)
    {
        $event = Events::where('id','=',$event_id)->first();
        if($event->assoc_id != null){
            $album = AssociationVideoAlbum::orderBy('created_at','asc')->where('event_id','=',$event_id)->get();
        }else{
            $album = VideoAlbum::orderBy('timestamp','asc')->where('event_id','=',$event_id)->get();   
        }
     //   $event_type = DB::table('event_type')->where('id','=',$event->eventType_id)->pluck('event_type')[0];
        return view('pages.events.video')->with([
       //     'event_type'=>$event_type,
       'page_name'=>'media',
            'event_name'=>$event_name,
            'event'=>$event,
            'event_profile'=>EventProfile::where('event_id','=',$event_id)->first(),
          //  'slider'=>EventSlider::orderBy('position','asc')->where('event_name','=',$event_name)->get(),
         //   'news'=>NewsEvents::orderBy('date','asc')->where('event_name','=',$event_name)->get(),
          //  'pdf'=>ImportantPDFEvents::where('event_name','=',$event_name)->get(),
            'default'=>DefaultEvents::where('event_id','=',$event_id)->first(),
         //   'image'=>Album::orderBy('timestamp','asc')->where('event_name','=',$event_name)->get(),
            'video_album'=>$album,
        ]);
    }
    public function event_video_gallery($event_id,$event_name,$album_id,$album_name)
    {
        $event = Events::where('id','=',$event_id)->first();
        if($event->assoc_id != null){
            $gallery = AssociationVideo::orderBy('created_at','asc')->where('album_id','=',$album_id)->get();
        }else{
            $gallery = VideoGallery::orderBy('created_at','asc')->where('album_id','=',$album_id)->get();   
        }
        return view('pages.events.video_gallery')->with([
             'event'=>$event,
             'page_name'=>'media',
            'event_name'=>$event_name,
            'album_name'=>$album_name,
             'event_profile'=>EventProfile::where('event_id','=',$event_id)->first(),
           // 'slider'=>EventSlider::orderBy('position','asc')->where('event_name','=',$event_name)->get(),
          //  'news'=>NewsEvents::orderBy('date','asc')->where('event_id','=',$event_id)->get(),
          //  'pdf'=>ImportantPDFEvents::where('event_id','=',$event_id)->get(),
            'default'=>DefaultEvents::where('event_id','=',$event_id)->first(),
         //   'image'=>Album::orderBy('timestamp','asc')->where('event_id','=',$event_id)->get(),
            'gallery'=>$gallery,
          //  'video'=>EventsVideoAlbum::orderBy('timestamp','asc')->where('event_id','=',$event_id)->get(),
        ]);
    }

    public function event_news($event_id,$event_name)
    {
        $event = Events::where('id','=',$event_id)->first();

        return view('pages.events.news')->with([
        //    'event_type'=>DB::table('event_type')->where('id','=',$event->eventType_id)->pluck('event_type')[0],
            'event_name'=>$event_name,
            'page_name'=>'news',
            'event'=>$event,
            'event_profile'=>EventProfile::where('event_id','=',$event_id)->first(),
           // 'slider'=>EventSlider::orderBy('position','asc')->where('event_name','=',$event_name)->get(),
            'news'=>NewsEvents::orderBy('date','asc')->where('event_id','=',$event_id)->get(),
           // 'pdf'=>ImportantPDFEvents::where('event_name','=',$event_name)->get(),
            'default'=>DefaultEvents::where('event_id','=',$event_id)->first(),
           // 'image'=>Album::orderBy('timestamp','asc')->where('event_name','=',$event_name)->get(),
            //'video'=>EventsVideoAlbum::orderBy('timestamp','asc')->where('event_name','=',$event_name)->get(),
        ]);
    }
    public function event_results($event_id,$event_name)
    {
        $event = Events::where('id','=',$event_id)->first();
     //   $event_type = DB::table('event_type')->where('id','=',$event->eventType_id)->pluck('event_type')[0];
        return view('pages.events.results')->with([
          //  'event_type'=>$event_type,
            'event_name'=>$event_name,
            'page_name'=>'results',
            'event'=>$event,
            'event_profile'=>EventProfile::where('event_id','=',$event_id)->first(),
            //'slider'=>EventSlider::orderBy('position','asc')->where('event_name','=',$event_name)->get(),
          //  'news'=>NewsEvents::orderBy('date','asc')->where('event_name','=',$event_name)->get(),
            'pdf'=>ImportantPDFEvents::where('event_id','=',$event_id)->get(),
            'default'=>DefaultEvents::where('event_id','=',$event_id)->first(),
          //  'image'=>Album::orderBy('timestamp','asc')->where('event_name','=',$event_name)->get(),
           // 'video'=>EventsVideoAlbum::orderBy('timestamp','asc')->where('event_name','=',$event_name)->get(),
            'results'=>EventResults::orderBy('date','asc')->where('event_id','=',$event_id)->get(),
        ]);
    }






}

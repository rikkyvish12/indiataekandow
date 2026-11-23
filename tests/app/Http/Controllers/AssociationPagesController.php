<?php
// use App\Models\Album;
// use App\Models\Awards;
// use App\Models\Events;
// use App\Models\Results;
// use App\Models\Education;
// use App\Models\AntiDoping;
// use App\Models\Department;
// use App\Models\HallOfFame;
// use App\Models\Management;
// use App\Models\NewsEvents;
// use App\Models\Taekwondo;
// use App\Models\VideoAlbum;
// use App\Models\EventSlider;
// use App\Models\EventsVideo;
// use App\Models\Secretariat;
// use App\Models\EventProfile;
// use App\Models\EventResults;
// use App\Models\ImageGallery;
// use App\Models\VideoGallery;
// use App\Models\DefaultEvents;
// use App\Models\MemberProfile;
// use App\Models\CommitteeMember;
// use App\Models\EventsVideoAlbum;
// use App\Models\PresidentMessage;
// use App\Models\EventImageGallery;
// use App\Models\ImportantPDFEvents;
// use App\Models\RulesAndRegulations;


namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Events;
use App\Models\States;
use App\Models\Slider;
use App\Models\Patrons;
use App\Models\Documents;
use App\Models\AssociationNews;
use App\Models\Governance;
use App\Models\AssociationAlbum;
use App\Models\AssociationVideo;
use App\Models\Association;
use App\Models\AssociationSlider;
use App\Models\DefaultAssociation;
use App\Models\AssociationPatrons;
use App\Models\AssociationProfile;
use Illuminate\Http\Request;
use App\Models\AssociationCommittee;
use App\Models\AssociationEvent;
use App\Models\AssociationDocuments;
use App\Models\AssociationGovernance;
use App\Models\AssociationVideoAlbum;
use App\Models\AssociationImageGallery;
use App\Models\AssociationCommitteeMember;
use App\Models\AssociationPresidentMessage;
use App\Models\AssociationSecretaryMessage;
use DB;
use App\Http\Traits\SocialMediaTrait;

class AssociationPagesController extends Controller
{
    use SocialMediaTrait; // use SocialMediaTrait trait to get the header repeated data


    public function assoc_main($assoc_id,$assoc_name)
    {
        $assoc_type_id = Association::where('id',$assoc_id)->pluck('assoc_type_id')[0];
        
        return view('pages.association.index')->with([
            'assoc_type_id'=>$assoc_type_id,
            'assoc_id'=>$assoc_id,
            'committee'=>AssociationCommittee::where('assoc_id','=',$assoc_id)->get(),
            'assoc_name'=>$assoc_name,
            'slider'=>AssociationSlider::orderBy('position','asc')->where('assoc_id','=',$assoc_id)->get(),
            'assoc_profile'=>AssociationProfile::where('assoc_id','=',$assoc_id)->first(),
            'news'=>AssociationNews::where('assoc_id','=',$assoc_id)->get(),
            'default'=>DefaultAssociation::where('assoc_id','=',$assoc_id)->first(),
            'image'=>AssociationAlbum::orderBy('timestamp','asc')->where('parent_id',0)->where('assoc_id','=',$assoc_id)->get(),
            'video'=>AssociationVideoAlbum::orderBy('timestamp','asc')->where('assoc_id','=',$assoc_id)->get(),
            'page_name'=>'home'

        ]);
    }
    public function assoc_president_message($assoc_id,$assoc_name)
    {
        $assoc_type_id = Association::where('id',$assoc_id)->pluck('assoc_type_id')[0];
        return view('pages.association.president_message')->with([
            'assoc_type_id'=>$assoc_type_id,
            'assoc_id'=>$assoc_id,
            'committee'=>AssociationCommittee::where('assoc_id','=',$assoc_id)->get(),
            'assoc_name'=>$assoc_name,
            'title'=>' President Message',
            'slider'=>AssociationSlider::orderBy('position','asc')->where('assoc_id','=',$assoc_id)->get(),
            'assoc_profile'=>AssociationProfile::where('assoc_id','=',$assoc_id)->first(),
            'news'=>AssociationNews::where('assoc_id','=',$assoc_id)->get(),
            'default'=>DefaultAssociation::where('assoc_id','=',$assoc_id)->first(),
            'image'=>AssociationAlbum::orderBy('timestamp','asc')->where('assoc_id','=',$assoc_id)->get(),
            'video'=>AssociationVideoAlbum::orderBy('timestamp','asc')->where('assoc_id','=',$assoc_id)->get(),
            'context'=>AssociationPresidentMessage::where('assoc_id','=',$assoc_id)->first(),
            'page_name'=>'about'
        ]);
    }
    public function assoc_secretary_message($assoc_id,$assoc_name)
    {
        $assoc_type_id = Association::where('id',$assoc_id)->pluck('assoc_type_id')[0];
        return view('pages.association.president_message')->with([
            'assoc_type_id'=>$assoc_type_id,
            'assoc_id'=>$assoc_id,
            'committee'=>AssociationCommittee::where('assoc_id','=',$assoc_id)->get(),
            'assoc_name'=>$assoc_name,
            'title'=>' Secretary Message',
            'slider'=>AssociationSlider::orderBy('position','asc')->where('assoc_id','=',$assoc_id)->get(),
            'assoc_profile'=>AssociationProfile::where('assoc_id','=',$assoc_id)->first(),
            'news'=>AssociationNews::where('assoc_id','=',$assoc_id)->get(),
            'default'=>DefaultAssociation::where('assoc_id','=',$assoc_id)->first(),
            'image'=>AssociationAlbum::orderBy('timestamp','asc')->where('assoc_id','=',$assoc_id)->get(),
            'video'=>AssociationVideoAlbum::orderBy('timestamp','asc')->where('assoc_id','=',$assoc_id)->get(),
            'context'=>AssociationSecretaryMessage::where('assoc_id','=',$assoc_id)->first(),
            'page_name'=>'about'

        ]);
    }
    public function assoc_governacne($assoc_id,$assoc_name)
    {
        $assoc_type_id = Association::where('id',$assoc_id)->pluck('assoc_type_id')[0];
        return view('pages.association.governance')->with([
            'assoc_type_id'=>$assoc_type_id,
            'assoc_id'=>$assoc_id,
            'committee'=>AssociationCommittee::where('assoc_id','=',$assoc_id)->get(),
            'assoc_name'=>$assoc_name,
            'title'=>'Governance',
            'slider'=>AssociationSlider::orderBy('position','asc')->where('assoc_id','=',$assoc_id)->get(),
            'assoc_profile'=>AssociationProfile::where('assoc_id','=',$assoc_id)->first(),
            'news'=>AssociationNews::where('assoc_id','=',$assoc_id)->get(),
            'default'=>DefaultAssociation::where('assoc_id','=',$assoc_id)->first(),
            'image'=>AssociationAlbum::orderBy('timestamp','asc')->where('assoc_id','=',$assoc_id)->get(),
            'video'=>AssociationVideoAlbum::orderBy('timestamp','asc')->where('assoc_id','=',$assoc_id)->get(),
            'context'=>AssociationSecretaryMessage::where('assoc_id','=',$assoc_id)->first(),
            'member'=>AssociationGovernance::where('assoc_id','=',$assoc_id)->get(),
            'page_name'=>'about'

        ]);
    }
    public function assoc_patrons($assoc_id,$assoc_name)
    {
        $assoc_type_id = Association::where('id',$assoc_id)->pluck('assoc_type_id')[0];
        return view('pages.association.governance')->with([
            'assoc_type_id'=>$assoc_type_id,
            'assoc_id'=>$assoc_id,
            'committee'=>AssociationCommittee::where('assoc_id','=',$assoc_id)->get(),
            'assoc_name'=>$assoc_name,
            'title'=>'Patrons and Adviser',
            'slider'=>AssociationSlider::orderBy('position','asc')->where('assoc_id','=',$assoc_id)->get(),
            'assoc_profile'=>AssociationProfile::where('assoc_id','=',$assoc_id)->first(),
            'news'=>AssociationNews::where('assoc_id','=',$assoc_id)->get(),
            'default'=>DefaultAssociation::where('assoc_id','=',$assoc_id)->first(),
            'image'=>AssociationAlbum::orderBy('timestamp','asc')->where('assoc_id','=',$assoc_id)->get(),
            'video'=>AssociationVideoAlbum::orderBy('timestamp','asc')->where('assoc_id','=',$assoc_id)->get(),
            'context'=>AssociationSecretaryMessage::where('assoc_id','=',$assoc_id)->first(),
            'member'=>AssociationPatrons::where('assoc_id','=',$assoc_id)->get(),
            'page_name'=>'about'

        ]);
    }
    public function assoc_committee($assoc_id,$assoc_name,$committee_id)
    {
        $assoc_type_id = Association::where('id',$assoc_id)->pluck('assoc_type_id')[0];
        return view('pages.association.governance')->with([
            'assoc_type_id'=>$assoc_type_id,
            'assoc_id'=>$assoc_id,
            'committee'=>AssociationCommittee::where('assoc_id','=',$assoc_id)->get(),
            'member'=>AssociationCommitteeMember::where('committee_id','=',$committee_id)->get(),
            'assoc_name'=>$assoc_name,
            'title'=>AssociationCommittee::where('assoc_id','=',$assoc_id)->pluck('name')[0],
           // 'slider'=>AssociationSlider::orderBy('position','asc')->where('assoc_id','=',$assoc_id)->get(),
            'assoc_profile'=>AssociationProfile::where('assoc_id','=',$assoc_id)->first(),
            'news'=>AssociationNews::where('assoc_id','=',$assoc_id)->get(),
            'default'=>DefaultAssociation::where('assoc_id','=',$assoc_id)->first(),
         //   'image'=>AssociationAlbum::orderBy('timestamp','asc')->where('assoc_id','=',$assoc_id)->get(),
          //  'video'=>AssociationVideoAlbum::orderBy('timestamp','asc')->where('assoc_id','=',$assoc_id)->get(),
         //   'context'=>AssociationSecretaryMessage::where('assoc_id','=',$assoc_id)->first(),
           // 'member'=>AssociationPatrons::where('assoc_id','=',$assoc_id)->get(),
           'page_name'=>'about'

        ]);
    }
    public function assoc_documents($assoc_id,$assoc_name)
    {
        $assoc_type_id = Association::where('id',$assoc_id)->pluck('assoc_type_id')[0];
        return view('pages.association.documents')->with([
            'assoc_type_id'=>$assoc_type_id,
            'assoc_id'=>$assoc_id,
         //   'committee'=>AssociationCommittee::where('assoc_id','=',$assoc_id)->get(),
            'audit'=>AssociationDocuments::where('assoc_id','=',$assoc_id)->where('type','=','AUDIT & ACCOUNTING')->get(),
            'forms'=>AssociationDocuments::where('assoc_id','=',$assoc_id)->where('type','=','FORMS & CIRCULARS')->get(),
            'documents'=>AssociationDocuments::where('assoc_id','=',$assoc_id)->where('type','=','DOCUMENTS')->get(),
            'assoc_name'=>$assoc_name,
            'title'=>'Documents and Downloads',
           // 'slider'=>AssociationSlider::orderBy('position','asc')->where('assoc_id','=',$assoc_id)->get(),
            'assoc_profile'=>AssociationProfile::where('assoc_id','=',$assoc_id)->first(),
          //  'news'=>AssociationNews::where('assoc_id','=',$assoc_id)->get(),
            'default'=>DefaultAssociation::where('assoc_id','=',$assoc_id)->first(),
          //  'image'=>AssociationAlbum::orderBy('timestamp','asc')->where('assoc_id','=',$assoc_id)->get(),
          //  'video'=>AssociationVideoAlbum::orderBy('timestamp','asc')->where('assoc_id','=',$assoc_id)->get(),
            'context'=>AssociationSecretaryMessage::where('assoc_id','=',$assoc_id)->first(),
           // 'member'=>AssociationPatrons::where('assoc_id','=',$assoc_id)->get(),
           'page_name'=>'docs'
        ]);
    }
    public function assoc_contact($assoc_id,$assoc_name)
    {
        $assoc_type_id = Association::where('id',$assoc_id)->pluck('assoc_type_id')[0];
        return view('pages.association.contact')->with([
            'assoc_type_id'=>$assoc_type_id,
            'assoc_id'=>$assoc_id,
            'committee'=>AssociationCommittee::where('assoc_id','=',$assoc_id)->get(),
            'audit'=>AssociationDocuments::where('assoc_id','=',$assoc_id)->where('type','=','AUDIT & ACCOUNTING')->get(),
            'forms'=>AssociationDocuments::where('assoc_id','=',$assoc_id)->where('type','=','FORMS & CIRCULARS')->get(),
            'documents'=>AssociationDocuments::where('assoc_id','=',$assoc_id)->where('type','=','DOCUMENTS')->get(),
            'assoc_name'=>$assoc_name,
            'title'=>'Documents and Downloads',
            'slider'=>AssociationSlider::orderBy('position','asc')->where('assoc_id','=',$assoc_id)->get(),
            'assoc_profile'=>AssociationProfile::where('assoc_id','=',$assoc_id)->first(),
            'news'=>AssociationNews::where('assoc_id','=',$assoc_id)->get(),
            'default'=>DefaultAssociation::where('assoc_id','=',$assoc_id)->first(),
            'image'=>AssociationAlbum::orderBy('timestamp','asc')->where('assoc_id','=',$assoc_id)->get(),
            'video'=>AssociationVideoAlbum::orderBy('timestamp','asc')->where('assoc_id','=',$assoc_id)->get(),
            'context'=>AssociationSecretaryMessage::where('assoc_id','=',$assoc_id)->first(),
            'member'=>AssociationPatrons::where('assoc_id','=',$assoc_id)->get(),
            'page_name'=>'contact'
        ]);
    }
    public function assoc_news($assoc_id,$assoc_name)
    {
        $assoc_type_id = Association::where('id',$assoc_id)->pluck('assoc_type_id')[0];
        return view('pages.association.news')->with([
            'assoc_type_id'=>$assoc_type_id,
            'assoc_id'=>$assoc_id,
            'committee'=>AssociationCommittee::where('assoc_id','=',$assoc_id)->get(),
          //  'audit'=>AssociationDocuments::where('assoc_id','=',$assoc_id)->where('type','=','AUDIT & ACCOUNTING')->get(),
          //  'forms'=>AssociationDocuments::where('assoc_id','=',$assoc_id)->where('type','=','FORMS & CIRCULARS')->get(),
          //  'documents'=>AssociationDocuments::where('assoc_id','=',$assoc_id)->where('type','=','DOCUMENTS')->get(),
            'assoc_name'=>$assoc_name,
          //  'title'=>'Documents and Downloads',
         //   'slider'=>AssociationSlider::orderBy('position','asc')->where('assoc_id','=',$assoc_id)->get(),
            'assoc_profile'=>AssociationProfile::where('assoc_id','=',$assoc_id)->first(),
            'news'=>AssociationNews::where('assoc_id','=',$assoc_id)->get(),
            'default'=>DefaultAssociation::where('assoc_id','=',$assoc_id)->first(),
          //  'image'=>AssociationAlbum::orderBy('timestamp','asc')->where('assoc_id','=',$assoc_id)->get(),
          //  'video'=>AssociationVideoAlbum::orderBy('timestamp','asc')->where('assoc_id','=',$assoc_id)->get(),
          //  'context'=>AssociationSecretaryMessage::where('assoc_id','=',$assoc_id)->first(),
           // 'member'=>AssociationPatrons::where('assoc_id','=',$assoc_id)->get(),
           'page_name'=>'media'
        ]);
    }
    public function assoc_image_album($assoc_id,$assoc_name)
    {
        $assoc_type_id = Association::where('id',$assoc_id)->pluck('assoc_type_id')[0];
        return view('pages.association.image_album')->with([
            'assoc_type_id'=>$assoc_type_id,
            'assoc_id'=>$assoc_id,
            'assoc_name'=>$assoc_name,
            'title'=>'Image Albums',
            'assoc_profile'=>AssociationProfile::where('assoc_id','=',$assoc_id)->first(),
            'default'=>DefaultAssociation::where('assoc_id','=',$assoc_id)->first(),
            'albums'=>AssociationAlbum::orderBy('timestamp','asc')->where('parent_id',0)->where('assoc_id','=',$assoc_id)->get(),
            'context'=>AssociationSecretaryMessage::where('assoc_id','=',$assoc_id)->first(),
            'page_name'=>'media'
        ]);
    }
    public function assoc_image_gallery(Request $request,$assoc_id,$assoc_name,$album_id,$album_name)
    {
        $parent_album_id = $album_id;
        $state_id = Association::where('id',$assoc_id)->value('state_id');
        $state_name = States::where('id',$state_id)->value('name');
    
        $assoc_type_id = Association::where('id',$assoc_id)->pluck('assoc_type_id')[0];
        $nested = AssociationAlbum::where('id',$album_id)->value('nested');
        $folder_id = $request->input('folder_id');
        $sub_folder_count = 0;
        $is_folder = 0;                                       // this is written for future purpose
        if(isset($folder_id)){
            $album_id = $folder_id;
            $is_folder = 1; 
            $child_folders = AssociationAlbum::orderBy('created_at','desc')->where('parent_id','=',$folder_id)->get();
            if(sizeof($child_folders)>0){
                $album_id = $folder_id;
                $nested = 1;
            }else{
                $nested = 0;
            }
        }

        if($nested){
            $folders=AssociationAlbum::orderBy('created_at','desc')->where('parent_id','=',$album_id)->get();
            $title = ucwords(str_replace('_', ' ', $album_name));
         //   $shareComponent  =  $this->socialMedia($path);
          //  dd($folders);
          foreach($folders as $folder){
            $get_path= DB::table('assoc_image_galleries')->where('album_id','=',$folder['id'])->latest()->first();
           
            $folder['first_image_path'] =$get_path->image_path;
          }
            return view('pages.association.image_gallery')->with([
                'album_id'=>$album_id,
                'nested'=>$nested,
                'title'=>$title,
                'folders'=>$folders,
                'assoc_type_id'=>$assoc_type_id,
                'assoc_profile'=>AssociationProfile::where('assoc_id','=',$assoc_id)->first(),
                'state_name'=>$state_name,
                'assoc_id'=>$assoc_id,
                'assoc_name'=>$assoc_name,
                'album_name'=>$album_name,
                'parent_album_id'=>$parent_album_id,
                'default'=>DefaultAssociation::where('assoc_id','=',$assoc_id)->first(),
                'is_folder'=>$is_folder,
                'page_name'=>'media'

            ]);
        }else{
            $gallery=AssociationImageGallery::orderBy('created_at','desc')->where('album_id','=',$album_id)->paginate(9);
            $title = ucwords(str_replace('_', ' ', $album_name));
         //   $shareComponent  =  $this->socialMedia($path);
            return view('pages.association.image_gallery')->with([
                'album_id'=>$album_id,
                'nested'=>$nested,
                'title'=>$title,
                'gallery'=>$gallery,
                'assoc_type_id'=>$assoc_type_id,
                'assoc_profile'=>AssociationProfile::where('assoc_id','=',$assoc_id)->first(),
                'default'=>DefaultAssociation::where('assoc_id','=',$assoc_id)->first(),
                'state_name'=>$state_name,
                'assoc_id'=>$assoc_id,
                'assoc_name'=>$assoc_name,
                'album_name'=>$album_name,
                'parent_album_id'=>$parent_album_id,
                'is_folder'=>$is_folder,
                'page_name'=>'media'

            ]);
        }



        // $assoc_type_id = Association::where('id',$assoc_id)->pluck('assoc_type_id')[0];
        // return view('pages.association.image_gallery')->with([
        //     'assoc_type_id'=>$assoc_type_id,
        //     'assoc_name'=>$assoc_name,
        //     'gallery'=>AssociationImageGallery::where('album_name','=',$album_name)->where('assoc_id','=',$assoc_id)->get(),
        //     'title'=>$album_name,
        //     'assoc_profile'=>AssociationProfile::where('assoc_id','=',$assoc_id)->first(),
        //     'default'=>DefaultAssociation::where('assoc_id','=',$assoc_id)->first(),
        //     'image'=>AssociationAlbum::orderBy('timestamp','asc')->where('assoc_id','=',$assoc_id)->get(),
        //     'member'=>AssociationPatrons::where('assoc_id','=',$assoc_id)->get(),
        // ]);
    }

    public function assoc_video_album($assoc_id,$assoc_name)
    {
        $assoc_type_id = Association::where('id',$assoc_id)->pluck('assoc_type_id')[0];
        return view('pages.association.video_album')->with([
            'assoc_type_id'=>$assoc_type_id,
            'assoc_id'=>$assoc_id,
            'committee'=>AssociationCommittee::where('assoc_id','=',$assoc_id)->get(),
            'assoc_name'=>$assoc_name,
            'title'=>'Video Albums',
            'slider'=>AssociationSlider::orderBy('position','asc')->where('assoc_id','=',$assoc_id)->get(),
            'assoc_profile'=>AssociationProfile::where('assoc_id','=',$assoc_id)->first(),
            'news'=>AssociationNews::where('assoc_id','=',$assoc_id)->get(),
            'default'=>DefaultAssociation::where('assoc_id','=',$assoc_id)->first(),
            'image'=>AssociationAlbum::orderBy('timestamp','asc')->where('assoc_id','=',$assoc_id)->get(),
            'video'=>AssociationVideoAlbum::orderBy('timestamp','asc')->where('assoc_id','=',$assoc_id)->get(),
            'context'=>AssociationSecretaryMessage::where('assoc_id','=',$assoc_id)->first(),
            'member'=>AssociationPatrons::where('assoc_id','=',$assoc_id)->get(),
            'page_name'=>'media'

            
        ]);
    }

    public function assoc_video_gallery($assoc_id,$assoc_name,$album_id,$album_name)
    {
        
        $assoc_type_id = Association::where('id',$assoc_id)->pluck('assoc_type_id')[0];
        return view('pages.association.video_gallery')->with([
            'assoc_type_id'=>$assoc_type_id,
            'committee'=>AssociationCommittee::where('assoc_id','=',$assoc_id)->get(),
            'assoc_name'=>$assoc_name,
            'gallery'=>AssociationVideo::where('album_id','=',$album_id)->get(),
            'title'=>$album_name,
            'slider'=>AssociationSlider::orderBy('position','asc')->where('assoc_id','=',$assoc_id)->get(),
            'assoc_profile'=>AssociationProfile::where('assoc_id','=',$assoc_id)->first(),
            'news'=>AssociationNews::where('assoc_id','=',$assoc_id)->get(),
            'default'=>DefaultAssociation::where('assoc_id','=',$assoc_id)->first(),
            'assoc_id'=>$assoc_id,
            'video'=>AssociationVideoAlbum::orderBy('timestamp','asc')->where('assoc_id','=',$assoc_id)->get(),
            'context'=>AssociationSecretaryMessage::where('assoc_id','=',$assoc_id)->first(),
            'member'=>AssociationPatrons::where('assoc_id','=',$assoc_id)->get(),
            'page_name'=>'media'

        ]);
    }
    public function assoc_district($assoc_id,$assoc_name)
    {
        $assoc_type_id = Association::where('id',$assoc_id)->pluck('assoc_type_id')[0];
         $state_id = Association::where('id','=',$assoc_id)->pluck('state_id');
         $state_name = States::where('id',$state_id)->pluck('name')[0];
         return view('pages.association.district')->with([
            'assoc_type_id'=>$assoc_type_id,
            'assoc_id'=>$assoc_id,
            'committee'=>AssociationCommittee::where('assoc_id','=',$assoc_id)->get(),
            'association'=>Association::where('assoc_type_id','=','2')->where('state_id','=',$state_id)->get(),
            'audit'=>AssociationDocuments::where('assoc_id','=',$assoc_id)->where('type','=','AUDIT & ACCOUNTING')->get(),
            'forms'=>AssociationDocuments::where('assoc_id','=',$assoc_id)->where('type','=','FORMS & CIRCULARS')->get(),
            'documents'=>AssociationDocuments::where('assoc_id','=',$assoc_id)->where('type','=','DOCUMENTS')->get(),
            'assoc_name'=>$assoc_name,
            'state_name'=>$state_name,
            'title'=>'Documents and Downloads',
            'slider'=>AssociationSlider::orderBy('position','asc')->where('assoc_id','=',$assoc_id)->get(),
            'assoc_profile'=>AssociationProfile::where('assoc_id','=',$assoc_id)->first(),
            'news'=>AssociationNews::where('assoc_id','=',$assoc_id)->get(),
            'default'=>DefaultAssociation::where('assoc_id','=',$assoc_id)->first(),
            'image'=>AssociationAlbum::orderBy('timestamp','asc')->where('assoc_id','=',$assoc_id)->get(),
            'video'=>AssociationVideoAlbum::orderBy('timestamp','asc')->where('assoc_id','=',$assoc_id)->get(),
            'context'=>AssociationSecretaryMessage::where('assoc_id','=',$assoc_id)->first(),
            'member'=>AssociationPatrons::where('assoc_id','=',$assoc_id)->get(),
            'page_name'=>'about'

        ]);
    }
    public function assoc_other($assoc_id,$assoc_name)
    {
        $assoc_type_id = Association::where('id',$assoc_id)->pluck('assoc_type_id')[0];
        $state_id = Association::where('id','=',$assoc_id)->pluck('state_id');
        $state_name = States::where('id',$state_id)->pluck('name')[0];

        return view('pages.association.other')->with([
            'assoc_type_id'=>$assoc_type_id,
            'assoc_id'=>$assoc_id,
            'committee'=>AssociationCommittee::where('assoc_id','=',$assoc_id)->get(),
            'association'=>Association::where('assoc_type_id','=','3')->get(),
            'audit'=>AssociationDocuments::where('assoc_id','=',$assoc_id)->where('type','=','AUDIT & ACCOUNTING')->get(),
            'forms'=>AssociationDocuments::where('assoc_id','=',$assoc_id)->where('type','=','FORMS & CIRCULARS')->get(),
            'documents'=>AssociationDocuments::where('assoc_id','=',$assoc_id)->where('type','=','DOCUMENTS')->get(),
            'assoc_name'=>$assoc_name,
            'state_name'=>$state_name,
            'title'=>'Documents and Downloads',
            'slider'=>AssociationSlider::orderBy('position','asc')->where('assoc_id','=',$assoc_id)->get(),
            'assoc_profile'=>AssociationProfile::where('assoc_id','=',$assoc_id)->first(),
            'news'=>AssociationNews::where('assoc_id','=',$assoc_id)->get(),
            'default'=>DefaultAssociation::where('assoc_id','=',$assoc_id)->first(),
            'image'=>AssociationAlbum::orderBy('timestamp','asc')->where('assoc_id','=',$assoc_id)->get(),
            'video'=>AssociationVideoAlbum::orderBy('timestamp','asc')->where('assoc_id','=',$assoc_id)->get(),
            'context'=>AssociationSecretaryMessage::where('assoc_id','=',$assoc_id)->first(),
            'member'=>AssociationPatrons::where('assoc_id','=',$assoc_id)->get(),
            'page_name'=>'about'

        ]);
    }
    public function assoc_events($assoc_id,$assoc_name)
    {
        $assoc_type_id = Association::where('id',$assoc_id)->pluck('assoc_type_id')[0];
        if($assoc_type_id == 1){
            $route_prefix = "/state";
        }elseif($assoc_type_id == 2){
            $route_prefix = "/district";
        }else{
            $route_prefix = "/other_assoc";
        }
        return view('pages.association.event')->with([
            'assoc_type_id'=>$assoc_type_id,
            'assoc_id'=>$assoc_id,
            'committee'=>AssociationCommittee::where('assoc_id','=',$assoc_id)->get(),
            'events'=>Events::where('assoc_id','=',$assoc_id)->get(),
            'assoc_name'=>$assoc_name,
            'assoc_profile'=>AssociationProfile::where('assoc_id','=',$assoc_id)->first(),
            'default'=>DefaultAssociation::where('assoc_id','=',$assoc_id)->first(),
            'route_prefix'=>$route_prefix,
            'page_name'=>'events'

        ]);
    }

    public function assoc_events_details($assoc_id,$event_id,$event_name)
    {
        $assoc_type_id = Association::where('id',$assoc_id)->pluck('assoc_type_id')[0];
        $event=Events::where('id','=',$event_id)->first();
        $assoc_name = Association::where('id',$assoc_id)->value('name');
      //  $event_type = DB::table('event_type')->where('id','=',$event->eventType_id)->pluck('event_type')[0];
         //  dd($events);
        // $title_in = Events::where('id','=',$id)->pluck('title');

        $title = ucwords(str_replace('_', ' ', ""));

                return view('pages.association.event_details')->with(
                    ['title'=>$title,'event'=>$event,
                    'assoc_name'=>$assoc_name,
                    'assoc_profile'=>AssociationProfile::where('assoc_id','=',$assoc_id)->first(),
                    'assoc_type_id'=>$assoc_type_id,
                    'assoc_id'=>$assoc_id,
                    'default'=>DefaultAssociation::where('assoc_id','=',$assoc_id)->first(),
                    'page_name'=>'events'

                ]);
    }


}

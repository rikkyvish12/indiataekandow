<?php

namespace App\Http\Controllers\Admin\Events;

use Illuminate\Http\Request;
use App\Models\EventsVideoAlbum;
use App\Models\EventsVideo;
use App\Models\Events;
use App\Models\AssociationType;

use App\Models\AssociationVideo;
use App\Models\AssociationVideoAlbum;

use App\Models\VideoAlbum;
use App\Models\VideoGallery;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EventsVideoAlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($event_id)
    {
        // dd($event_id);
        $get_event = Events::where('id',$event_id)->first();

        $albumType = NULL;
        $galleryType = NULL;
        $assoc_id =null;
        if($get_event->assoc_id != NULL){
            $albumType= AssociationVideoAlbum::class; 
        }else{
            $albumType= VideoAlbum::class;
        }



        return view('pages.admin.event.video_album.index')
        ->with('albums',$albumType::where('event_id',$event_id)->get())
        ->with('event_id',$event_id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($event_id)
    {
        return view('pages.admin.event.video_album.create')->with('event_id',$event_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $get_event = Events::where('id',$event_id)->first();

        $album=new EventsVideoAlbum;    
        $album->event_name=$get_event->title;
        $album->album_name=$request->input('album_name');
        $album->timestamp=$request->input('timestamp');

        $album->save();
        $destination_path =NULL;

           if($get_event->assoc_id != NULL){
               $assoc_type = AssociationType::where('id','=',$get_event->assoc_id )->value('name');
               

               $final_assoc_type=str_replace('_association', '', $assoc_type);
               $destination_path = 'storage/events/association/'. $final_assoc_type.'/'.$get_event->assoc_id.'/'.$event_id.'/media/video_albums/'.$album->id.'/';           
           }else{
               $destination_path = 'storage/events/main/'.$event_id.'/media/video_albums/'.$album->id.'/'; 

           }

        if($request->hasFile('coverImage'))
        {
            $coverImage = time().'.'.request()->coverImage->getClientOriginalExtension();
            request()->coverImage->move($destination_path, $coverImage);
            $album->cover_image='/'.$destination_path.$coverImage;
        }
        $album->save();
        return redirect(route('event_admin.album_video.index'))->with('success','Album Added Successfully');

    }
    public function createNewVideoAlbumEvent(Request $request){
        try{
            // dd($request->all());
            $finalYoutubeLinkClassArray = json_decode($request->input('finalYoutubeLinkClassArray'),true); 
    
            // dd($finalYoutubeLinkClassArray);
                $date_time =  $request->input('date_time');
                $event_id=$request->input('event_id');
                $album_name = $request->input('album_name_input');

                $album_is_saved =false;
                $video_is_saved=false;
                $get_event = Events::where('id',$event_id)->first();

                $destination_path = NULL;    
                $albumType = NULL;
                $galleryType = NULL;
                $assoc_id =null;
                if($get_event->assoc_id != NULL){
                    $assoc_type = AssociationType::where('id','=',$get_event->assoc_id )->value('name');
                    $final_assoc_type = str_replace('_association', '', $assoc_type);
                    $destination_path = 'storage/events/association/'. $final_assoc_type.'/'.$get_event->assoc_id.'/'.$event_id.'/media/video_albums/';    
                    $albumType= AssociationVideoAlbum::class; 
                    $galleryType=AssociationVideo::class;
                    $assoc_id=$get_event->assoc_id ;
            
                }else{
                    $destination_path = 'storage/events/main/'.$event_id.'/media/video_albums/';
                    $albumType= VideoAlbum::class;
                    $galleryType=VideoGallery::class;
                }

                $create_album=new  $albumType;
              
                $create_album->album_name=$album_name;
                $create_album->event_id=$event_id;
                $create_album->timestamp=$date_time;  

                if($albumType == AssociationVideoAlbum::class)
                $create_album->assoc_id= $get_event->assoc_id;              

                $create_album->created_at=\Carbon\Carbon::now();
                $create_album->save();
    
           // $album = Album::find($new_album->id);
            if($request->hasFile('cover_image_file'))
            {
                $cover_image = 'cover_image.'.request()->cover_image_file->getClientOriginalExtension();
                // if($get_event->assoc_id != NULL){
                //     $assoc_type = AssociationType::where('id','=',$get_event->assoc_id )->value('name');
                    

                //     $final_assoc_type=str_replace('_association', '', $assoc_type);
                //     // dd($final_assoc_type);
                //     // request()->cover_image_file->move('storage/association/'.$get_event->assoc_id.'/media/video_albums/'.$create_album->id.'/', $cover_image);
                //     // $create_album->cover_image='/storage/association/'.$get_event->assoc_id.'/media/video_albums/'.$create_album->id.'/'.$cover_image;
                //     request()->cover_image_file->move('storage/events/association/'. $final_assoc_type.'/'.$get_event->assoc_id.'/'.$event_id.'/media/video_albums/'.$create_album->id.'/', $cover_image);
                //     $create_album->cover_image='/storage/events/association/'. $final_assoc_type.'/'.$get_event->assoc_id.'/'.$event_id.'/media/video_albums/'.$create_album->id.'/'.$cover_image;
                // }else{
                    request()->cover_image_file->move($destination_path.$create_album->id.'/',$cover_image);
                    $create_album->cover_image='/'.$destination_path.$create_album->id.'/'.$cover_image;
                // }
                
            }
            $album_is_saved = $create_album->save();
    
            foreach($finalYoutubeLinkClassArray as $youtubeLink){
                $video=new $galleryType;
                
                $parts = parse_url($youtubeLink);
                parse_str($parts['query'], $query);
                $url = "https://www.youtube.com/watch?v=" . $query['v'];
                // $my_array_of_vars;
                // parse_str( parse_url( $youtubeLink, PHP_URL_QUERY ), $my_array_of_vars );
                $video->youtube_link =  $url ;
                $video->youtube_code =  $query['v'];
                $video->album_id=$create_album->id;
           
    
                $video->created_at=\Carbon\Carbon::now();
                $video->save();
            }
            // $video->youtube_code=$video_id;
            
    
            if($album_is_saved){
                   $final['status']="success";
            }else{
                    $final['status']="unsuccess";
    
            }
    
            return json_encode($final);
    
         }catch(Exception $e) {
            $final['status']="error";
            return json_encode($final);
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
    public function edit($event_id,$id)
    {
        $get_event = Events::where('id',$event_id)->first();

        $albumType = NULL;
        $galleryType = NULL;
        $assoc_id =null;
        if($get_event->assoc_id != NULL){
            $albumType= AssociationVideoAlbum::class; 
            $galleryType=AssociationVideo::class;
        }else{
            $albumType= VideoAlbum::class;
            $galleryType=VideoGallery   ::class;
        }

        $album=$albumType::find($id);
        $videos = $galleryType::where('album_id','=',$id)->get();
        $youtubeArray= $galleryType::where('album_id','=',$id)->get()->pluck('youtube_link')->toArray();

        return view('pages.admin.event.video_album.edit')->with('album',$albumType::find($id))->with('event_id',$event_id)->with(['album'=>$album,'videos'=>$videos,'videos_count' => count($videos) ,'youtubeArray'=>$youtubeArray]);;

        // return view('pages.admin.event.video_album.edit')->with('album',EventsVideoAlbum::find($id));
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
        $album= EventsVideoAlbum::find($id);
        $album->event_name=Auth::user()->name;
        $album->album_name=$request->input('album_name');
        $album->timestamp=$request->input('timestamp');
        if($request->hasFile('coverImage'))
        {
            $coverImage = time().'.'.request()->coverImage->getClientOriginalExtension();
            request()->coverImage->move('event_video_album_cover_image/', $coverImage);
            $album->cover_image='/event_video_album_cover_image/'.$coverImage;
        }
        $album->save();
        return redirect(route('event_admin.album_video.index'))->with('success','Album Updated Successfully');

    }
    public function updateSelectedVideoAlbumDetailsEvents(Request $request){
        try{
            // dd($request->all());
         $selected_album_id = $request->input('selected_album_id');
         $date_time =  $request->input('date_time');
         $album_name = $request->input('album_name_input');
         $event_id = $request->input('event_id');

        $get_event = Events::where('id',$event_id)->first();

        $destination_path = NULL;    
        $albumType = NULL;
        $galleryType = NULL;
        $assoc_id =null;
        if($get_event->assoc_id != NULL){
            $assoc_type = AssociationType::where('id','=',$get_event->assoc_id )->value('name');
            $final_assoc_type = str_replace('_association', '', $assoc_type);
            $destination_path = 'storage/events/association/'. $final_assoc_type.'/'.$get_event->assoc_id.'/'.$event_id.'/media/video_albums/';    
            $albumType= AssociationVideoAlbum::class; 
            $galleryType=AssociationVideo::class;
            $assoc_id=$get_event->assoc_id ;
    
        }else{
            $destination_path = 'storage/events/main/'.$event_id.'/media/video_albums/';
            $albumType= VideoAlbum::class;
            $galleryType=VideoGallery::class;
        }



             $edit_album =  $albumType::find($selected_album_id);
             $edit_album->album_name=$album_name;
             $edit_album->timestamp=$date_time;
             $edit_album->updated_at=\Carbon\Carbon::now();
             $edit_album->save();
 
         if($request->hasFile('cover_image_file'))
         {
             $cover_image = 'cover_image.'.request()->cover_image_file->getClientOriginalExtension();
          
                request()->cover_image_file->move($destination_path.$edit_album->id.'/',$cover_image);
                $edit_album->cover_image='/'.$destination_path.$edit_album->id.'/'.$cover_image;
            
         }
         $album_is_edited = $edit_album->save();
 
         if($album_is_edited){
             $final['status']="success";
      }else{
              $final['status']="unsuccess";
 
      }
 
      return json_encode($final);
 
   }catch(Exception $e) {
      $final['status']="error";
      return json_encode($final);
 }
         
     }

     public function updateSelectedVideoAlbumYoutubeLinksEvents(Request $request){
        try{
            // dd($request->all());
            $finalYoutubeLinkClassArray = json_decode($request->input('finalYoutubeLinkClassArray'),true); 
            $selected_album_id = $request->input('selected_album_id');
            $event_id = $request->input('event_id');

            $get_event = Events::where('id',$event_id)->first();

            $destination_path = NULL;    
            $albumType = NULL;
            $galleryType = NULL;
            if($get_event->assoc_id != NULL){
                
                $galleryType=AssociationVideo::class;
        
            }else{
                $galleryType=VideoGallery::class;
            }
                                       
                $galleryType::where('album_id', $selected_album_id )->delete();              
        
                foreach($finalYoutubeLinkClassArray as $youtubeLink){
                    $edit_videos =  new $galleryType;
                    $parts = parse_url($youtubeLink);
                    parse_str($parts['query'], $query);
                    $url = "https://www.youtube.com/watch?v=" . $query['v'];
                    // $my_array_of_vars;
                    // parse_str( parse_url( $youtubeLink, PHP_URL_QUERY ), $my_array_of_vars );
                    $edit_videos->youtube_link =  $url ;
                    $edit_videos->youtube_code =  $query['v'];
                    $edit_videos->album_id=$selected_album_id;
                    $edit_videos->created_at=\Carbon\Carbon::now();
                    $edit_videos->save();
        
                }
                
           
                    $final['status']="success";    
                    return json_encode($final);
        
          }catch(Exception $e) {
             $final['status']="error";
             return json_encode($final);
            }
        
        
            }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($event_id,$id)
    {
        $get_event = Events::where('id',$event_id)->first();

        $albumType = NULL;
             $galleryType = NULL;
             if($get_event->assoc_id != NULL){
                 $albumType= AssociationVideoAlbum::class; 
                 $galleryType=AssociationVideo::class;
             }else{
                 $albumType= VideoAlbum::class;
                 $galleryType=VideoGallery::class;
             }



        $album= $albumType::find($id);

        $get_videos= $galleryType::where('album_id','=',$album->id)->get();
        // dd($get_images);

        if($get_videos){
             $get_videos->each->delete(); 
        }

        $path =  pathinfo($album->cover_image, PATHINFO_DIRNAME);
        $final_path= ltrim($path, '/');
        //  dd($final_path);
        if(\File::exists($final_path))
        {
            \File::deleteDirectory($final_path);
        }

      


       
       
        $album->delete();
        return back()->with('success','Album Deleted Successfully');

    }
}

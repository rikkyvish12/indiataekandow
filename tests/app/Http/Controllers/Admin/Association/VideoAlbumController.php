<?php

namespace App\Http\Controllers\Admin\Association;

use Illuminate\Http\Request;
use App\Models\AssociationVideoAlbum;
use App\Models\Association;
use App\Models\AssociationType;
use App\Models\Events;
use App\Models\AssociationVideo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\AssociationEvent;


class VideoAlbumController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($assoc_id)
    {
        $album = AssociationVideoAlbum::where('assoc_id',$assoc_id)->orderBy('created_at','desc')->get();
        // dd($album );
        return view('pages.admin.association.videoalbum.index')
        ->with('album',$album)
        ->with('assoc_id',$assoc_id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($assoc_id)
    {
        $all_events = Events::where('assoc_id',$assoc_id )->get();
        // dd($all_events);
        return view('pages.admin.association.videoalbum.create')->with('assoc_id',$assoc_id)->with('all_events',$all_events);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $album = new AssociationVideoAlbum;
    //     $album->state_name=Auth::user()->name;
    //     $album->album_name=$request->input('album_name');
    //     $album->assoc_id=$request->input('assoc_id');
    //     $album->timestamp=$request->input('timestamp');
    //     if($request->hasFile('coverImage'))
    //     {
    //         $coverImage = time().'.'.request()->coverImage->getClientOriginalExtension();
    //         request()->coverImage->move('album_coverImage/', $coverImage);
    //         $album->coverImage='/album_coverImage/'.$coverImage;
    //     }
    //     $album->save();
    //     return redirect(route('assoc_admin.album_video.index'))->with('success','Album Added Successfully');
    // }
    public function createNewVideoAlbum(Request $request){
    try{
        // dd($request->all());
        $finalYoutubeLinkClassArray = json_decode($request->input('finalYoutubeLinkClassArray'),true); 

        // dd($finalYoutubeLinkClassArray);
        $date_time =  $request->input('date_time');
        
        $destination_path = null; 
        $assoc_id=$request->input('assoc_id');
        
        $assoc = Association::where('id',$assoc_id)->first();
        $assoc_type = AssociationType::where('id','=',$assoc->assoc_type_id )->value('name');
        $final_assoc_type = str_replace('_association', '', $assoc_type);


        $create_album=new AssociationVideoAlbum;
        $album_type = $request->input('album_type');
        if( $album_type ==="1"){            
            $create_album->album_name=$request->input('album_name_input');
            $create_album->album_type_id=$album_type;
            $create_album->assoc_id=$assoc_id;
            $destination_path = 'storage/association/'.$final_assoc_type.'/'.$assoc_id.'/media/video_albums/';

            // $create_album->event_name=$album_name;

        }else if($album_type ==="2"){
            $event_id = $request->input('event_id');            
            $create_album->album_name=$request->input('album_name_input');
            $destination_path = 'storage/events/association/'. $final_assoc_type.'/'.$assoc_id.'/'.$event_id.'/media/video_albums/';
            $create_album->assoc_id=$assoc_id;
            $create_album->album_type_id=$album_type;
            $create_album->event_id=$event_id;
        }
        $create_album->timestamp=$date_time;
        $create_album->save();

       // $album = Album::find($new_album->id);
        if($request->hasFile('cover_image_file'))
        {
            $cover_image = 'cover_image.'.request()->cover_image_file->getClientOriginalExtension();
            request()->cover_image_file->move($destination_path.$create_album->id.'/', $cover_image);
            $create_album->cover_image='/'.$destination_path.$create_album->id.'/'.$cover_image;
        }
        $album_is_saved = $create_album->save();

        

        foreach($finalYoutubeLinkClassArray as $youtubeLink){
            $video=new AssociationVideo;
            $my_array_of_vars;
            parse_str( parse_url( $youtubeLink, PHP_URL_QUERY ), $my_array_of_vars );
            $video->youtube_link = $youtubeLink;
            $video->youtube_code =  $my_array_of_vars['v'];
            $video->album_id=$create_album->id;
    
            $video->created_at=\Carbon\Carbon::now();
            $video->save();
        }
        // $video->youtube_code=$video_id;
 

        if($album_is_saved  ){
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
    public function edit($assoc_id,$id)
    {
        $album=AssociationVideoAlbum::find($id);
        $videos = AssociationVideo::where('album_id','=',$id)->get();
        $youtubeArray= AssociationVideo::where('album_id','=',$id)->get()->pluck('youtube_link')->toArray();
        // dd($youtubeArray);
        $all_events = Events::where('assoc_id',$assoc_id )->get();
        return view('pages.admin.association.videoalbum.edit')->with('album',AssociationVideoAlbum::find($id))->with('assoc_id',$assoc_id)->with(['album'=>$album,'videos'=>$videos,'videos_count' => count($videos) ,'all_events'=> $all_events,'youtubeArray'=>$youtubeArray]);;

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
        $album =  AssociationVideoAlbum::find($id);
        $album->album_name=$request->input('album_name');
        $album->timestamp=$request->input('timestamp');
        if($request->hasFile('coverImage'))
        {
            $coverImage = time().'.'.request()->coverImage->getClientOriginalExtension();
            request()->coverImage->move('album_coverImage/', $coverImage);
            $album->cover_image='/album_coverImage/'.$coverImage;
        }
        $album->save();
        return redirect(route('assoc_admin.album_video.index'))->with('success','Album Updated Successfully');
  
    }
    public function updateSelectedVideoAlbumDetails(Request $request){
        try{
            // dd($request->all());
         $date_time =  $request->input('date_time');
         $event_id = null; 
         $selected_album_id = $request->input('selected_album_id');
         $destination_path = null; 
         $assoc_id=$request->input('assoc_id');
         $album_type = $request->input('album_type');

         
         $assoc = Association::where('id',$assoc_id)->first();
         $assoc_type = AssociationType::where('id','=',$assoc->assoc_type_id )->value('name');
         $final_assoc_type = str_replace('_association', '', $assoc_type);

         $edit_album =  AssociationVideoAlbum::find($selected_album_id);

         $type_changed=false;
            if($edit_album->album_type_id != $album_type ){
      
                $type_changed = true;
            }
 
         if( $album_type ==="1"){            
             $edit_album->album_type_id=$album_type;
             $edit_album->album_name= $request->input('album_name_input');
             $destination_path = 'storage/association/'.$final_assoc_type.'/'.$assoc_id.'/media/video_albums/';

             if($type_changed == true){
                
                    $from = 'storage/events/association/'. $final_assoc_type.'/'.$assoc_id.'/'.$edit_album->event_id.'/media/video_albums/'.$edit_album->id.'/';
                    $to =  'storage/association/'.$final_assoc_type.'/'.$assoc_id.'/media/video_albums/'.$edit_album->id.'/';

                    // dd($to);
                    if(!\File::exists($to)) {
                        \File::makeDirectory( $to, 0777, true, true);
                    }
                    \File::copyDirectory($from,$to);

                    if(\File::exists($from))
                    {
                    \File::deleteDirectory($from);
                    }
                    
                    $edit_album->cover_image	=  '/'.$to.'cover_image.jpg';
                    $edit_album->event_id=NULL;

            }



         }else if($album_type ==="2"){
             $event_id= $request->input('event_id');
             $edit_album->album_type_id=$album_type;
             $edit_album->event_id=$event_id;
             $edit_album->album_name= $request->input('album_name_input');
             $destination_path = 'storage/events/association/'. $final_assoc_type.'/'.$assoc_id.'/'.$event_id.'/media/video_albums/';

             if($type_changed == true){
             
                 
                $from = 'storage/association/'.$final_assoc_type.'/'.$assoc_id.'/media/video_albums/'.$edit_album->id.'/';
        
                $to =   'storage/events/association/'. $final_assoc_type.'/'.$assoc_id.'/'.$edit_album->event_id.'/media/video_albums/'.$edit_album->id.'/';
                if(!\File::exists($to)) {
                    \File::makeDirectory( $to, 0777, true, true);
                }
                \File::copyDirectory($from,$to);
                if(\File::exists($from))
                {
                \File::deleteDirectory($from);
                }
                 $edit_album->cover_image =  '/'.$to.'cover_image.jpg';
            }

        }


         
         $edit_album->timestamp=$date_time;
 
         if($request->hasFile('cover_image_file') && $type_changed == false)
         {
             $cover_image = 'cover_image.'.request()->cover_image_file->getClientOriginalExtension();
             request()->cover_image_file->move($destination_path.$edit_album->id.'/', $cover_image);
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

     public function updateSelectedVideoAlbumYoutubeLinks(Request $request){
        try{
            // dd($request->all());
                $finalYoutubeLinkClassArray = json_decode($request->input('finalYoutubeLinkClassArray'),true); 
                $selected_album_id = $request->input('selected_album_id');
                $assoc_id = $request->input('assoc_id');

                // dd($finalYoutubeLinkClassArray);
                if($request->input('event_id')=="")
                    $event_id = null; 
                else
                   $event_id = $request->input('event_id');
        
                    $is_exist =   AssociationVideoAlbum::find($selected_album_id);
                    
                    if($is_exist)
                    
                    AssociationVideo::where('album_id', $selected_album_id )->delete();
                   
                        
        
        
              
        
                foreach($finalYoutubeLinkClassArray as $youtubeLink){
                    $edit_videos =  new AssociationVideo;
                    $my_array_of_vars;
                    parse_str( parse_url( $youtubeLink, PHP_URL_QUERY ), $my_array_of_vars );
                    $edit_videos->youtube_link = $youtubeLink;
                    $edit_videos->youtube_code =  $my_array_of_vars['v'];
                    $edit_videos->album_id=$selected_album_id;
                    $edit_videos->event_id=$event_id;
                    $edit_videos->assoc_id=$assoc_id;
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
    public function destroy($id)
    {
        $album =  AssociationVideoAlbum::find($id);

        $get_videos= AssociationVideo::where('album_id','=',$album->id)->get();
        // dd($get_videos);

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
        return redirect()->back()->with('success','Album Deleted Successfully');
  
    }
}

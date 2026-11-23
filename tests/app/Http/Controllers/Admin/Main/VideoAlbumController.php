<?php

namespace App\Http\Controllers\Admin\Main;

use App\Models\VideoAlbum;
use App\Models\VideoGallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Events;

class VideoAlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
        $get_event_title = NULL;
        $album = VideoAlbum::orderBy('created_at','desc')->get();
        // foreach( $album as  $item){
        //     // dd($item['event_id']);
        //     if($item['event_id']){
        //         // dd("in if");
        //         $get_event_title= Events::where('id','=',$item['event_id'])->pluck('title')[0];
        //         // dd($get_event_title);
        //         $item['event_title']= $get_event_title;
        //     }
         

        // }
// dd($album);
        return view('pages.admin.main.videoalbum.index')->with('album',$album);
    }catch(Exception $e) {
       
        return view('pages.admin.main.videoalbum.index');
  }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{

            $all_events = Events::where('assoc_id',NULL)->get();
            return view('pages.admin.main.videoalbum.create')->with('all_events',$all_events);
    }catch(Exception $e) {
       
        return view('pages.admin.main.videoalbum.create');
  }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function createNewVideoAlbum(Request $request){
        // dd($request->all());
    try{
        $finalYoutubeLinkClassArray = json_decode($request->input('finalYoutubeLinkClassArray'),true); 

        // dd($finalYoutubeLinkClassArray);
        $date_time =  $request->input('date_time');
        $event_id = null; 
        $destination_path = null; 

        $create_album=new VideoAlbum;
        $album_type = $request->input('album_type');
        if( $album_type ==="1"){
            
            $create_album->album_type_id=$album_type;
            $create_album->album_name=$request->input('album_name_input');
            // $create_album->event_name=$album_name;
            $destination_path = 'storage/main/media/video_albums/';


        }else if($album_type ==="2"){
            $event_id= $request->input('event_id');
            $create_album->album_type_id=$album_type;
            $create_album->event_id=$event_id;
            $create_album->album_name=$request->input('album_name_input');
            $destination_path = 'storage/events/main/'.$event_id.'/media/video_albums/';            

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
            $video=new VideoGallery;
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

    // public function store(Request $request)
    // {
    //     $album = new VideoAlbum;
    //     $album->event_name=$request->input('event_name');
    //     $album->album_name=$request->input('album_name');
    //     $album->timestamp=$request->input('timestamp');
    //     if($request->hasFile('coverImage'))
    //     {
    //         $coverImage = time().'.'.request()->coverImage->getClientOriginalExtension();
    //         request()->coverImage->move('album_coverImage/', $coverImage);
    //         $album->coverImage='/album_coverImage/'.$coverImage;
    //     }
    //     $album->save();
    //     return redirect(route('admin.video_album.index'))->with('success','Album Added Successfully');
    // }

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
        $album=VideoAlbum::find($id);
        $videos = VideoGallery::where('album_id','=',$id)->get();
        $youtubeArray= VideoGallery::where('album_id','=',$id)->get()->pluck('youtube_link')->toArray();
        // dd($youtubeArray);
        $all_events = Events::where('assoc_id',NULL)->get();
        // $album = VideoAlbum::get();
        return view('pages.admin.main.videoalbum.edit')->with(['album'=>$album,'videos'=>$videos,'videos_count' => count($videos) ,'all_events'=> $all_events,'youtubeArray'=>$youtubeArray]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function updateSelectedAlbumDetails(Request $request){
       try{
        $date_time =  $request->input('date_time');
        $event_id = null; 
        $selected_album_id = $request->input('selected_album_id');
        $edit_album =  VideoAlbum::find($selected_album_id);

        $type_changed=false;
        if($edit_album->album_type_id != $album_type ){
  
            $type_changed = true;
        }

        $album_type = $request->input('album_type');
        if( $album_type ==="1"){
            $edit_album->album_type_id=$album_type;
            $edit_album->album_name=$request->input('album_name_input');

            if($type_changed == true){
                
                $from = 'storage/events/main/'.$event_id.'/media/video_albums/'.$edit_album->id.'/';
                $to =   'storage/main/media/video_albums/'.$edit_album->id.'/';

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
            $edit_album->album_name=$request->input('album_name_input');

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

        if($request->hasFile('cover_image_file'))
        {
            $cover_image = 'cover_image.'.request()->cover_image_file->getClientOriginalExtension();
            request()->cover_image_file->move('storage/main/media/video_albums/'.$selected_album_id.'/', $cover_image);
            $edit_album->cover_image='/storage/main/media/video_albums/'.$selected_album_id.'/'.$cover_image;
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
    // public function update(Request $request, $id)
    // {
        
    //     $album->event_name=$request->input('event_name');
    //     $album->album_name=$request->input('album_name');
    //     $album->timestamp=$request->input('timestamp');
    //     if($request->hasFile('coverImage'))
    //     {
    //         $coverImage = time().'.'.request()->coverImage->getClientOriginalExtension();
    //         request()->coverImage->move('album_coverImage/', $coverImage);
    //         $album->coverImage='/album_coverImage/'.$coverImage;
    //     }
    //     $album->save();
    //     return redirect(route('admin.video_album.index'))->with('success','Album Updated Successfully');
  
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    public function updateSelectedAlbumYoutubeLinks(Request $request){
try{
        $finalYoutubeLinkClassArray = json_decode($request->input('finalYoutubeLinkClassArray'),true); 
        $selected_album_id = $request->input('selected_album_id');
        // dd($finalYoutubeLinkClassArray);
        if($request->input('event_id')=="")
            $event_id = null; 
        else
           $event_id = $request->input('event_id');

            $is_exist =   VideoAlbum::find($selected_album_id);
            
            if($is_exist)
             VideoGallery::where('album_id', $selected_album_id )->delete();
           
                


      

        foreach($finalYoutubeLinkClassArray as $youtubeLink){
            $edit_videos =  new VideoGallery;
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
    public function destroy($id)
    {
        $album =  VideoAlbum::find($id);

        VideoGallery::where('album_id','=',$album->id)->delete(); 
               

        $path =  pathinfo($album->cover_image, PATHINFO_DIRNAME);
        $final_path= ltrim($path, '/');
        //  dd($final_path);
        if(\File::exists($final_path))
        {
            \File::deleteDirectory($final_path);
        }
      
        $album->delete();
        return redirect(route('admin.video_album.index'))->with('success','Album Deleted Successfully');
  
    }
}
<?php

namespace App\Http\Controllers\Admin\Events;

use App\Models\Album;
use App\Models\ImageGallery;

use App\Models\Events;
use Illuminate\Http\Request;

use App\Models\EventImageGallery;
use App\Models\EventAlbum;

use App\Models\AssociationAlbum;
use App\Models\AssociationImageGallery;

use App\Models\AssociationType;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EventAlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($event_id)
    {
        $get_event = Events::where('id',$event_id)->first();

        $albumType = NULL;
        $galleryType = NULL;
        $assoc_id =null;
        if($get_event->assoc_id != NULL){
            $albumType= AssociationAlbum::class; 
        }else{
            $albumType= Album::class;
        }

        $album= $albumType::where('parent_id','=',0)->where('event_id','=',$event_id)->get();
        return view('pages.admin.event.album.index')->with('album', $album)->with('event_id',$event_id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($event_id)
    {
        return view('pages.admin.event.album.create')->with('event_id',$event_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $album = new Album;
        $album->event_name=Auth::user()->name;
        $album->album_name=$request->input('album_name');
        $album->timestamp=$request->input('timestamp');
        if($request->hasFile('coverImage'))
        {
            $coverImage = time().'.'.request()->coverImage->getClientOriginalExtension();
            request()->coverImage->move('album_coverImage/', $coverImage);
            $album->coverImage='/album_coverImage/'.$coverImage;
        }
        $album->save();
        return redirect(route('pages.admin.event.album.index'))->with('success','Album Added Successfully');
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
            $albumType= AssociationAlbum::class; 
            $galleryType=AssociationImageGallery::class;
        }else{
            $albumType= Album::class;
            $galleryType=ImageGallery::class;
        }

        $all_events = Events::where('id',$event_id)->get();
        $album = $albumType::find($id);
        $album_folders= Null;
        if($album->nested == 1){
            $album_folders_ids = $albumType::where('parent_id',$id)->pluck('id'); 
            $album_folders = $albumType::where('parent_id',$id)->get();
            $get_folder_names=[];
            foreach($album_folders as $folder){
                array_push($get_folder_names,$folder->album_name);
            }
            $album_folders_images = $galleryType::whereIn('album_id', $album_folders_ids)->get();
           // echo sizeof($album_folders_images);
            // dd($get_folder_names);
            // dd($album_folders);
            
           return view('pages.admin.event.album.edit')->with('event_id',$event_id)->with('album',$album)->with('album_folders',$album_folders)->with('album_folders_images',$album_folders_images);
        }else{
           
             $album_folders_images = $galleryType::where('album_id',$id)->get();
             return view('pages.admin.event.album.edit')->with('event_id',$event_id)->with('album',$album)->with('album_folders',$album_folders)->with('album_folders_images',$album_folders_images);
        }

        // return view('pages.admin.event.album.edit')->with('album',Album::find($id));

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
        $album =  Album::find($id);
        $album->event_name=Auth::user()->name;
        $album->album_name=$request->input('album_name');
        $album->timestamp=$request->input('timestamp');
        if($request->hasFile('coverImage'))
        {
            $coverImage = time().'.'.request()->coverImage->getClientOriginalExtension();
            request()->coverImage->move('album_coverImage/', $coverImage);
            $album->coverImage='/album_coverImage/'.$coverImage;
        }
        $album->save();
        return redirect(route('event_admin.album.index'))->with('success','Album Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($event_id,$id)
    {
        // $album =  Album::find($id);
      
       
        // EventImageGallery::where('album_name', $album->album_name)->delete();


        // $album->delete();

        $get_event = Events::where('id',$event_id)->first();

        $albumType = NULL;
             $galleryType = NULL;
             if($get_event->assoc_id != NULL){
                 $albumType= AssociationAlbum::class; 
                 $galleryType=AssociationImageGallery::class;
             }else{
                 $albumType= Album::class;
                 $galleryType=ImageGallery::class;
             }

        $get_album = $albumType::find($id);
        $get_all_folders = $albumType::where('parent_id','=', $id)->pluck('id')->toArray();
        $path  =NULL;
        

        if($get_event->assoc_id != NULL){
            $assoc_type = AssociationType::where('id','=',$get_event->assoc_id )->value('name');
            

            $final_assoc_type=str_replace('_association', '', $assoc_type);
            $path = 'storage/events/association/'. $final_assoc_type.'/'.$get_event->assoc_id.'/'.$event_id.'/media/albums/'.$id;           
        }else{
            $path = 'storage/events/main/'.$event_id.'/media/albums/'.$id;

        }


        if(\File::exists($path))
        {
            \File::deleteDirectory($path);
        }
        
       
        if($get_all_folders){
           
                $galleryType::whereIn('album_id',$get_all_folders)->delete();
            
        }else{
            $galleryType::whereIn('album_id',$id)->delete();
        }

        $albumType::where('parent_id','=', $id)->delete();

        $get_album->delete();
        return redirect()->back()->with('success','Album Deleted Successfully');
  
    }
}

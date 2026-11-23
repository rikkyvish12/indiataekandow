<?php

namespace App\Http\Controllers\Admin\Main;

use App\Models\Album;
use App\Models\ImageGallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Events;
use DB;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.main.album.index')->with('album',Album::where('parent_id',0)->where('status',1)->orderBy('created_at','desc')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all_events = Events::where('assoc_id',NULL)->get();
        return view('pages.admin.main.album.create')->with('all_events',$all_events);
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
        $album->event_name=$request->input('event_name');
        $album->album_name=$request->input('album_name');
        $album->timestamp=$request->input('timestamp');
        if($request->hasFile('coverImage'))
        {
            $coverImage = time().'.'.request()->coverImage->getClientOriginalExtension();
            request()->coverImage->move('album_coverImage/', $coverImage);
            $album->coverImage='/album_coverImage/'.$coverImage;
        }
        $album->save();
        return redirect(route('admin.album.index'))->with('success','Member Added Successfully');
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
        $all_events = Events::where('assoc_id',NULL)->get();
        $album = Album::find($id);
        $album_folders= Null;
        if($album->nested == 1){
            $album_folders_ids = Album::where('parent_id',$id)->pluck('id'); 
            $album_folders = Album::where('parent_id',$id)->get();
            $get_folder_names=[];
            foreach($album_folders as $folder){
                array_push($get_folder_names,$folder->album_name);
            }
            $album_folders_images = DB::table('image_galleries')
            ->whereIn('album_id', $album_folders_ids)
            ->get();
           // echo sizeof($album_folders_images);
            // dd($get_folder_names);
            // dd($album_folders);
           return view('pages.admin.main.album.edit')->with('all_events',$all_events)->with('album',$album)->with('album_folders',$album_folders)->with('album_folders_images',$album_folders_images);
        }else{
           
             $album_folders_images = ImageGallery::where('album_id',$id)->get();
             return view('pages.admin.main.album.edit')->with('all_events',$all_events)->with('album',$album)->with('album_folders',$album_folders)->with('album_folders_images',$album_folders_images);
        }

      

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
        $album->event_name=$request->input('event_name');
        $album->album_name=$request->input('album_name');
        $album->timestamp=$request->input('timestamp');
        if($request->hasFile('coverImage'))
        {
            $coverImage = time().'.'.request()->coverImage->getClientOriginalExtension();
            request()->coverImage->move('album_coverImage/', $coverImage);
            $album->coverImage='/album_coverImage/'.$coverImage;
        }
        $album->save();
        return redirect(route('admin.album.index'))->with('success','Member Updated Successfully');
  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $album =  Album::find($id);
      
       
        // ImageGallery::where('album_name', $album->album_name)->delete();


        // $album->delete();
        $get_album = Album::find($id);
        $get_all_folders = Album::where('parent_id','=', $id)->pluck('id')->toArray();
        $path  =NULL;
        if($get_album->album_type_id == 2){
            $path = 'storage/events/main/'.$get_album->event_id.'/media/albums/'.$id;
        }else{
            $path = 'storage/main/media/albums/'.$id;

        }
       
        if($get_all_folders){
                ImageGallery::whereIn('album_id', $get_all_folders)->delete();
            
        }else{
            ImageGallery::where('album_id',$id)->delete();
        }

        Album::where('parent_id','=', $id)->delete();

        if(\File::exists($path))
        {
            \File::deleteDirectory($path);
        }
        

        $get_album->delete();

        return redirect(route('admin.album.index'))->with('success','Member Deleted Successfully');
  
    }
}

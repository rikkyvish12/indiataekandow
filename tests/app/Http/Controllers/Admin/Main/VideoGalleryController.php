<?php

namespace App\Http\Controllers\Admin\Main;

use App\Models\VideoAlbum;
use App\Models\VideoGallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VideoGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.main.videogallery.index')->with('videos',VideoGallery::orderBy('created_at','desc')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.main.videogallery.create')->with('album',VideoAlbum::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $link = $request->input('link');
      // For videos like http://www.youtube.com/watch/v/..

        // $video_id = explode("&", $video_id[1]); // Deleting any other params
        // $video_id = $video_id[0];

        $video=new VideoGallery;
        $video->youtube_link=$link;
        // $video->youtube_code=$video_id;
        $video->album_name=$request->input('album');

        $video->save();

        return redirect(route('admin.video_gallery.index'))->with('success','Youtube Video Added Successfully');

       
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
        $video = VideoGallery::find($id);
        $album = VideoAlbum::get();
        
        return view('pages.admin.main.videogallery.edit')->with(['video'=> $video, 'album'=>$album]);
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
        // dd($request->all());
        // dd($id);
        $video =  VideoGallery::find($id);
        $video->youtube_link=$request->input('link');
        $video->album_name=$request->input('album');
        $video->save();

        return redirect(route('admin.video_gallery.index'))->with('success','Album Updated Successfully');
  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $album =  VideoGallery::find($id);
      
        $album->delete();
        return redirect(route('admin.video_gallery.index'))->with('success','Album Deleted Successfully');
  
    }
}

<?php

namespace App\Http\Controllers\Admin\Association;

use App\Models\AssociationVideo;
use Illuminate\Http\Request;
use App\Models\AssociationVideoAlbum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.association.videogallery.index')->with('videos',AssociationVideo::orderBy('created_at','desc')->where('state_name','=',Auth::user()->name)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.association.videogallery.create')->with('album',AssociationVideoAlbum::all()->where('state_name','=',Auth::user()->name));
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
        $video_id = explode("?v=", $link); // For videos like http://www.youtube.com/watch?v=...
        if (empty($video_id[1]))
            $video_id = explode("/v/", $link); // For videos like http://www.youtube.com/watch/v/..

        // $video_id = explode("&", $video_id[1]); // Deleting any other params
        $video_id = $video_id[0];

        $video=new AssociationVideo;
        $video->youtube_link=$link;
        $video->youtube_code=$video_id;
        $video->album_name=$request->input('album');
        $video->state_name=Auth::user()->name;

        $video->save();

        return redirect(route('assoc_admin.video_gallery.index'))->with('success','Youtube Video Added Successfully');

       
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
        $video =AssociationVideo::find($id);
        $album = AssociationVideoAlbum::orderBy('created_at','desc')->where('state_name','=',Auth::user()->name)->get();

        return view('pages.admin.association.videogallery.edit',compact('album',$album ,'video',$video));
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
        $video =  AssociationVideo::find($id);
        $link = $request->input('link');
        $video_id = explode("?v=", $link); // For videos like http://www.youtube.com/watch?v=...
        if (empty($video_id[1]))
            $video_id = explode("/v/", $link); // For videos like http://www.youtube.com/watch/v/..

        // $video_id = explode("&", $video_id[1]); // Deleting any other params
        $video_id = $video_id[0];
        $video->youtube_link=$link;
        $video->youtube_code=$video_id;
        $video->album_name=$request->input('album');
        $video->state_name=Auth::user()->name;
           
        $video->save();
        return redirect(route('assoc_admin.video_gallery.index'))->with('success','Album Updated Successfully');
  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video=  AssociationVideo::find($id);
        $video->delete();
        return redirect(route('admin_state.video_gallery.index'))->with('success','Image Deleted Successfully');
    }
}

<?php

namespace App\Http\Controllers\Admin\Events;

use App\Models\EventsVideo;
use Illuminate\Http\Request;
use App\Models\EventsVideoAlbum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EventsVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.event.videogallery.index')->with('videos',EventsVideo::where('event_name','=',Auth::user()->name)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.event.videogallery.create')->with('album',EventsVideoAlbum::where('event_name','=',Auth::user()->name)->get());
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

        $video_id = explode("&", $video_id[1]); // Deleting any other params
        $video_id = $video_id[0];

        $video=new EventsVideo;
        $video->youtube_link=$link;
        $video->youtube_code=$video_id;
        $video->event_name=Auth::user()->name;
        $video->album_name=$request->input('album');

        $video->save();

        return redirect(route('event_admin.video_gallery.index'))->with('success','Youtube Video Added Successfully');

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video=EventsVideo::find($id);
        $video->delete();
        return redirect(route('event_admin.video_gallery.index'))->with('success','Youtube Video Deleted Successfully');

    }
}

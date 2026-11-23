<?php

namespace App\Http\Controllers\Admin\Events;

use App\Models\ImageGallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Album;

class EventAlbumImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('pages.admin.event.imagegallery.index')->with('images',ImageGallery::orderBy('created_at','desc')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.event.imagegallery.create')->with('album',Album::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $image = $request->file('file');

        $imageName = $image->getClientOriginalName();

        $image->move('album_image/', $imageName);

        $imageUpload = new ImageGallery();
        $imageUpload->album_name = $request->input('album');
        $imageUpload->photo = '/album_image/'.$imageName;
        $imageUpload->save();

        return response()->json([
            'status' => 1,
            'photo' => $imageName
        ]);
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
        $imageUpload =  ImageGallery::find($id);
        $imageUpload->delete();
        return redirect(route('admin.image_gallery.index'))->with('success','Image Deleted Successfully');
    }
}

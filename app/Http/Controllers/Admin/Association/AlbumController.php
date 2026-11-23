<?php

namespace App\Http\Controllers\Admin\Association;

use App\Models\AssociationAlbum;
use App\Models\ImageGallery;
use Illuminate\Http\Request;
use App\Models\AssociationImageGallery;
use App\Models\AssociationEvent;
use App\Models\Events;
use App\Models\Association;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($assoc_id)
    {
        $album= AssociationAlbum::where('parent_id',0)->where('assoc_id',$assoc_id)->where('status',1)->orderBy('created_at','desc')->get();
        return view('pages.admin.association.album.index')
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
        return view('pages.admin.association.album.create')->with('assoc_id',$assoc_id)->with('all_events',$all_events);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $album = new AssociationAlbum;
        $album->state_name=Auth::user()->name;
        $album->album_name=$request->input('album_name');
        $album->timestamp=$request->input('timestamp');
        if($request->hasFile('coverImage'))
        {
            $coverImage = time().'.'.request()->coverImage->getClientOriginalExtension();
            request()->coverImage->move('album_coverImage/', $coverImage);
            $album->coverImage='/album_coverImage/'.$coverImage;
        }
        $album->save();
        return redirect(route('assoc_admin.album_image.index'))->with('success','Album Added Successfully');
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
        $all_events = Events::where('assoc_id',$assoc_id)->get();
        $album = AssociationAlbum::find($id);
        $album_folders= Null;
        if($album->nested == 1){
            $album_folders_ids = AssociationAlbum::where('parent_id',$id)->pluck('id'); 
            $album_folders = AssociationAlbum::where('parent_id',$id)->get();
            $get_folder_names=[];
            foreach($album_folders as $folder){
                array_push($get_folder_names,$folder->album_name);
            }
            $album_folders_images = AssociationImageGallery::whereIn('album_id', $album_folders_ids)->get();
           // echo sizeof($album_folders_images);
            // dd($get_folder_names);
            // dd($album_folders);
           return view('pages.admin.association.album.edit')->with('assoc_id',$assoc_id)->with('all_events',$all_events)->with('album',$album)->with('album_folders',$album_folders)->with('album_folders_images',$album_folders_images);
        }else{
           
             $album_folders_images = AssociationImageGallery::where('album_id',$id)->get();
             return view('pages.admin.association.album.edit')->with('assoc_id',$assoc_id)->with('all_events',$all_events)->with('album',$album)->with('album_folders',$album_folders)->with('album_folders_images',$album_folders_images);
        }


        // return view('pages.admin.association.album.edit')->with('album',AssociationAlbum::find($id));

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
        $album =  AssociationAlbum::find($id);
        $album->album_name=$request->input('album_name');
        $album->timestamp=$request->input('timestamp');
        if($request->hasFile('coverImage'))
        {
            $coverImage = time().'.'.request()->coverImage->getClientOriginalExtension();
            request()->coverImage->move('album_coverImage/', $coverImage);
            $album->coverImage='/album_coverImage/'.$coverImage;
        }
        $album->save();
        return redirect(route('assoc_admin.album_image.index'))->with('success','Album Updated Successfully');
  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($assoc_id,$id)
    {
        // $album =  AssociationAlbum::find($id);
      
       
        // AssociationImageGallery::where('album_name', $album->album_name)->delete();


        // $album->delete();

        $get_album = AssociationAlbum::find($id);
        $get_all_folders = AssociationAlbum::where('parent_id','=', $id)->pluck('id')->toArray();
        $path  =NULL;
        if($get_album->album_type_id == 2){
            $path = 'storage/events/association/'. $final_assoc_type.'/'.$assoc_id.'/'.$get_folder->event_id.'/media/albums/'.$id;
          
        }else{
            $path = 'storage/association/'.$final_assoc_type.'/'.$assoc_id.'/media/albums/'.$id;

        }
        if(\File::exists($path))
        {
            \File::deleteDirectory($path);
        }
        
       
        if($get_all_folders){
            AssociationImageGallery::whereIn('album_id',$get_all_folders)->delete();
            
        }else{
            AssociationImageGallery::where('album_id',$id)->delete();
        }

        AssociationAlbum::where('parent_id','=', $id)->delete();

        $get_album->delete();

        return redirect()->back()->with('success','Album Deleted Successfully')->with('assoc_id',$assoc_id);
  
    }
}

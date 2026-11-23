<?php

namespace App\Http\Controllers\Admin\Events;

use App\Models\Album;
use App\Models\ImageGallery;


use App\Models\AssociationAlbum;
use App\Models\AssociationImageGallery;

use App\Models\EventImageGallery;
use App\Models\EventAlbum;

use App\Models\AssociationType;
use App\Models\Events;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EventImageGalleryController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('pages.admin.event.imagegallery.index')->with('images',EventImageGallery::orderBy('created_at','desc')->where('event_name','=',Auth::user()->name)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.event.imagegallery.create')->with('album',EventAlbum::all()->where('event_id','=',Auth::user()->id));
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

        $image->move('event_album_image/', $imageName);

        $imageUpload = new EventImageGallery();
        $imageUpload->event_name = Auth::user()->name;
        $imageUpload->album_name = $request->input('album');
        $imageUpload->image = '/event_album_image/'.$imageName;
        $imageUpload->save();

        return response()->json([
            'status' => 1,
            'image' => $imageName
        ]);
    }
    public function createNewImageAlbumEvent(Request $request){
    
        try{
        //  dd($request->all());
        if($request->file('file') && $request->input('files_info')){
         $images = $request->file('file');  
         $file_details_object = $request->input('files_info');  
         $file_details = json_decode($file_details_object,true); 
         //  $images_count = sizeof($images);
        }
  
        // $event_id =  $request->input('event_id'); 
        

        $event_id =  $request->input('event_id');  
        $album_name =  $request->input('album_name');
        $date_time =  $request->input('date_time');
        $assoc_type = NULL;
        $album_is_saved = false;
        $video_is_saved = false;
        $cover_image_file =  $request->input('cover_image_file');  
        $folders_info =  json_decode($request->input('folders_info'),true);  

        $get_event = Events::where('id',$event_id)->first();

        $destination_path = NULL;    
        $albumType = NULL;
        $galleryType = NULL;
        $assoc_id =null;
        if($get_event->assoc_id != NULL){
            $assoc_type = AssociationType::where('id','=',$get_event->assoc_id )->value('name');
            $final_assoc_type = str_replace('_association', '', $assoc_type);
            $destination_path = 'storage/events/association/'. $final_assoc_type.'/'.$get_event->assoc_id.'/'.$event_id.'/media/albums/';    
            $albumType= AssociationAlbum::class; 
            $galleryType=AssociationImageGallery::class;
            $assoc_id=$get_event->assoc_id ;
       
        }else{
            $destination_path = 'storage/events/main/'.$event_id.'/media/albums/';
            $albumType= Album::class;
            $galleryType=ImageGallery::class;
        }
       
        // $album_type = $request->input('album_type');
        // if( $album_type ==="1"){
       
        $new_album  = new  $albumType;
        $new_album->event_id=$event_id;
        $new_album->parent_id=0;
        $new_album->album_name=$album_name;
        $new_album->album_type_id=2;     
        if($albumType ==AssociationAlbum::class)   
         $new_album->assoc_id=$assoc_id;
        
        $new_album->coverImage=$album_name;
        $new_album->timestamp=$date_time;
        $new_album->created_at=\Carbon\Carbon::now();

        $new_album->save();
       // $album = Album::find($new_album->id);
        if($request->hasFile('cover_image_file'))
        {
            $cover_image = 'cover_image.'.request()->cover_image_file->getClientOriginalExtension();
            request()->cover_image_file->move($destination_path.$new_album->id.'/', $cover_image);
            $new_album->coverImage='/'.$destination_path.$new_album->id.'/'.$cover_image;
        }
        if(sizeof($folders_info)>0){
         $new_album->nested=1;
        }
        $new_album->save();
     
        if(sizeof($folders_info)>0){
        if($request->file('file') && $request->input('files_info') && $request->input('folders_info')){
         foreach($folders_info as $folder_info){
             // save the folder here
             $new_album_folder = new $albumType;
             
             if($albumType ==AssociationAlbum::class)   
             $new_album_folder->assoc_id=$assoc_id;
           
             $new_album_folder->album_type_id=2;
             $new_album_folder->event_id=$event_id;
             $new_album_folder->parent_id=$new_album->id;
             $new_album_folder->album_name=$folder_info['folder_name'];
           //  $new_album_folder->coverImage=$album_type;
             $new_album_folder->timestamp=$date_time;
             $new_album_folder->save();
             
            
             foreach($file_details as $file_detail){
              if($file_detail['folder_id'] == $folder_info['folder_id']){
                 
                 foreach($images as $image){
                   //  echo $folder_info['folder_id'].'_'.$image->getClientOriginalName().'=='.$file_detail['name'].'========'.$folder_info['folder_id'].'_'.$image->getClientOriginalName() == $file_detail['name'].'\n';
                     if($image->getClientOriginalName() == $file_detail['name']){          
                       // $new_album_folder->id;  // move location to images table;
                        $filename =  $image->getClientOriginalName();
                        // $destination_path = $destination_path.'/'.$new_album->id.'/'.$new_album_folder->id;
                        $image_gallery = new $galleryType;
                        // $image_gallery->event_id=$event_id;

                        $image_gallery->album_id = $new_album_folder->id;
                        $image_gallery->image_path = '/'.$destination_path.$new_album->id.'/'.$new_album_folder->id.'/'.$filename;
                       
                      //  echo public_path().$destination_path.'/',$filename;
                        try{
                            if(!\File::exists($destination_path.$new_album->id.'/'.$new_album_folder->id)) {
                                \File::makeDirectory( $destination_path.$new_album->id.'/'.$new_album_folder->id, 0777, true, true);
                            }
                             $image->move($destination_path.$new_album->id.'/'.$new_album_folder->id.'/',$filename);
                           
                         }catch(Exception $e) {
                            echo "Error:".$filename;
                        }
     
                        $image_gallery->save();
     
                     }
                 }
               }
             }
         }
             $new_album->status = 1;
             $new_album->save();
             $final['status']="success";
             return json_encode($final);
          
        }
     }else{
         foreach($images as $image){
             //  echo $folder_info['folder_id'].'_'.$image->getClientOriginalName().'=='.$file_detail['name'].'========'.$folder_info['folder_id'].'_'.$image->getClientOriginalName() == $file_detail['name'].'\n';
     
                 // $new_album_folder->id;  // move location to images table;
                  $filename =  $image->getClientOriginalName();
                //   $destination_path = $destination_path.'/'.$new_album->id;
                  $image_gallery = new $galleryType;
                //   $image_gallery->event_id=$event_id;
                  $image_gallery->album_id = $new_album->id;
                  $image_gallery->image_path = '/'.$destination_path.$new_album->id.'/'.$filename;
                 
                //  echo public_path().$destination_path.'/',$filename;
                  try{
                    if(!\File::exists($destination_path.$new_album->id).'/') {
                        \File::makeDirectory( $destination_path.$new_album->id.'/', 0777, true, true);
                    }
                       $image->move($destination_path.$new_album->id.'/',$filename);
                     
                   }catch(Exception $e) {
                      echo "Error:".$filename;
                  }
     
                  $image_gallery->save();
     
               
           }
           $new_album->status = 1;
           $new_album->save();
           $final['status']="success";
           return json_encode($final);
     }
        }catch(Exception $e) {
         $final['status']="unsuccess";
         return json_encode($final);
       }
     
        
     }
     
     public function deleteSelectedAlbumImages(Request $request){
        //  dd($request->all());
         try{
             $allCheckedImagesIds =  json_decode($request->input('allCheckedImagesIds'),true); 

             $get_event = Events::where('id',$request->input('event_id'))->first();

             $galleryType = NULL;
             $assoc_id =null;
             if($get_event->assoc_id != NULL){
                 $galleryType=AssociationImageGallery::class;
             }else{
                 $galleryType=ImageGallery::class;
             }

             foreach($allCheckedImagesIds as $ImagesId){
             
                 $image_row = $galleryType::find($ImagesId);
                 $path = $image_row->image_path;
                    $path = ltrim($path, '/');
                    //  dd($path);
                    if(\File::exists($path))
                    {
                        // echo" if";
                        // dd($path);
                        \File::delete($path);  
                    }
                     if($image_row){
                         $image_row->delete();
                         // dd($path);               
                     }
                     
             }
             if($request->input('folder_name')){
                 $final['folder_name']=$request->input('folder_name');
             }
             $final['status']="success";
             return json_encode($final);
         }catch(Exception $e) {
             $final['status']="error";
             return json_encode($final);
         }
     
     
     }
     public function renameSelectedFolder(Request $request){
        //  dd($request->all());
      try{
         $folder_name =  $request->input('folder_name');
         $folder_id =  $request->input('folder_id');

         $get_event = Events::where('id',$request->input('event_id'))->first();

         $albumType = NULL;
         $assoc_id =null;
         if($get_event->assoc_id != NULL){
             $albumType= AssociationAlbum::class; 
         }else{
             $albumType= Album::class;
         }

     
         $get_folder= $albumType::find($folder_id);
     
         if($get_folder){
             // dd($get_folder);
             $get_folder->album_name = $folder_name;
             $get_folder->save();
             $final['status']="success";
             $final['folder_id'] = $folder_id;
            
     
         }else{
             $final['status']="unsuccess";
         }
         return json_encode($final);
        
        
     }catch(Exception $e) {
         $final['status']="error";
         return json_encode($final);
     }
     
     
     }
     
     public function deleteSelectedFolder(Request $request){
         try{
            //  dd($request->all());
            $event_id =$request->input('event_id');
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


             $folder_id =  $request->input('folder_id');
             $assoc_id =  $request->input('assoc_id');

             $get_folder= $albumType::find($folder_id);
            //  dd($get_folder);

             $folder_name= $get_folder->album_name;           
     
             $get_main_album_id = $get_folder->parent_id;


             $path =NULL;
            //  if($get_folder->event_id == NULL){
            //     $path = 'storage/association/'.$assoc_id.'/media/albums/general/'.$get_main_album_id .'/'.$folder_id;
            //  }else{
            //     $path = 'storage/association/'.$assoc_id.'/media/albums/event/'.$get_folder->event_id.'/'.$get_main_album_id .'/'.$folder_id;
            //  }


            if($get_event->assoc_id != NULL){
                $assoc_type = AssociationType::where('id','=',$get_event->assoc_id )->value('name');
                

                $final_assoc_type=str_replace('_association', '', $assoc_type);
                $path = 'storage/events/association/'. $final_assoc_type.'/'.$get_event->assoc_id.'/'.$event_id.'/media/albums/'.$get_main_album_id .'/'.$folder_id;;           
            }else{
                $path = 'storage/events/main/'.$event_id.'/media/albums/'.$get_main_album_id .'/'.$folder_id;

            }
                    
             
    //  dd($path);
                        $get_images= $galleryType::where('album_id','=',$folder_id)->get();
                        // dd($get_images);

                        if($get_images){
                        $get_images->each->delete(); 
                    }

                    if($get_folder){
                        $get_folder->delete();
                        // dd($path);               
                    }
                    
                     if(\File::exists($path))
                    {
                     \File::deleteDirectory($path);
                     }
          
                     
            
             $final['status']="success";
             $final['folder_name']=$folder_name;
     
             return json_encode($final);
            
            
         }catch(Exception $e) {
             $final['status']="error";
             return json_encode($final);
         }
         
     }

     public function updateSelectedImageAlbumDetails(Request $request){
        try{

            
            $date_time =  $request->input('date_time');
            $event_id =  $request->input('event_id');
            $selected_album_id = $request->input('selected_album_id');

            $get_event = Events::where('id',$event_id)->first();

            $albumType = NULL;
            $galleryType = NULL;
            $assoc_id =null;

            if($get_event->assoc_id != NULL){
                $albumType= AssociationAlbum::class; 
                $galleryType=AssociationImageGallery::class;
                $assoc_id=$get_event->assoc_id;
            }else{
                $albumType= Album::class;
                $galleryType=ImageGallery::class;
            }

            $edit_album =  $albumType::find($selected_album_id);
            $edit_album->album_name=$request->input('album_name_input');            
            $edit_album->timestamp=$request->input('date_time');
            $edit_album->updated_at=\Carbon\Carbon::now();
            $edit_album->save();

         
     
        
            $destination_path = NULL;
            
            if($get_event->assoc_id != NULL){
                $assoc_type = AssociationType::where('id','=',$get_event->assoc_id )->value('name');
                

                $final_assoc_type=str_replace('_association', '', $assoc_type);
                $destination_path = 'storage/events/association/'. $final_assoc_type.'/'.$get_event->assoc_id.'/'.$event_id.'/media/albums/';           
            }else{
                $destination_path = 'storage/events/main/'.$event_id.'/media/albums/';

            }

            // dd($edit_album);
          
            if($request->hasFile('cover_image_file'))
            {
                $cover_image = 'cover_image.'.request()->cover_image_file->getClientOriginalExtension();
                request()->cover_image_file->move($destination_path.$edit_album->id.'/', $cover_image);
                $edit_album->coverImage='/'.$destination_path.$edit_album->id.'/'.$cover_image;
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
    public function uploadMoreImagesAndFoldersEvents(Request $request)
    {
        try{
            // dd($request->all());
           if($request->file('file') && $request->input('files_info')){
            $images = $request->file('file');  
            $file_details_object = $request->input('files_info');  
            $file_details = json_decode($file_details_object,true); 
            //  $images_count = sizeof($images);
           }
          
          
           $main_album_id =  $request->input('main_album_id');
           $event_id =  $request->input('event_id');
           $destination_path= NULL;
         
           $folders_info =  json_decode($request->input('folders_info'),true);  
        

           $get_event = Events::where('id',$event_id)->first();

           $albumType = NULL;
           $galleryType = NULL;
           $assoc_id =null;

           if($get_event->assoc_id != NULL){
               $albumType= AssociationAlbum::class; 
               $galleryType=AssociationImageGallery::class;
               $assoc_id=$get_event->assoc_id;
           }else{
               $albumType= Album::class;
               $galleryType=ImageGallery::class;
           }

           $new_album = $albumType::find($main_album_id);

        
           $destination_path = NULL;
           
           if($get_event->assoc_id != NULL){
               $assoc_type = AssociationType::where('id','=',$get_event->assoc_id )->value('name');
               

               $final_assoc_type=str_replace('_association', '', $assoc_type);
               $destination_path = 'storage/events/association/'. $final_assoc_type.'/'.$get_event->assoc_id.'/'.$event_id.'/media/albums/';           
           }else{
               $destination_path = 'storage/events/main/'.$event_id.'/media/albums/';

           }
         
        
           if(sizeof($folders_info)>0){
           if($request->file('file') && $request->input('files_info') && $request->input('folders_info')){
            foreach($folders_info as $folder_info){
                $album_folder_id = null;
                if($folder_info['exist'] == 1){
                    $album_folder_id =$folder_info['folder_id'];
                }else{
                    $new_album_folder = new $albumType;
                    // $new_album_folder->album_type_id=$new_album->album_type_id;
                    $new_album_folder->event_id=$new_album->event_id;
                if($albumType ==AssociationAlbum::class)   
                    $new_album_folder->assoc_id=$assoc_id;
                    $new_album_folder->parent_id=$new_album->id;
                    $new_album_folder->album_name=$folder_info['folder_name'];
                  //  $new_album_folder->coverImage=$album_type;
                    $new_album_folder->timestamp=$new_album->timestamp;
                    $new_album_folder->save();

                    $album_folder_id= $new_album_folder->id;
                }
                // save the folder here
             
                
               
                foreach($file_details as $file_detail){
                 if($file_detail['folder_id'] == $folder_info['folder_id']){
                    
                    foreach($images as $image){
                      //  echo $folder_info['folder_id'].'_'.$image->getClientOriginalName().'=='.$file_detail['name'].'========'.$folder_info['folder_id'].'_'.$image->getClientOriginalName() == $file_detail['name'].'\n';
                        if($image->getClientOriginalName() == $file_detail['name']){          
                          // $new_album_folder->id;  // move location to images table;
                           $filename =  $image->getClientOriginalName();
                        //    $destination_path = 'storage/association/state/'.$assoc_id.'/media/albums/'.$new_album->id.'/'.$album_folder_id;
                           $image_gallery = new $galleryType;
                           $image_gallery->album_id = $album_folder_id;
                           $image_gallery->image_path = '/'.$destination_path.$new_album->id.'/'.$album_folder_id.'/'.$filename;
                          
                         //  echo public_path().$destination_path.'/',$filename;
                           try{
                                $image->move($destination_path.$new_album->id.'/'.$album_folder_id.'/',$filename);
                              
                            }catch(Exception $e) {
                               echo "Error:".$filename;
                           }
        
                           $image_gallery->save();
        
                        }
                    }
                  }
                }
            }
                $new_album->status = 1;
                $new_album->save();
                $final['status']="success";
                return json_encode($final);
             
           }
        }else{
// dd($images);
            foreach($images as $image){
                //  echo $folder_info['folder_id'].'_'.$image->getClientOriginalName().'=='.$file_detail['name'].'========'.$folder_info['folder_id'].'_'.$image->getClientOriginalName() == $file_detail['name'].'\n';
        
                    // $new_album_folder->id;  // move location to images table;
                     $filename =  $image->getClientOriginalName();
                    //  $destination_path = 'storage/association/state/'.$assoc_id.'/media/albums/'.$new_album->id;
                     $image_gallery = new $galleryType;
                     $image_gallery->album_id = $new_album->id;
                     $image_gallery->event_id=$event_id;
                     $image_gallery->image_path = '/'.$destination_path.$new_album->id.'/'.$filename;
                    
                   //  echo public_path().$destination_path.'/',$filename;
                     try{
                          $image->move($destination_path.$new_album->id.'/',$filename);
                        
                      }catch(Exception $e) {
                         echo "Error:".$filename;
                     }
        
                     $image_gallery->save();
        
                  
              }
              
              $final['status']="success";
              return json_encode($final);
         
        }
           }catch(Exception $e) {
            $final['status']="unsuccess";
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
    public function destroy($event_id,$id)
    {
        $get_event = Events::where('id',$event_id)->first();

        $galleryType = NULL;
        if($get_event->assoc_id != NULL){
            $galleryType=AssociationImageGallery::class;
        }else{
            $galleryType=ImageGallery::class;
        }


        $imageUpload =  $galleryType::find($id);
        $imageUpload->delete();
        return redirect(route('admin.image_gallery.index'))->with('success','Image Deleted Successfully');
    }
}

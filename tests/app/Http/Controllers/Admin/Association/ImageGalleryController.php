<?php

namespace App\Http\Controllers\Admin\Association;
use App\Models\Association;
use App\Models\AssociationAlbum;
use App\Models\Events;
use Illuminate\Http\Request;
use App\Models\AssociationImageGallery;
use App\Models\AssociationType;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ImageGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('pages.admin.association.imagegallery.index')->with('images',AssociationImageGallery::orderBy('created_at','desc')->where('state_name','=',Auth::user()->name)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.association.imagegallery.create')->with('album',AssociationAlbum::all()->where('state_name','=',Auth::user()->name));
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

        $imageUpload = new AssociationImageGallery();
        $imageUpload->album_name = $request->input('album');
        $imageUpload->photo = '/album_image/'.$imageName;
        $imageUpload->save();

        return response()->json([
            'status' => 1,
            'photo' => $imageName
        ]);
    }
    public function createNewImageAlbum(Request $request){
    
        try{
        //  dd($request->all());
        if($request->file('file') && $request->input('files_info')){
         $images = $request->file('file');  
         $file_details_object = $request->input('files_info');  
         $file_details = json_decode($file_details_object,true); 
         //  $images_count = sizeof($images);
        }
  
        $event_id =  $request->input('event_id');  
        $assoc_id =  $request->input('assoc_id');  
        $album_name =  $request->input('album_name');

        $assoc = Association::where('id',$assoc_id)->first();
        $assoc_type = AssociationType::where('id','=',$assoc->assoc_type_id )->value('name');
        $final_assoc_type = str_replace('_association', '', $assoc_type);



        $album_type = 1;  
        $destination_path = 'storage/association/'.$final_assoc_type.'/'.$assoc_id.'/media/albums/';
        $date_time =  $request->input('date_time');  
        $cover_image_file =  $request->input('cover_image_file');  
        $folders_info =  json_decode($request->input('folders_info'),true); 


        if($event_id != null){
           // $album_name = Events::where('id',$event_id)->pluck('title')[0];
            $album_type = 2;
           
            $destination_path = 'storage/events/association/'. $final_assoc_type.'/'.$assoc_id.'/'.$event_id.'/media/albums/';   

        }
       
     
        $new_album = new AssociationAlbum;
        $new_album->album_type_id=$album_type;
        $new_album->event_id=$event_id;
        $new_album->parent_id=0;
        $new_album->album_name=$album_name;
        $new_album->assoc_id=$assoc_id;
        $new_album->coverImage=$album_type;
        $new_album->timestamp=$date_time;
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
             $new_album_folder = new AssociationAlbum;
             $new_album_folder->album_type_id=$album_type;
             $new_album_folder->event_id=$event_id;
             $new_album_folder->assoc_id=$assoc_id;
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
                        $image_gallery = new AssociationImageGallery;

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
                  $image_gallery = new AssociationImageGallery;
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
         // dd($request->all());
         try{
             $allCheckedImagesIds =  json_decode($request->input('allCheckedImagesIds'),true);  
     
             foreach($allCheckedImagesIds as $ImagesId){
             
                 $image_row = AssociationImageGallery::find($ImagesId);
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
         // dd($request->all());
      try{
         $folder_name =  $request->input('folder_name');
         $folder_id =  $request->input('folder_id');
     
         $get_folder= AssociationAlbum::find($folder_id);
     
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
             // dd($request->all());
             $folder_id =  $request->input('folder_id');
             $assoc_id =  $request->input('assoc_id');
             $get_folder= AssociationAlbum::find($folder_id);
             $folder_name= $get_folder->album_name;
     
             $get_main_album_id = $get_folder->parent_id;
             $assoc = Association::where('id',$assoc_id)->first();
             $assoc_type = AssociationType::where('id','=',$assoc->assoc_type_id )->value('name');
             $final_assoc_type = str_replace('_association', '', $assoc_type);

             $path =NULL;
             if($get_folder->event_id == NULL){
                $path = 'storage/association/'.$final_assoc_type.'/'.$assoc_id.'/media/albums/'.$get_main_album_id .'/'.$folder_id;
             }else{
               
                $path =  'storage/events/association/'. $final_assoc_type.'/'.$assoc_id.'/'.$get_folder->event_id.'/media/albums/'.$get_main_album_id .'/'.$folder_id;
             }
            
             
    //  dd($path);
                     if(\File::exists($path))
                    {
                     \File::deleteDirectory($path);
                     }
          
                     if($get_folder){
                        $get_folder->delete();
                        // dd($path);               
                    }

                    $get_images= AssociationImageGallery::where('album_id','=',$folder_id)->get();
                    // dd($get_images);
                    if($get_images){
                        $get_images->each->delete(); 
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
            $assoc_id =  $request->input('assoc_id');
            $album_type = $request->input('album_type');
            $event_id = null; 
            $selected_album_id = $request->input('selected_album_id');
            $edit_album =  AssociationAlbum::find($selected_album_id);
            $from = NULL;
            $to = NULL;
            $type_changed=false;
            if($edit_album->album_type_id != $album_type ){
      
                $type_changed = true;
            }
            
            // dd($edit_album);
            $destination_path =NULL;

                
            $assoc = Association::where('id',$assoc_id)->first();
            $assoc_type = AssociationType::where('id','=',$assoc->assoc_type_id )->value('name');
            $final_assoc_type = str_replace('_association', '', $assoc_type);

          
          
            if( $album_type ==="1"){
                $album_name = $request->input('album_name_input');
                $edit_album->album_type_id=$album_type;
                $edit_album->album_name=$album_name;
                

                $destination_path = 'storage/association/'.$final_assoc_type.'/'.$assoc_id.'/media/albums/';
                    if($type_changed == true){
                        $check_for_folders =   AssociationAlbum::where('parent_id' ,'=',$edit_album->id)->pluck('id')->toArray();
                   
                        // dd(gettype($check_for_folders));
                        
                        if($check_for_folders){
                            $final_object= AssociationImageGallery::whereIn('album_id',$check_for_folders)->get();
                        }else{
                            // dd("else");
                            $final_object = AssociationImageGallery::where('album_id',$edit_album->id)->get();
                        }
                        
    
                        
                     foreach($final_object as $value){                  
                            $get_entry = AssociationImageGallery::where('id','=',$value['id'])->first();   
                            // $check_path = str_replace('events/association/'. $final_assoc_type.'/'.$assoc_id.'/'.$edit_album->event_id.'/','association/'.$final_assoc_type.'/'.$assoc_id.'/', $value['image_path']);                
                            // dd('events/association/'. $final_assoc_type.'/'.$assoc_id.'/'.$edit_album->event_id.'/');
                            $get_entry->image_path=  str_replace('events/association/'. $final_assoc_type.'/'.$assoc_id.'/'.$edit_album->event_id.'/','association/'.$final_assoc_type.'/'.$assoc_id.'/', $value['image_path']);
                            $get_entry->save();
                        }

                            $from = 'storage/events/association/'. $final_assoc_type.'/'.$assoc_id.'/'.$edit_album->event_id.'/media/albums/'.$edit_album->id.'/';
                            $to =  'storage/association/'.$final_assoc_type.'/'.$assoc_id.'/media/albums/'.$edit_album->id.'/';

                            // dd($from);
                            if(!\File::exists($to)) {
                                \File::makeDirectory( $to, 0777, true, true);
                            }
                            \File::copyDirectory($from,$to);

                            if(\File::exists($from))
                            {
                            \File::deleteDirectory($from);
                            }
                            
                            $edit_album->coverImage	=  '/'.$to.'cover_image.jpg';

                    }
                    $edit_album->event_id=$event_id;
                    AssociationAlbum::where('parent_id' ,'=',$edit_album->id)->update(['event_id' => $event_id]);

            }else if($album_type ==="2"){
                $event_id= $request->input('event_id');
                $album_name = $request->input('album_name_input');
                $edit_album->album_type_id=$album_type;
                $edit_album->event_id=$event_id;
                $edit_album->album_name=$album_name;
                $destination_path= 'storage/events/association/'. $final_assoc_type.'/'.$assoc_id.'/'.$event_id.'/media/albums/';
                $final_object =[];
                $check_for_folders = null;
                $count = 0;

                
                if($type_changed == true){
                   
                    $check_for_folders =   AssociationAlbum::where('parent_id' ,'=',$edit_album->id)->pluck('id')->toArray();
                   
                    // dd(gettype($check_for_folders));
                    
                    if($check_for_folders){
                        $final_object= AssociationImageGallery::whereIn('album_id',$check_for_folders)->get();
                    }else{
                        // dd("else");
                        $final_object = AssociationImageGallery::where('album_id',$edit_album->id)->get();
                    }
                    

                   
                 foreach($final_object as $value){                  
                        $get_entry = AssociationImageGallery::where('id','=',$value['id'])->first();                   
                        $get_entry->image_path=  str_replace('association/'.$final_assoc_type.'/'.$assoc_id, 'events/association/'. $final_assoc_type.'/'.$assoc_id.'/'.$event_id, $value['image_path']);
                        $get_entry->save();
                    }
                    $from = 'storage/association/'.$final_assoc_type.'/'.$assoc_id.'/media/albums/'.$edit_album->id.'/';
            
                    $to =   'storage/events/association/'. $final_assoc_type.'/'.$assoc_id.'/'.$edit_album->event_id.'/media/albums/'.$edit_album->id.'/';
                    if(!\File::exists($to)) {
                        \File::makeDirectory( $to, 0777, true, true);
                    }
                    \File::copyDirectory($from,$to);
                    if(\File::exists($from))
                    {
                    \File::deleteDirectory($from);
                    }
                     $edit_album->coverImage =  '/'.$to.'cover_image.jpg';
                }
                AssociationAlbum::where('parent_id' ,'=',$edit_album->id)->update(['event_id' => $event_id]);

            }


            $edit_album->timestamp=$date_time;
    
            if($request->hasFile('cover_image_file') && $type_changed == false)
            {
               if(\File::exists($edit_album->coverImage))
                {
                    \File::delete($edit_album->coverImage);  
                }
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
    public function uploadMoreImagesAndFoldersAssoc(Request $request)
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
           $assoc_id =  $request->input('assoc_id');
           $destination_path= NULL;
         
           $folders_info =  json_decode($request->input('folders_info'),true);  

           $assoc = Association::where('id',$assoc_id)->first();
           $assoc_type = AssociationType::where('id','=',$assoc->assoc_type_id )->value('name');
           $final_assoc_type = str_replace('_association', '', $assoc_type);

          $new_album = AssociationAlbum::find($main_album_id);
          if($new_album->event_id == NULL){
            
            $destination_path = 'storage/association/'.$final_assoc_type.'/'.$assoc_id.'/media/albums/';
         }else{            
            $destination_path = 'storage/events/association/'. $final_assoc_type.'/'.$assoc_id.'/'.$new_album->event_id .'/media/albums/'; 
         }
         
        
           if(sizeof($folders_info)>0){
           if($request->file('file') && $request->input('files_info') && $request->input('folders_info')){
            foreach($folders_info as $folder_info){
                $album_folder_id = null;
                if($folder_info['exist'] == 1){
                    $album_folder_id =$folder_info['folder_id'];
                }else{
                    $new_album_folder = new AssociationAlbum;
                    $new_album_folder->album_type_id=$new_album->album_type_id;
                    $new_album_folder->event_id=$new_album->event_id;
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
                           $image_gallery = new AssociationImageGallery;
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
                     $image_gallery = new AssociationImageGallery;
                     $image_gallery->album_id = $new_album->id;
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
    public function destroy($id)
    {
        $imageUpload =  AssociationImageGallery::find($id);
        $imageUpload->delete();
        return redirect(route('admin_state.image_gallery.index'))->with('success','Image Deleted Successfully');
    }
}

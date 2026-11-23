@extends('layouts.admin.admin')

<script>
   function manageAlbumType(){
       var user_type = $("#album_type").val();
       if(user_type == 1){
          $("#event_selection").hide();
          $("#album_name").show();
          $(".album_name").attr('disabled',false)
         
           //  $(".validate_album_name").hide();
          $('#album_name_input').val("").addClass('edit_album_require')
          $('#event_id').val("").trigger('change').removeClass('edit_album_require')

          
      }else if(user_type == 2){
          $("#event_selection").show();
        //  $("#album_name").hide();
         // $(".album_name").attr('disabled',false)
         
           $(".validate_event_id").hide();

          $('#event_id').val("").trigger('change').addClass('edit_album_require')          
        //  $('#album_name_input').val("").removeClass('edit_album_require')

      }else{
        $(".album_name").attr('disabled',true)
        $(".validate_event_id").show();
        $(".validate_album_name").show();

        $('#event_id').val("").trigger('change').removeClass('edit_album_require')
        $('#album_name_input').val("").removeClass('edit_album_require')

      } 
      
   }
   </script>


@section('content')
<div id="content" class="main-content">
    <div class="container">
<br><br>
        <div class="container">
            <div class="row layout-top-spacing">
                <div id="basic" class="col-lg-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Edit Album</h4>
                                </div>                 
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                        <div class="row">
                                <div class="col-lg-12 col-12 mx-auto">
                                  @if($album_folders)
                                      <button type="button"  style="display:none"  onclick="addAllFoldersNameToArray('{{($album_folders)}}')" id="addAllFoldersNameToArrayButton">click-me</button>
                                  @else
                                      <button type="button"  style="display:none"  onclick="" id="addAllFoldersNameToArrayButton">click-me</button>
                                  @endif
                                    <!-- <form method="post" action="{{ route('admin.album.update',$album->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        {{ method_field('PUT') }}
                                        <div class="form-group">
                                            <p>Event Name</p>
                                            <input  type="text" name="event_name" value="{{ $album->event_name }}" id="event_name" placeholder="Event Name" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <p>Album Name</p>
                                            <input  type="text" name="album_name" value="{{ $album->album_name }}" id="album_name" placeholder="Album Name" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <p>Date and Time</p>
                                            <input  type="datetime-local" name="timestamp" value="{{ $album->timestamp }}" id="timestamp" placeholder="Date and Time" class="form-control" required>
                                        </div>
                                        <div class="custom-file mb-4">
                                            <input type="file" class="custom-file-input" id="imgInp" name="coverImage" >
                                            <label class="custom-file-label" for="customFile">Choose Cover Image file</label>
                                            <br><br>
                                            <img src="{{ $album->coverImage }}" style="max-width: 100%" alt="">
                                        </div>
                                       
                                        <button type="submit" class="btn btn-primary" style="margin: 10px">Submit</button>
                                    </form> -->
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                        <a class="nav-link active" id="product-tab" data-toggle="tab" href="#product-info" role="tab" aria-controls="product-info" aria-selected="true">Album-Details</a>
                                        </li>
                                        <!-- <li class="nav-item">
                                        <a class="nav-link" id="edit-cover-image-tab" data-toggle="tab" href="#edit-cover-image" role="tab" aria-controls="edit-cover-image-tab" aria-selected="false">Edit Album Cover </a>
                                        </li> -->
                                        <li class="nav-item">
                                        <a class="nav-link" id="edit-images-tab" data-toggle="tab" href="#edit-images" role="tab" aria-controls="edit-images-tab" aria-selected="false">Edit-Images-And-Folders</a>
                                        </li>
                                        <li class="nav-item">
                                        <a class="nav-link" id="edit-images-tab" data-toggle="tab" href="#new-images" role="tab" aria-controls="edit-images-tab" aria-selected="false">Add-New-Images-And-Folders-Upload</a>
                                        </li>
                                
                                    
                                    </ul>

            <div class="tab-content">
                                                        <!-- start album details-->

                <div class="tab-pane fade show active" id="product-info" role="tabpanel" aria-labelledby="product-tab" style="height: 100%;">
                  <section>
                  <div class="row" style="">
                      <div class="col-12">
                      <button class="btn btn-success btn-sm float-right" style="margin-top:10px" onclick="updateSelectedAlbumDetails()" >Update</button>
                                    <input id="getValueForAlbumCover"  type="hidden" value=""> 
                                    <input id="getValueForAlbumCoverIndex"  type="hidden" value=""> 
                                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

                                    <input id="album_id"  type="hidden" value="{{$album->id}}">


                      </div>
                      
                    </div>
                  <br />
                        <div class="row border-bottom" style="margin-bottom: 10px;">  
                          <div class="col-6">
                            <div class="form-group">
                              <p>Album Type <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                              <select id="album_type" name="album_type" class="form-control edit_album_require"  placeholder="Album-type" onchange="manageAlbumType()" style="width:100%;max-width:100%;">
                                <option value="">-Select-Album-Type-</option>
                                                 @if($album->album_type_id == 1)
                                                      <option value="1" selected>General</option>
                                                      <option value="2">Event Album</option>
                                                  @else
                                                  <option value="1" >General</option>
                                                  <option value="2" selected>Event Album</option>
                                                  @endif
                                                  </select>
                                                  <span id="error_album_type" ></span>

                              </div>
                            </div>     
                            <div class="col-6" id="event_selection"  style="{{ $album->album_type_id ==  2 ? 'width:100%;max-width:100%;' : 'display:none'  }}">
                                <p>Select Event <span class="text-danger "  style="font-size:16pt;display: inline;">*</span><span class="validate_event_id text-danger" style="display:none">(Please select Album type first)</span></p>
                                <select  id="event_id" name="event_id" class="form-control event_id {{ $album->album_type_id ==  2 ? 'edit_album_require' : ''  }}"  placeholder="Event-Name" style="width:100%;max-width:100%;" onchange="">
                                            <option value="" selected>-Select-Event-</option>
                                            @foreach ($all_events as $event)
                                              @if($event->id  == $album->event_id )
                                                  <option value="{{$event->id}}" selected >{{$event->title}}</option>
                                              @else
                                                 <option value="{{$event->id}}" >{{$event->title}}</option>
                                              @endif
                                          @endforeach
                                        </select>   
                                        <span id="error_event_id" ></span>

                                      </div>
                                      
                                      
                          <div class="col-6">
                                <div class="form-group">
                                  <div id="album_name" style="{{ $album->album_type_id ==  1 ? 'width:100%;max-width:100%;' : ''  }}">
                                    <p>Album Name <span class="text-danger "  style="font-size:16pt;display: inline;">*</span><span class="validate_album_name text-danger" style="display:none">(Please select Album type first)</span></p>
                                    <input  type="text"  name="album_name" id="album_name_input" placeholder="Album-Name" class="form-control album_name_input edit_album_require " value="{{ $album->album_name}}">
                                    <span id="error_album_name_input" ></span>

                                  </div>
                               
                               </div>
                          </div>
                       </div>
                      
                       <div class="row border-bottom" style="margin-bottom: 10px;">                      
                            <div class="col-6" >
                                <div class="form-group " >
                                <label >Date and Time <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></label> 
                                  <input  type="datetime-local" name="date_time" id="date_time" placeholder="Date-Time" value="{{ $album->timestamp }}" class="form-control edit_album_require" >
                                  <span id="error_date_time" ></span>

                                </div>
                            </div>
                         
                       <!-- <div class="col-6">
                        <div class="custom-file-container" data-upload-id="Imagepreview1" >
                          <p style="float: left" >Upload Cover Image </p>
                          <a href="javascript:void(0)" style="float: right" class="custom-file-container__image-clear-selected" title="Clear Image" onclick="loadOldImage('{{ $album->coverImage }}')">Clear Image
                          <i class="fa fa-times text-danger" aria-hidden="true"></i></a>
                          <label class="custom-file-container__custom-file" >
                              <input type="file" class="custom-file-container__custom-file__custom-file-input step_1" id="album_cover"  name="album_cover" accept="image/*">
                              <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                              <span class="custom-file-container__custom-file__custom-file-control"></span>
                          </label>                         
                             <img src="/{{$album->coverImage}}" width="300" height="300" id="cover_image">

                          
                      </div>
                     
                 </div> -->

                 <div class="col-6">
                              <p>Upload Cover Image  <span class="text-danger "  style="font-size:16pt;display: inline;">*</span> :<span style="color:#EDE04D"> ( Standard image resolution to be used :  approx 350x250) </span> </p>
                                        <div class="custom-file mb-4">
                                        
                                            <input type="file" onchange="checkResolution(1)" class="custom-file-input " id="album_cover" name="album_cover" accept="image/*" style="cursor:pointer" placeholder="Upload-Cover-Image">
                                            <label class="custom-file-label" for="customFile" style="cursor:pointer">Choose Cover Image file</label>
                                            <br><br>
                                            <img src="{{ $album->coverImage }}" id="covImg" style="max-width: 50%;max-height:300px" alt="">
                                        </div>
                              
                              <!-- <div class="col-6">
                                <div class="form-group " style="margin-top: 10px;">
                                  <label >Album Name</label>                                                                   
                                  <input  type="text" name="album_name" id="album_name" placeholder="Album Name" class="form-control edit_album_require" >
                                </div>
                              </div> -->
                              <!-- <span id="error_album_cover" ></span> -->

                          </div>

                </div>

               
                    </section>   
                </div>
                <!-- end album details-->
                 <!-- start edit cover images -->
                 <!-- <div class="tab-pane fade" id="edit-cover-image" role="tabpanel" aria-labelledby="edit-cover-image-tab" >
                  <div id="images_grid_old"  class="row">
                    <div id="image_refreshal_div" >
                     <table id="" class="" style="min-width:100%;max-width:100% !important">
                       <thead>
                         <tr  class="border-bottom">
                             <th >Image #</th>
                             <th>Sequence</th>
                             <th>Path</th>
                             <th>Actions</th>
                         </tr>
                       </thead>
                       <tbody> 
                          <tr>
                            <td><img src="{{ $album->coverImage }}?{{time()}} " style="max-width: 100%" alt=""></td>
                            <td><input type="text" class="form-control onlyOneToNine change_sequence " style="width: 50%;text-align:right" value="" id="new_sequence_"></td>
                            <td ><input type="text" class="form-control old_sequence " style="width: 50%;display:none" value="" id="old_sequence_"></td>
                            <td id="path_" class='image_path_td'>{{ $album->coverImage }}</td>
                            <td>
                                <button class="btn btn-outline-primary" onclick="deleteSelectedImageFile('{{$album->coverImage, $album->id }}')">Delete</button>
                            </td>

                          </tr> 
                                  

                               
                                        
                                
                          
                      </tbody>
                         </table>
                       </div>
                   
                    </div>
              </div> -->
              <!-- end edit cover images -->
                 <!-- start edit images -->
                <div class="tab-pane fade" id="edit-images" role="tabpanel" aria-labelledby="edit-images-tab" >
                  <div class="row " >
                    <div class="col-12 " >
                    
                                  <input id="getValueForAlbumCover"  type="hidden" value=""> 
                                  <input id="getValueForAlbumCoverIndex"  type="hidden" value=""> 
                                  <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

                                  <input id="album_id"  type="hidden" value="{{$album->id}}"> 

                    </div>
                  </div>
                  <div id=""  class="row" >
                    @if($album->nested == 1)
                        @foreach($album_folders as $album_folder)
                        <div id="album_folders_images" class="col-12" >
                          <div class="card" style="margin-bottom: 10px;" id="folder_{{$album_folder->id}}">
                            <div class="card-header">
                              <div class="row">
                              <div class="col-md-6 col-sm-6 col-12">
                              <i style="font-size:24px" class="fa">&#xf07c;</i><h6  id="header_{{$album_folder->id}}" >{{$album_folder->album_name}}</h6>
                                <!-- <h6 class="badge badge-light" id="header_{{$album_folder->id}}" style="font-size: 15px;min-width:50px">{{$album_folder->album_name}}</h6> -->
                                <!-- <h6 id="!!!header_id!!!" >!!!folder-name!!!</h6> -->
                            </div>
                            <div class="col-md-6 pl-0 col-sm-6 col-12 text-right">
                              <button type="button" class="btn btn-info btn-sm" class="btn btn-primary" data-toggle="modal" data-target="#renameModal" onclick="folderNameToModal('{{$album->album_name}}','{{$album_folder->id}}','{{$album_folder->album_name}}')">Rename-Folder</button>
                                <button type="button" class="btn btn-warning btn-sm" onclick="deleteSelectedFolderImages('{{$album_folder->id}}','{{$album_folder->album_name}}')">Delete-Images</button>
                                <button type="button" class="btn btn-danger btn-sm" onclick="deleteSelectedFolder('{{$album_folder->id}}')">Delete-Folder</button>

                            </div>
                          </div>
                            </div>
                            <div class="card-body bg-light" >
                
                
                                        <div class="row mt-4" id="section_{{$album_folder->id}}">
                                            @foreach($album_folders_images as $album_folders_image)
                                                @if($album_folders_image->album_id == $album_folder->id)
                                                <div  class="col-2" id="imgCardId_{{$album_folders_image->id}}" style="margin-bottom: 20px;">
                                                  <div class="card" > 
                                                    <div class="form-check">
                                                      <input class="form-check-input "  type="checkbox" value="" id="img_{{$album_folders_image->id}}"  onchange="addCheckedImagesToArray(this,'{{$album_folder->id}}_{{$album_folders_image->id}}')" >
                                                      <label class="form-check-label" for="img_{{$album_folders_image->id}}">
                                                        Select
                                                      </label>
                                                    </div>
                                                    <img src='{{$album_folders_image->image_path}}' style="max-height:150px" >
                                                  </div>

                                                </div><br />
                                                @endif

                                              @endforeach
                                            
                                        </div>
                              
                
                            </div>
                        </div>
                          </div>
                          @endforeach
                       @else
                       <div id="album_images" style="width:100%;max-width:100%" >
                       <div class="card" style="margin-bottom: 10px;" >
                        <div class="card-header">
                          <div class="row">
                          <div class="col-md-6 col-sm-6 col-12">
                            <!-- <h6 id="header_"></h6> -->
                        </div>
                        <div class="col-md-6 pl-0 col-sm-6 col-12 text-right">
                           <!-- <button type="button" class="btn btn-warning btn-sm" onclick="">Rename-Folder</button> -->
                           <!-- <button type="button" class="btn btn-warning btn-sm" onclick="">Delete-Folder</button> -->
                            <button type="button" class="btn btn-warning btn-sm" onclick="deleteSelectedImages()">Delete-Images</button>
                        </div>
                      </div>
                        </div>
                        <div class="card-body bg-light" >
            
            
                                    <div class="row mt-4" id="section">
                                        @foreach($album_folders_images as $album_folders_image)
                                             @if($album_folders_image->album_id == $album->id)
                                            <div  class="col-2" style="margin-bottom: 20px;" id="imgCardId_{{$album_folders_image->id}}">
                                              <div class="card" > 
                                                <div class="form-check">
                                                  <input class="form-check-input" type="checkbox" value="" name="{{$album_folders_image->id}}" id="img_{{$album_folders_image->id}}" onchange="addCheckedImagesToArray(this,'{{$album_folders_image->id}}')" >
                                                  <label class="form-check-label" for="img_{{$album_folders_image->id}}">
                                                    Select
                                                  </label>
                                                </div>
                                                <img src='{{$album_folders_image->image_path}}' style="max-height:150px" >
                                              </div>

                                            </div><br />
                                        
                                              @endif
                                          @endforeach
                                        
                                    </div>
                          
            
                            </div>
                        </div>
                      </div>
                      @endif
                   
                    </div>
              </div>
              <!-- end edit images -->
              <!-- start of upload new images -->
              <div class="tab-pane fade" id="new-images" role="tabpanel" aria-labelledby="new-images-tab">
                  <section>
                    <div class="row border-bottom" >
                    <div class="col-8" >
                      </div>
                      <div class="col-2" >
                            @if($album_folders)
                              <button type="button" class="btn btn-primary btn-sm float-right" id="add_folder" onclick="" style="margin-top:10px;margin-bottom: 10px;" data-toggle="modal" data-target="#addFolderModalForImages">
                                      <i class="fa fa-plus fa-fw" aria-hidden="true"></i>New-Folder
                                </button>                               
                          @endif
                    
                      </div>
                      <div class="col-2 " >
                      <button class="btn btn-success btn-sm float-right" style="margin-top:10px;margin-bottom: 10px;" onclick="uploadNow()" >Start Upload</button>
                                    <input id="getValueForAlbumCover"  type="hidden" value=""> 
                                    <input id="getValueForAlbumCoverIndex"  type="hidden" value=""> 
                                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
  
                                    <input id="album_id"  type="hidden" value="{{$album->id}}"> 
                                    <input id="assoc_id"  type="hidden" value="{{$assoc_id}}"> 

  
                      </div>
                    </div>
                    <input type="file" style="display:none ;" multiple id="fileToUpload"  name="fileToUpload" accept="image/*" onchange=uploadOnChange()>

                     <!-- mainFolderDiv selection-->
                             <div title="mainFolderDiv" id="mainFolderDiv">
                              
                              </div>
                  <!-- end of mainFolderDiv selection-->
                 <!-- Template= for image selection-->
                              <div id='folder-image-template' style="display: none;">
                                    <div class="card" style="margin-bottom: 10px;" id="!!!folder_template_id!!!">
                                      <div class="card-header">
                                        <div class="row">
                                        <div class="col-md-6 col-sm-6 col-12">
                                          <!-- <h6 id="!!!header_id!!!">!!!folder-name!!!</h6> -->
                                          <i style="font-size:24px" class="fa">&#xf07c;</i><h6 id="!!!header_id!!!">!!!folder-name!!!</h6>
                                          <!-- <h6 class="badge badge-light" id="!!!header_id!!!" style="font-size: 15px;min-width:50px">!!!folder-name!!!</h6> -->

                                      </div>
                                      
                                      <div class="col-md-6 pl-0 col-sm-6 col-12 text-right">
                                          <button type="button" class="btn btn-warning btn-sm" onclick="selectImages('!!!UNID!!!')">Select-Images</button>
                                      </div>
                                    </div>
                                      </div>
                                      <div class="card-body bg-light" >


                                                  <div class="row mt-4" id="section_!!!UNID!!!"></div>
                                        

                                      </div>
                                  </div>
                              </div>
               <!-- end of Template for image selection-->

                    <div id=""  class="row">
                      @if($album->nested == 1)
                      @foreach($album_folders as $album_folder)
                      <div id="album_folders_images" class="col-12">
                        <div class="card" style="margin-bottom: 10px;" id="new_folder_{{$album_folder->id}}">
                          <div class="card-header">
                            <div class="row">
                            <div class="col-md-6 col-sm-6 col-12">
                            <i style="font-size:24px" class="fa">&#xf07c;</i><h6  id="new_header_{{$album_folder->id}}">{{$album_folder->album_name}}</h6>

                              <!-- <h6 class="badge badge-light" style="font-size: 15px; min-width:50px"></h6> -->
                              
                          </div>
                          <div class="col-md-6 pl-0 col-sm-6 col-12 text-right">
                            <button type="button" class="btn btn-warning btn-sm" onclick="selectImages('{{$album_folder->id}}')">Select-Images</button>
                          </div>
                        </div>
                          </div>
                          <div class="card-body bg-light" >
              
              
                                      <div class="row mt-4" id="new_section_{{$album_folder->id}}">
                                       
                                      </div>
                            
              
                          </div>
                      </div>
                         </div>
                         @endforeach
                         @else
                         <div id="new_album_images" class="col-12" >
                             <div class="row">
                                    <div class="col-12 float-right">
                                        <button type="button" class="btn btn-warning btn-sm float-right" onclick="selectImages('new_images_section')" style="margin:10px">Select-Images</button>
                                    </div>
                               </div>

                                    <div class="row">
                                      <div class="card-body bg-light" >
                                        <div class="row mt-12" id="section_new_images_section">
                                          
                                          </div>
                                      </div>
                              </div>
                        </div>
                        @endif
                     
                      </div>





                  <br />
                  <div id="process_div" style="display: none;">
                    <br />
                        <div id="uploading">
                        <div class="d-flex justify-content-between">
                          <small>Uploading Images</small>
                       
                        </div>
                      <div class="progress progress-lg mt-2">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 0%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" id="percent">0%</div>
                      </div>
                    </div>
                    <br /><br />
                    <div id="data_processing" style="display:none">
                      <div class="loading-label" style="text-align: center;">
                        <small>Please wait...</small>
                     
                      </div>
                   
                   
                        <div class="dot-opacity-loader">
                          <span></span>
                          <span></span>
                          <span></span>
                        </div>
                      </div>
                  </div>
                  <div id="images_grid"  class="row">
                    </div>
                  
                  
                    
                  </section>
                </div>
              <!--end of upload new images  -->


            </div>  
                                </div>                                        
                            </div>
                          
                        </div>
                    </div>
                </div>

            </div>
        </div>
        </div>
     
  <!-- start of Add folder Modal  -->
  <div class="modal fade" id="addFolderModalForImages">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="addFolderModalHeading"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row " style="margin-bottom: 10px;">
                        <div class="col-6">
                            <div class="form-group " style="margin-top: 10px;">
                                <!-- <label >Add Folder</label>  -->
                                <input type="text" name="album_folder_name" id="album_folder_name" placeholder="Folder Name"
                                    class="form-control">

                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group " style="margin-top: 10px;">
                                <!-- <label >Add Folder</label>  -->
                                <button type="button" class="btn btn-success"
                                    onclick="checkAddFolderModalInput($('#album_folder_name').val().trim(),'create')"
                                    style="" id="addFolderCreateButton">
                                    <i class="fa fa-plus fa-fw" aria-hidden="true"></i>Create
                                </button>

                                <button type="button" class="btn btn-success"
                                    style="display:none" id="addFolderUpdateButton">
                                    <i class="icon-refresh fa-fw" aria-hidden="true"></i> Update
                                </button>

                            </div>
                        </div>


                    </div>


                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    <!-- end of Add folder Modal -->

  <!-- The rename folder Modal -->
  <div class="modal fade" id="renameModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="renameFolderModalHeader"></h4>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
                     <div class="card" style="margin-bottom: 10px;" >
                        <div class="card-header">
                        <div class="row">
                              <div class="col-12">

                                          <div class="form-input">
                                                  
                                                  <label class="form-input-label" for="renameFolderModalInput">
                                                   Folder-Name
                                                   
                                                  </label>
                                                  <input class="form-control" type="text" id="renameFolderModalInput" >
                                                </div>
                                </div>
                              </div>
                      </div>


         
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="renameModalUpdateButton" ><i class="fa fa-refresh fa-fw"></i> Update</button>

          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  <!-- end of rename folder modal  -->
<!--  END CONTENT AREA  -->
<!-- <script>
 function loadOldImage(old_path){
    cover_image.src = old_path;
    $("#album_cover").empty();
  }
album_cover.onchange = evt => {
  const [file] = album_cover.files
   if (file) {
      cover_image.src = URL.createObjectURL(file)
   }
 }



</script> -->




@endsection
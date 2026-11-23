@extends('layouts.admin.admin')

<script>
   function manageAlbumType(){
       var user_type = $("#album_type").val();
       if(user_type == 1){
          $("#event_selection").hide();
          $("#album_name").show();
          $(".album_name").attr('disabled',false)
         
             $(".validate_album_name").hide();
          $('#album_name_input').val("").addClass('edit_album_require')
          $('#event_id').val("").trigger('change').removeClass('edit_album_require')

          
      }else if(user_type == 2){
          $("#event_selection").show();
          $("#album_name").hide();
          $(".album_name").attr('disabled',false)
         
           $(".validate_event_id").hide();

          $('#event_id').val("").trigger('change').addClass('edit_album_require')          
          $('#album_name_input').val("").removeClass('edit_album_require')

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
<i type="button" class="fa fa-arrow-left fa-2x fa-fw" style="margin-top: 10px;margin-left:30px;margin-bottom:10px;float:left;" onclick="goBack('/admin/video_album')"></i>

<div id="content" class="main-content">
    <div class="container">
<br><br>
        <div class="container">
            <div class="row layout-top-spacing">
                <div id="basic" class="col-lg-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        
                        <div class="widget-content widget-content-area">

                            <div class="row">
                                <div class="col-lg-12 col-12 mx-auto">
                                   
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                        <a class="nav-link active" id="product-tab" data-toggle="tab" href="#product-info" role="tab" aria-controls="product-info" aria-selected="true">Album Details</a>
                                        </li>
                                     
                                        
                                        <li class="nav-item">
                                        <a class="nav-link" id="edit-youtube-links-tab" data-toggle="tab" href="#edit-youtube-links" role="tab" aria-controls="edit-youtube-links-tab" aria-selected="false">Edit Youtube Links</a>
                                        </li>
                                
                                    
                                    </ul>
                                    <div class="tab-content" >
                                                        <!-- start album details-->

                <div class="tab-pane fade show active" id="product-info" role="tabpanel" aria-labelledby="product-tab" style="height: inherit;">
                  <section>
                  <div class="row" style="">
                      <div class="col-12">
                      <button class="btn btn-success btn-sm float-right hideWhenSubmitting" style="margin-top:10px" onclick="updateSelectedAlbumDetails()" >Update</button>
                                      <input id="getValueForAlbumCover"  type="hidden" value=""> 
                                    <input id="getValueForAlbumCoverIndex"  type="hidden" value=""> 
                                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

                                    <input id="selected_album_id"  type="hidden" value="{{$album->id}}">
                                    <input id="album_event_id"  type="hidden" value="{{$album->event_id}}"> 
 

                      </div>
                      
                    </div>
                  <br />
                  <div class="row border" style="margin-bottom: 10px;" >
                              <div class="col-6">
                              <div class="form-group">
                                <p>Albul Type <span class="text-danger "  style="font-size:16pt;display: inline;">*</span</p>
                                <select id="album_type" name="album_type" placeholder="Album-Type"  class="form-control edit_album_require" onchange="manageAlbumType()" style="width:100%;max-width:100%;">
                                                    @if($album->album_type_id == 1)
                                                        <option value="" selected>-Select-Album-Type-</option>
                                                        <option value="1" selected>Generic</option>
                                                        <option value="2">Event Album</option>
                                                    @else
                                                        <option value="" selected>-Select-Album-Type-</option>
                                                        <option value="1" >Generic</option>
                                                        <option value="2" selected>Event Album</option>
                                                    @endif
                                                    </select>
                                                    <span id="error_album_type" ></span>

                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group" >
                                <div id="album_name"  style="{{ $album->album_type_id ==  1 ? 'width:100%;max-width:100%;' : 'display:none'  }}">
                                  <p>Album Name:<span class="text-danger "  style="font-size:16pt;display: inline;">*</span> <span class="validate_album_name text-danger"  style="display:none">(Please select Album type first)</span></p>
                                  <input  type="text" name="album_name_input" id="album_name_input" placeholder="Album-Name" class="form-control {{ $album->album_type_id ==  1 ? 'edit_album_require' : ''  }}" " value="{{$album->album_name}}">
                                  <span id="error_album_name_input" ></span>
                                </div>
                                <div id="event_selection" style="{{ $album->album_type_id ==  2 ? 'width:100%;max-width:100%;' : 'display:none'  }}">
                              <p>Select Event: <span class="text-danger "  style="font-size:16pt;display: inline;">*</span<span class="validate_event_id text-danger" style="display:none">(Please select Album type first)</span></p>
                              <select id="event_id" name="event_id" class="form-control event_id {{ $album->album_type_id ==  2 ? 'edit_album_require' : ''  }}"" placeholder="Event-Name" style="width:100%;max-width:100%;" onchange="">
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
                                  </div>
                                </div>  
                                <div class="col-6">
                                  <div class="form-group " style="margin-top: 10px;">
                                    <p >Date and Time <span class="text-danger "  style="font-size:16pt;display: inline;">*</span</p> 
                                    <input  type="datetime-local" name="date_time" id="date_time" placeholder="Date-Time" class="form-control edit_album_require" value="{{$album->timestamp}}" >
                                    <span id="error_date_time" ></span>
                                   
                                  </div>
                                </div>
                              <div class="col-6">
                              <p style="float: left" >Upload Cover Image  <span class="text-danger "  style="font-size:16pt;display: inline;">*</span> :<span style="color:#EDE04D"> ( Standard image resolution to be used :  approx 350x250) </span> </p>
                                        <div class="custom-file mb-4">
                                        
                                            <input type="file" class="custom-file-input" id="fileToUpload" name="fileToUpload" placeholder="Upload-Cover-Image" style="cursor:pointer" accept="image/*" >
                                            <label class="custom-file-label" for="customFile" style="cursor:pointer">Choose Cover Image file</label>
                                            <br><br>
                                            <img src="{{ $album->cover_image }}" id="covImg" style="max-width: 50%;max-height:300px" alt="">
                                        </div>
                                        <span id="error_fileToUpload" ></span>

                              <!-- <div class="col-6">
                                <div class="form-group " style="margin-top: 10px;">
                                  <label >Album Name</label>                                                                   
                                  <input  type="text" name="album_name" id="album_name" placeholder="Album Name" class="form-control edit_album_require" >
                                </div>
                              </div> -->
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
              <div class="loader"></div>

               
              <!-- start of upload new images -->
              <div class="tab-pane fade" id="edit-youtube-links" role="tabpanel" aria-labelledby="edit-youtube-links-tab" style="">
                  <section>
                      <div class="row" style="margin-top:10px">
                          <div class="col-3">
                            
                            <button type="button" class="btn btn-primary btn-sm hideWhenSubmitting"   id="new_image_album_add_images_button" style="margin:10px"  onclick="createInputToAcceptYoutubeLinkEdit('{{$videos_count}}')">Insert-Videos-Link</button>
                            <input type="hidden" value="0" id="fieldToSetCounterUsingObjectSize">
                          </div>
                          <div class="col-9">
                            <button class="btn btn-success btn-sm float-right hideWhenSubmitting" style="margin:10px" onclick="verifyBeforeUpdatingSelectedAlbumYoutubeLinks()" >Update</button>
                          </div>
                     </div>
              

                 <button type="button"  style="display:none"  onclick="addYoutubeLinkToFinalObject('{{($videos)}}')" id="addYoutubeLinkToFinalObjectButton">click-me</button>
                 
                


                        <div  class="table-responsive "  style="">
                              <table class="table table-bordered"     >
                                <tr style="color:white">
                                  <th>Link</th>
                                  <th>Verify/Verified</th>
                                  <th colspan="2"  style="text-align:center" >Action</th>
                                </tr>
                                <tbody id="video_link_grid" >
                                @for ($i = 0; $i < $videos_count; $i++)
        
                                    <tr id="mainYoutubeInsertedRow_{{$i+1}}" class="hideWhenSubmitting">
                                          <td>                            
                                            <input type=text class="form-control youtubeLinkInputClass" id="youtubeInput_{{$i+1}}" placeholder="Youtube link" value="{{$videos[$i]->youtube_link}}" disabled>
                                          </td>
                                          
                                          <td>                            
                                            <span id="emptySpan_{{$i+1}}" ><span style="color:green"><i class="fas fa-check-circle fa-fw fa-lg" ></i>Verified</span></span> 
                                            <button type="button" class="btn btn-outline-success verifyYoutubeLinkButton"  id="verifyYoutubeLinkInsertedButton_{{$i+1}}" style="display:none"  onclick="verifyYoutubeLinkInserted('{{$i+1}}')">Verify</button>                            

                                          </td> 

                                          <td>                            
                                            <button type="button" class="btn btn-outline-warning "  id="clearYoutubeLinkInput_{{$i+1}}"  onclick="clearYoutubeLinkInput('{{$i+1}}')"><i style="font-size:12px" class="fa">&#xf021;</i></button>                            
                                         </td>
                                        
                                          <td>                            
                                            <button type="button" onclick="removeYoutubeLinkInputRow('{{$i+1}}')" class="btn btn-outline-danger" ><i class=" fa fa-trash  "  style="font-size:12px"></i></button>                            
                                          </div>                                                    

                                      </tr>    
                                      @endfor  
                               
                                </tbody>
                              </table>   
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

<!--  END CONTENT AREA  -->
<script>
    fileToUpload.onchange = evt => {
        const [file] = fileToUpload.files
           if (file) {
            covImg.src = URL.createObjectURL(file)
            }
         }


         
  </script>
 
@endsection
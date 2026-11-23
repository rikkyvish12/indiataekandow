@extends('layouts.admin.admin')

<style >
   .wizard > .content
{
   
    min-height: 45em !important;
    

}
</style>
<script>
   function manageAlbumType(){
       var user_type = $("#album_type").val();
       if(user_type == 1){
          $("#event_selection").hide();
          $("#album_name").show();
          // $(".album_name").attr('disabled',false)
          $(".validate").hide();
          $('#album_name_input').val("").addClass('create_album_require')
          $('#event_id').val("").trigger('change').removeClass('create_album_require')

          
      }else if(user_type == 2){
          $("#event_selection").show();
          // $("#album_name").hide();
          // $(".album_name").attr('disabled',false)
          $(".validate").hide();
          $('#event_id').val("").trigger('change').addClass('create_album_require')          
          $('#album_name_input').val("").removeClass('create_album_require')

      }else{
        $(".album_name").attr('disabled',true)
        $(".validate").show();
        // $('#event_id').val("").trigger('change').removeClass('create_album_require')
        // $('#album_name_input').val("").removeClass('create_album_require')

      } 
      
   }
   </script>
@section('content')
<i type="button" class="fa fa-arrow-left fa-2x fa-fw" style="margin-top: 10px;margin-left:30px;margin-bottom:10px;float:left;" onclick="goBack('/admin/video_album')"></i>

<div id="content" class="main-content">
    <div class="container">
<br><br>
        <div class="container">
            <div class="row ">
                <div id="basic" class="col-lg-12 ">
                    <div class="statbox widget box box-shadow">
                        
                       <!-- <div class="widget-content widget-content-area">

                            <div class="row">
                                <div class="col-lg-12 col-12 mx-auto">
                                    <form method="post" action="{{ route('admin.video_album.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <p>Event Name</p>
                                            <input  type="text" name="event_name" id="event_name" placeholder="Event Name" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <p>Album Name</p>
                                            <input  type="text" name="album_name" id="album_name" placeholder="Album Name" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <p>Date and Time</p>
                                            <input  type="datetime-local" name="timestamp" id="timestamp" placeholder="Date and Time" class="form-control" required>
                                        </div>
                                        <div class="custom-file mb-4">
                                            <input type="file" class="custom-file-input" id="imgInp" name="coverImage" required>
                                            <label class="custom-file-label" for="customFile">Choose Cover Image file</label>
                                        </div>
                                       
                                        <button type="submit" class="btn btn-primary" style="margin: 10px">Submit</button>
                                    </form>
                                </div>                                        
                            </div>

                        </div>  -->

                        <form id="new_video_album" action="#" style="">
                                    <input id="getValueForAlbumCover"  type="hidden" value=""> 
                                    <input id="getValueForAlbumCoverIndex"  type="hidden" value=""> 
                                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

                                    
                               <div>
                               <h5>Album Info</h5>
                               
                      <section id="product_info">
                        <form class="moreProductInfo"  id="moreProductInfo" method="get" action="#">
                        <div class="row border" style="margin-bottom: 10px;" >
                              <div class="col-6">
                                <div class="form-group">
                                  <p>Albul Type</p>
                                  <select id="album_type" name="album_type" class="form-control create_album_require" placeholder="Album-Type" onchange="manageAlbumType()" style="width:100%;max-width:100%;">
                                                          <option value="" selected>-Select-Album-Type-</option>
                                                          <option value="1">Generic</option>
                                                          <option value="2">Event Album</option>

                                                      </select>
                                                      <span id="error_album_type" ></span>

                                  </div>
                              </div>

                              <div class="col-6" id="event_selection" style="display: none;">
                                   <p>Select Event <span class="text-danger "  style="font-size:16pt;display: inline;">*</span><span class="validate text-danger">(Please select Album type first)</span></p>
                                      <select id="event_id" name="event_id" class="form-control album_name" placeholder="Event-Name" style="width:100%;max-width:100%;" onchange="">
                                          <option value="" selected>-Select-Event-</option>
                                          @foreach ($all_events as $event)
                                              <option value="{{$event->id}}" >{{$event->title}}</option>
                                          @endforeach

                                      </select>   
                                      <span id="error_event_id" ></span>
                                 </div>

                              <div class="col-6">
                                  <div class="form-group" >
                                    <div id="album_name">
                                      <p>Album Name: <span class="text-danger "  style="font-size:16pt;display: inline;">*</span><span class="validate text-danger">(Please select Album type first)</span></p>
                                      <input  type="text" name="album_name" id="album_name_input" placeholder="Album-Name" class="form-control album_name " >
                                      <span id="error_album_name_input" ></span>
                                  </div>
                                </div>
                                </div>

                                
                                 
                                <div class="col-6">
                                    <div class="form-group " >
                                      <p >Date and Time <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p> 
                                      <input  type="datetime-local" name="date_time" id="date_time" placeholder="Date-Time" class="form-control create_album_require" >
                                      <span id="error_date_time" ></span>
                                    </div>
                                </div>
                              <div class="col-6">
                                             <div class="custom-file-container" data-upload-id="Imagepreview1">
                                                <p style="float: left" >Upload Cover Image  <span class="text-danger "  style="font-size:16pt;display: inline;">*</span> :<small style="color:red"> ( Standard resolution :  approx 350x250) </small> </p>
                                                      <a href="javascript:void(0)" style="float: right" class="custom-file-container__image-clear" id="clear_image" title="Clear Image">Clear Image
                                                      <i class="fa fa-times text-danger" aria-hidden="true"></i></a>
                                                      <label class="custom-file-container__custom-file" >
                                                      <input type="file" class="custom-file-container__custom-file__custom-file-input create_album_require" onchange="checkResolution()" id="fileToUpload" placeholder="Upload-Cover-Image"  name="fileToUpload" accept="image/*" required>
                                                          <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                          <span class="custom-file-container__custom-file__custom-file-control"></span>
                                                      </label>
                                                      <div class="custom-file-container__image-preview"></div>
                                                      <span id="error_fileToUpload" ></span>

                                              </div>

                                              
                              
                              <!-- <div class="col-6">
                                <div class="form-group " style="margin-top: 10px;">
                                  <label >Album Name</label>                                                                   
                                  <input  type="text" name="album_name" id="album_name" placeholder="Album Name" class="form-control create_album_require" >
                                </div>
                              </div> -->
                          </div>
                        


                            </form>
                      </section>

                      <div class="loader"></div>
                      
                      <h5>Add Youtube Links</h5>
                      <section>
                        <div class="row">
                          <div class="col-3">
                            
                            <button type="button" class="btn btn-primary btn-sm hideWhenSubmitting"   id="new_image_album_add_images_button" onclick="createInputToAcceptYoutubeLink()">Insert-Videos-Link</button>
                          </div>
                          <div class="col-9">
                           
                          </div>
                        </div>
                      <br />
                      <div id="process_div" style="display: none;">
                        <br />
                            <div id="uploading">
                            <div class="d-flex justify-content-between">
                              <small>Uploading Video</small>
                           
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
                      <div  class="table-responsive"  style="">
                              <table class="table table-bordered"     >
                                <tr style="color:white">
                                  <th>Link</th>
                                  <th>Verify/Verified</th>
                                  <th colspan="2"  style="text-align:center" >Action</th>
                                </tr>
                                <tbody id="video_link_grid" >
                              
                               
                                </tbody>
                              </table>   
                        </div>

                        <!-- <div id="video_link_grid"  style="width:50%">
                        </div> -->
                        
                      </section>
</div >
           
           </form>
                    </div>
                </div>

            </div>
        </div>
        </div>

<!--  END CONTENT AREA  -->
@endsection
@extends('layouts.admin.admin')
<style>
.loader {
  border: 7px solid #1b2e4b;
  border-radius: 50%;
  border-top: 7px solid #4361ee;
  width: 58px;
  height: 58px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

.loader.dual-loader {
  border-bottom: 7px solid #4361ee;
}
.wizard > .content {
    min-height: 0;
}
.wizard > .content > .body {
    height: auto !important;
    position: relative !important;
}
.swal-modal .swal-text {
    text-align: center;
}



</style>
<script>
  function updateFolderOption(){
    if($('#no_folders').is(":checked")){
       $('#add_folder').attr('disabled',true);
       album_folders = [];
       all_folders_name = [];
       document.getElementById('fileToUpload').value = "";
       $("#added_album_folder_tbody").empty();
       $("#primaryAlbumDiv").empty();
       var folder_image_template = $("#folder-image-template").html();
  folder_image_template = folder_image_template.replace(/!!!folder-name!!!/g, 'Primary Album');
  folder_image_template = folder_image_template.replace(/!!!UNID!!!/g, 'main_album');
  $("#primaryAlbumDiv").append(folder_image_template); 
  $("#primaryAlbumDiv").show();
   $("#mainFolderDiv").empty();



    }else{
      $('#add_folder').attr('disabled',false)
      $("#primaryAlbumDiv").empty();
      document.getElementById('fileToUpload').value = "";
    }
  }
  function manageAlbumType(){
       var user_type = $("#album_type").val();
       if(user_type == 1){
          $("#event_selection").hide();
          $("#album_name").show();
          // $(".album_name").attr('disabled',false)
          $(".validate").hide();
          $('#album_name_input').val("").addClass('step_1')
          $('#event_id').val("").trigger('change').removeClass('step_1')

          
      }else if(user_type == 2){
          $("#event_selection").show();
       //   $("#album_name").hide();
          // $(".album_name").attr('disabled',false)
          $(".validate").hide();
          $('#event_id').val("").trigger('change').addClass('step_1')          
       //   $('#album_name_input').val("").removeClass('step_1')

      }else{
        $(".album_name").attr('disabled',true)
        $(".validate").show();
      //  $('#event_id').val("").trigger('change').removeClass('step_1')
     //   $('#album_name_input').val("").removeClass('step_1')

      } 
      
   }

  // function manageAlbumType(){
  //      var user_type = $("#album_type").val();
  //      if(user_type == 1){
  //      $("#event_selection").hide();
  //      $("#event_selection").attr('selected','');
  //      $("#album_name").show();
  //      $(".album_name").attr('disabled',false)
  //      $(".validate").hide();
  //     }else if(user_type == 2){
  //      $("#event_selection").show();
  //      $("#album_name").hide();
  //      $("#album_name").val('');

  //      $(".album_name").attr('disabled',false)
  //      $(".validate").hide();

  //     }else{
  //       $(".album_name").attr('disabled',true)
  //       $(".validate").show();
  //       $("#album_name").val('');
  //       $("#event_selection").attr('selected','');;


  //     } 

  //  }
</script>


@section('content')
<div id="content" class="main-content">
    <div class="container">
<br><br>
        <div class="container">
            <div class="row layout-top-spacing">
                <div id="basic" class="col-lg-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                      
                    <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="assoc_id" id="assoc_id" value="{{$assoc_id}}">


                 
<form id="new_image_album" style="margin-top: 10px;">

    <h3>Album Info</h3>
    <section >
      <div class="row border" style="margin-bottom: 10px;" >
        <div class="col-6">
        <div class="form-group">
          <p>Album Type <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
          <select id="album_type" name="album_type" class="form-control step_1" onchange="manageAlbumType()" placeholder="Album-type" style="width:100%;max-width:100%;">
                                  <option value="" selected>-Select-Album-Type-</option>
                                  <option value="1" >Generic</option>
                                  <option value="2">Event Album</option>

                              </select>
                              <span id="error_album_type" ></span>

          </div>
        </div>
        <div class="col-6" id="event_selection" style="display: none;">
          <p>Select Event <span class="text-danger "  style="font-size:16pt;display: inline;">*</span><span class="validate text-danger">(Please select Album type first)</span></p>
          <select  id="event_id" name="event_id" class="form-control event_id" placeholder="Event-Name" style="width:100%;max-width:100%;" onchange="">
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
            <p>Album Name <span class="text-danger "  style="font-size:16pt;display: inline;">*</span><span class="validate text-danger">(Please select Album type first)</span></p>
            <input  type="text"  name="album_name" id="album_name_input" placeholder="Album-Name" class="form-control album_name_input " >
            <span id="error_album_name_input" ></span>

          </div>
         
            </div>
          </div>
          <div class="col-6">
            <div class="form-group " style="margin-top: 10px;">
              <p >Date and Time <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p> 
              <input  type="datetime-local" name="date_time" id="date_time" placeholder="Date-Time" class="form-control step_1" >
              <span id="error_date_time" ></span>
            </div>
          </div>
        <div class="col-6">
          <div class="custom-file-container" data-upload-id="Imagepreview1" >
            <p style="float: left" >Upload Cover Image  <span class="text-danger "  style="font-size:16pt;display: inline;">*</span> :<small style="color:red"> ( Standard resolution :  approx 350x250) </small> </p>
            <a href="javascript:void(0)" style="float: right" id="clear_image" class="custom-file-container__image-clear" title="Clear Image">Clear Image
            <i class="fa fa-times text-danger" aria-hidden="true"></i></a>
            <label class="custom-file-container__custom-file" >
                <input type="file" onchange="checkResolution()" class="custom-file-container__custom-file__custom-file-input step_1 " id="album_cover" placeholder="Upload-Cover-Image" name="album_cover" accept="image/*">
                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                <span class="custom-file-container__custom-file__custom-file-control"></span>
            </label>
            <div class="custom-file-container__image-preview"></div>
            <span id="error_album_cover" ></span>

        </div>

        <!-- <div class="col-6">
          <div class="form-group " style="margin-top: 10px;">
            <label >Album Name</label>                                                                   
            <input  type="text" name="album_name" id="album_name" placeholder="Album Name" class="form-control create_album_require" >
          </div>
        </div> -->
   </div>
  
    </section>
    <h3>Add Image Folders</h3>
    <section  id="add_image_folders">
    
         <div class="row " style="margin-bottom: 10px;">
            <div class="col-12">
              <div class="n-chk">
                <label class="new-control new-checkbox checkbox-primary">
                  <input type="checkbox" class="new-control-input" onchange="updateFolderOption()" id="no_folders">
                  <span class="new-control-indicator"></span>No Folders
                </label>
            </div>
                <div class="form-group " >
                    <!-- <label >Add Folder</label>  -->
                    <button type="button" class="btn btn-primary" id="add_folder"
                        onclick=""
                        style="float:right" data-toggle="modal"
                        data-target="#addFolderModalForImages">
                        <i class="fa fa-plus fa-fw" aria-hidden="true"></i>Add Folder
                    </button>
                </div>
            </div>
            <!-- <div class="col-6">
        <div class="form-group " style="margin-top: 10px;">
          <label >Album Name</label>
          <input  type="text" name="album_name" id="album_name" placeholder="Album Name" class="form-control create_album_require" >
        </div>
      </div> -->
        </div>
        <div class="table-responsive">
            <table class="table " >
                <thead>
                    <tr>

                    </tr>
                </thead>
                <tbody id="added_album_folder_tbody">

                </tbody>
            </table>
        </div>
     </section>

    <h3>Upload images</h3>
    <section>
      
      <input type="file" style="display:none ;" multiple id="fileToUpload"  name="fileToUpload" accept="image/*" onchange=uploadOnChange()>

      <div title="mainFolderDiv" id="mainFolderDiv">
      
      </div>
      <div title="primaryAlbumDiv" id="primaryAlbumDiv">
      </div>

      <!-- <div title="subFolderDiv" id="mainSubFolderDiv" style="display:none"></div> -->

      <div id="folderUploadImageMainDiv" style="display:none"></div>
      <div id="UploadImageMainDiv" style="display:none"></div>

      <!-- <button onclick="uploadNow()">Finish</button> -->
    </section>

   
    </form>
                           
                    </div>
                </div>
              </div>
            </div>
        </div>
        

        <!-- Teplate for image selection-->
    <div id='folder-image-template' style="display: none;">
          <div class="card" style="margin-bottom: 10px;" id="!!!folder_template_id!!!">
            <div class="card-header">
              <div class="row">
              <div class="col-md-6 col-sm-6 col-12">
              
             
              <i style="font-size:24px" class="fa">&#xf07c;</i><h6 id="!!!header_id!!!" >!!!folder-name!!!</h6>
              
               
                <!-- <span  id="!!!header_id!!!" style="font-size: 15px;">!!!folder-name!!!</span> -->

              </div>

            <div class="col-md-6 pl-0 col-sm-6 col-12 text-right">
                <button type="button" class="btn btn-warning btn-sm" onclick="selectImages('!!!UNID!!!')">Select-Images</button>
            </div>
          </div>
            </div>
            <div class="card-body bg-light" >


                        <div class="row mt-4" id="section_!!!UNID!!!">
                            
                        </div>
              

            </div>
        </div>
    </div>
    <div class="modal" id="progress_modal">
      <div class="modal-dialog modal-dialog-centered ">
          <div class="modal-content">


              <!-- Modal body -->
              <div class="modal-body">
                  <div class="row " style="margin-bottom: 10px;">
                      <div class="col-12" style="text-align: center;">
                        <div id="progress_div">
                        <div class="progress br-30" >
                          <div class="progress-bar bg-info" role="progressbar" id="image_upload_progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                         
                        </div>
                        <label id="upload_percent">0%</label>
                      </div>
                        <div id="please_wait" style="display: none;">
                        <div class="spinner-border text-primary" role="status">
                          <span class="sr-only">Loading...</span>
                        </div>
                        <label id="upload_percent">Please wait...</label>
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


    <!-- start of sub folder Modal  -->
    <div class="modal fade" id="addSubFolderModalForImages">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="addSubFolderModalHeading"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row " style="margin-bottom: 10px;">
                        <div class="col-6">
                            <div class="form-group " style="margin-top: 10px;">
                                <!-- <label >Add Folder</label>  -->
                                <input type="text" name="album_sub_folder_name" id="album_sub_folder_name"
                                    placeholder="Sub-Folder Name" class="form-control">

                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group " style="margin-top: 10px;">
                                <!-- <label >Add Folder</label>  -->
                                <button type="button" class="btn btn-success"
                                    onclick="checkAddSubFolderModalInput($('#album_sub_folder_name').val().trim(),'sub_create')"
                                    style="" id="addFolderCreateButton">
                                    <i class="fa fa-plus fa-fw" aria-hidden="true"></i>Create
                                </button>

                                <button type="button" class="btn btn-success"
                                    onclick="checkAddSubFolderModalInput($('#album_sub_folder_name').val().trim(),'sub_update')"
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
    <!-- end of sub folder Modal  -->
    </div>
    <!--  END CONTENT AREA  -->
<!--  END CONTENT AREA  -->
@endsection
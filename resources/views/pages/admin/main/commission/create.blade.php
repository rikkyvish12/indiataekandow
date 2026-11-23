@extends('layouts.admin.admin')


<style >
   .wizard > .content
{
   
    min-height: 40em !important;
    

}


</style>

@section('content')
<i type="button" class="fa fa-arrow-left fa-2x fa-fw" style="margin-top: 10px;margin-left:30px;margin-bottom:10px;float:left;" onclick="goBack('/admin/commission')"></i>

<div id="content" class="main-content">
    <div class="container">
<br><br>
        <div class="container">
            <div class="row ">
                <div id="basic" class="col-lg-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <!-- <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Create commission</h4>
                                </div>                 
                            </div>
                        </div> -->
                        <div class="widget-content widget-content-area">

                            <!-- <div class="row">
                                <div class="col-lg-12 col-12 mx-auto">
                                    <form method="post" action="{{ route('admin.commission.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <p>name</p>
                                            <input  type="text" name="name" id="name" placeholder="commission Name" class="form-control" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary" style="margin: 10px">Submit</button>
                                    </form>
                                </div>                                        
                            </div> -->

                  

                        <form id="new_commission_form" action="#" style="margin-top:5px">
                                 
                                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="current_member_edit_id" id="current_member_edit_id" value="">

 
                                    
                               <div>
                               <h5>commission Information</h5>
                               
                      <section id="product_info">
                         
                        <form class="moreProductInfo"  id="moreProductInfo" method="get" action="#">
                          <div class="row border" style="margin-bottom: 10px;">
                              <div class="col-6">
                                <div class="form-group " style="margin-top: 10px;">
                                  <label >commission Name <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></label> 
                                  <input  type="text" name="commission_name" id="commission_name" placeholder="commission-Name" class="form-control create_commission_require noSpace" >
                                  
                                  <span id="error_commission_name" ></span>

                                </div>
                              </div>
                             
                              
                         </div>

                            </form>
                      </section>

                      <div class="loader"></div>
                      
                      <h5>Add commission Members</h5>
                      <section>
                    
                      <div class="row">
                          <div class="col-12">
                          <u> <strong>commission : <span id="commission_name_step2_header" style="color:black;font-size:12pt"></span></strong></u>
                            <button type="button" class="btn btn-primary btn-sm hideWhenSubmitting float-right" data-backdrop="static" data-keyboard="false"  data-toggle="modal" data-target="#myModal" id="new_image_album_add_images_button" onclick="genarateRandomMemberIdForImageObjectRef()"><i class="fa fa-plus fa-fw"></i> Add-Members</button>
                          </div>
                          <!-- <div class="col-9">
                           
                          </div> -->
                        </div>
                      <br />
                      <div id="process_div" style="display: none;">
                        <br />
                            <div id="uploading">
                            <div class="d-flex justify-content-between">
                              <small>Uploading</small>
                           
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
                     
                        <div  class="table-responsive"  style="width:75%; margin: 0 auto">
                              <table class="table table-bordered"     >
                                <tr style="color:white">
                                  <th>Member Name</th>
                                  <th>Member Designation</th>
                                  <th>Member Position</th>
                                  <th>Member Image</th>
                                  <th colspan="2"  style="text-align:center" >Action</th>
                                </tr>
                                <tbody id="commission_member_grid" >
                              
                                    <tr>
                                      <td colspan="6" style="text-align:center">
                                        No member added yet
                                      </td>
                                    </tr>
                                </tbody>
                              </table>   
                        </div>
                        
                      </section>
</div >
           
           </form> 

                    </div>

                    </div>
                </div>

            </div>
        </div>
        </div>

        <!-- modal start -->
         <div class="modal fade" id="myModal" data-backdrop="false" data-backdrop="static" data-keyboard="false" >
          <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
      
              <!-- Modal Header -->
               <div class="modal-header">
                <h4 class="modal-title" id="commission_modal_heading"></h4>
                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
              </div> 
        
              <!-- Modal body -->
              <div class="modal-body">

                 <div class="row">
                    <div class="col-6" >
                             <div class="form-group">
                                 <p>Name<span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                 <input  type="text" name="comm_member_name" id="comm_member_name" placeholder="Member-Name" class="form-control add_member_require noSpace" >
                                 <span id="error_comm_member_name"  ></span>
                              </div>
                                       
                     </div>
                    <div class="col-6" >
                          <div class="form-group">
                            <p>Designation<span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                            <input  type="text" name="comm_member_designation" id="comm_member_designation" placeholder="Member-Designation" class="form-control add_member_require noSpace" >
                            <span id="error_comm_member_designation"  ></span>

                         </div>
                     </div>

                   

                 </div>

                 <div class="row">
                        <div class="col-6" >
                                    <div class="form-group">
                                        <p>Position<span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                        <input  type="text" name="comm_member_position" id="comm_member_position" placeholder="Member-Position" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" class="form-control add_member_require noZeroAtStart" >        
                                        <span id="error_comm_member_position"  ></span>

                                    </div>
                                              
                            </div>
                            <!-- <div class="col-2"  >
                            </div> -->
                          <div class="col-6"  >
                                <div class="form-group">
                                               <div id="uploadImagecommissionMemberButtonDiv">
                                                    <label>Upload Image <span class="text-danger "  style="font-size:16pt;display: inline;">*</span> :<span style="color:#EDE04D"> ( Standard image resolution to be used :  approx 350x250) </span></label>
                                                    <input type="file" name="fileToUpload" id="fileToUpload" style="display: none;" placeholder="Upload-Image" class="add_member_require" onchange="uploadOnChange()" >
                                                    <button type="button" class="btn btn-primary enableDisable" style="width:100%" id="fileToUploadButton" onclick="document.getElementById('fileToUpload').click()"  style="margin-top">Upload</button>                    
                                                </div> 
                                          
                                            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#verifySellerImageModal">
                                                  Verify Image
                                                </button> -->
                                          
                                                <div id="docImageUploadPrevDiv" class="row" style="display:none;"></div>
                                              

                                        </div>

                                        <span id="error_fileToUpload"  ></span>

                                       

                          </div> 
                    
                  
                    </div>
                     
               

              </div> 

        
              <!-- Modal footer -->
              <div class="modal-footer">
              <button type="button" class="btn btn-success" id="addMemberButton" onclick="verifyEmptyInputsBeforeProceeding()"><i class="fa fa-plus fa-fw"></i> Add</button>

                <button type="button" class="btn btn-primary"  id="addMemberCloseButton"  data-dismiss="modal" onclick="resetAddMemberModal()">Close</button>
              </div>
            
          </div>
        </div>
      </div>
        <!-- modal ends -->

<!--  END CONTENT AREA  -->
@endsection
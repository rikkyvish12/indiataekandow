@extends('layouts.admin.admin')
@section('styles')

ul.a {
list-style-type: circle;
}

ul.b {
list-style-type: square;
}



@endsection


@section('content')
<i type="button" class="fa fa-arrow-left fa-2x fa-fw" style="margin-top: 10px;margin-left:30px;float:left;"
  onclick="goBack('/admin/commission')"></i>

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
                  <h4>Edit Commission</h4>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area">

              <div class="row">
                <div class="col-lg-12 col-12 mx-auto">
                  <!-- <form method="post" action="{{ route('admin.commission.update',$commission->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        {{ method_field('put') }}
                                        <div class="form-group">
                                            <p>name</p>
                                            <input  type="text" name="name" value="{{ $commission->name }}" id="name" placeholder="commission Name" class="form-control" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary" style="margin: 10px">Submit</button>
                                    </form> -->

                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="product-tab" data-toggle="tab" href="#product-info" role="tab"
                        aria-controls="product-info" aria-selected="true">Commission Details</a>
                    </li>


                    <li class="nav-item">
                      <a class="nav-link" id="edit-commission-members-tab" data-toggle="tab"
                        href="#edit-commission-members" role="tab" aria-controls="edit-commission-members-tab"
                        aria-selected="false">Edit Members</a>
                    </li>


                  </ul>
                  <div class="tab-content">
                    <!-- start album details-->

                    <div class="tab-pane fade show active" id="product-info" role="tabpanel"
                      aria-labelledby="product-tab" style="height: 100%;">
                      <section>
                        <div class="row" style="">
                          <div class="col-12">
                            <button class="btn btn-success btn-sm float-right" style="margin-top:10px"
                              onclick="updateSelectedCommission()">Update</button>

                            <input id="getMemberIdForEditing" type="hidden" value="">
                            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                            <input id="selected_commission_id" type="hidden" value="{{$commission->id}}">


                          </div>

                        </div>
                        <br />
                        <div class="row border-bottom" style="margin-bottom: 10px;">
                          <div class="col-6">
                            <div class="form-group ">
                              <label>Commission Name <span class="text-danger "
                                  style="font-size:16pt;display: inline;">*</span></label>
                              <input type="text" name="commission_name" id="commission_name" placeholder="Commission Name"
                                value="{{$commission->name}}" class="form-control edit_album_require noSpace">
                              <span id="error_edit_commission_name"></span>

                            </div>
                          </div>

                        </div>



                      </section>
                    </div>
                    <!-- end album details-->

                    <div class="loader"></div>


                    <!-- start of upload new images -->
                    <div class="tab-pane fade" id="edit-commission-members" role="tabpanel"
                      aria-labelledby="edit-commission-members-tab" style="">
                      <section class="hideWhenSubmitting">
                        <input id="allowExistingMemberImageToEditUsingFileObject" type="hidden" value="0">

                        <div class="row" style="margin-top:10px">
                          <div class="col-9">


                            <!-- <input type="hidden" value="0" id="fieldToSetCounterUsingObjectSize"> -->
                          </div>
                          <div class="col-2">

                            <button type="button" class="btn btn-primary btn-sm hideWhenSubmitting float-right"
                              style="margin-top:10px" data-backdrop="static" data-keyboard="false" data-toggle="modal"
                              data-target="#myModal" id="new_image_album_add_images_button"
                              onclick="genarateRandomMemberIdForImageObjectRef()"><i class="fa fa-plus fa-fw"></i>
                              Add-Member</button>
                            <!-- <input type="hidden" value="0" id="fieldToSetCounterUsingObjectSize"> -->
                          </div>

                          <div class="col-1">
                            <button class="btn btn-success btn-sm float-right hideWhenSubmitting"
                              style="margin-top:10px" onclick="handleEditMemberUpload()">Update</button>
                          </div>

                        </div>



                        <br />
                        <div class="row" style="width:75%; margin: 0 auto">
                          <div class="col-12">
                            <!-- <span style="font-size:14pt;color:white"><u>Add New Members</u> </span> -->
                            <!-- <button type="button" class="btn btn-primary btn-sm hideWhenSubmitting float-right" data-backdrop="static" data-keyboard="false"  data-toggle="modal" data-target="#myModal" id="new_image_album_add_images_button" onclick="genarateRandomMemberIdForImageObjectRef()"><i class="fa fa-plus fa-fw"></i> Add-Member</button> -->
                          </div>
                          <!-- <div class="col-9">
                           
                          </div> -->
                        </div>
                        <br />

                        <div class="table-responsive" style="width:75%; margin: 0 auto">
                          <table class="table table-bordered">
                            <tr style="color:white">
                              <th>Member Name</th>
                              <th>Member Designation</th>
                              <th>Member Position</th>
                              <th>Member Image</th>
                              <th colspan="2" style="text-align:center">Action</th>
                            </tr>
                            <tbody id="commission_member_grid">

                              <tr>
                                <td colspan="6" style="text-align:center">
                                  No new members added yet
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>

                        <div class="table-responsive" style="width:75%; margin: 0 auto">

                          <table class="table table-bordered">
                            <!-- <tr style="color:white">
                                  <th>Member Name</th>
                                  <th>Member Designation</th>
                                  <th>Member Position</th>
                                  <th>Member Image</th>
                                  <th colspan="2"  style="text-align:center" >Action</th>
                                </tr> -->
                            <tbody id="existing_commission_member_grid">


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
  <!-- existing member modal start -->
  <div class="modal fade" id="myModal2" data-backdrop="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Member: <span id="existing_commission_member_name_in_modal_heading"></span></h4>
          <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
        </div>

        <!-- Modal body -->
        <div class="modal-body">

          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <p>Name<span class="text-danger " style="font-size:16pt;display: inline;">*</span></p>
                <input type="text" name="existing_comm_member_name" id="existing_comm_member_name"
                  placeholder="Member-Name" class="form-control noSpace existing_member_add_member_require">
                <span id="error_existing_comm_member_name"></span>

              </div>

            </div>
            <div class="col-6">
              <div class="form-group">
                <p>Designation<span class="text-danger " style="font-size:16pt;display: inline;">*</span></p>
                <input type="text" name="existing_comm_member_designation" id="existing_comm_member_designation"
                  placeholder="Member-Designation" class="form-control noSpace existing_member_add_member_require">
                <span id="error_existing_comm_member_designation"></span>

              </div>
            </div>



          </div>

          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <p>Position<span class="text-danger " style="font-size:16pt;display: inline;">*</span></p>
                <input type="text" name="existing_comm_member_position" id="existing_comm_member_position"
                  placeholder="Member-Position" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))"
                  class="form-control noZeroAtStart existing_member_add_member_require">
                <span id="error_existing_comm_member_position"></span>

              </div>

            </div>
            <!-- <div class="col-2"  >
                            </div> -->
            <div class="col-6">
              <div class="form-group">
                <div id="uploadImageButtonForExistingcommissionMemberDiv">
                  <label>Upload Image<span class="text-danger " style="font-size:16pt;display: inline;">*</span></label>
                  <input type="file" name="existingFileToUpload" id="existingFileToUpload" style="display: none;"
                    placeholder="Upload-Image" class="" onchange="uploadOnChangeForExistingMember()">
                  <button type="button" class="btn btn-primary enableDisable" style="width:100%"
                    id="eistingFileToUploadButton" onclick="document.getElementById('existingFileToUpload').click()"
                    style="margin-top">Upload</button>
                </div>

                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#verifySellerImageModal">
                                                  Verify Image
                                                </button> -->

                <div id="existingDocImageUploadPrevDiv" class="row" style="display:none;"></div>


              </div>
              <span id="error_existingFileToUpload"></span>

            </div>


          </div>



        </div>


        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="existingAddMemberButton"
            onclick="verifyExistingMemberEmptyInputsBeforeProceeding()"><i class="fa fa-plus fa-fw"></i> Add</button>

          <button type="button" class="btn btn-primary" id="existingAddMemberCloseButton" data-dismiss="modal"
            onclick="existingMemberResetModal()">Close</button>
        </div>

      </div>
    </div>
  </div>
  <!--existing member  modal ends -->


  <!-- modal start -->
  <div class="modal fade" id="myModal" data-backdrop="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Member: <span id="commission_member_name_in_modal_heading"></span></h4>
          <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
        </div>

        <!-- Modal body -->
        <div class="modal-body">

          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <p>Name<span class="text-danger " style="font-size:16pt;display: inline;">*</span></p>
                <input type="text" name="comm_member_name" id="comm_member_name" placeholder="Member-Name"
                  class="form-control noSpace add_member_require">
                <span id="error_comm_member_name"></span>

              </div>

            </div>
            <div class="col-6">
              <div class="form-group">
                <p>Designation<span class="text-danger " style="font-size:16pt;display: inline;">*</span></p>
                <input type="text" name="comm_member_designation" id="comm_member_designation"
                  placeholder="Member-Designation" class="form-control noSpace add_member_require">
                <span id="error_comm_member_designation"></span>

              </div>
            </div>



          </div>

          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <p>Position<span class="text-danger " style="font-size:16pt;display: inline;">*</span></p>
                <input type="text" name="comm_member_position" id="comm_member_position"
                  onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" placeholder="Member-Position"
                  class="form-control add_member_require noZeroAtStart">
                <span id="error_comm_member_position"></span>

              </div>

            </div>
            <!-- <div class="col-2"  >
                            </div> -->
            <div class="col-6">
              <div class="form-group">
                <div id="uploadImagecommissionMemberButtonDiv">
                  <label>Upload Image<span class="text-danger " style="font-size:16pt;display: inline;">*</span></label>
                  <input type="file" name="fileToUpload" id="fileToUpload" style="display: none;"
                    placeholder="Upload-Image" class="add_member_require" onchange="uploadOnChange()">
                  <button type="button" class="btn btn-primary enableDisable" style="width:100%" id="fileToUploadButton"
                    onclick="document.getElementById('fileToUpload').click()" style="margin-top">Upload</button>
                </div>

                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#verifySellerImageModal">
                                                  Verify Image
                                                </button> -->

                <div id="docImageUploadPrevDiv" class="row" style="display:none;"></div>


              </div>
              <span id="error_fileToUpload"></span>

            </div>


          </div>



        </div>


        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="addMemberButton"
            onclick="verifyEmptyInputsBeforeProceeding()"><i class="fa fa-plus fa-fw"></i> Add</button>

          <button type="button" class="btn btn-primary" id="addMemberCloseButton" data-dismiss="modal"
            onclick="resetAddMemberModal()">Close</button>
        </div>

      </div>
    </div>
  </div>
  <!-- modal ends -->
  <!--  END CONTENT AREA  -->
  @endsection

  @section('script')
  <script>
    getAllMembersForSelectedCommission({{$commission->id}});
    
  </script>
  @endsection
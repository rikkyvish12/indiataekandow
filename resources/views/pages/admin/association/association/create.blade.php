@extends('layouts.admin.admin')



@section('script')
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
{{-- <script type="text/javascript">
    CKEDITOR.replace('presidentDescription', {
        filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>
<script type="text/javascript">
    CKEDITOR.replace('secretaryDescription', {
        filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script> --}}
<script type="text/javascript">
    CKEDITOR.replace('description', {
        filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
    function manageUserType(){
        var user_type = $("#managing_user_type").val();
        if(user_type == 1){
        $('#new_user').hide();
        $('#existing_user').show();

        $(".new_users").hide();
        $(".new_users").val('').prop('disabled',true);
        $(".existing_users").show();
        $(".existing_users").val('').prop('disabled',false);

      
       }else if(user_type == 2){
        $('#new_user').show();
        $('#existing_user').hide();

        $(".new_users").show();
        $(".new_users").val('').prop('disabled',false);      
        $(".existing_users").hide();
        $(".existing_users").val('').prop('disabled',true);
       }else{
        $('#new_user').hide();
        $('#existing_user').hide();

        $(".new_users").hide();
        $(".existing_users").hide();
        $(".new_users").val('').prop('disabled',true);
        $(".existing_users").val('').prop('disabled',true);


        // $('.new_user').removeAttr('required');
        // $('.existing_user').removeAttr('required');
       }

    }

    function loadDistricts(){
       var state_id = $("#state_id").val();
        $.ajax({
    type: "GET",
    url: "/getDistricts/"+state_id,
    beforeSend: function(){
        
        //   alert("started")
        },
        complete: function(){
        
        //       alert("complete")
  
        },
    success: function(response){
    var data = JSON.parse(response);
    if(data!=""){

        var result = "";
      console.log(data) 
       $("#district_id").empty(); 
      $("#district_id").append($('<option>', {
              value: '',
              text: '-Select-District-',
          })); 
        $.each(data, function(i, item) {  
            $("#district_id").append($('<option>', {
              value: item.id,
              text: item.name,
          })); 
        });  
     
       
      }else{
        alert('no districts') 
        } 
        
        
     } 
    }); 

}
@if($url == 'state_association')
function checkAvailability(){
         var existing_state = JSON.parse('{{$existing_states}}')
         var state_id = $("#state_id").val();


         if(existing_state.indexOf(parseInt(state_id)) > -1){
            //  alert("This state is already taken");
             swal({
                title: "Select State",
                text: "This state has already been taken..",
                icon: "error",
                
             });
              $("#state_id").val('');
         }

    }
@elseif($url == 'district_association')
    function checkAvailability(){

         var existing_state = JSON.parse('{{$existing_districts}}')

         var district_id = $("#district_id").val();


         if(existing_state.indexOf(parseInt(district_id)) > -1){
            //  alert("This state is already taken");
             swal({
                title: "District",
                text: "This district has already been created..",
                icon: "error",
                
             });
              $("#district_id").val('');
         }

    }
    @endif
</script>
@endsection

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
                                    <h4>Create {{ $title }} => ( State: <label>{{$state_name}}</label> )</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                        @include('layouts.admin.alerts')
    
                            <div class="row">
                                <div class="col-lg-12 col-12 mx-auto">
                                    <form method="post" action="{{ route('assoc_admin.assoc_'.$url,$assoc_id) }}" enctype="multipart/form-data">
                                        @csrf
                                        {{-- <div class="row">
                                            <div class="col-6 col-md-6 col-sm-6"> --}}
                                                <div class="form-group">
                                                <p>Association Name <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                                <input  type="text" name="name" id="name" placeholder="Association name" class="form-control noSpace"  value="{{ old('name')}}"   {{ $errors->has('name') ? 'autofocus' : 'null' }} >
                                                    <small class="text-danger">{{$errors->first('name')}}</small>
                                                </div>

                                        @if ($url == 'state_association')
                                        <div class="form-group">
                                            <p>Select State <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <select id="state_id" name="state_id" class="form-control" style="width:100%;max-width:100%;" onchange="checkAvailability()" {{ $errors->has('state_id') ? 'autofocus' : 'null' }} >
                                                        <option value="" selected>-Select-State-</option>
                                                        @foreach ($states as $state)
                                                           <option value="{{$state->id}}" @if(old('state_id') == $state->id) selected @endif  }} >{{$state->name}}</option>
                                                        @endforeach

                                              </select>
                                              <small class="text-danger">{{$errors->first('state_id')}}</small>
                                         </div>
                                         @elseif($url == 'district_association')
                                         <!-- <div class="form-group">
                                            <p>District Name <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="district_name" id="district_name" placeholder="District Name" class="form-control noSpace" value="{{ old('district_name')}}"  >
                                        </div> -->
                                     
                                         <div class="form-group">
                                            <p>Select District <span class="text-danger "  style="font-size:16pt;display: inline;">*</span><span style="color:#EDE04D"> ( Please select state before selecting district for better result) </span></p>
                                            <select id="district_id" name="district_id" class="form-control noSpace" style="width:100%;max-width:100%;" onchange="checkAvailability()" {{ $errors->has('district_id') ? 'autofocus' : 'null' }} >
                                                        <option value="" selected>-Select-District-</option>
                                                        @foreach ($districts as $district)
                                                        <option value="{{$district->id}}"  @if(old('district_id') == $district->id) selected @endif  >{{$district->name}}</option>
                                                        @endforeach

                                              </select>
                                              <small class="text-danger">{{$errors->first('district_id','The district field is required, please select state before selecting district')}}</small>
                                         </div>
                                        @endif
                                            {{-- </div>
                                            <div class="col-6 col-md-6"> --}}
                                            <small class="text-danger">{{$errors->first('logo')}}</small>
                                                <div class="custom-file-container" data-upload-id="Imagepreview1">
                                                    <p style="float: left">Upload Association Logo Image <span class="text-danger "  style="font-size:16pt;display: inline;">*</span> :<span style="color:#EDE04D"> ( Standard image resolution to be used :  approx 350X250) </span></p>
                                                    <a href="javascript:void(0)" style="float: right" class="custom-file-container__image-clear" title="Clear Image">Clear Image
                                                    <i class="fa fa-times text-danger" aria-hidden="true"></i></a>
                                                    <label class="custom-file-container__custom-file" >
                                                    <input type="file" class="custom-file-container__custom-file__custom-file-input" id="imgInp"  name="logo" accept="image/*"  {{ $errors->has('logo') ? 'autofocus' : 'null' }} >
                                                        <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                        <span class="custom-file-container__custom-file__custom-file-control"></span>
                                                    </label>
                                                    <div class="custom-file-container__image-preview"></div>
                                                </div>
                                            {{-- </div>
                                    </div>

                                 <div class="row">
                                      <div class="col-6 col-md-6 col-sm-6"> --}}
                                        <hr style="height:1px;border:none;color:#333;background-color:#333;" />
                                        <div class="form-group">
                                            <p>President Name <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="presidentName" id="presidentName" placeholder="President Name" class="form-control noSpace" value="{{ old('presidentName')}}"  {{ $errors->has('presidentName') ? 'autofocus' : 'null' }}>
                                            <small class="text-danger">{{$errors->first('presidentName')}}</small>
                                        </div>
                                        <div class="form-group">
                                        <p>President Email <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                        <input  type="text" name="presidentEmail" id="presidentEmail" placeholder="President Email" class="form-control noSpace" value="{{ old('presidentEmail')}}"  {{ $errors->has('presidentEmail') ? 'autofocus' : 'null' }} >
                                            <small class="text-danger">{{$errors->first('presidentEmail')}}</small>
                                        </div>
                                        <div class="form-group">
                                            <p>Office Address <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <textarea name="presidentDescription" id="presidentDescription" class="form-control " cols="30" rows="5" maxlength="100" style="resize:none;"  {{ $errors->has('presidentDescription') ? 'autofocus' : 'null' }}  placeholder="Office Address" >{{old('presidentDescription')}}</textarea>
                                            <small class="text-danger">{{$errors->first('presidentDescription')}}</small>
                                        </div>
                                      {{-- </div>
                                        <div class="col-6 col-md-6 col-sm-6"> --}}
                                        {{-- <span style="color: red">( Image resolution must be 960x1280 * )</span> --}}

                                        <small class="text-danger">{{$errors->first('presidentPhoto')}}</small>
                                        <div class="custom-file-container" data-upload-id="Imagepreview2">
                                            <p style="float: left">Upload President Image <span class="text-danger "  style="font-size:16pt;display: inline;">*</span>:<span style="color:#EDE04D"> ( Standard image resolution to be used : 350X250  ) </span> </p>
                                            <a href="javascript:void(0)" style="float: right" class="custom-file-container__image-clear" title="Clear Image">Clear Image
                                            <i class="fa fa-times text-danger" aria-hidden="true"></i></a>
                                            <label class="custom-file-container__custom-file" >
                                            <input type="file" class="custom-file-container__custom-file__custom-file-input" id="imgInp"  name="presidentPhoto" accept="image/*"  {{ $errors->has('presidentPhoto') ? 'autofocus' : 'null' }}>
                                                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                <span class="custom-file-container__custom-file__custom-file-control"></span>
                                            </label>
                                            <div class="custom-file-container__image-preview"></div>
                                        </div>
                                        {{-- </div>
                                    </div>
                                    <hr style="height:1px;border:none;color:#333;background-color:#333;" /> --}}
                                    {{-- <div class="row">
                                        <div class="col-6 col-md-6 col-sm-6"> --}}
                                            <hr style="height:1px;border:none;color:#333;background-color:#333;" />
                                        <div class="form-group">
                                            <p>Secretary Name <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="secretaryName" id="secretaryName" placeholder="Secretary Name " class="form-control noSpace" value="{{ old('secretaryName')}}"  {{ $errors->has('secretaryName') ? 'autofocus' : 'null' }} >
                                            <small class="text-danger">{{$errors->first('secretaryName')}}</small>
                                        </div>
                                        <div class="form-group">
                                            <p>Secretary Email <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="secretaryEmail" id="secretaryEmail" placeholder="Secretary Email" class="form-control noSpace" value="{{ old('secretaryEmail')}}"  {{ $errors->has('secretaryEmail') ? 'autofocus' : 'null' }}>
                                            <small class="text-danger">{{$errors->first('secretaryEmail')}}</small>
                                        </div>
                                        <div class="form-group">
                                            <p>Address <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <textarea name="secretaryDescription" id="secretaryDescription" class="form-control" cols="30" rows="5" maxlength="100" style="resize:none;"  {{ $errors->has('secretaryDescription') ? 'autofocus' : 'null' }} placeholder="Secretary Address" >{{old('secretaryDescription')}}</textarea>
                                            <small class="text-danger">{{$errors->first('secretaryDescription')}}</small>
                                        </div>
                                      {{-- </div> --}}
                                        {{-- <span style="color: red">( Image resolution must be 960x1280 * )</span> --}}
                                        {{-- <div class="col-6 col-md-6 col-sm-6"> --}}

                                        <small class="text-danger">{{$errors->first('secretaryPhoto')}}</small>
                                        <div class="custom-file-container" data-upload-id="Imagepreview3">
                                            <p style="float: left">Upload Secretary Image <span class="text-danger "  style="font-size:16pt;display: inline;">*</span>:<span style="color:#EDE04D"> ( Standard image resolution to be used : approx 350X250) </span> </p>
                                            <a href="javascript:void(0)" style="float: right" class="custom-file-container__image-clear" title="Clear Image">Clear Image
                                            <i class="fa fa-times text-danger" aria-hidden="true"></i></a>
                                            <label class="custom-file-container__custom-file" >
                                            <input type="file" class="custom-file-container__custom-file__custom-file-input" id="Inp2"  name="secretaryPhoto" accept="image/*"  {{ $errors->has('secretaryPhoto') ? 'autofocus' : 'null' }}>
                                                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                <span class="custom-file-container__custom-file__custom-file-control"></span>
                                            </label>
                                            <div class="custom-file-container__image-preview"></div>
                                        </div>
{{--
                                    </div>
                                </div> --}}
                                <hr style="height:1px;border:none;color:#333;background-color:#333;" />
                                        <div class="form-group">
                                            <p>Description <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <textarea name="description" id="description" class="form-control" cols="30" rows="10" placeholder="Description" {{ $errors->has('description') ? 'autofocus' : 'null' }} >{{old('description')}}</textarea>
                                            <small class="text-danger">{{$errors->first('description')}}</small>
                                        </div>
                                         <div id="new_layout_user_selection" style="display:;">
                                            <div class="form-group">
                                                <p>Managing-User <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                                <select id="managing_user_type" name="managing_user_type" class="form-control" onchange="manageUserType()" style="width:100%;max-width:100%;" onchange="managePresentation()" >
                                                                        <option value=""    >-Select-User-Type-</option>
                                                                        <option value="1"   @if(old('managing_user_type') =="1") selected @endif >Select Existing User</option>
                                                                        <option value="2"   @if(old('managing_user_type') == "2") selected @endif >Add New User</option>

                                                                    </select>
                                                                    <small class="text-danger">{{$errors->first('managing_user_type','Select atleast one option for user type')}}</small>


                                                </div>
                                                <div id="existing_user"  style="display:{{ (old('managing_user_type') !='1' ? 'none':'block')}}"> <div class="form-group">
                                                    <p>Select User <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                                    <select id="existing_users" name="existing_users" class="form-control existing_users" style="width:100%;max-width:100%;" style="display:{{ (old('managing_user_type') !='1' ? 'none':'block')}}" {{ $errors->has('existing_users') ? 'autofocus' : 'null' }} onchange="managePresentation()">
                                                        <option value="" selected>-Select-User-</option>
                                                        @foreach ($users as $user)
                                                           <option value="{{$user->id}}" @if(old('existing_users') == $user->id) selected @endif>{{$user->email}}</option>
                                                        @endforeach

                                                    </select>     
                                                    <small class="text-danger">{{$errors->first('existing_users','Select atleast an existing user to proceed')}}</small>
                                                                                           </div>
                                                 <!-- <div class="form-group">
                                                    <p>Password</p>
                                                    <input  type="text" name="password" id="password" placeholder="Password" class="form-control">
                                                </div> -->
                                            </div>
                                          
                                                <div id="new_user" class="new_user" style="display:{{ (old('managing_user_type') !='2' ? 'none':'block')}}"> <div class="form-group" >
                                                    <p>User Name <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                                        <input  type="text" name="username" id="username" placeholder="Full Name"   value="{{ old('username')}}"  class="form-control noSpace new_users" style="display:{{ (old('managing_user_type') !='2' ? 'none':'block')}}" {{ $errors->has('username') ? 'autofocus' : 'null' }}>
                                                        <small class="text-danger">{{$errors->first('username','The username field is required when managing user type is New User')}}</small>
                                                        <p>Email ID <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                                        <input  type="email" name="email" id="email" placeholder="email"   value="{{ old('email')}}"  class="form-control noSpace new_users" style="display:{{ (old('managing_user_type') !='2' ? 'none':'block')}}" {{ $errors->has('email') ? 'autofocus' : 'null' }}>
                                                        <small class="text-danger">{{$errors->first('email','The email field is required when managing user type is New User.')}}</small>
                                                    </div>
                                                    <div class="form-group">
                                                        <p>Password <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                                        <input  type="text" name="password" id="password" placeholder="Password"  class="form-control noSpace new_users"  style="display:{{ (old('managing_user_type') !='2' ? 'none':'block')}}" {{ $errors->has('password') ? 'autofocus' : 'null' }}>
                                                        <small class="text-danger">{{$errors->first('password','The password field is required when managing user type is New User')}}</small>
                                                    </div>
                                                </div>
                                        </div>
                                      
                                        <!-- <div class="form-group">
                                            <p>Password</p>
                                            <input value="password" type="text" name="password" id="password" placeholder="Password" class="form-control" required>
                                        </div> -->
                                        <button type="submit" class="btn btn-primary" style="margin: 10px">Submit</button>
                                        @if ($url == 'district_association')
                                            <button type="button" class="btn btn-danger" style="margin: 10px" onclick="goBack('/assoc_admin/district_association/{{$assoc_id}}')">Cancel</button>
                                        @else
                                             <button type="button" class="btn btn-danger" style="margin: 10px" onclick="goBack('/assoc_admin/other_association/{{$assoc_id}}')">Cancel</button>

                                        @endif

                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        </div>

<!--  END CONTENT AREA  -->
@endsection

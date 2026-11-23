@extends('layouts.admin.admin')
@section('script')
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('national_event', {
        filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
    function managePresentation(){
       var presentation = $("#event_presentation").val();
       if(presentation == 1){
        $("#internal_content").show();
        $("#new_layout_user_selection").hide();
        $("#external_link_div").hide();

            // $('.internal_content').prop('required',true);
            // $('.new_layout_user_selection').removeAttr('required');
            // $('.external_link').removeAttr('required');
            // $('.existing_user').removeAttr('required');
            // $('.new_user').removeAttr('required');
            $('#national_event').prop('disabled',false)
            $('#existing_users').prop('disabled',true)
            $('#event_managing_user_type').prop('disabled',true)
            $('#full_name').prop('disabled',true)
            $('#email').prop('disabled',true)
            $('#password').prop('disabled',true)
            $('#external_link').prop('disabled',true)



       }else if(presentation == 2){
        $("#internal_content").hide();
        $("#new_layout_user_selection").show();
        $("#external_link_div").hide();

            // $('.new_layout_user_selection').prop('required',true);
            // $('.internal_content').removeAttr('required');
            // $('.external_link').removeAttr('required');
            // $('.existing_user').removeAttr('required');
            // $('.new_user').removeAttr('required');
            $('#event_managing_user_type').prop('disabled',false)
            $('#national_event').prop('disabled',true)
            $('#existing_users').prop('disabled',false)
            $('#full_name').prop('disabled',false)
            $('#email').prop('disabled',false)
            $('#password').prop('disabled',false)
            $('#external_link').prop('disabled',true)

       }else if(presentation == 3){
        $("#internal_content").hide();
        $("#new_layout_user_selection").hide();
        $("#external_link_div").show();

            // $('.external_link').prop('required',true);
            // $('.internal_content').removeAttr('required');
            // $('.new_layout_user_selection').removeAttr('required');
            // $('.existing_user').removeAttr('required');
            // $('.new_user').removeAttr('required');
            $('#national_event').prop('disabled',true)
            $('#event_managing_user_type').prop('disabled',true)
            $('#existing_users').prop('disabled',true)
            $('#full_name').prop('disabled',true)
            $('#email').prop('disabled',true)
            $('#password').prop('disabled',true)
            $('#external_link').prop('disabled',false)

       }else{
            $('#national_event').prop('disabled',true)
            $('#event_managing_user_type').prop('disabled',true)
            $('#existing_users').prop('disabled',true)
            $('#full_name').prop('disabled',true)
            $('#email').prop('disabled',true)
            $('#password').prop('disabled',true)
            $('#external_link').prop('disabled',true)
            // $('.internal_content').removeAttr('required');
            // $('.new_layout_user_selection').removeAttr('required');
            // $('.existing_user').removeAttr('required');
            // $('.external_link_div').removeAttr('required');s
       }
    }
    function manageUserType(){
        var user_type = $("#event_managing_user_type").val();
        if(user_type == 1){
            $("#new_user").hide();
            $("#existing_user").show();
            // $('.new_user').removeAttr('required');
            // $('.existing_user').prop('required',true);
            $('#existing_users').prop('disabled',false)
            $('#full_name').prop('disabled',true)
            $('#email').prop('disabled',true)
            $('#password').prop('disabled',true)
       }else if(user_type == 2){
            $("#new_user").show();
            // $('.new_user').prop('required',true);
            // $('.existing_user').removeAttr('required');
            $("#existing_user").hide();
            $('#existing_users').prop('disabled',true)
            $('#full_name').prop('disabled',false)
            $('#email').prop('disabled',false)
            $('#password').prop('disabled',false)
       }else{
            $("#new_user").hide();
            $("#existing_user").hide();
            $('#existing_users').prop('disabled',true)
            $('#full_name').prop('disabled',true)
            $('#email').prop('disabled',true)
            $('#password').prop('disabled',true)
       }

    }
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
                                    <h4>Edit State Events</h4>
                                </div>                 
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                        @include('layouts.admin.alerts')

                            <div class="row">
                                <div class="col-lg-12 col-12 mx-auto">
                                    <form method="post" action="{{ route('assoc_admin.event_update',[$assoc_id,$event->id]) }}" enctype="multipart/form-data">
                                    @csrf
                                        
                                    <div class="form-group">
                                            <p>Title <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="title" value="{{old('title', $event->title) }}" id="title" placeholder="Title" class="form-control noSpace" {{ $errors->has('title ') ? 'autofocus' : '' }}>
                                            <small class="text-danger">{{ $errors->first('title') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <p>Location <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="location" value="{{ old('location',$event->location) }}" id="location" placeholder="Location" class="form-control noSpace"  {{ $errors->has('location') ? 'autofocus' : '' }}>
                                            <small class="text-danger">{{ $errors->first('location') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <p>Date <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="date" name="date" value="{{ old('date',$event->date) }}" id="date" placeholder="Date" class="form-control" {{ $errors->has('date') ? 'autofocus' : '' }} >
                                            <small class="text-danger">{{ $errors->first('date') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <p>Intro <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="intro" value="{{ old('intro',$event->intro) }}" id="intro" placeholder="Intro" class="form-control noSpace" {{ $errors->has('intro') ? 'autofocus' : '' }}>
                                            <small class="text-danger">{{ $errors->first('intro') }}</small>
                                        </div>

                                        <small class="text-danger">{{ $errors->first('coverImage') }}</small>
                                        <p>Upload Cover Image <span class="text-danger "  style="font-size:16pt;display: inline;">*</span>:<span style="color:#EDE04D"> ( Standard image resolution to be used :   approx 350X250 ) </span></p>

                                        <div class="custom-file mb-4">
                                            <input type="file" class="custom-file-input" id="imgInp" name="coverImage" style="cursor:pointer" {{ $errors->has('coverImage') ? 'autofocus' : '' }} >
                                            <label class="custom-file-label" for="customFile" style="cursor:pointer">Choose Cover Image file</label>
                                            <br><br>
                                            <img src="{{ $event->coverImage }}" id="coverImg" style="max-width: 20%" alt="">
                                        </div>
                                        <div class="form-group">
                                        <p>Select Event Presentation <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                        <select id="event_presentation" name="event_presentation" class="form-control" style="width:100%;max-width:100%;" required onchange="managePresentation()">
                                                                <option value="" selected>-Select-Presentation-</option>
                                                                <option value="1"  @if($event->content) selected @endif  >Present within main website</option>
                                                                <option value="2"  @if($event->user_access) selected @endif >Present as new website-layout</option>
                                                                <option value="3"  @if($event->link) selected @endif >Present as External-Link</option>

                                                            </select>
                                       
                                            <div id="internal_content" style="@if($event->content) display:block @else  display:none @endif" >
                                                <div class="form-group">
                                                
                                                    <p>Content <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                                    <textarea name="national_event" id="national_event" class="form-control " cols="30" rows="10" placeholder="international event" {{ $errors->has('national_event') ? 'autofocus' : '' }}>{{$event->content}}</textarea>
                                                    <small class="text-danger">{{$errors->first('national_event','Event description is required if "Present within main website" is selected')}}</small>
                                                </div>
                                            </div>  
                                                                                    
                                       
                                                <div id="new_layout_user_selection" style="@if($event->user_access) display:block @else  display:none @endif">
                                                    <div class="form-group">
                                                    
                                                        <p>Event-Managing <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                                        <select id="event_managing_user_type" name="event_managing_user_type" class="form-control new_layout_user_selection" onchange="manageUserType()" {{ $errors->has('event_managing_user_type') ? 'autofocus' : 'null' }} style="width:100%;max-width:100%;" onchange="managePresentation()" required>
                                                                                <option value=""    >-Select-User-Type-</option>
                                                                                <option value="1"   selected >Select Existing User</option>
                                                                                <option value="2"    >Add New User</option>

                                                                            </select>
                                                                            <small class="text-danger">{{$errors->first('event_managing_user_type','Select atleast one option for user type if "Present as new website-layout" is selected')}}</small>
                                                        </div>  
                                                        <div id="existing_user" > <div class="form-group">
                                                            <p>Select User<span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                                            <select id="existing_users" name="existing_users" class="form-control existing_user" style="width:100%;max-width:100%;" {{ $errors->has('existing_users') ? 'autofocus' : 'null' }} onchange="managePresentation()">
                                                                <option value="" selected>-Select-User-</option>
                                                                @foreach ($users as $user)
                                                                    @if($user->id == $event->user_id)
                                                                    <option value="{{$user->id}}"  selected >{{$user->email}}</option>
                                                                    @else
                                                                    <option value="{{$user->id}}" >{{$user->email}}</option>
                                                                    @endif
                                                                @endforeach


                                                                <!-- @foreach ($users as $user)
                                                                <option value="{{$user->id}}" @if(old('existing_users') == $user->id) selected @endif>{{$user->email}}</option>
                                                                @endforeach -->

                                                            </select>
                                                            <small class="text-danger">{{$errors->first('existing_users','Select atleast an existing user to proceed')}}</small>
                                                
                                                        </div>
                                                        <!-- <div class="form-group">
                                                            <p>Password</p>
                                                            <input  type="text" name="password" id="password" placeholder="Password" class="form-control">
                                                        </div> -->
                                                    </div>
                                                    <div id="new_user" style="display:none">
                                                        <div class="form-group">
                                                            <p>User Name <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                                            <input  type="text" name="full_name" id="full_name" placeholder="Full Name"   value="{{ old('full_name')}}"  class="form-control noSpace new_user"  {{ $errors->has('full_name') ? 'autofocus' : 'null' }}>
                                                            <small class="text-danger">{{$errors->first('full_name')}}</small>

                                                            <p>Email ID <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                                            <input  type="email" name="email" id="email" placeholder="email"   value="{{ old('email')}}"  class="form-control noSpace new_user"  {{ $errors->has('email') ? 'autofocus' : 'null' }}>
                                                            <small class="text-danger">{{$errors->first('email')}}</small>

                                                        </div>
                                                        <div class="form-group">
                                                            <p>Password <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                                            <input  type="text" name="password" id="password" placeholder="Password"  class="form-control noSpace new_user" {{ $errors->has('password') ? 'autofocus' : 'null' }}>
                                                            <small class="text-danger">{{$errors->first('password')}}</small>

                                                        </div>
                                                        
                                                    </div>
                                                  
                                        </div>
                                      
                                         
                                        <div id="external_link_div" style="@if($event->link) display:block @else  display:none @endif" >
                                            <div class="form-group">
                                            
                                                <p>Enter full external link</p>
                                                <input  type="text" name="external_link" id="external_link" placeholder="External Link" class="form-control external_link noSpace"  value="{{$event->link}}" {{ $errors->has('external_link') ? 'autofocus' : '' }}>
                                                <small class="text-danger">{{$errors->first('external_link','Event external link is required if "Present as External-Link" is selected')}}</small>
                                            </div>
                                        </div>

                                        
                                        
                                       
                                        </div>

                                        <button type="submit" class="btn btn-primary" style="margin: 10px">Submit</button>
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
<script>
    imgInp.onchange = evt => {
        const [file] = imgInp.files
           if (file) {
            coverImg.src = URL.createObjectURL(file)
            }
         }
  </script>
@endsection
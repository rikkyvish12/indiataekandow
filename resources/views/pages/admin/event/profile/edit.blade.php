@extends('layouts.admin.admin')



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
                                    <h4>Event Profile</h4>
                                </div>                 
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                        @include('layouts.admin.alerts')
                            <div class="row">
                            
                                <div class="col-lg-12 col-12 mx-auto">
                                    <form method="post" action="{{ route('event_admin.profile_update',[$event_id,$event_profile->id]) }}" enctype="multipart/form-data">
                                        @csrf
                                       
                                        
                                        <!-- <small class="text-danger">{{ $errors->first('logo') }}</small>

                                        <div class="custom-file mb-4">

                                            <input type="file" class="custom-file-input" id="imgInp" name="logo" {{ $errors->has('logo') ? 'autofocus' : 'null' }}>
                                            <label class="custom-file-label" for="customFile">Choose Logo fileChoose Logo file <span class="text-danger "  style="font-size:16pt;display: inline;">*</span> :<span style="color:#EDE04D"> ( Standard image resolution to be used : approx 352x395 ) </span></label>
                                            <br><br>
                                            <img src="{{ $event_profile->logo }}" id="logo" style="max-width: 100%" alt="">
                                        </div> -->
                                        <div class="form-group">
                                            <p>Email <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="email" name="email" id="email" value="{{old('email', $event_profile->email)}}" placeholder="Email" class="form-control noSpace" {{ $errors->has('email') ? 'autofocus' : 'null' }}>
                                            <small class="text-danger">{{ $errors->first('email') }}</small>

                                        </div>
                                        <div class="form-group">
                                            <p>Contact No.<span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="number" id="number" value="{{ old('number', ( $event_profile->number !== 'text') ? $event_profile->number : '' )}}" placeholder="Number" maxlength="10" class="form-control noZeroAtStart" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" {{ $errors->has('number') ? 'autofocus' : 'null' }}>
                                            <small class="text-danger">{{ $errors->first('number') }}</small>

                                        </div>
                                        <div class="form-group">
                                            <p>Facebook</p>
                                            <input  type="text" name="facebook" id="facebook" value="{{ old('facebook', ($event_profile->facebook !== 'text') ? $event_profile->facebook : '' ) }}" placeholder="Facebook" class="form-control noSpace"  >
                                        </div>
                                        <div class="form-group">
                                            <p>Instagram</p>
                                            <input  type="text" name="instagram" id="instagram" value="{{ old('instagram', ( $event_profile->instagram !== 'text') ? $event_profile->instagram : '' ) }}" placeholder="Instagram" class="form-control noSpace"  >
                                        </div>
                                        <div class="form-group">
                                            <p>Address <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                           <textarea name="address" id="address" cols="10" rows="3" class="form-control" placeholder="Address" {{ $errors->has('address') ? 'autofocus' : 'null' }}>{{ old('address',$event_profile->address)  }}</textarea>
                                           <small class="text-danger">{{ $errors->first('address') }}</small>

                                        </div>
                                        <div class="form-group">
                                            <p>Description <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                           <textarea name="description" id="description" cols="10" rows="3" class="form-control" placeholder="Description" {{ $errors->has('description') ? 'autofocus' : 'null' }}>{{old('description', $event_profile->description) }}</textarea>
                                           <small class="text-danger">{{ $errors->first('description') }}</small>

                                        </div>
                                       
                                        <button type="submit" class="btn btn-primary" style="margin: 10px">Submit</button>
                                        <button type="button" class="btn btn-danger" style="margin: 10px" onclick="goBack('/event_admin/profile/{{$event_id}}')">Cancel</button>

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
                logo.src = URL.createObjectURL(file)
            }
       }
</script>
@endsection

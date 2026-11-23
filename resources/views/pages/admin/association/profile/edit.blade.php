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
                                    <h4>State Profile</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                        @include('layouts.admin.alerts')

                            <div class="row">
                                <div class="col-lg-12 col-12 mx-auto">
                                    <form method="post" action="{{ route('assoc_admin.assoc_profile_update',$assoc_id) }}" enctype="multipart/form-data">
                                        @csrf

                                        <!-- <small class="text-danger">{{ $errors->first('logo') }}</small> -->
                                        <!-- <div class="custom-file mb-4">
                                            <input type="file" class="custom-file-input" id="imgInp" name="logo"  style="cursor:pointer" {{ $errors->has('logo') ? ' has-error' : '' }} >
                                            <label class="custom-file-label" for="customFile">Choose Logo file <span class="text-danger "  style="font-size:16pt;display: inline;">*</span> :<span style="color:#EDE04D"> ( Standard image resolution to be used : approx 352x395) </span></label>
                                            <br><br>
                                            <img src="{{$assoc_profile->logo}}" id="logo" style="max-width: 100%" alt="">
                                        </div> -->
                                        <div class="form-group">
                                            <p>Email <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="email" name="email" id="email" value="{{old('email',  $assoc_profile->email) }}" placeholder="email" class="form-control noSpace" {{ $errors->has('email') ? 'autofocus' : 'null' }} >
                                            <small class="text-danger">{{$errors->first('email')}}</small>
                                        </div>
                                        <div class="form-group">
                                            <p>Contact No. <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="number" id="number" value="{{old('number', ($assoc_profile->number !== 'text') ? $assoc_profile->number : ''  ) }}" placeholder="Number" class="form-control noSpace" {{ $errors->has('number') ? 'autofocus' : 'null' }} >
                                            <small class="text-danger">{{$errors->first('number')}}</small>
                                        </div>
                                        <div class="form-group">
                                            <p>Facebook</p>
                                            <input  type="text" name="facebook" id="facebook" value="{{ old('facebook', ($assoc_profile->facebook !== 'text') ? $assoc_profile->facebook : '' ) }}" placeholder="Facebook" class="form-control noSpace" {{ $errors->has('facebook') ? 'autofocus' : 'null' }} >
                                            <small class="text-danger">{{$errors->first('facebook')}}</small>
                                        </div>
                                        <div class="form-group">
                                            <p>Instagram</p>
                                            <input  type="text" name="instagram" id="instagram" value="{{ old('instagram', ($assoc_profile->instagram !== 'text') ? $assoc_profile->instagram : ''  ) }}" placeholder="Instagram" class="form-control noSpace" {{ $errors->has('instagram') ? 'autofocus' : 'null' }} >
                                            <small class="text-danger">{{$errors->first('instagram')}}</small>
                                        </div>
                                        <div class="form-group">
                                            <p>Address <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                           <textarea name="address" id="address" cols="10" rows="3" class="form-control" placeholder="Address" {{ $errors->has('address') ? 'autofocus' : 'null' }} >{{ old('address',$assoc_profile->address) }}</textarea>
                                           <small class="text-danger">{{$errors->first('address')}}</small>
                                        </div>
                                        <div class="form-group">
                                            <p>Description <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                           <textarea name="description" id="description" cols="10" rows="3" class="form-control" placeholder="Description" {{ $errors->has('description') ? 'autofocus' : 'null' }} >{{ old('description',$assoc_profile->description) }}</textarea>
                                           <small class="text-danger">{{$errors->first('description')}}</small>
                                        </div>
                                        <div class="form-group">
                                          <p>Send-To-Email <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                          <input  type="email" name="send_to_email" id="send_to_email" placeholder="Send-To-Email" value="{{old('send_to_email',$assoc_profile->send_to_email)}}" class="form-control noSpace" {{ $errors->has('send_to_email') ? 'autofocus' : 'null' }}   > 
                                          <small class="text-danger">{{ $errors->first('send_to_email') }}</small>
                                      </div>

                                      <div class="form-group">
                                          <p>Send-To-Email-2 <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                          <input  type="email" name="send_to_email_2" id="send_to_email_2" placeholder="Send-To-Email-2" value="{{old('send_to_email_2',$assoc_profile->send_to_email_2)}}" class="form-control noSpace"   > 
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
<!-- <script>
    imgInp.onchange = evt => {
        const [file] = imgInp.files
           if (file) {
            logo.src = URL.createObjectURL(file)
            }
         }
  </script> -->
@endsection

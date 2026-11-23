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
                                    <h4>Default Background</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            @include('layouts.admin.alerts')
                            <div class="row">
                                <div class="col-lg-12 col-12 mx-auto">
                                    <form method="post" action="{{ route('assoc_admin.state_default_background_update',[$assoc_id,$defaults->id]) }}" enctype="multipart/form-data">
                                        @csrf

                                        <small class="text-danger">{{ $errors->first('logo') }}</small>
                                        <div class="custom-file mb-4">
                                            <input type="file" class="custom-file-input" id="imgInplogo" name="logo"  style="cursor:pointer" {{ $errors->has('logo') ? ' has-error' : '' }} >
                                            <label class="custom-file-label" for="customFile">Choose Logo file   :<span style="color:#EDE04D"> ( Standard image resolution to be used : approx 350X250 ) </span></label>
                                            <br><br>
                                            <img src="{{$defaults->logo}}" id="logoPrev" style="max-width: 100%" alt="">
                                        </div>

                                        <small class="text-danger">{{ $errors->first('background') }}</small>
                                        <div class="custom-file mb-4">
                                            <input type="file" class="custom-file-input" id="imgInp" name="background" style="cursor:pointer" {{ $errors->has('background') ? ' has-error' : '' }} >
                                            <label class="custom-file-label" for="customFile" style="cursor:pointer">Choose Background Image file :<span style="color:#EDE04D"> ( Standard image resolution to be used : approx 1920x1157 ) </span></label>
                                            <br><br>
                                            <img src="{{ $defaults->background }}" id="bg_img" style="max-width: 100%" alt="">
                                        </div>

                                        <small class="text-danger">{{ $errors->first('banner') }}</small>
                                        <div class="custom-file mb-4">
                                            <input type="file" class="custom-file-input" id="Inp2" name="banner" style="cursor:pointer" {{ $errors->has('banner') ? ' has-error' : '' }}>
                                            <label class="custom-file-label" for="customFile" style="cursor:pointer">Choose Banner Image file  :<span style="color:#EDE04D"> ( Standard image resolution to be used : 1920x300 ) </span></label>
                                            <br><br>
                                            <img src="{{ $defaults->banner }}" id="bann_img" style="max-width: 100%" alt="">
                                        </div>

                                        

                                        <button type="submit" class="btn btn-primary" style="margin: 10px">Submit</button>
                                        <button type="button" class="btn btn-danger" style="margin: 10px" onclick="goBack('/assoc_admin/profile/{{$assoc_id}}')">Cancel</button>

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
     imgInplogo.onchange = evt => {
        const [file] = imgInplogo.files
           if (file) {
            logoPrev.src = URL.createObjectURL(file)
            }
         }

    imgInp.onchange = evt => {
        const [file] = imgInp.files
           if (file) {
            bg_img.src = URL.createObjectURL(file)
            }
         }
         Inp2.onchange = evt => {
        const [file] = Inp2.files
           if (file) {
            bann_img.src = URL.createObjectURL(file)
            }
         }
  </script>
 
@endsection

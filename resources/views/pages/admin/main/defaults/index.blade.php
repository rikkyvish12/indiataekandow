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
                                @if (isset($defaults))
                                    <div class="col-lg-12 col-12 mx-auto">
                                    <form method="POST" action="{{ route('admin.default_background.update',$defaults->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        {{ method_field('PUT') }}
                                        <small class="text-danger">{{ $errors->first('logo') }}</small>
                                        <div class="custom-file mb-4">
                                          <input type="file" class="custom-file-input" id="imgInp" name="logo" style="cursor:pointer" {{ $errors->has('logo') ? ' has-error' : '' }} >
                                          <label class="custom-file-label" for="customFile" style="cursor:pointer">Choose Logo file   :<span style="color:#EDE04D"> ( Standard image resolution to be used : approx 350X250 ) </span></label>
                                          <br><br>
                                          <img src="{{ $defaults->logo }}" id="logo" style="width: 20%; height:20%;" alt="">
                                      </div>
                                        <small class="text-danger">{{ $errors->first('background') }}</small>
                                        <div class="custom-file mb-4" >
                                            <input type="file" class="custom-file-input" id="bgimgInp" name="background"  style="cursor:pointer" {{ $errors->has('background') ? ' has-error' : '' }} >
                                            <label class="custom-file-label" for="customFile" style="cursor:pointer">Choose Background Image file :<span style="color:#EDE04D"> ( Standard image resolution to be used : approx 1920x1157 ) </span></label>
                                            <br><br>
                                            <img src="{{ $defaults->background }}" id="bgImg" style="max-width: 20%" alt="">
                                        </div>

                                        <small class="text-danger">{{ $errors->first('banner') }}</small>
                                        <div class="custom-file mb-4" style="cursor:pointer">
                                            <input type="file" class="custom-file-input" id="banimgInp" name="banner" {{ $errors->has('banner') ? ' has-error' : '' }}  style="cursor:pointer">
                                            <label class="custom-file-label" for="customFile" style="cursor:pointer">Choose Banner Image file  :<span style="color:#EDE04D"> ( Standard image resolution to be used : 1920x300 ) </span></label>
                                            <br><br>
                                            <img src="{{ $defaults->banner }}" id="bannerImg" style="max-width: 20%" alt="">
                                        </div>

                                        <small class="text-danger">{{ $errors->first('footerBackground') }}</small>
                                            <div class="custom-file mb-4" style="cursor:pointer">
                                                <input type="file" class="custom-file-input" id="footerBackgroundInp" name="footerBackground" {{ $errors->has('footerBackground') ? ' has-error' : '' }}  style="cursor:pointer">
                                                <label class="custom-file-label" for="customFile" style="cursor:pointer">Choose Footer BG Image  :<span style="color:#EDE04D"> ( Standard image resolution to be used : 1920x1157, preferably dark colors ) </span></label>
                                                <br><br>
                                                <img src="{{ $defaults->footerBackground }}" id="footerBackgroundImg" style="max-width: 20%" alt="">
                                            </div>

                                        {{-- <div class="custom-file mb-4">
                                            <input type="file" class="custom-file-input" id="Inp2" name="news_background" >
                                            <label class="custom-file-label" for="customFile">Choose News Background Image file :<span style="color:#EDE04D"> ( Standard image resolution to be used : Between  to ) </span></label>
                                            <br><br>
                                            <img src="{{ $defaults->news_background }}" style="max-width: 100%" alt="">
                                        </div> --}}
                                        <button type="submit" class="btn btn-primary" style="margin: 10px">Submit</button>
                                    </form>
                                </div>
                                @else
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <div class="col-lg-12 col-12 mx-auto">
                                        <form method="POST" action="{{ route('admin.default_background.store') }}" enctype="multipart/form-data">
                                            @csrf
                                            {{ method_field('POST') }}
                                            <small class="text-danger">{{ $errors->first('logo') }}</small>
                                            <div class="custom-file-container" data-upload-id="Imagepreview1">
                                                <p style="float: left">Upload Logo Image <span class="text-danger "  style="font-size:16pt;display: inline;">*</span>:<span style="color:#EDE04D">( Standard image resolution to be used :  approx 350X250) </span>
                                                </p>
                                                <a href="javascript:void(0)" style="float: right" class="custom-file-container__image-clear" title="Clear Image">Clear Image
                                                <i class="fa fa-times text-danger" aria-hidden="true"></i></a>
                                                <label class="custom-file-container__custom-file" >
                                                    <input type="file" class="custom-file-input" id="imgInp" name="logo" style="cursor:pointer" {{ $errors->has('logo') ? 'autofocus' : 'null' }} >
                                                    <label class="custom-file-label" for="customFile" style="cursor:pointer">Choose Logo file    :<span style="color:#EDE04D"> ( Standard image resolution to be used : approx 350X250 ) </span></label>
                                                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                                                </label>
                                                <div class="custom-file-container__image-preview"></div>
                                            </div>

                                    
                                            <small class="text-danger">{{ $errors->first('background') }}</small>
                                            <div class="custom-file-container" data-upload-id="Imagepreview2">
                                                <p style="float: left">Choose Background Image file :<span class="text-danger "  style="font-size:16pt;display: inline;">*</span>:<span style="color:#EDE04D">( Standard image resolution to be used : approx 1920x1157 ) </span>
                                                </p>
                                                <a href="javascript:void(0)" style="float: right" class="custom-file-container__image-clear" title="Clear Image">Clear Image
                                                <i class="fa fa-times text-danger" aria-hidden="true"></i></a>
                                                <label class="custom-file-container__custom-file" >
                                                    <input type="file" class="custom-file-input" id="bgimgInp" name="background"  style="cursor:pointer" {{ $errors->has('background') ? ' has-error' : '' }} >
                                                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                                                </label>
                                                <div class="custom-file-container__image-preview"></div>
                                            </div>
 
                                            <small class="text-danger">{{ $errors->first('banner') }}</small>
                                            <div class="custom-file-container" data-upload-id="Imagepreview3">
                                                <p style="float: left">Choose Banner Image file  :<span class="text-danger "  style="font-size:16pt;display: inline;">*</span>:<span style="color:#EDE04D">( Standard image resolution to be used : approx 1920x300 )</span>
                                                </p>
                                                <a href="javascript:void(0)" style="float: right" class="custom-file-container__image-clear" title="Clear Image">Clear Image
                                                <i class="fa fa-times text-danger" aria-hidden="true"></i></a>
                                                <label class="custom-file-container__custom-file" >
                                                    <input type="file" class="custom-file-input" id="banimgInp" name="banner"  style="cursor:pointer" {{ $errors->has('banner') ? ' has-error' : '' }}>
                                                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                                                </label>
                                                <div class="custom-file-container__image-preview"></div>
                                            </div>

 
                                            <small class="text-danger">{{ $errors->first('footerBackground') }}</small>
                                            <div class="custom-file-container" data-upload-id="Imagepreview4">
                                                <p style="float: left">Choose Footer BG Image  :<span class="text-danger "  style="font-size:16pt;display: inline;">*</span>:<span style="color:#EDE04D">( Standard image resolution to be used : 1920x1157, preferably dark colors  ) </span>
                                                </p>
                                                <a href="javascript:void(0)" style="float: right" class="custom-file-container__image-clear" title="Clear Image">Clear Image
                                                <i class="fa fa-times text-danger" aria-hidden="true"></i></a>
                                                <label class="custom-file-container__custom-file" >
                                                    <input type="file" class="custom-file-input" id="footerBackgroundInp" name="footerBackground" {{ $errors->has('footerBackground') ? ' has-error' : '' }}  style="cursor:pointer">
                                                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                                                </label>
                                                <div class="custom-file-container__image-preview"></div>
                                            </div>


                     

                                            {{-- <div class="custom-file mb-4">
                                                <input type="file" class="custom-file-input" id="Inp2" name="news_background" >
                                                <label class="custom-file-label" for="customFile">Choose News Background Image file :<span style="color:#EDE04D"> ( Standard image resolution to be used : Between  to ) </span></label>
                                                <br><br>
                                                <img src="{{ $defaults->news_background }}" style="max-width: 100%" alt="">
                                            </div> --}}
                                            <button type="submit" class="btn btn-primary" style="margin: 10px">Submit</button>
                                            <button type="button" class="btn btn-danger" style="margin: 10px" onclick="goBack('/admin/profile')">Cancel</button>

                                        </form>
                                    </div>                                </div>
                                @endif
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


    bgimgInp.onchange = evt => {
   const [file] = bgimgInp.files
    if (file) {
        bgImg.src = URL.createObjectURL(file)
    }
}
banimgInp.onchange = evt => {
   const [file] = banimgInp.files
    if (file) {
        bannerImg.src = URL.createObjectURL(file)
    }
}

footerBackgroundInp.onchange = evt => {
   const [file] = footerBackgroundInp.files
    if (file) {
        footerBackground.src = URL.createObjectURL(file)
    }
}
</script>
@endsection

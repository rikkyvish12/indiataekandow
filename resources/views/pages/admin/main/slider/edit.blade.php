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
                                    <h4>Edit Slider</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">


                            <div class="row">
                                <div class="col-lg-12 col-12 mx-auto">
                                    <form method="post" action="{{ route('admin.slider.update',$slider->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        {{ method_field('PUT') }}
                                        <div class="form-group">
                                            <p>Position <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input value="{{ old('position',$slider->position) }}"  type="text" name="position" id="position" class="form-control noZeroAtStart" placeholder="Position" {{ $errors->has('position') ? 'autofocus' : 'null' }}  onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))"  >
                                            <small class="text-danger">{{ $errors->first('position') }}</small>
                                        </div>
                                        <!-- <div class="form-group">
                                            <p>Title</p>
                                            <input  type="text" value="{{ $slider->title }}" name="title" id="title" placeholder="Title" class="form-control" required>
                                        </div> -->
                                        <div class="form-group">
                                            <p>Description</p>
                                            <input  type="text" value="{{ old('description',$slider->description) }}" name="description" id="description" placeholder="Description" class="form-control noSpace" maxlength="90" >
                                        </div>
                                        <div class="form-group">
                                            <p>URL: <span style="color:#EDE04D"> (Please enter full URL for eg: http or https://www.abc.com )</span></p>
                                                <div class="row">
                                                    <div class="col-lg-12 col-12 mx-auto">
                                                            <!-- <select id="protocol" name="protocol" class="form-control" style="width:100%;max-width:90%;" >
                                                                <option  value="http"  {{ (old("protocol") == 'http' ? "selected":"") }} >http</option>
                                                                <option  value="https"   {{ (old("protocol") == 'https' ? "selected":"") }} value="https">https</option>
                                                            </select> -->
                                                            <input  type="text" name="url" id="url" placeholder="URL" class="form-control" value="{{old('url',$slider->url)}}" {{ $errors->has('url') ? 'autofocus' : 'null' }} >
                                                            <small class="text-danger">{{ $errors->first('url') }}</small>

                                                    </div>
                                                    <!-- <div class="col-lg-10 col-10 mx-auto">
                                                            <input  type="text" name="url" id="url" placeholder="Please enter full URL for eg: www.google.com" class="form-control noSpace"  value="{{ old('url')}}">
                                                    </div> -->
                                                </div>



                                        </div>
                                        <div class="form-group">
                                            <p>Link Button Text</p>
                                            <input  type="text" name="linkButtonText" id="linkButtonText" placeholder="Link Button Text" class="form-control noSpace"  value="{{old('linkButtonText',$slider->linkButtonText)}}"   >
                                        </div>

                                        <small class="text-danger">{{ $errors->first('backgroundImage') }}</small>
                                        <p style="float: left">Upload Background Image file <span class="text-danger "  style="font-size:16pt;display: inline;">*</span> :<span style="color:#EDE04D"> ( Standard image resolution to be used :  approx 1920x750 ) </span> </p>
                                        <div class="custom-file mb-4">
                                            <input type="file" class="custom-file-input" id="backgroundImage" name="backgroundImage" style="cursor:pointer" {{ $errors->has('backgroundImage') ? ' has-error' : '' }}   accept="image/*">
                                            <label class="custom-file-label" for="customFile"  style="cursor:pointer">Choose Background Image file  </label>
                                            <br><br>
                                            <img src="{{ $slider->backgroundImage }}" id="bImg" style="max-width: 50%" alt="">
                                        </div>
                                        <!-- <div class="custom-file mb-4">
                                            <input type="file" class="custom-file-input" id="Inp2" name="playerImage">
                                            <label class="custom-file-label" for="customFile">Choose Player Image file  :<span style="color:#EDE04D"> ( Standard image resolution to be used : approx 1920x750 ) </span></label>
                                            <br><br>
                                            <img src="{{ $slider->playerImage }}" id="pImg" style="max-width: 50%" alt="">
                                        </div> -->
                                        <small class="text-danger">{{ $errors->first('playerImage') }}</small>

                                        <div class="custom-file-container" data-upload-id="Imagepreview1" >
                                            <p style="float: left" >Upload Player Image file <span style="color:#EDE04D">: ( Standard image resolution to be used :approx 525x750  )</span></p>
                                            <a href="javascript:void(0)" style="float: right" class="custom-file-container__image-clear-selected" title="Clear Image" onclick="loadOldImage('{{ $slider->coverImage }}')">Clear Image
                                            <i class="fa fa-times text-danger" aria-hidden="true"></i></a>
                                            <label class="custom-file-container__custom-file"  style="cursor:pointer">
                                                <input type="file" class="custom-file-container__custom-file__custom-file-input step_1" id="playerImage"  name="playerImage"  {{ $errors->has('playerImage') ? 'autofocus' : '' }} accept="image/*"  style="cursor:pointer">
                                                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                <span class="custom-file-container__custom-file__custom-file-control"></span>
                                            </label>
                                                <img src="{{$slider->playerImage}}"  id="pImg">


                                        </div>

                                        <button type="submit" class="btn btn-primary" style="margin: 10px">Submit</button>
                                        <button type="button" class="btn btn-danger" style="margin: 10px" onclick="goBack('/admin/slider')">Cancel</button>

                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        </div>


        <script>
             function loadOldImage(old_path){
                pImg.src = old_path;
            $("#pImg").empty();
        }

   playerImage.onchange = evt => {
    const [file] = playerImage.files
     if (file) {
        pImg.src = URL.createObjectURL(file)
     }
   }

   backgroundImage.onchange = evt => {
    const [file] = backgroundImage.files
     if (file) {
        bImg.src = URL.createObjectURL(file)
     }
   }


        </script>

<!--  END CONTENT AREA  -->
@endsection

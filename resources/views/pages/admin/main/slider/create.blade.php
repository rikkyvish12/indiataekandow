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
                                    <h4>Create Slider</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">


                            <div class="row">
                                <div class="col-lg-12 col-12 mx-auto">
                                    <form method="post" action="{{ route('admin.slider.store') }}" enctype="multipart/form-data">
                                    @csrf

                                        <div class="form-group">
                                            <p>Position <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="position" class="form-control noZeroAtStart noSpace" value="{{ old('position')}}" id="position" {{ $errors->has('position') ? 'autofocus' : 'null' }} placeholder="Position"   onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))"  >
                                            <small class="text-danger">{{ $errors->first('position') }}</small>

                                        </div>
                                        <!-- <div class="form-group">
                                            <p>Title</p>
                                            <input  type="text" name="title" id="title" placeholder="Title" class="form-control" required>
                                        </div> -->
                                        <div class="form-group">
                                            <p>Description</p>
                                            <input  type="text" name="description" id="description" placeholder="Description" class="form-control noSpace" value="{{ old('description')}}" maxlength="90" >
                                        </div>
                                        <div class="form-group">
                                            <p>URL: <span style="color:#EDE04D"> (Please enter full URL for eg: http or https://www.abc.com )</span></p>
                                                <div class="row">
                                                    <div class="col-lg-12 col-12 mx-auto">
                                                            <!-- <select id="protocol" name="protocol" class="form-control" style="width:100%;max-width:90%;" >
                                                                <option  value="http"  {{ (old("protocol") == 'http' ? "selected":"") }} >http</option>
                                                                <option  value="https"   {{ (old("protocol") == 'https' ? "selected":"") }} value="https">https</option>
                                                            </select> -->
                                                            <input  type="text" name="url" id="url" placeholder="URL" class="form-control" value="{{ old('url')}}" {{ $errors->has('url') ? 'autofocus' : 'null' }}>
                                                            <small class="text-danger">{{ $errors->first('url') }}</small>

                                                    </div>
                                                    <!-- <div class="col-lg-10 col-10 mx-auto">
                                                            <input  type="text" name="url" id="url" placeholder="Please enter full URL for eg: www.google.com" class="form-control noSpace"  value="{{ old('url')}}">
                                                    </div> -->
                                                </div>
                                        </div>
                                        <div class="form-group">
                                            <p>Link Button Text</p>
                                            <input  type="text" name="linkButtonText" id="linkButtonText" placeholder="Link Button Text" value="{{ old('linkButtonText')}}" class="form-control noSpace">
                                        </div>

                                        <small class="text-danger">{{ $errors->first('backgroundImage') }}</small>
                                        <div class="custom-file-container" data-upload-id="Imagepreview1">

                                            <p style="float: left">Upload Background Image file <span class="text-danger "  style="font-size:16pt;display: inline;">*</span> :<span style="color:#EDE04D"> ( Standard image resolution to be used :  approx 1920x750 ) </span> </p>
                                            <a href="javascript:void(0)" style="float: right" class="custom-file-container__image-clear" title="Clear Image">Clear Image
                                            <i class="fa fa-times text-danger" aria-hidden="true"></i></a>
                                            <label class="custom-file-container__custom-file" >
                                                <input type="file" class="custom-file-container__custom-file__custom-file-input" class="imgInp" id="imgInp" {{ $errors->has('backgroundImage') ? 'autofocus' : '' }}  name="backgroundImage" accept="image/*"  >
                                                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                <span class="custom-file-container__custom-file__custom-file-control"></span>
                                            </label>
                                            <div class="custom-file-container__image-preview"></div>


                                        </div>


                                        <small class="text-danger">{{ $errors->first('playerImage') }}</small>
                                        <div class="custom-file-container" data-upload-id="Imagepreview2">
                                            <p style="float: left">Upload Player Image file  :<span style="color:#EDE04D"> ( Standard image resolution to be used :  approx 525x750 ) </span> </p>
                                            <a href="javascript:void(0)" style="float: right" class="custom-file-container__image-clear" title="Clear Image">Clear Image
                                            <i class="fa fa-times text-danger" aria-hidden="true"></i></a>
                                            <label class="custom-file-container__custom-file" >
                                                <input type="file" class="custom-file-container__custom-file__custom-file-input" id="Inp2"  name="playerImage" accept="image/*" {{ $errors->has('playerImage') ? 'autofocus' : '' }}>
                                                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                <span class="custom-file-container__custom-file__custom-file-control"></span>
                                            </label>
                                            <div class="custom-file-container__image-preview"></div>
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

<!--  END CONTENT AREA  -->
@endsection

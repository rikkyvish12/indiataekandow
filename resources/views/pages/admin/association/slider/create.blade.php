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
                        @include('layouts.admin.alerts')

                            <div class="row">
                                <div class="col-lg-12 col-12 mx-auto">
                                    <form method="post" action="{{ route('assoc_admin.state_slider_store',$assoc_id) }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                        <p>Position <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="position" class="form-control noZeroAtStart noSpace" value="{{ old('position')}}" id="position" {{ $errors->has('position') ? 'autofocus' : 'null' }} placeholder="Position"   onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))"  >
                                            <small class="text-danger">{{ $errors->first('position') }}</small>

                                        </div>
                                        <!-- <span style="color:#EDE04D"> ( Note: Only 'jpg & jpeg' as case sensetive format is supported. Resolution '1920 x 1030' pixels are allowed.) </span><br /> -->
                                      <!-- <br /> -->

                                      <small class="text-danger">{{ $errors->first('image') }}</small>

                                        <div class="custom-file-container" data-upload-id="Imagepreview1">
                                        <p style="float: left">Upload Slider Image <span class="text-danger "  style="font-size:16pt;display: inline;">*</span> :<span style="color:#EDE04D"> ( Standard image resolution to be used :  approx 1920x750 ) </span> </p>
                                            <a href="javascript:void(0)" style="float: right" class="custom-file-container__image-clear" title="Clear Image">Clear Image
                                            <i class="fa fa-times text-danger" aria-hidden="true"></i></a>
                                            <label class="custom-file-container__custom-file" >
                                                <input type="file" class="custom-file-container__custom-file__custom-file-input" id="imgInp"  name="image" accept="image/*" {{ $errors->has('image') ? 'autofocus' : '' }}>
                                                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                <span class="custom-file-container__custom-file__custom-file-control"></span>
                                            </label>
                                            <div class="custom-file-container__image-preview"></div>
                                        </div>
                                        <button type="submit" class="btn btn-primary" style="margin: 10px">Submit</button>
                                        <button type="button" class="btn btn-danger" style="margin: 10px" onclick="goBack('/assoc_admin/slider/{{$assoc_id}}')">Cancel</button>

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

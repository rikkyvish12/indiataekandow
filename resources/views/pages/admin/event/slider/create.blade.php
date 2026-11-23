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
                                    <form method="post" action="{{ route('event_admin.slider_store',$event_id) }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <p>Position <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="position" id="position" placeholder="Position" class="form-control noZeroAtStart" onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))" value="{{old('position')}}" {{ $errors->has('position') ? 'autofocus' : '' }}>
                                            <small class="text-danger">{{ $errors->first('position') }}</small>

                                        </div>

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
                                        <button type="button" class="btn btn-danger" style="margin: 10px" onclick="goBack('/event_admin/slider/{{$event_id}}')">Cancel</button>

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
            bImg.src = URL.createObjectURL(file)
            }
         }
  </script>
@endsection


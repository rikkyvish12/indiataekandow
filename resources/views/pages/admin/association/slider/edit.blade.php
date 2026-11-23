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
                        @include('layouts.admin.alerts')
                            <div class="row">
                                <div class="col-lg-12 col-12 mx-auto">
                                    <form method="post" action="{{ route('assoc_admin.state_slider_update',[$assoc_id,$slider->id]) }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <p>Position <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input value="{{ old('position',$slider->position) }}"  type="text" name="position" id="position" class="form-control noZeroAtStart" placeholder="Position" {{ $errors->has('position') ? 'autofocus' : 'null' }}  onKeyUp="$(this).val($(this).val().replace(/[^\d]/ig, ''))"  >
                                            <small class="text-danger">{{ $errors->first('position') }}</small>

                                        </div>

                                        <small class="text-danger">{{ $errors->first('image') }}</small>
                                        <p style="float: left">Upload Slider Image <span class="text-danger "  style="font-size:16pt;display: inline;">*</span> :<span style="color:#EDE04D"> ( Standard image resolution to be used :  approx 1920x750 ) </span> </p>
                                        <div class="custom-file mb-4">
                                            <input type="file" class="custom-file-input" id="imgInp" name="image" style="cursor:pointer" {{ $errors->has('image') ? ' has-error' : '' }}   accept="image/*">
                                            <label class="custom-file-label" for="customFile" style="cursor:pointer">Choose  Image file</label>
                                            <br><br>
                                            <img src="{{ $slider->image }}" id="bImg" style="max-width: 50%" alt="">
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
<script>
    imgInp.onchange = evt => {
        const [file] = imgInp.files
           if (file) {
            bImg.src = URL.createObjectURL(file)
            }
         }
  </script>
@endsection

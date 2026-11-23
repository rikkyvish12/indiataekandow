@extends('layouts.admin.admin')

@section('script')
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('other_event', {
        filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
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
                                    <h4>Create Find Event Near Me</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                        @include('layouts.admin.alerts')
                            <div class="row">
                                <div class="col-lg-12 col-12 mx-auto">
                                    <form method="post" action="{{ route('admin.other_event.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                        <p>Title/Name <span class="text-danger "  style="font-size:16pt;display: inline;">*</span> :<span style="color:#EDE04D">  (Title should be short and simple) </span></p>
                                            <input  type="text" name="title" id="title" placeholder="Title/Name" class="form-control noSpace"  value="{{old('title')}}" {{ $errors->has('title') ? 'autofocus' : '' }}>
                                            <small class="text-danger">{{ $errors->first('title') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <p>Location <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="location" id="location" placeholder="Location" class="form-control noSpace"  value="{{old('title')}}"  {{ $errors->has('location') ? 'autofocus' : '' }}>
                                            <small class="text-danger">{{ $errors->first('location') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <p>Date <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="date" name="date" id="date" placeholder="Date" class="form-control" value="{{old('date')}}" {{ $errors->has('date') ? 'autofocus' : '' }}>
                                            <small class="text-danger">{{ $errors->first('date') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <p>Intro <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="intro" id="intro" placeholder="Intro" class="form-control noSpace" value="{{old('intro')}}" {{ $errors->has('intro') ? 'autofocus' : '' }}>
                                            <small class="text-danger">{{ $errors->first('intro') }}</small>
                                        </div>
                                        {{-- <div class="form-group">
                                            <p>Link</p>
                                            <div class="row">
                                                    <div class="col-lg-2 col-2 mx-auto">
                                                            <select id="protocol" name="protocol" class="form-control" style="width:100%;max-width:90%;" value="{{old('protocol')}}" >
                                                            <option  value="http"  {{ (old("protocol") == 'http' ? "selected":"") }} >http</option>
                                                            <option  value="https"  {{ (old("protocol") == 'https' ? "selected":"") }} >https</option>
                                                            </select>
                                                            <!-- <input  type="text" name="url" id="url" placeholder="url" class="form-control" style="width:70%"> -->
                                                    </div>
                                                    <div class="col-lg-10 col-10 mx-auto">
                                                            <!-- <select id="protocol" name="protocol" class="form-control" style="width:20%">
                                                                <option value="1">http</option>
                                                                <option value="2">https</option>
                                                            </select> -->
                                                            <input  type="text" name="link" id="link" placeholder="link" class="form-control" value="{{old('link')}}" >
                                                    </div>
                                                </div>
                                            <!-- <input  type="text" name="link" id="link" placeholder="Link" class="form-control"> -->
                                        </div> --}}

                                        <small class="text-danger">{{ $errors->first('coverImage') }}</small>
                                        <div class="custom-file-container" data-upload-id="Imagepreview1">
                                        <p style="float: left">Upload Cover Image <span class="text-danger "  style="font-size:16pt;display: inline;">*</span>:<span style="color:#EDE04D"> ( Standard image resolution to be used :  approx 350x250 ) </span></p>
                                            <a href="javascript:void(0)" style="float: right" class="custom-file-container__image-clear" title="Clear Image">Clear Image
                                            <i class="fa fa-times text-danger" aria-hidden="true"></i></a>
                                            <label class="custom-file-container__custom-file" >
                                                <input type="file" class="custom-file-container__custom-file__custom-file-input" id="imgInp"  name="coverImage" accept="image/*" {{ $errors->has('coverImage') ? 'autofocus' : '' }}>
                                                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                <span class="custom-file-container__custom-file__custom-file-control"></span>
                                            </label>
                                            <div class="custom-file-container__image-preview"></div>
                                        </div>

                                        <div class="form-group">
                                            <p>Content <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <textarea name="other_event" id="other_event" class="form-control" cols="30" rows="10" placeholder="National event"  {{ $errors->has('other_event') ? 'autofocus' : '' }}>{{old('other_event')}}</textarea>
                                            <small class="text-danger">{{ $errors->first('other_event') }}</small>
                                        </div>

                                        <button type="submit" class="btn btn-primary" style="margin: 10px">Submit</button>
                                        <button type="button" class="btn btn-danger" style="margin: 10px" onclick="goBack('/admin/other_event')">Cancel</button>

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

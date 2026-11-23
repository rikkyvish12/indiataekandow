@extends('layouts.admin.admin')

{{-- @section('script')
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('international_event', {
        filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>
@endsection --}}

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
                                <div class="col-xl-8 col-md-8 col-sm-8 col-8">
                                    <h4>Create International Events</h4>
                                </div>
                                {{-- <div class="col-xl-4 col-md-4 col-sm-4 col-4">
                                    <a href="{{ route('admin.international_event.index') }}" class="btn btn-sm btn-info mt-4 mr-3" style="float: right"></i><< Back</a>
                                </div>           --}}
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                        @include('layouts.admin.alerts')
                            <div class="row">
                                <div class="col-lg-12 col-12 mx-auto">
                                    <form method="post" action="{{ route('admin.international_event.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <p>Title <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="title" id="title" placeholder="Title" class="form-control noSpace"  value="{{ old('title')}}" {{ $errors->has('title') ? 'autofocus' : '' }}>
                                            <small class="text-danger">{{ $errors->first('title') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <p>Location <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="location" id="location" placeholder="Location" class="form-control noSpace"  value="{{ old('location')}}" {{ $errors->has('location') ? 'autofocus' : '' }}>
                                            <small class="text-danger">{{ $errors->first('location') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <p>Date <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="date" name="date" id="date" placeholder="Date" class="form-control"  value="{{ old('date')}}" {{ $errors->has('date') ? 'autofocus' : '' }}>
                                            <small class="text-danger">{{ $errors->first('date') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <p>Intro <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="intro" id="intro" placeholder="Intro" class="form-control noSpace	"  value="{{ old('intro')}}" {{ $errors->has('intro') ? 'autofocus' : '' }}>
                                            <small class="text-danger">{{ $errors->first('intro') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <p>Link <span class="text-danger "  style="font-size:16pt;display: inline;">*</span> <span style="color:#EDE04D"> (Please enter full URL for eg: http or https://www.abc.com )</span></p>
                                                <div class="row">
                                                    <div class="col-lg-12 col-12 mx-auto">
                                                            <!-- <select id="protocol" name="protocol" class="form-control" style="width:100%;max-width:90%;" >
                                                                <option  value="http"  {{ (old("protocol") == 'http' ? "selected":"") }} >http</option>
                                                                <option  value="https"   {{ (old("protocol") == 'https' ? "selected":"") }} value="https">https</option>
                                                            </select> -->
                                                            <input  type="text" name="link" id="link" placeholder="Link" class="form-control noSpace" value="{{ old('link')}}" {{ $errors->has('link') ? 'autofocus' : 'null' }}>
                                                            <small class="text-danger">{{ $errors->first('link') }}</small>

                                                    </div>
                                                    <!-- <div class="col-lg-10 col-10 mx-auto">
                                                            <input  type="text" name="url" id="url" placeholder="Please enter full URL for eg: www.google.com" class="form-control noSpace"  value="{{ old('url')}}">
                                                    </div> -->
                                                </div>
                                        </div>

                                        <small class="text-danger">{{ $errors->first('coverImage') }}</small>
                                        <div class="custom-file-container" data-upload-id="Imagepreview1">
                                            <p style="float: left">Upload Cover Image <span class="text-danger "  style="font-size:16pt;display: inline;">*</span> :<span style="color:#EDE04D"> ( Standard image resolution to be used :  approx 350x250) </span> </p>
                                            <a href="javascript:void(0)" style="float: right" class="custom-file-container__image-clear" title="Clear Image">Clear Image
                                            <i class="fa fa-times text-danger" aria-hidden="true"></i></a>
                                            <label class="custom-file-container__custom-file" >
                                                <input type="file" class="custom-file-container__custom-file__custom-file-input" id="imgInp"  name="coverImage" accept="image/*" {{ $errors->has('coverImage') ? 'autofocus' : '' }}>
                                                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                <span class="custom-file-container__custom-file__custom-file-control"></span>
                                            </label>
                                            <div class="custom-file-container__image-preview"></div>
                                        </div>
                                        {{-- <div class="form-group">
                                            <p>Content</p>
                                            <textarea name="international_event" id="international_event" class="form-control" cols="30" rows="10" placeholder="international event" {{ $errors->has('international_event') ? 'autofocus' : '' }}></textarea>
                                        </div> --}}

                                        <button type="submit" class="btn btn-primary" style="margin: 10px">Submit</button>
                                        <button type="button" class="btn btn-danger" style="margin: 10px" onclick="goBack('/admin/international_event')">Cancel</button>

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

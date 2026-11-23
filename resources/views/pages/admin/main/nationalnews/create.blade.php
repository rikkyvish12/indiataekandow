@extends('layouts.admin.admin')


@section('script')
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('national_news', {
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
                                    <h4>Create National News</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                        @include('layouts.admin.alerts')
                            <div class="row">
                                <div class="col-lg-12 col-12 mx-auto">
                                    <form method="post" action="{{ route('admin.national_news.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <p>Title <span class="text-danger "  style="font-size:16pt;display: inline;">*</span> <span style="color:#EDE04D"></p>
                                            <input  type="text" name="title" id="title" placeholder="Title" class="form-control noSpace" value="{{ old('title')}}"  {{ $errors->has('title') ? 'autofocus' : '' }}>
                                            <small class="text-danger">{{ $errors->first('title') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <p>Date <span class="text-danger "  style="font-size:16pt;display: inline;">*</span> <span style="color:#EDE04D"></p>
                                            <input  type="date" name="date" id="date" placeholder="Date" class="form-control" value="{{ old('date')}}"  {{ $errors->has('date') ? 'autofocus' : '' }}>
                                            <small class="text-danger">{{ $errors->first('date') }}</small>
                                        </div>
                                        {{-- <div class="form-group">
                                            <p>Link <span class="text-danger "  style="font-size:16pt;display: inline;">*</span> <span style="color:#EDE04D"></p>
                                            <input  type="text" name="link" id="link" placeholder="Link" class="form-control" value="{{ old('link')}}"  {{ $errors->has('Link') ? 'autofocus' : '' }}>
                                            <small class="text-danger">{{ $errors->first('Link') }}</small>
                                        </div> --}}
                                        <div class="form-group">
                                            <p>Description <span class="text-danger "  style="font-size:16pt;display: inline;">*</span> <span style="color:#EDE04D"></p>
                                            <textarea name="national_news" id="description" class="form-control" cols="30" rows="10" placeholder="national news description"  {{ $errors->has('national_news') ? 'autofocus' : '' }}>{{old('national_news')}}</textarea>
                                            <small class="text-danger">{{ $errors->first('national_news') }}</small>
                                        </div>
                                        
                                        <small class="text-danger">{{ $errors->first('coverImage') }}</small>
                                        <div class="custom-file-container" data-upload-id="Imagepreview1">
                                        <p style="float: left">Upload Cover Image <span class="text-danger "  style="font-size:16pt;display: inline;">*</span> <span style="color:#EDE04D">:<span style="color:#EDE04D"> ( Standard image resolution to be used :  approx 350x250) </span> </p>
                                            <a href="javascript:void(0)" style="float: right" class="custom-file-container__image-clear" title="Clear Image">Clear Image
                                            <i class="fa fa-times text-danger" aria-hidden="true"></i></a>
                                            <label class="custom-file-container__custom-file" >
                                                <input type="file" class="custom-file-container__custom-file__custom-file-input" id="imgInp"  name="coverImage" accept="image/*" >
                                                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                <span class="custom-file-container__custom-file__custom-file-control"></span>
                                            </label>
                                            <div class="custom-file-container__image-preview"></div>
                                        </div>
                                        <button type="submit" class="btn btn-primary" style="margin: 10px">Submit</button>
                                        <button type="button" class="btn btn-danger" style="margin: 10px" onclick="goBack('/admin/national_news')">Cancel</button>
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

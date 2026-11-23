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
                                    <h4>Edit National News</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                        @include('layouts.admin.alerts')
                            <div class="row">
                                <div class="col-lg-12 col-12 mx-auto">
                                    <form method="post" action="{{ route('admin.national_news.update',$news->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        {{ method_field('PUT') }}
                                        <div class="form-group">
                                            <p>Title <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="title" value="{{ $news->title }}" id="title" placeholder="Title" class="form-control noSpace" {{ $errors->has('title') ? 'autofocus' : '' }}>
                                            <small class="text-danger">{{ $errors->first('title') }}</small>

                                        </div>
                                        <div class="form-group">
                                            <p>Date <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="date" name="date" value="{{ $news->Date }}" id="date" placeholder="Date" class="form-control" {{ $errors->has('date') ? 'autofocus' : '' }}>
                                            <small class="text-danger">{{ $errors->first('date') }}</small>

                                        </div>
                                        {{-- <div class="form-group">
                                            <p>Link</p>
                                            <input  type="text" name="link" value="{{ $news->link }}" id="link" placeholder="Link" class="form-control">
                                        </div> --}}
                                        <div class="form-group">
                                            <p>Description <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <textarea name="national_news" id="description" class="form-control" cols="30" rows="10" placeholder="national news description" {{ $errors->has('national_news') ? 'autofocus' : '' }}>>{{ $news->description }}</textarea>
                                            <small class="text-danger">{{ $errors->first('national_news') }}</small>

                                        </div>
                                        
                                        <small class="text-danger">{{ $errors->first('coverImage') }}</small>
                                        <p>Upload Cover Image  <span class="text-danger "  style="font-size:16pt;display: inline;">*</span>:<span style="color:#EDE04D"> ( Standard image resolution to be used :  approx 350x250) </span></p>
                                        <div class="custom-file mb-4">
                                            <input type="file" class="custom-file-input" id="imgInp"  style="cursor:pointer" name="coverImage" >
                                            <label class="custom-file-label" for="customFile">Choose Cover Image file</label>
                                            <br><br>
                                            <img src="{{ $news->coverImage }}" id="covImg" style="max-width: 20%" alt="">
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
        <script>
            imgInp.onchange = evt => {
                const [file] = imgInp.files
                   if (file) {
                    covImg.src = URL.createObjectURL(file)
                    }
                 }
          </script>
<!--  END CONTENT AREA  -->
@endsection

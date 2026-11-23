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
                                    <h4>Edit Find Event Near Me</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                        @include('layouts.admin.alerts')
                            <div class="row">
                                <div class="col-lg-12 col-12 mx-auto">
                                    <form method="post" action="{{ route('admin.other_event.update',$event->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        {{ method_field('PUT') }}
                                        <div class="form-group">
                                            <p>Title <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="title" value="{{ $event->title }}" id="title" placeholder="Title" class="form-control noSpace" {{ $errors->has('title') ? 'autofocus' : '' }}>
                                            <small class="text-danger">{{ $errors->first('title') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <p>Location <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="location" value="{{ $event->location }}" id="location" placeholder="Location" class="form-control noSpace" {{ $errors->has('location') ? 'autofocus' : '' }}>
                                            <small class="text-danger">{{ $errors->first('location') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <p>Date <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="date" name="date" value="{{ $event->date }}" id="date" placeholder="Date" class="form-control" {{ $errors->has('date') ? 'autofocus' : '' }}>
                                            <small class="text-danger">{{ $errors->first('date') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <p>Intro <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="intro" value="{{ $event->intro }}" id="intro" placeholder="Intro" class="form-control noSpace" {{ $errors->has('intro') ? 'autofocus' : '' }}>
                                            <small class="text-danger">{{ $errors->first('intro') }}</small>
                                        </div>
                                        {{-- <div class="form-group">
                                            <p>Link</p>
                                            <div class="row">
                                                    <div class="col-lg-2 col-2 mx-auto">
                                                         <select id="protocol" name="protocol" class="form-control" style="width:100%;max-width:90%;">
                                                            @if($event->parseLinkScheme == 'http')
                                                                <option value="http" selected>http</option>
                                                                <option value="https">https</option>
                                                            @elseif($event->parseLinkScheme == 'https')
                                                                <option value="http" >http</option>
                                                                <option value="https" selected >https</option>
                                                            @else
                                                                <option value="http" selected>http</option>
                                                                <option value="https"  >https</option>
                                                            @endif
                                                            </select>
                                                            <!-- <input  type="text" name="url" id="url" placeholder="url" class="form-control" style="width:70%"> -->
                                                    </div>
                                                    <div class="col-lg-10 col-10 mx-auto">
                                                            <!-- <select id="protocol" name="protocol" class="form-control" style="width:20%">
                                                                <option value="1">http</option>
                                                                <option value="2">https</option>
                                                            </select> -->
                                                            <input  type="text" name="link" value="{{ $event->parseLinkHost }}" id="link" placeholder="Link" class="form-control">
                                                    </div>
                                                </div>

                                        </div> --}}

                                        <small class="text-danger">{{ $errors->first('coverImage') }}</small>
                                        <p style="float: left">Upload Cover Image <span class="text-danger "  style="font-size:16pt;display: inline;">*</span>:<span style="color:#EDE04D"> ( Standard image resolution to be used :  approx 350x250 ) </span></p>
                                        <div class="custom-file mb-4">
                                            <input type="file" class="custom-file-input" id="imgInp" style="cursor:pointer" name="coverImage" {{ $errors->has('coverImage') ? 'autofocus' : '' }}>
                                            <label class="custom-file-label" for="customFile" style="cursor:pointer">Choose Cover Image file</label>
                                            <br><br>
                                            <img src="{{ $event->coverImage }}" id="covImg" style="max-width: 100%" alt="">
                                        </div>
                                        <div class="form-group">
                                            <p>Content <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <textarea name="other_event" id="other_event" class="form-control" cols="30" rows="10" placeholder="National event">{{ $event->content }}</textarea>
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

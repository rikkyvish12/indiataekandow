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
                                    <h4>Edit National News</h4>
                                </div>                 
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <div class="row">
                                <div class="col-lg-12 col-12 mx-auto">
                                    <form method="post" action="{{ route('event_admin.news_update',[$event_id,$news->id]) }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                        <p>Title <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="title" value="{{ old('title',$news->title) }}" id="title" placeholder="Title" class="form-control noSpace"  {{ $errors->has('title') ? 'autofocus' : '' }}>
                                            <small class="text-danger">{{ $errors->first('title') }}</small>
                                        </div>
                                        <div class="form-group">
                                        <p>Date <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="date" name="date" value="{{ old('date', $news->date) }}" id="date" placeholder="Date" class="form-control" {{ $errors->has('date') ? 'autofocus' : '' }}>
                                            <small class="text-danger">{{ $errors->first('date') }}</small>
                                        </div>
                                        <div class="form-group">
                                        <p>Link <span class="text-danger "  style="font-size:16pt;display: inline;">*</span> <span style="color:#EDE04D"> (Please enter full URL for eg: http or https://www.abc.com )</span></p>
                                            <input  type="text" name="link" value="{{old('link', $news->link) }}" id="link" placeholder="Link" class="form-control noSpace" {{ $errors->has('link') ? 'autofocus' : 'null' }}>
                                            <small class="text-danger">{{ $errors->first('link') }}</small>
                                        </div>

                                        <small class="text-danger">{{ $errors->first('coverImage') }}</small>
                                        <p>Cover Image: <span class="text-danger "  style="font-size:16pt;display: inline;">*</span>:<span style="color:#EDE04D"> ( Standard image resolution to be used :  approx 350x250) </span></p>
                                        <div class="custom-file mb-4">
                                            <input type="file" class="custom-file-input" id="imgInp" name="coverImage" style="cursor:pointer" {{ $errors->has('coverImage') ? 'autofocus' : '' }} >
                                            <label class="custom-file-label" for="customFile" style="cursor:pointer">Choose Cover Image file</label>
                                            <br><br>
                                            <img src="{{ $news->coverImage }}" style="max-width: 100%" id="covImg" alt="">
                                        </div>
                                        <button type="submit" class="btn btn-primary" style="margin: 10px">Submit</button>
                                        <button type="button" class="btn btn-danger" style="margin: 10px" onclick="goBack('/event_admin/news/{{$event_id}}')">Cancel</button>

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
                    covImg.src = URL.createObjectURL(file)
                    }
                 }
          </script>
<!--  END CONTENT AREA  -->
@endsection
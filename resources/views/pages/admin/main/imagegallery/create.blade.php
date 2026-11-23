@extends('layouts.admin.admin')

@section('head')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
@endsection


@section('script')
<script type="text/javascript">
    Dropzone.options.imageUpload = {
        maxFilesize: 99999,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
    };
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
                                    <h4>Add Images To Album</h4>
                                </div>                 
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">

                            <div class="row">
                                <div class="col-lg-12 col-12 mx-auto">
                                    <form method="post" action="{{ route('admin.image_gallery.store') }}" enctype="multipart/form-data" class="dropzone" id='image-upload'>
                                        @csrf
                                        <div class="form-group">
                                            <p>Album</p>
                                            <select name="album" id="album" class="form-control">
                                                @foreach ($album as $item)
                                                    <option value="{{ $item->album_name }}">{{ $item->album_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
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
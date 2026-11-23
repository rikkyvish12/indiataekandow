@extends('layouts.admin.admin')

@section('script')
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
{{-- <script type="text/javascript">
    CKEDITOR.replace('presidentDescription', {
        filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>
<script type="text/javascript">
    CKEDITOR.replace('secretaryDescription', {
        filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script> --}}
<script type="text/javascript">
    CKEDITOR.replace('description', {
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
                                    <h4>Edit {{ $title }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                        @include('layouts.admin.alerts')

                            <div class="row">
                                <div class="col-lg-12 col-12 mx-auto">
                                    <form method="post" action="{{ route('admin.'.$url.'.update',$association->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        {{ method_field('PUT') }}
                                        <small class="text-danger">{{$errors->first('logo')}}</small>

                                        <div class="custom-file mb-4">
                                            <input type="file" class="custom-file-input" id="logo" name="logo" style="cursor:pointer" {{ $errors->has('logo') ? 'autofocus' : 'null' }}>
                                            <label class="custom-file-label" for="customFile" style="cursor:pointer">Choose Logo Image file <span class="text-danger "  style="font-size:16pt;display: inline;">*</span>:<span style="color:#EDE04D"> ( Standard image resolution to be used :  approx 350X250) </span></label>
                                            <br><br>
                                            <img src="{{ $association->logo }}" id="assoc_logo" style=" margin-top:10px" alt="">
                                        </div>
                                        <div class="form-group">
                                            <p>Name <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="name" value="{{ $association->name }}" id="name" placeholder="name" class="form-control noSpace"   {{ $errors->has('name') ? 'autofocus' : 'null' }}  >
                                            <small class="text-danger">{{$errors->first('name')}}</small>
                                        </div>
                                        @if ($association->assoc_type_id == '2')
                                        <div class="form-group">
                                            <p>District Name <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="district_name" value="{{ $association->district_name }}" id="district_name" placeholder="District Name"  {{ $errors->has('district_name') ? 'autofocus' : 'null' }} class="form-control noSpace"   >
                                            <small class="text-danger">{{$errors->first('district_name')}}</small>
                                        </div>
                                        @endif
                                        <div class="form-group">
                                            <p>President Name <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="presidentName" value="{{ $association->presidentName }}" id="presidentName" placeholder="President Name"  {{ $errors->has('presidentName') ? 'autofocus' : 'null' }} class="form-control noSpace"   >
                                            <small class="text-danger">{{$errors->first('presidentName')}}</small>
                                        </div>
                                        <div class="form-group">
                                            <p>President  <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="presidentEmail" value="{{ $association->presidentEmail }}" id="presidentEmail" placeholder="President Email"  {{ $errors->has('presidentEmail') ? 'autofocus' : 'null' }} class="form-control noSpace">
                                            <small class="text-danger">{{$errors->first('presidentEmail')}}</small>
                                        </div>
                                        <div class="form-group">
                                            <p>Office Address <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <textarea name="presidentDescription" id="presidentDescription" class="form-control" cols="30" rows="5" maxlength="100" style="resize:none;"  {{ $errors->has('presidentDescription') ? 'autofocus' : 'null' }} placeholder="President Description" >{{$association->presidentDescription}}</textarea>
                                            <small class="text-danger">{{$errors->first('presidentDescription')}}</small>
                                        </div>

                                        <small class="text-danger">{{$errors->first('presidentPhoto')}}</small>
                                        <div class="custom-file mb-4">
                                            <input type="file" class="custom-file-input" id="imgInp" name="presidentPhoto"  style="cursor:pointer" {{ $errors->has('presidentPhoto') ? 'autofocus' : 'null' }}>
                                            <label class="custom-file-label" for="customFile" style="cursor:pointer">Choose President Photo Image file <span class="text-danger "  style="font-size:16pt;display: inline;">*</span> :<span style="color:#EDE04D"> ( Standard image resolution to be used : approx 350X250) </span> </label>
                                            <br><br>
                                            <img src="{{ $association->presidentPhoto }}" id="presiImg" style=" margin-top:10px" alt="">
                                        </div>

                                        <div class="form-group">
                                            <p>Secretary Name <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="secretaryName" value="{{ $association->secretaryName }}" id="secretaryName" placeholder="Secretary Name"  {{ $errors->has('secretaryName') ? 'autofocus' : 'null' }} class="form-control noSpace"   >
                                            <small class="text-danger">{{$errors->first('secretaryName')}}</small>
                                        </div>
                                        <div class="form-group">
                                            <p>Secretary Email <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="secretaryEmail" value="{{ $association->secretaryEmail }}" id="secretaryEmail" placeholder="Secretary Email"  {{ $errors->has('secretaryEmail') ? 'autofocus' : 'null' }} class="form-control noSpace">
                                            <small class="text-danger">{{$errors->first('secretaryEmail')}}</small>
                                        </div>
                                        <div class="form-group">
                                            <p>Office Address <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <textarea name="secretaryDescription" id="secretaryDescription" class="form-control" cols="30" rows="5" maxlength="100" style="resize:none;" {{ $errors->has('secretaryDescription') ? 'autofocus' : 'null' }}  placeholder="Secretary Description" >{{$association->secretaryDescription}}</textarea>
                                            <small class="text-danger">{{$errors->first('secretaryDescription')}}</small>
                                        </div>

                                        <small class="text-danger">{{$errors->first('secretaryPhoto')}}</small>
                                        <div class="custom-file mb-4">
                                            <input type="file" class="custom-file-input" id="Inp2" name="secretaryPhoto" style="cursor:pointer" {{ $errors->has('secretaryPhoto') ? 'autofocus' : 'null' }}>
                                            <label class="custom-file-label" for="customFile" style="cursor:pointer">Choose Secretary Photo Image file <span class="text-danger "  style="font-size:16pt;display: inline;">*</span>:<span style="color:#EDE04D"> ( Standard image resolution to be used : approx 350X250) </span> </label>
                                            <br><br>
                                            <img src="{{ $association->secretaryPhoto }}" id="secrImg" style=" margin-top:10px" alt="">
                                        </div>

                                        <div class="form-group">
                                            <p>Description <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <textarea name="description" id="description" class="form-control" cols="30" rows="10" placeholder="Description"  {{ $errors->has('description') ? 'autofocus' : 'null' }}>{{$association->description}}</textarea>
                                            <small class="text-danger">{{$errors->first('description')}}</small>
                                        </div>
                                        <button type="submit" class="btn btn-primary" style="margin: 10px">Submit</button>
                                        <button type="button" class="btn btn-danger" style="margin: 10px" onclick="goBack('/admin/state_association')">Cancel</button>

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
            logo.onchange = evt => {
                const [file] = logo.files
                   if (file) {
                    assoc_logo.src = URL.createObjectURL(file)
                    }
                 }
             imgInp.onchange = evt => {
                const [file] = imgInp.files
                   if (file) {
                    presiImg.src = URL.createObjectURL(file)
                    }
                 }
                 Inp2.onchange = evt => {
                const [file] = Inp2.files
                   if (file) {
                    secrImg.src = URL.createObjectURL(file)
                    }
                 }
      </script>
<!--  END CONTENT AREA  -->
@endsection

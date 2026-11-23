@extends('layouts.admin.admin')

@section('script')
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<script type="text/javascript">
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
</script>
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
                                    @if ($url == 'district_association')
                                    <form method="post" action="{{ route('assoc_admin.state_dist_update',[$assoc_id,$association->id]) }}" enctype="multipart/form-data">
                                        @elseif($url == 'other_association')
                                        <form method="post" action="{{ route('assoc_admin.state_other_update',[$assoc_id,$association->id]) }}" enctype="multipart/form-data">
                                            @endif
                                        @csrf
                                        {{ method_field('POST') }}
                                        <div class="custom-file mb-4">
                                            <input type="file" class="custom-file-input" id="imgInp" name="logo">
                                            <label class="custom-file-label" for="customFile">Choose Logo Image file</label>
                                            <br><br>
                                            <img src="{{ $association->logo }}" id="logo" style="max-width: 30%" alt="">
                                        </div>
                                        <div class="form-group">
                                            <p>Name</p>
                                            <input  type="text" name="name" value="{{ $association->name }}" id="name" placeholder="Name" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <p>President Name</p>
                                            <input  type="text" name="presidentName" value="{{ $association->presidentName }}" id="presidentName" placeholder="President Name" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <p>President Description</p>
                                            <textarea name="presidentDescription" id="presidentDescription" class="form-control" cols="30" rows="10" placeholder="President Description">{{$association->presidentDescription}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <p>President Email</p>
                                            <input  type="text" name="presidentEmail" value="{{ $association->presidentEmail }}" id="presidentEmail" placeholder="President Email" class="form-control">
                                        </div>
                                        <div class="custom-file mb-4">
                                            <input type="file" class="custom-file-input" id="Inp2" name="presidentPhoto" >
                                            <label class="custom-file-label" for="customFile">Choose President Photo Image file</label>
                                            <br><br>
                                            <img src="{{ $association->presidentPhoto }}" id="p_img" style="max-width: 30%" alt="">
                                        </div>

                                        <div class="form-group">
                                            <p>Secretary Name</p>
                                            <input  type="text" name="secretaryName" value="{{ $association->secretaryName }}" id="secretaryName" placeholder="Secretary Name" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <p>Secretary Description</p>
                                            <textarea name="secretaryDescription" id="secretaryDescription" class="form-control" cols="30" rows="10" placeholder="Secretary Description">{{ $association->secretaryDescription }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <p>Secretary Email</p>
                                            <input  type="text" name="secretaryEmail" value="{{ $association->secretaryEmail }}" id="secretaryEmail" placeholder="Secretary Email" class="form-control">
                                        </div>
                                        <div class="custom-file mb-4">
                                            <input type="file" class="custom-file-input" id="Inp3" name="secretaryPhoto" >
                                            <label class="custom-file-label" for="customFile">Choose Secretary Photo Image file</label>
                                            <br><br>
                                            <img src="{{ $association->secretaryPhoto }}" id="s_img" style="max-width: 30%" alt="">
                                        </div>

                                        <div class="form-group">
                                            <p>Description</p>
                                            <textarea name="description" id="description" class="form-control" cols="30" rows="10" placeholder="Description">{{$association->description}}</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary" style="margin: 10px">Submit</button>
                                        @if ($url == 'district_association')
                                            <button type="button" class="btn btn-danger" style="margin: 10px" onclick="goBack('/assoc_admin/district_association/{{$assoc_id}}')">Cancel</button>
                                        @else
                                             <button type="button" class="btn btn-danger" style="margin: 10px" onclick="goBack('/assoc_admin/other_association/{{$assoc_id}}')">Cancel</button>

                                        @endif
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
            logo.src = URL.createObjectURL(file)
            }
         }
         Inp2.onchange = evt => {
        const [file] = Inp2.files
           if (file) {
            p_img.src = URL.createObjectURL(file)
            }
         }
         Inp3.onchange = evt => {
        const [file] = Inp3.files
           if (file) {
            s_img.src = URL.createObjectURL(file)
            }
         }
  </script>
@endsection

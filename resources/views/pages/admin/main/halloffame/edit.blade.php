@extends('layouts.admin.admin')


@section('script')
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
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
                                    <h4>Edit halloffame</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                        @include('layouts.admin.alerts')
                            <div class="row">
                                <div class="col-lg-12 col-12 mx-auto">
                                    <form method="post" action="{{ route('admin.halloffame.update',$halloffame->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        {{ method_field('PUT') }}
                                        <div class="form-group">
                                            <p>Name <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="name" value="{{ $halloffame->name }}" id="name" placeholder="Name" class="form-control noSpace" {{ $errors->has('name') ? 'autofocus' : '' }}>
                                            <small class="text-danger">{{ $errors->first('name') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <p>Title <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="title" value="{{ $halloffame->title }}" id="title" placeholder="Title" class="form-control noSpace" {{ $errors->has('title') ? 'autofocus' : '' }}>
                                            <small class="text-danger">{{ $errors->first('title') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <p>Date <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="date" name="date" value="{{ $halloffame->date }}" id="date" placeholder="Date" class="form-control" {{ $errors->has('date') ? 'autofocus' : '' }}>
                                            <small class="text-danger">{{ $errors->first('date') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <p>Description <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <textarea name="description" id="description" placeholder="Description" class="form-control" cols="30" rows="10" {{ $errors->has('description') ? 'autofocus' : '' }}>{{ $halloffame->description }}</textarea>
                                            <small class="text-danger">{{ $errors->first('description') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <p>Intro <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="intro" id="intro" placeholder="Intro" value="{{ $halloffame->intro }}" class="form-control noSpace" {{ $errors->has('intro') ? 'autofocus' : '' }}>
                                            <small class="text-danger">{{ $errors->first('intro') }}</small>

                                        </div>
                                        
                                        <small class="text-danger">{{ $errors->first('coverImage') }}</small>
                                        <p style="float: left">Upload Cover Image <span class="text-danger "  style="font-size:16pt;display: inline;">*</span> :<span style="color:#EDE04D"> ( Standard image resolution to be used :  approx 350x250) </span> </p>
                                        <div class="custom-file mb-4">
                                            <input type="file" class="custom-file-input" id="imgInp" name="coverImage" accept="image/*" {{ $errors->has('coverImage') ? 'autofocus' : '' }}>
                                            <label class="custom-file-label" for="customFile">Choose Cover Image file</label>
                                            <br><br>
                                            <img src="{{ $halloffame->coverImage }}" id="covImg" style="max-width: 50%" alt="">
                                        </div>

                                        <small class="text-danger">{{ $errors->first('coverImage1') }}</small>
                                        <p style="float: left">Upload Cover Image 1 :<span style="color:#EDE04D"> ( Standard image resolution to be used :  approx 350x250) </span> </p>
                                        <div class="custom-file mb-4">
                                            <input type="file" class="custom-file-input" id="imgInp1" name="coverImage1" accept="image/*" {{ $errors->has('coverImage1') ? 'autofocus' : '' }}>
                                            <label class="custom-file-label" for="customFile">Choose Cover Image 1 file</label>
                                            <br><br>
                                            <img src="{{ $halloffame->coverImage1 }}" id="covImg1" style="max-width: 50%" alt="">
                                        </div>

                                        <small class="text-danger">{{ $errors->first('coverImage2') }}</small>
                                        <p style="float: left">Upload Cover Image 2 :<span style="color:#EDE04D"> ( Standard image resolution to be used :  approx 350x250) </span> </p>
                                        <div class="custom-file mb-4">
                                            <input type="file" class="custom-file-input" id="imgInp2" name="coverImage2" accept="image/*" {{ $errors->has('coverImage2') ? 'autofocus' : '' }}>
                                            <label class="custom-file-label"  for="customFile">Choose Cover Image 2 file</label>
                                            <br><br>
                                            <img src="{{ $halloffame->coverImage2 }}" id="covImg2" style="max-width: 50%" alt="">
                                        </div>

                                        <small class="text-danger">{{ $errors->first('coverImage3') }}</small>
                                        <p style="float: left">Upload Cover Image 3 :<span style="color:#EDE04D"> ( Standard image resolution to be used :  approx 350x250) </span> </p>
                                        <div class="custom-file mb-4">
                                            <input type="file" class="custom-file-input" id="imgInp3" name="coverImage3" accept="image/*" {{ $errors->has('coverImage3') ? 'autofocus' : '' }}>
                                            <label class="custom-file-label" for="customFile">Choose Cover Image 3 file</label>
                                            <br><br>
                                            <img src="{{ $halloffame->coverImage3 }}" id="covImg3" style="max-width: 50%" alt="">
                                        </div>

                                        <button type="submit" class="btn btn-primary" style="margin: 10px">Submit</button>
                                        <button type="button" class="btn btn-danger" style="margin: 10px" onclick="goBack('/admin/halloffame')">Cancel</button>

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
         imgInp1.onchange = evt => {
        const [file] = imgInp1.files
           if (file) {
            covImg1.src = URL.createObjectURL(file)
            }
         }
         imgInp2.onchange = evt => {
        const [file] = imgInp2.files
           if (file) {
            covImg2.src = URL.createObjectURL(file)
            }
         }
         imgInp3.onchange = evt => {
        const [file] = imgInp3.files
           if (file) {
            covImg3.src = URL.createObjectURL(file)
            }
         }
  </script>
@endsection

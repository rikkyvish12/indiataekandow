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
                                    <h4>Edit Judges</h4>
                                </div>                 
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">

                            <div class="row">
                                <div class="col-lg-12 col-12 mx-auto">
                                    <form method="post" action="{{ route('admin.profile_judges.update',$member->id) }}" enctype="multipart/form-data">
                                        @csrf 
                                        {{ method_field('PUT') }}
                                        <div class="form-group">
                                            <p>Name</p>
                                            <input  type="text" name="name" value="{{ $member->name }}" id="name" placeholder="Name" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <p>Title</p>
                                            <input  type="text" name="title" value="{{ $member->title }}" id="title" placeholder="Title" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <p>points</p>
                                            <input  type="points" name="points" value="{{ $member->points }}" id="points" placeholder="Points" class="form-control" required>
                                        </div>
                                      
                                        <div class="custom-file mb-4">
                                            <input type="file" class="custom-file-input" id="imgInp" name="image" >
                                            <label class="custom-file-label" for="customFile">Choose Profile Image file</label>
                                            <br><br>
                                            <img src="{{ $member->image }}" style="max-width: 100%" alt="">
                                        </div>
                                      
                                        <button type="submit" class="btn btn-primary" style="margin: 10px">Submit</button>
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
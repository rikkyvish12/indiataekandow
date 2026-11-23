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
                                    <h4>Secretary Message</h4>
                                </div>                 
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">

                            <div class="row">
                                <div class="col-lg-12 col-12 mx-auto">
                                    @include('layouts.admin.alerts')
                                    <form method="post" action="{{ route('assoc_admin.secretary_message_update',[$assoc_id,$secretory_msg->id]) }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <textarea class="form-control" id="description" name="description" placeholder="taekwondo" rows="3" {{ $errors->has('description') ? ' has-error' : '' }}>{{ old('description',$secretory_msg->description) }}</textarea>
                                            <small class="text-danger">{{ $errors->first('description') }}</small>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
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
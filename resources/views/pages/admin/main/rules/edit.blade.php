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
                                    <h4>Edit Rules And Regulations</h4>
                                </div>                 
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                        @include('layouts.admin.alerts')

                            <div class="row">
                                <div class="col-lg-12 col-12 mx-auto">
                                    <form method="post" action="{{ route('admin.rulesandregulations.update',$rule->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        {{ method_field('PUT') }}
                                        <div class="form-group">
                                            <p>Name<span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input value="{{ $rule->name }}"  type="text" name="name" id="name" placeholder="Name" class="form-control noSpace"  {{ $errors->has('name') ? 'autofocus' : '' }}>
                                            <small class="text-danger">{{ $errors->first('name') }}</small>

                                        </div>
                                        <div class="form-group">
                                            <p>Description<span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <textarea name="description" class="form-control" id="description"  cols="30" rows="10"  {{ $errors->has('description') ? 'autofocus' : '' }}>{{ $rule->description }}</textarea>
                                            <small class="text-danger">{{ $errors->first('description') }}</small>

                                        </div>

                                        <small class="text-danger">{{ $errors->first('pdf') }}</small>
                                        <div class="custom-file mb-4">
                                            <input type="file" class="custom-file-input" id="imgInp" name="pdf" accept="application/pdf" onchange="onChangePDf()" {{ $errors->has('pdf') ? 'autofocus' : '' }}>
                                            <label class="custom-file-label" for="customFile" style="cursor:pointer">Choose PDF file<span class="text-danger "  style="font-size:16pt;display: inline;">*</span></label>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-4">
                                                <embed
                                                src="{{ $rule->pdf }}"
                                                style="width:width:300px; height:150px;margin-top:20px"
                                                frameborder="0"
                                                id="pdfViewer">  
                                            </div>
                                            <div class="col-9">
                                            </div>
                                        </div>
                                        <div class="row" style="margin:5px">
                                              <div class="col-4">
                                              <a href="{{$rule->pdf}}" class="btn btn-sm btn-success" target="_blank" style="margin:auto 0px;width:60%" id="anchorPDFViewer"> View</a>

                                             </div>
                                                  
                                         </div>





                                  
                                        <button type="submit" class="btn btn-primary" style="margin: 10px">Submit</button>
                                        <button type="button" class="btn btn-danger" style="margin: 10px" onclick="goBack('/admin/rulesandregulations')">Cancel</button>

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

<script>
       
    //    var imgInp = document.getElementById('#imgInp');
    function onChangePDf(){
        src= URL.createObjectURL(event.target.files[0])
        pdfViewer.src=src;
        anchorPDFViewer.href=src

    }
      

        </script>
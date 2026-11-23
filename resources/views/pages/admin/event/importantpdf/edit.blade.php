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
                                    <h4>Edit PDF</h4>
                                </div>                 
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">

                            <div class="row">
                                <div class="col-lg-12 col-12 mx-auto">
                                    <form method="post" action="{{ route('event_admin.important_pdf_update',[$event_id,$pdf->id]) }}" enctype="multipart/form-data">
                                        @csrf
                                       
                                        <div class="form-group">
                                        <p>Name<span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" value="{{ old('name',$pdf->pdf_name) }}" name="name" id="name" placeholder="PDF Name" class="form-control noSpace" {{ $errors->has('name') ? 'autofocus' : '' }}>
                                            <small class="text-danger">{{ $errors->first('name') }}</small>

                                        </div>
                                        
                                        <small class="text-danger">{{ $errors->first('pdf') }}</small>
                                        <div class="custom-file mb-4">
                                            <input type="file" class="custom-file-input" id="imgInp" name="pdf" accept="application/pdf" onchange="onChangePDf()" {{ $errors->has('pdf') ? 'autofocus' : '' }}>
                                            <label class="custom-file-label" for="customFile" style="cursor:pointer">Choose PDF file<span class="text-danger "  style="font-size:16pt;display: inline;">*</span></label>
                                        </div>

                                        <div class="row">
                                            <div class="col-4">
                                                <embed
                                                src="{{ $pdf->pdf }}"
                                                style="width:width:300px; height:150px;margin-top:20px"
                                                frameborder="0"
                                                id="pdfViewer">  
                                            </div>
                                            <div class="col-9">
                                            </div>
                                        </div>
                                        <div class="row" style="margin:5px">
                                              <div class="col-4">
                                              <a href="{{$pdf->pdf}}" class="btn btn-sm btn-success" target="_blank" style="margin:auto 0px;width:60%" id="anchorPDFViewer"> View</a>

                                             </div>
                                                  
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
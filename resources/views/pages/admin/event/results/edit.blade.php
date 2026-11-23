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
                                    <h4>Create Results</h4>
                                </div>                 
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">

                            <div class="row">
                                <div class="col-lg-12 col-12 mx-auto">
                                    <form method="post" action="{{ route('event_admin.results_update',[$event_id,$result->id]) }}" enctype="multipart/form-data">
                                        @csrf
                                      
                                        <div class="form-group">
                                        <p>Date <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="date" name="date" value="{{ old('date',$result->date) }}" id="date" placeholder="Date" class="form-control" {{ $errors->has('date') ? 'autofocus' : '' }}>
                                            <small class="text-danger">{{ $errors->first('date') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <p>Group</p>
                                            <input  type="text" name="group" value="{{old('group', $result->group) }}" id="group" placeholder="Group" class="form-control" {{ $errors->has('group') ? 'autofocus' : '' }}>
                                            <small class="text-danger">{{ $errors->first('group') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <p>Time</p>
                                            <input  type="time" name="time" value="{{ old('time',$result->time) }}" id="time" placeholder="Time" class="form-control" >
                                        </div>
                                        <div class="form-group">
                                            <p>Round</p>
                                            <input  type="round" name="round" value="{{old('round', $result->round) }}" id="round" placeholder="Round" class="form-control" {{ $errors->has('round') ? 'autofocus' : '' }}>
                                            <small class="text-danger">{{ $errors->first('round') }}</small>
                                        </div>

                                        <small class="text-danger">{{ $errors->first('result_pdf') }}</small>
                                        <p>Result .pdf <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                        <div class="custom-file mb-4">
                                        <input type="file" class="custom-file-input" id="imgInp" name="result_pdf" accept="application/pdf" style="cursor:pointer" onchange="onChangePDf()" {{ $errors->has('pdf') ? 'autofocus' : '' }} >
                                            <label class="custom-file-label" for="customFile" style="cursor:pointer">Choose .pdf file</label>
                                        </div>

                                        <div class="row">
                                            <div class="col-4">
                                            <embed
                                            src="{{$result->result_pdf}}"
                                            style="width:width:300px; height:150px;margin-top:20px"
                                            frameborder="0"
                                            id="pdfViewer">  
                                            </div>
                                            <div class="col-9">
                                            </div>
                                        </div>
                                        <div class="row" style="margin:5px">
                                              <div class="col-4">
                                              <a href="{{$result->result_pdf}}" class="btn btn-sm btn-success" target="_blank" style="margin:auto 0px;width:60%" id="anchorPDFViewer"> View</a>
                                             </div>
                                                  
                                         </div>
                                       
                                        <button type="submit" class="btn btn-primary" style="margin: 10px">Submit</button>
                                        <button type="button" class="btn btn-danger" style="margin: 10px" onclick="goBack('/event_admin/results/{{$event_id}}')">Cancel</button>

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
       
    //    var imgInp = document.getElementById('#imgInp');
    function onChangePDf(){
        src= URL.createObjectURL(event.target.files[0])
        pdfViewer.src=src;
        anchorPDFViewer.href=src
        document.getElementById("anchorPDFViewer").style.display = "inherit";

    }
      

        </script>
@endsection
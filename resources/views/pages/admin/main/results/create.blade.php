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
                        @include('layouts.admin.alerts')
                            <div class="row">
                                <div class="col-lg-12 col-12 mx-auto">
                                    <form method="post" action="{{ route('admin.results.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <p>Date <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="date" name="date" id="date" placeholder="date" class="form-control "  value="{{ old('date')}}"  {{ $errors->has('date') ? 'autofocus' : '' }}>
                                            <small class="text-danger">{{ $errors->first('date') }}</small>
                                        </div>
                                        
                                        <div class="form-group">
                                            <p>Event <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <!-- <input  type="text" name="event" id="event" placeholder="Event" class="form-control noSpace"  value="{{ old('event')}}"  {{ $errors->has('event') ? 'autofocus' : '' }}> -->
                                            <select id="event" name="event" class="form-control select_2" style="width:100%;max-width:100%;"  {{ $errors->has('event') ? 'autofocus' : 'null' }}">
                                                        <option value="" selected>-Select-Event-</option>
                                                        @foreach ($all_events as $event)
                                                           <option value="{{$event->id}}" @if(old('event') == $event->id) selected @endif>{{$event->title}}</option>
                                                        @endforeach

                                            </select> 

                                            
                                            <small class="text-danger">{{ $errors->first('event') }}</small>
                                        </div>
                                        <!-- <div class="form-group">
                                            <p>Event Name <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="event_name" id="event_name" placeholder="Event Name" class="form-control noSpace"  value="{{ old('event_name')}}"  {{ $errors->has('event_name') ? 'autofocus' : '' }}>
                                            <small class="text-danger">{{ $errors->first('event_name') }}</small>
                                        </div> -->
                                        <div class="form-group">
                                            <p>Group <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="group" id="group" placeholder="Group" class="form-control noSpace"  value="{{ old('group')}}"  {{ $errors->has('group') ? 'autofocus' : '' }}>
                                            <small class="text-danger">{{ $errors->first('group') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <p>Time</p>
                                            <input  type="time" name="time" id="time" placeholder="Time" class="form-control"  value="{{ old('time')}}" >
                                        </div>
                                        <div class="form-group">
                                            <p>Round <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                            <input  type="text" name="round" id="round" placeholder="Round" class="form-control"  value="{{ old('round')}}"  {{ $errors->has('round') ? 'autofocus' : '' }}>
                                            <small class="text-danger">{{ $errors->first('round') }}</small>
                                        </div>

                                        <small class="text-danger">{{ $errors->first('result_pdf') }}</small>
                                        <p>Result .pdf <span class="text-danger "  style="font-size:16pt;display: inline;">*</span></p>
                                        <div class="custom-file mb-4">
                                              
                                            <input type="file" class="custom-file-input" id="imgInp" name="result_pdf" style="cursor:pointer" accept="application/pdf" onchange="onChangePDf()"  {{ $errors->has('result_pdf') ? 'autofocus' : '' }}>
                                            <label class="custom-file-label" for="customFile" style="cursor:pointer">Choose .pdf file </label>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                            <embed
                                            src=""
                                            style="width:width:300px; height:150px;margin-top:20px"
                                            frameborder="0"
                                            id="pdfViewer">  
                                            </div>
                                            <div class="col-9">
                                            </div>
                                        </div>
                                        <div class="row" style="margin:5px">
                                              <div class="col-4">
                                              <a href="" class="btn btn-sm btn-success" target="_blank" style="margin:auto 0px;display:none;width:60%" id="anchorPDFViewer"> View</a>
                                             </div>
                                                  
                                         </div>
                                        <button type="submit" class="btn btn-primary" style="margin: 10px">Submit</button>
                                        <button type="button" class="btn btn-danger" style="margin: 10px" onclick="goBack('/admin/results')">Cancel</button>
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
        document.getElementById("anchorPDFViewer").style.display = "inherit";

    }
      

        </script>

        
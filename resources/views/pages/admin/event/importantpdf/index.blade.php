@extends('layouts.admin.admin')

@section('script')
     <!-- BEGIN PAGE LEVEL CUSTOM SCRIPTS -->
     <script src="{{ url('assets/js/scrollspyNav.js') }}"></script>
     <script>
        checkall('todoAll', 'todochkbox');
        $('[data-toggle="tooltip"]').tooltip()
     </script>
     <!-- END PAGE LEVEL CUSTOM SCRIPTS -->
@endsection


@section('head')
       <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
       <link href="{{ url('assets/css/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
       <link rel="stylesheet" type="text/css" href="{{ url('assets/css/forms/theme-checkbox-radio.css') }}">
       <link href="{{ url('assets/css/tables/table-basic.css') }}" rel="stylesheet" type="text/css" />
       <!-- END PAGE LEVEL CUSTOM STYLES -->
@endsection

@section('content')
    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="container">
           <div class="container">
              
             
              <div class="row layout-top-spacing">
                 
                 <div id="tableHover" class="col-lg-12 col-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                       <div class="widget-header">
                          <div class="row">
                             <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Important PDF <a href="{{ route('event_admin.important_pdf_create',$event_id) }}" class="btn btn-primary btn-sm float-right">Create</a></h4>
                             </div>
                          </div>
                       </div>
                       <div class="widget-content widget-content-area">
                          <div class="table-responsive">
                            @include('layouts.admin.alerts')

                            @if (count($pdf)>0)
                                <table class="table table-bordered table-hover mb-4">
                                   <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>PDF</th>          
                                          <th colspan="2">Action</th>
                                      </tr>
                                   </thead>
                                   <tbody>
                                      @foreach ($pdf as $item)
                                      <tr>
                                       <td>{{ $no++ }}</td>
                                       {{-- <td>{{ $item->pdf_name }}</td> --}}
                                       <td><a href="{{ $item->pdf }}" target="_blank">{{ $item->pdf_name }}</a></td>
                                       <td>
                                          <a href="{{ route('event_admin.important_pdf_edit',[$event_id,$item->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                                       </td>
                                       <td>
                                           <form action="{{ route('event_admin.important_pdf_destroy',[$event_id,$item->id]) }}" method="post" id="delete-entry_{{$item->id}}">
                                           @csrf
                                             
                                           <button type="submit" class="btn btn-danger btn-sm" onclick="deleteEntry(event,'delete-entry_{{$item->id}}')">Delete</button>
                                       </form>
                                       </td>
                                   </tr> 
                                      @endforeach
                                   </tbody>
                                </table>
                            @else
                                No PDF Added Yet
                            @endif
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
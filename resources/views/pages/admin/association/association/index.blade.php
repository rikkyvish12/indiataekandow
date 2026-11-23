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

            @if ($url == 'district_association')
              <div class="row layout-top-spacing">
                 <div id="tableHover" class="col-lg-12 col-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                       <div class="widget-header">
                          <div class="row">
                             <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>{{ $title }} <a href="{{ route('assoc_admin.district_association_create',$assoc_id) }}" class="btn btn-primary btn-sm float-right">Create</a></h4>
                            </div>
                          </div>
                       </div>
                       <div class="widget-content widget-content-area">
                          <div class="table-responsive">
                            @include('layouts.admin.alerts')
                            @if (count($association)>0)
                                <table class="table table-bordered table-hover mb-4">
                                   <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Logo</th>
                                          <th>Name</th>
                                          <th>President Name</th>
                                          <th>President Description</th>
                                          <th>President Email</th>
                                          <th>Secretary Name</th>
                                          <th>Secretary Description</th>
                                          <th>Secretary Email</th>
                                          <th>Description</th>
                                          <th colspan="2" style="text-align: center">Action</th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                      @foreach ($association as $item)
                                      <tr>
                                       <td>{{ $no++ }}</td>
                                       <td><a href="{{ $item->logo }}" target="_blank"><img style="max-width: 200px" src="{{ $item->logo }}"></a></td>
                                       <td>{{ $item->name }}</td>
                                       <td>{{ $item->presidentName }}</td>
                                       <td>{{ \Illuminate\Support\Str::limit($item->presidentDescription, 150, $end='...') }}</td>
                                       <td>{{ $item->presidentEmail }}</td>
                                       <td>{{ $item->secretaryName }}</td>
                                       <td>{{ \Illuminate\Support\Str::limit($item->secretaryDescription, 150, $end='...') }}</td>
                                       <td>{{ $item->secretaryEmail }}</td>
                                       <td>{{ \Illuminate\Support\Str::limit($item->description, 150, $end='...') }}</td>
                                       <td>
                                           @if(in_array(Auth::user()->id, explode(',',$item->user_access))) 
                                           <a href="{{ route('assoc_admin.district_association_edit',[$assoc_id,$item->id]) }}" class="btn btn-primary btn-sm ">Edit</a>
                                           @else 
                                          <a href="{{ route('assoc_admin.district_association_edit',[$assoc_id,$item->id]) }}" disabled class="disabled btn btn-primary btn-sm ">Edit</a>
                                          <small class="text-small text-danger">No Access</small>
      
                                          @endif
                                          
                                     
                                       </td>
                                       <td>
                                       @if(in_array(Auth::user()->id, explode(',',$item->user_access))) 
                                       <form action="{{ route('assoc_admin.state_dist_destroy',[$assoc_id,$item->id]) }}" method="post" style="" id="delete-entry_{{$item->id}}">
                                           @csrf
                                               {{ method_field('POST') }}
                                               <button type="submit" class="btn btn-danger btn-sm" onclick="deleteEntry(event,'delete-entry_{{$item->id}}')">Delete</button>
                                       </form>
                                        @else 
                                      
                                               <button type="button" disabled class="disabled btn btn-danger btn-sm" onclick="deleteEntry(event,'delete-entry_{{$item->id}}')">Delete</button>
                                                <small class="text-small text-danger">No Access</small>
                                               @endif
                                        
                                       </td>
                                   </tr>
                                      @endforeach
                                   </tbody>
                                </table>
                            @else
                                No {{ $title }} Added Yet
                            @endif
                         </div>
                       </div>
                    </div>
                 </div>
              </div>
              
              @elseif($url == 'other_association')
              <div class="row layout-top-spacing">
                <div id="tableHover" class="col-lg-12 col-12 layout-spacing">
                   <div class="statbox widget box box-shadow">
                      <div class="widget-header">
                         <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>{{ $title }} <a href="{{ route('assoc_admin.other_association_create',$assoc_id) }}" class="btn btn-primary btn-sm float-right">Create</a></h4>
                            </div>
                         </div>
                      </div>
                      <div class="widget-content widget-content-area">
                         <div class="table-responsive">
                           @include('layouts.admin.alerts')

                           @if (count($association)>0)
                               <table class="table table-bordered table-hover mb-4">
                                  <thead>
                                     <tr>
                                         <th>#</th>
                                         <th>Logo</th>
                                         <th>Name</th>
                                         <th>President Name</th>
                                         <th>President Description</th>
                                         <th>President Email</th>
                                         <th>Secretary Name</th>
                                         <th>Secretary Description</th>
                                         <th>Secretary Email</th>
                                         <th>Description</th>
                                         <th colspan="2" style="text-align: center">Action</th>
                                     </tr>
                                  </thead>
                                  <tbody>
                                     @foreach ($association as $item)
                                     <tr>
                                      <td>{{ $no++ }}</td>
                                      <td><a href="{{ $item->logo }}" target="_blank"><img style="max-width: 200px" src="{{ $item->logo }}"></a></td>
                                      <td>{{ $item->name }}</td>
                                      <td>{{ $item->presidentName }}</td>
                                      <td>{{ \Illuminate\Support\Str::limit($item->presidentDescription, 150, $end='...') }}</td>
                                      <td>{{ $item->presidentEmail }}</td>
                                      <td>{{ $item->secretaryName }}</td>
                                      <td>{{ \Illuminate\Support\Str::limit($item->secretaryDescription, 150, $end='...') }}</td>
                                      <td>{{ $item->secretaryEmail }}</td>
                                      <td>{{ \Illuminate\Support\Str::limit($item->description, 150, $end='...') }}</td>
                                      <td>
                                         <a href="{{ route('assoc_admin.other_association_edit',[$assoc_id,$item->id]) }}" class="btn btn-primary btn-sm ">Edit</a>
                                        </td>
                                        <td>
                                         <form action="{{ route('assoc_admin.state_other_destroy',[$assoc_id,$item->id]) }}" method="post" id="delete-entry_{{$item->id}}">
                                          @csrf
                                              {{ method_field('POST') }}
                                              <button type="submit" class="btn btn-danger btn-sm" onclick="deleteEntry(event,'delete-entry_{{$item->id}}')">Delete</button>
                                         </form>
                                      </td>
                                  </tr>
                                     @endforeach
                                  </tbody>
                               </table>
                           @else
                               No {{ $title }} Added Yet
                           @endif
                        </div>
                      </div>
                   </div>
                </div>
             </div>
              @endif
           </div>
        </div>
     </div>
     <!--  END CONTENT AREA  -->
@endsection

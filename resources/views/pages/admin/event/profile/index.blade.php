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
                       @if ($event_profile == NULL)
                          <div class="row">
                             <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Profile <a href="{{ route('event_admin.profile_create',$event_id) }}" class="btn btn-primary btn-sm float-right">Create</a></h4>
                             </div>
                          </div>
                        @endif      
                       </div>
                       <div class="widget-content widget-content-area">
                          <div class="table-responsive">
                            @include('layouts.admin.alerts')

                            @if ($event_profile)
                                <table class="table table-bordered table-hover mb-4">
                                   <thead>
                                      <tr>
                                          <th>#</th>
                                          <!-- <th>Name</th> -->
                                          <!-- <th>Logo</th>    -->
                                          <th>Email</th>
                                          <th>Address</th>         
                                          <th  >Action</th>
                                      </tr>
                                   </thead>
                                   <tbody>
                                      
                                      <tr>
                                       <td>{{ $no++ }}</td>
                                       <!-- <td>{{ $event_profile->event_name }}</td> -->
                                       <!-- <td><a href="{{ $event_profile->logo }}" target="_blank"><img style="max-width: 200px" src="{{ $event_profile->logo }}"></a></td> -->
                                       <td>{{ $event_profile->email }}</td>
                                       <td>{!! \Illuminate\Support\Str::limit($event_profile->address, 150, $end='...') !!}</td>
                                       <td>
                                          <a href="{{ route('event_admin.profile_edit',[$event_id,$event_profile->id]) }}" class="btn btn-primary btn-sm ">Edit</a>
                                          </td>
                                          <!-- <td>
                                           <form action="{{ route('event_admin.profile_destroy',[$event_id,$event_profile->id]) }}" method="post" style="">
                                           @csrf
                                               {{ method_field('DELETE') }}
                                               <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                       </form>
                                       </td> -->
                                   </tr> 
                                     
                                   </tbody>
                                </table>
                            @else
                                No Profile Added Yet
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
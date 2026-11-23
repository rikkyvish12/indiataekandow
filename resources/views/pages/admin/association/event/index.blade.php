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
                             @if($assoc_type == 'state_association')
                             <h4>State Events <a href="{{ route('assoc_admin.event_create',$assoc_id) }}" class="btn btn-primary btn-sm float-right">Create</a></h4>
                             @elseif($assoc_type == 'district_association')
                             <h4>District Events <a href="{{ route('assoc_admin.event_create',$assoc_id) }}" class="btn btn-primary btn-sm float-right">Create</a></h4>
                             @elseif($assoc_type == 'other_association')
                             <h4>Events <a href="{{ route('assoc_admin.event_create',$assoc_id) }}" class="btn btn-primary btn-sm float-right">Create</a></h4>
                                      
                             @endif
                             </div>
                          </div>
                       </div>
                       <div class="widget-content widget-content-area">
                          <div class="table-responsive">
                            @include('layouts.admin.alerts')

                            @if (count($events)>0)
                                <table class="table table-bordered table-hover mb-4">
                                   <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Title</th>
                                          <th>Cover Image</th>
                                          <th>Location</th>
                                          <th>Date</th>
                                          <th>Intro</th>
                                          <th>Content</th>
                                          <th>Link</th>
                                          <!-- <th>User-access</th> -->
                                          <th colspan="2" style="text-align: center">Action</th>
                                      </tr>
                                   </thead>
                                   <tbody>
                                      @foreach ($events as $item)
                                      <tr>
                                       <td>{{ $no++ }}</td>
                                       <td>{{ $item->title }}</td>
                                       <td><a href="{{ $item->coverImage }}" target="_blank"><img style="max-width: 200px" src="{{ $item->coverImage }}"></a></td>
                                       <td>{{ $item->location }}</td>
                                       <td>{{ $item->date }}</td>
                                       <td>{{ \Illuminate\Support\Str::limit($item->intro, 150, $end='...') }}</td>
                                       <td>
                                          @if($item->content != NULL )
                                          {!! \Illuminate\Support\Str::limit($item->content, 30, $end='...') !!}
                                          @else
                                          <small style="color:#EDE04D">No-Data-to-display</small>                                          
                                          @endif
                                      </td>
                                      <td>
                                          @if($item->link != NULL )
                                          {!! \Illuminate\Support\Str::limit($item->link, 30, $end='...') !!}
                                          @else
                                          <small style="color:#EDE04D">No-Data-to-display</small>                                          
                                          @endif
                                      </td>
                                      <!-- <td>
                                          @if($item->user_access != NULL )
                                          {!! \Illuminate\Support\Str::limit($item->user_name) !!}
                                          @else
                                          <small style="color:#EDE04D">No-Data-to-display</small>                                          
                                          @endif
                                      </td> -->
                                     

                                       <td>
                                          <a href="{{ route('assoc_admin.event_edit',[$assoc_id,$item->id]) }}" class="btn btn-primary btn-sm float-right">Edit</a>
                                       </td>
                                       <td>
                                           <form action="{{ route('assoc_admin.event_destroy',[$assoc_id,$item->id]) }}" method="post" id="delete-entry_{{$item->id}}">
                                           @csrf
                                           <button type="button" class="btn btn-danger btn-sm" onclick="deleteEntry(event,'delete-entry_{{$item->id}}')">Delete</button>
                                       </form>
                                       </td>
                                   </tr>
                                      @endforeach
                                   </tbody>
                                </table>
                            @else
                                No Events Added Yet
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

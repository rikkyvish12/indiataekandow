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
                                <h4>Coaches Profile <a href="{{ route('admin.profile_coaches.create') }}" class="btn btn-primary btn-sm float-right">Create</a></h4>
                             </div>
                          </div>
                       </div>
                       <div class="widget-content widget-content-area">
                          <div class="table-responsive">
                            @include('layouts.admin.alerts')

                            @if (count($members)>0)
                                <table class="table table-bordered table-hover mb-4">
                                   <thead>
                                      <tr>
                                          <th width="5%">#</th>
                                          <th width="9%">Name</th>
                                          <th width="9%">Title</th>
                                          <th width="9%">Points</th>
                                          <th width="9%">Image</th>
                                          <th width="13%" colspan="2">Action</th>
                                      </tr>
                                   </thead>
                                   <tbody>
                                      @foreach ($members as $item)
                                      <tr>

                                       <td>{{ $no++ }}</td>
                                       <td>{{ $item->name }}</td>
                                       <td>{{ $item->title }}</td>
                                       <td>{{ $item->points }}</td>
                                       <td><a href="{{ $item->image }}" target="_blank"><img style="max-width: 100px" src="{{ $item->image }}"></a></td>
                                       <td>
                                          <a href="{{ route('admin.profile_coaches.edit',$item->id) }}" class="btn btn-primary btn-sm float-left" style="margin-bottom: 10px">Edit</a>
                                           
                                       </td>
                                       <td><form action="{{ route('admin.profile_coaches.destroy',$item->id) }}" method="post" style="float: left:margin-top:10px">
                                          @csrf
                                              {{ method_field('DELETE') }}
                                              <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                      </form></td>
                                   </tr> 
                                      @endforeach
                                   </tbody>
                                </table>
                            @else
                                No Coaches Added Yet
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
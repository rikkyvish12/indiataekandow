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
                                <h4>Awards <a href="{{ route('admin.award.create') }}" class="btn btn-primary btn-sm float-right">Create</a></h4>
                             </div>
                          </div>
                       </div>
                       <div class="widget-content widget-content-area">
                          <div class="table-responsive">
                            @include('layouts.admin.alerts')

                            @if (count($award)>0)
                                <table class="table table-bordered table-hover mb-4">
                                   <thead>
                                      <tr>
                                          <th width="5%">#</th>
                                          <th width="9%">Name</th>
                                          <th width="9%">Title</th>
                                          <th width="9%">Date</th>
                                          <th width="9%">Description</th>
                                          <th width="9%">Intro</th>
                                          <th width="9%">CoverImage</th>
                                          <th width="9%">CoverImage1</th>                                     
                                          <th width="9%">CoverImage2</th>                                     
                                          <th width="9%">CoverImage3</th>                                     
                                          <th width="13%" colspan="2" style="text-align:center">Action</th>
                                      </tr>
                                   </thead>
                                   <tbody>
                                      @foreach ($award as $item)
                                      <tr>

                                       <td>{{ $no++ }}</td>
                                       <td>{{ $item->name }}</td>
                                       <td>{{ $item->title }}</td>
                                       <td>{{ date('d-m-Y', strtotime($item->date)) }}</td>
                                       <td>{!! \Illuminate\Support\Str::limit($item->description, 150, $end='...') !!}</td>
                                       <td>{!! \Illuminate\Support\Str::limit($item->intro, 150, $end='...') !!}</td>
                                       <td><a href="{{ $item->coverImage }}" target="_blank"><img style="max-width: 100px" src="{{ $item->coverImage }}"></a></td>
                                       

                                       <td>
                                       @if($item->coverImage1 !=="text")
                                      
                                          <a href="{{ $item->coverImage1 }}" target="_blank"><img style="max-width: 100px" src="{{ $item->coverImage1 }}"></a>

                                       @else
                                       <small style="color:#EDE04D"> No-Image-to-display </small>
                                      @endif
                                       </td>
                                       <td>
                                       @if($item->coverImage2 !=="text")
                                      
                                          <a href="{{ $item->coverImage2 }}" target="_blank"><img style="max-width: 100px" src="{{ $item->coverImage2 }}"></a>

                                       @else
                                       <small style="color:#EDE04D"> No-Image-to-display </small>
                                      @endif
                                       </td>
                                       <td>
                                       @if($item->coverImage3 !=="text")
                                      
                                          <a href="{{ $item->coverImage3 }}" target="_blank"><img style="max-width: 100px" src="{{ $item->coverImage3 }}"></a>

                                       @else
                                       <small style="color:#EDE04D"> No-Image-to-display </small>
                                      @endif
                                       </td>
                                       <!-- <td><a href="{{ $item->coverImage1 }}" target="_blank"><img style="max-width: 100px" src="{{ $item->coverImage1 }}"></a></td>
                                       <td><a href="{{ $item->coverImage2 }}" target="_blank"><img style="max-width: 100px" src="{{ $item->coverImage2 }}"></a></td>
                                       <td><a href="{{ $item->coverImage3 }}" target="_blank"><img style="max-width: 100px" src="{{ $item->coverImage3 }}"></a></td> -->
                                       <td>
                                          <a href="{{ route('admin.award.edit',$item->id) }}" class="btn btn-primary btn-sm float-right" style="">Edit</a>
                                          
                                       </td>
                                       <td> <form action="{{ route('admin.award.destroy',$item->id) }}" method="post" id="delete-entry_{{$item->id}}">
                                          @csrf
                                              {{ method_field('DELETE') }}
                                              <button type="button" class="btn btn-danger btn-sm" onclick="deleteEntry(event,'delete-entry_{{$item->id}}')">Delete</button>
                                      </form></td>
                                   </tr> 
                                      @endforeach
                                   </tbody>
                                </table>
                            @else
                                No Awards Added Yet
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
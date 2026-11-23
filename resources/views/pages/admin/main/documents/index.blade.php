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
                                <h4>Documents <a href="{{ route('admin.documents.create') }}" class="btn btn-primary btn-sm float-right">Create</a></h4>
                             </div>
                          </div>
                       </div>
                       <div class="widget-content widget-content-area">
                          <div class="table-responsive">
                             @include('layouts.admin.alerts')
                             <table class="table table-bordered table-hover mb-4">
                                <thead>
                                   <tr>
                                    <th width="20%">#</th>
                                    <th width="20%">Type</th>
                                    <th width="20%">Name</th>
                                    <th width="20%">Actions</th>
                                   </tr>
                                </thead>
                                <tbody>
                                @if(count($documents)>0)
                                    @foreach ($documents as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->type }}</td>
                                            <td><a href="{{ $item->file }}" target="_blank">{{ $item->name }}</a></td>
                                            <td>
                                                <form action="{{ route('admin.documents.destroy',$item->id) }}" method="post" id="delete-entry_{{$item->id}}">
                                                @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="deleteEntry(event,'delete-entry_{{$item->id}}')">Delete</button>
                                            </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                 @else
                                 <tr>
                                            <td colspan="4">No Documents added yet</td>
                                 <tr>
                                 @endif
                                </tbody>
                             </table>
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
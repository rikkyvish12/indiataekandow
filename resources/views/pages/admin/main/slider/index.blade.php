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
                             <div class="col-xl-6 col-md-6 col-sm-6 col-6">                           
                                <h4>Slider</h4>
                             </div>
                             <div class="col-xl-6 col-md-6 col-sm-6 col-6" style="padding: 20px">                           
                            <a href="{{ route('admin.slider.create') }}" class="btn btn-primary btn-sm float-right" style="margin-right:10px">Create</a>
                            {{-- <button class="btn btn-default btn-rounded la la-plus" style="float:right" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#manageSequenceBannerModal" onclick="" id="manageBannerSequence">Manage Sequence</button>&nbsp;&nbsp; --}}

                            {{-- <a data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#manageSequenceBannerModal" onclick="" id="manageBannerSequence" class="btn btn-primary btn-sm float-right" style="margin-right:10px">Manage Position</a> --}}
                           </div>
                          </div>
                       </div>
                       <div class="widget-content widget-content-area">
                          <div class="table-responsive">
                            @include('layouts.admin.alerts')

                            @if (count($slider)>0)
                                <table class="table table-bordered table-hover mb-4 ">
                                   <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Position</th>
                                          <!-- <th>Title</th> -->
                                          <th>Description</th>
                                          <th>Background Image</th>
                                          <th>Player Image</th>
                                          <th>Url</th>    
                                          <th>Link-Button-Text</th>                                 
                                          <th colspan="2" style="text-align: center">Action</th>
                                      </tr>
                                   </thead>
                                   <tbody>
                                      @foreach ($slider as $item)
                                      <tr>
                                       <td>{{ $no++ }}</td>
                                       <td>{{ $item->position }}</td>
                                       <!-- <td>{{ $item->title }}</td> -->
                                       <td>
                                         @if($item->description !=NULL)
                                             {{ \Illuminate\Support\Str::limit($item->description, 150, $end='...') }}
                                          @else
                                             <small style="color:#EDE04D"> No-data-to-display</small>
                                          @endif
                                       </td>
                                       <td><a href="{{ $item->backgroundImage }}" target="_blank"><img style="max-width: 200px" src="{{ $item->backgroundImage }}"></a></td>
                                       <td>
                                       @if($item->playerImage !==NULL)
                                      
                                          <a href="{{ $item->playerImage }}" target="_blank"><img style="max-width: 150px" src="{{ $item->playerImage }}"></a>

                                       @else
                                       <small style="color:#EDE04D"> No-Image-to-display</small>
                                       @endif
                                       </td>
                                       <td>
                                          @if($item->url != NULL)                                      
                                          {{ $item->url }}

                                          @else
                                             <small style="color:#EDE04D"> No-data-to-display</small>
                                          @endif
                                       </td>
                                       <td>
                                       @if($item->linkButtonText != NULL)                                      

                                          {{$item->linkButtonText}}
                                       @else
                                             <small style="color:#EDE04D"> No-data-to-display</small>
                                      @endif
                                       </td>

                                       <td>
                                          <a href="{{ route('admin.slider.edit',$item->id) }}" class="btn btn-primary btn-sm ">Edit</a>
                                       </td>
                                       <td> <form action="{{ route('admin.slider.destroy',$item->id) }}" method="post" style="" id="delete-entry_{{$item->id}}">
                                          @csrf
                                              {{ method_field('DELETE') }}
                                              <!-- <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Slider?')">Delete</button> -->
                                               <button type="button" class="btn btn-danger btn-sm" onclick="deleteEntry(event,'delete-entry_{{$item->id}}')">Delete</button>
                                      </form></td>
                                   </tr> 
                                      @endforeach
                                   </tbody>
                                </table>
                            @else
                                No Sliders Added Yet
                            @endif
                         </div>
                       </div>
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </div>
      <!--Manage Banner Sequence Modal -->
      <div class="modal fade" id="manageSequenceBannerModal" role="dialog" style="z-index: 1050">
         <div class="modal-dialog modal-md">
           <!-- Modal content-->
           <div class="modal-content " >
                 <div class="modal-header">
                       <span style=""><h5>Manage Position</h5></span>  
                       <button type="button" style="font-size: 30px;" class="close"   data-dismiss="modal" onclick="resetSequenceModalOldValues()" id="addNewAddressModalRightTopCloseButton" >&times;</button>
                 </div>
                 <div class="modal-body" style="padding:  0px 40px 0px 40px;">
                 <div id="manageSequenceModalTBody">  <!-- div used to refresh when user close modal to retain old position/values -->
                             <table class="table table-cart table-mobile">
                               <thead>
                                 <tr >
                                   <th><b>Banner</b></th>
                                   <!-- <th><b>Title</b></th> -->
                                   <th><b>Position</b></th>
                                 
                                 </tr>
                               </thead>
                               <tbody >
 
                               @if(sizeof($slider) > 0)
                                  @foreach($slider as $banner)
                                   <tr class="product-tr">
                                      <td class="product-col"  style="width: 50%;">
                                           
                                                           <a href="javascript:void(0)" >
                                                               <img src="{{$banner->backgroundImage}}?{{time()}}" alt="Baner 2" class="rounded" style="width:250px;height:100px"> 
                                                           </a>
                                                           
                                                 
                                       </td>
                                       <!-- <td  class="product-col"  style="width: 30%;">
                                           
                                                       <input type="text" class="form-control "  style="border:none" id="modal_intro_title_{{$banner['id']}}" placeholder="intro title" value="{{$banner['title']}}" diabled>
                                            
                                       </td> -->
                                       <td class="product-col"  style="width: 50%;" id=""> 
                                       <span  id="oldSequence_{{$banner['id']}}" class="old_sequences" style="display:none">{{$banner['position']}}</span>  
                                       <span  id="" class="banner_ids" style="display:none">{{$banner['id']}}</span>  
                                       <input type="text" class="form-control banner_sequence"  id="modal_new_sequence_{{$banner['id']}}" onkeypress="return isNumberKey(event)" 
                                       value="{{$banner['position']}}"  style="text-align:center"  >
                                       <label class="text-danger align-items-center" id="manage_sequence_error_label" style="" ></label>
 
                                       </td>
                                   </tr>
                                     
                                 @endforeach
                               @endif
                               </tbody>
                             </table>
                      </div>  <!--  refreshal div -->
                       
                 </div>
                       <hr class="mb-1">
                 <div class="modal-footer">
                               <button type="button" style="" class="btn btn-outline-success" id="manageSequenceBannerModalSaveButton" onclick="updateBannerSequence('{{sizeof($slider)}}')" data="modal">Update</button>
                               <button type="button" style="" class=" btn btn-outline-danger" onclick="resetSequenceModalOldValues() " id="manageSequenceBannerModalCloseButton" data-dismiss="modal">Close</button>
                 </div>
           </div>
         </div>
       </div>
     <!--  END CONTENT AREA  -->

     @endsection
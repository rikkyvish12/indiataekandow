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
                                    <h4>SELECT Association TO MANAGE</h4>
                                </div>                 
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">

                            <div class="row">
                                <div class="col-lg-12 col-12 mx-auto">
                                    <form method="post" action="#" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <p>Seletect Association to Manage</p>
                                            <select name="events" id="events" class="form-control">
                                            @foreach ($assoc as $item)
                                                <option  value="{{ $item->id }}">{{ $item->name }}  ({{$item->sub_info}})</option>
                                            @endforeach
                                            </select>
                                        </div>
                                        <!-- <div class="form-group">
                                            <p>Youtube Link</p>
                                            <input  type="text" name="link" id="link" placeholder="Youtube Link" class="form-control" required>
                                        </div> -->
                                        <button type="button" class="btn btn-primary" style="margin: 10px" onclick="manageSelectedEvent()">Manage</button>
                                    </form>
                                </div>                                        
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        </div>
        <script>
   function manageSelectedEvent(){
       var selected_state_id  = $("#events").val();
       var event_name =$("#events option:selected").text();
       window.location.href = '/assoc_admin/slider/'+selected_state_id;
   }
</script>
<!--  END CONTENT AREA  -->
@endsection
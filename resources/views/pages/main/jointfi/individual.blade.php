@extends('layouts.main.main')

@section('title')
individual
@endsection

@section('content')
<!--Main Slider Start-->
<div class="inner-banner-header wf100 default-banner" >
  <h1 >Join TFI</h1>
  <div class="gt-breadcrumbs">
    <ul>
      <li> <a href="/"> <i class="fas fa-home"></i> Home </a> </li>
      <li> <a >Join TFI</a> </li>
      <li> <a href="/individual" class="active">As an Individual</a> </li>

    </ul>
  </div>
</div>
<!--Main Slider Start-->
<!--Main Content Start-->
<div class="main-content innerpagebg wf100 p80 default-bg" >
  <!--News Large Page Start-->
  <!--Start-->
  <div class="news-details">
    <div class="container">
      <div class="row">
        <!--News Start-->
        <div class="col-lg-12">
          <div class="news-details-wrap">
            <div class="news-large-post">
              <div class="post-txt">
                <h2>Individual</h2>

                <div class="" style="padding-top: 10px">
                    <!-- <h2>==> Coming Soon</h2> -->
                         <!--Form Start-->
                     <div class="col-lg-12">
                        <div class="contact-form">
                        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                       

                        <form>
                           <ul class="form-row">
                              <li class="half-col">
                                  <label>Name:</label> <span class="text-danger "  style="font-size:16pt;display: inline;">*</span> 
                               <input type="text" class="form-control joinTfiInputs clearTfiFormInputs" placeholder="Your Name" id="full_name">
                               <span id="error_full_name" ></span>

                              </li>
                              <li class="half-col">
                              <label>State: <span class="text-danger "  style="font-size:16pt;display: inline;">*</span> 

                                <select class="form-control joinTfiInputs clearTfiFormSelects"  placeholder="State" aria-label="Default select example" id="state" style="margin-top: 5px;min-width:100% !important;width:100% !important;height:50px">
                                <option value="" selected>--Select State--</option>
                                    @foreach ($states as $state)
                                        @if($state->id ==15)
                                          <option value="{{$state->id}}" selected>{{$state->name}}</option>
                                        @else
                                        <option value="{{$state->id}}">{{$state->name}}</option>
                                        @endif
                                    @endforeach
                                  </select>
                                  <span id="error_state" ></span>

                            </li>
                              <li class="half-col">
                                <label>Contact:</label> <span class="text-danger "  style="font-size:16pt;display: inline;">*</span> 
                                <input type="text" class="form-control joinTfiInputs clearTfiFormInputs" placeholder="Contact" id="contact">
                                <span id="error_contact" ></span>


                                <label>Email-Id:</label> <span class="text-danger "  style="font-size:16pt;display: inline;">*</span> 
                                <input type="email" class="form-control joinTfiInputs clearTfiFormInputs" placeholder="Email" id="email">
                                <span id="error_email" ></span>


                                <label>Identity: <span class="text-danger "  style="font-size:16pt;display: inline;">*</span> 
                                <select class="form-control joinTfiInputs clearTfiFormSelects" aria-label="Default select example"  placeholder="Identity" id="identity" style="margin-top: 5px;min-width:100% !important;width:100% !important;height:50px">
                                <option value="" selected>--Select Identity--</option>
                                    <option value="1">Player</option>
                                    <option value="2">Referee</option>
                                    <option value="3">Coach</option>
                                    <option value="3">Official</option>
                                    <option value="3">Medical</option>
                                  </select>
                                  <span id="error_identity" ></span>

                             </li>
                              <li class="half-col">
                                <label>Address:</label> <span class="text-danger "  style="font-size:16pt;display: inline;">*</span> 
                                 <textarea style="height:auto;" class="form-control joinTfiInputs clearTfiFormInputs" rows="7" id="address" placeholder="Write Your Address"></textarea>
                                 <span id="error_address" ></span>

                              </li>
                              <li class="full-col" style="margin-top: 10px">
                                 <button type="button" onclick="joinTFI('individual')">Submit</button>
                              </li>
                           </ul>
                            </form>
                        </div>
                     </div>
                     <!--Form End-->

                 </div>
              </div>
            </div>
          </div>
        </div>
        <!--News End-->
      </div>
    </div>
  </div>
  <!--End-->
</div>
<!--Main Content End-->

<!--  lodaer error modal --> 

<div class="modal" tabindex="-1" id="loader-modal" role="dialog" data-backdrop="static" data-keyboard="false" style="background: transparent;box-shadow: none; text-align: center">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="background: transparent;box-shadow: none;border:none ">
      
      <div class="modal-body">
        <div class="lds-roller" style="margin: 0 auto;">
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
        </div>

      </div>
      
    </div>
  </div>
</div>

<!--end of loader modal-->

<!-- The Join Tfi Modal -->
  <div class="modal fade" id="errorModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
          
          <button type="button" class="close" data-dismiss="modal" style="text-align:right;margin-right:5px">&times;</button>
        
        <!-- Modal body -->
        <div class="modal-body" id="tfi_modal_body">
          
        </div>
        
      
      </div>
    </div>
  </div>
<!-- End of Join Tfi Modal -->
@endsection


@extends('layouts.main.main')

@section('title')
district_tfi
@endsection

@section('script')

@endsection
@section('content')
<!--Main Slider Start-->
<div class="inner-banner-header wf100 default-banner" >
  <h1 >Join TFI</h1>
  <div class="gt-breadcrumbs">
    <ul>
      <li> <a href="/"> <i class="fas fa-home"></i> Home </a> </li>
      <li> <a >Join TFI</a> </li>
      <li> <a href="/district_tfi" class="active">As a District TFI</a> </li>

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
                {{-- <h2>Feel Free to Contact us</h2> --}}
                <h2>As a District TFI</h2>

                <div class="" style="padding-top: 10px">
                    <!-- <h2>==> Coming Soon</h2> -->
                         <!--Form Start-->
                     <div class="col-lg-12">
                        <div class="contact-form">
                        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                        

                        <form>
                           <ul class="form-row">
                              <li class="half-col"> 
                                  <label>Name Of Person:</label> <span class="text-danger "  style="font-size:16pt;display: inline;">*</span>
                                 <input type="text" class="form-control joinTfiInputs clearTfiFormInputs" placeholder="Your Name" id="full_name">
                                 <span id="error_full_name" ></span>

                              </li>
                              <li class="half-col">
                                <label>District:</label> <span class="text-danger "  style="font-size:16pt;display: inline;">*</span>
                                 <!-- <input type="text" class="form-control" placeholder="District" id="district">  -->
                                 <select id="district" name="district" class="form-control joinTfiInputs clearTfiFormSelects" style="width:100%;max-width:100%;height:50px" placeholder="District" >
                                                        <option value="" selected>-Select-District-</option>
                                                        @foreach ($districts as $district)
                                                        <option value="{{$district->id}}"  >{{$district->name}}</option>
                                                        @endforeach

                                              </select>
                                 <span id="error_district" ></span>

                              </li>
                              <li class="half-col">
                              <label>State: <span class="text-danger "  style="font-size:16pt;display: inline;">*</span> 

                              <select class="form-control joinTfiInputs clearTfiFormSelects"  id="state" placeholder="State" style="margin-top: 5px;width:100%;max-width:100% !important;height:50px" >
                                <!-- <option value="" >--Select State--</option> -->
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
                                <label>Email-Id Of Organisation:</label> <span class="text-danger "  style="font-size:16pt;display: inline;">*</span>
                                <input type="email" class="form-control joinTfiInputs clearTfiFormInputs" placeholder="Email" id="email">
                                <span id="error_email" ></span>

                             </li>
                             <li class="half-col">
                                <label>Contact:</label> <span class="text-danger "  style="font-size:16pt;display: inline;">*</span>
                                <input type="text" class="form-control joinTfiInputs clearTfiFormInputs" placeholder="Contact" id="contact" >
                                <span id="error_contact" ></span>

                               <label>Website:</label> <span class="text-danger "  style="font-size:16pt;display: inline;">*</span>
                                <input type="text" class="form-control joinTfiInputs clearTfiFormInputs" placeholder="Website" id="website">
                                <span id="error_website" ></span>

                                <label>Social Media:</label> <span class="text-danger "  style="font-size:16pt;display: inline;">*</span>
                                <input type="text" class="form-control joinTfiInputs clearTfiFormInputs" placeholder="Social-Media-Link" id="social_media">
                                <span id="error_social_media" ></span>

                             </li>
                              <li class="half-col">
                                <label>Address of Organisation:</label> <span class="text-danger "  style="font-size:16pt;display: inline;">*</span>
                                 <textarea style="height:auto;" class="form-control joinTfiInputs clearTfiFormInputs" rows="8" placeholder="Address" id="address"></textarea>
                                 <span id="error_address" ></span>

                              </li>
                              <li class="full-col">
                                <label>Your Message:</label> <span class="text-danger "  style="font-size:16pt;display: inline;">*</span>
                                 <textarea style="height:auto;" class="form-control joinTfiInputs clearTfiFormInputs" rows="5" placeholder="Message" id="message"></textarea>
                                 <span id="error_message" ></span>

                              </li>
                              <li class="full-col" style="margin-top: 10px">
                              <button type="button" onclick="joinTFI('district')">Submit</button>
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

<!-- The Join TFI Modal -->
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
<!-- End of Join TFI Modal -->
<script>

function loadDistricts(){
       var state_id = $("#state").val();
        $.ajax({
    type: "GET",
    url: "/getDistricts/"+state_id,
    beforeSend: function(){
        
        //   alert("started")
        },
        complete: function(){
        
        //       alert("complete")
  
        },
    success: function(response){
    var data = JSON.parse(response);
    if(data!=""){

        var result = "";
      console.log(data) 
       $("#district").empty(); 
      $("#district").append($('<option>', {
              value: '',
              text: '-Select-District-',
          })); 
        $.each(data, function(i, item) {  
            $("#district").append($('<option>', {
              value: item.id,
              text: item.name,
          })); 
        });  
     
       
      }else{
        alert('no districts') 
        } 
        
        
     } 
    }); 

}
</script>
@endsection


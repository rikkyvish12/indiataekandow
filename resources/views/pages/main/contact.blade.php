@extends('layouts.main.main')


@section('title')
    Contact
@endsection


@section('content')
     <!--Main Slider Start-->
     <div class="inner-banner-header wf100 default-banner">
        <h1 >Contact</h1>
        <div class="gt-breadcrumbs">
           <ul>
              <li> <a href="contact.html#" class="active"> <i class="fas fa-home"></i> Home </a> </li>
              <li> <a href="contact.html#"> Contact </a> </li>
           </ul>
        </div>
     </div>
     <!--Main Slider Start-->
     <!--Main Content Start-->
     <div class="main-content p80 innerpagebg wf100 default-bg" >
        <!--Contact Page Start-->
        <div class="contact">
           <div class="container">
              <div class="row">
                 <!--Form Start-->
                 <div class="col-md-6">
                    <div class="contact-form">
                       <h2>Feel Free to Contact us</h2>
                       <ul class="form-row">
                       <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                       
                           <li class="half-col">
                              <input type="text" class="form-control contactUs clearContactFormInputs" placeholder="Your-Name" name="contactName" id="full_name">
                              <span id="error_full_name" ></span>

                           </li>
                           <li class="half-col">
                              <input type="text" class="form-control contactUs clearContactFormInputs" placeholder="Email" name="contactEmail" id="email">
                              <span id="error_email" ></span>

                           </li>
                           <li class="half-col">
                              <input type="text" class="form-control contactUs clearContactFormInputs" placeholder="Contact" name="contactNumber" id="contact">
                              <span id="error_contact" ></span>

                           </li>
                           <li class="half-col">
                              <input type="text" class="form-control contactUs clearContactFormInputs" placeholder="Subject" name="contactSubject" id="subject">
                              <span id="error_subject" ></span>

                           </li>
                           <li class="full-col">
                              <textarea  class="form-control contactUs clearContactFormInputs"   placeholder="Write Your Message" name="contactMessage" id="message"></textarea>
                              <span id="error_message" ></span>

                           </li>
<br>
                           <li class="full-col">
                           <button type="button" onclick="contactUs('main')" style="margin-top:5px">Contact-Us</button>
                           </li>
                        
                       </ul>
                    </div>
                 </div>
                 <!--Form End-->
                 @if ($profile)
                                    <!--Map Start-->
                                    <div class="col-md-6">
                                        <div class="google-map">
                                        {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1697.3072037532606!2d-74.00693495101423!3d40.7123457655961!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a188537cd67:0xa98395c323552df0!2sJacob+Wrey+Mould+Fountain!5e0!3m2!1sen!2s!4v1556523104271!5m2!1sen!2s"></iframe> --}}
                                        {!! $profile->map !!}
                                        </div>
                                    </div>
                                    <!--Map End-->
                                    </div>
                                    <div class="row mt-60">
                                    <div class="col-md-12">
                                        <h2>Contact Information</h2>
                                    </div>
                                    <!--Start-->
                                    <div class="col-md-4">
                                        <div class="contact-box">
                                        <h5>Address:</h5>
                                        <p> {{$profile->address}}
                                        </p>
                                        </div>
                                    </div>
                                    <!--End-->
                                    <!--Start-->
                                    <div class="col-md-4">
                                        <div class="contact-box">
                                        <h5>Contact:</h5>
                                        <p><strong>Phone:</strong> {{ $profile->number }}</p>
                                        </div>
                                    </div>
                                    <!--End-->
                                    <!--Start-->
                                    <div class="col-md-4">
                                        <div class="contact-box">
                                        <h5>For More Information:</h5>
                                        <p> <strong>Email:</strong>{{$profile->email}}</p>
                                        </div>
                                    </div>
                 @else

                 <!--Map Start-->
                 <div class="col-md-6">
                    <div class="google-map">
                       {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1697.3072037532606!2d-74.00693495101423!3d40.7123457655961!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a188537cd67:0xa98395c323552df0!2sJacob+Wrey+Mould+Fountain!5e0!3m2!1sen!2s!4v1556523104271!5m2!1sen!2s"></iframe> --}}

                    </div>
                 </div>
                 <!--Map End-->
              </div>
              <div class="row mt-60">
                 <div class="col-md-12">
                    <h2>Contact Information</h2>
                 </div>
                 <!--Start-->
                 <div class="col-md-4">
                    <div class="contact-box">
                       <h5>Address:</h5>
                       <p>
                       </p>
                    </div>
                 </div>
                 <!--End-->
                 <!--Start-->
                 <div class="col-md-4">
                    <div class="contact-box">
                       <h5>Contact:</h5>
                       <p><strong>Phone:</strong> </p>
                    </div>
                 </div>
                 <!--End-->
                 <!--Start-->
                 <div class="col-md-4">
                    <div class="contact-box">
                       <h5>For More Information:</h5>
                       <p> <strong>Email:</strong></p>
                    </div>
                 </div>
                 @endif

                 <!--End-->
              </div>
           </div>
        </div>
        <!--Contact Page End-->
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
        <div class="modal-body" id="contact_modal_body">
          
        </div>
        
      
      </div>
    </div>
  </div>
<!-- End of Join TFI Modal -->
@endsection

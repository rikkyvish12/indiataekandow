@extends('layouts.association.association')

@section('content')
<input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">

<div class="bigslam-page-wrapper" id="bigslam-page-wrapper" >
    <div class="gdlr-core-page-builder-body">
        <div class="bigslam-page-title-wrap  bigslam-style-small bigslam-center-align default-banner">
            <div class="bigslam-header-transparent-substitute"></div>
            <div class="bigslam-page-title-overlay"></div>
            <div class="bigslam-page-title-container bigslam-container">
                <div class="bigslam-page-title-content bigslam-item-pdlr">
                    <h1 class="bigslam-page-title">Contact Us</h1>
                    <div class="bigslam-page-caption">Get in Touch</div>
                </div>
            </div>
        </div>
 <input type="hidden" value="{{ $assoc_profile->id }}" id="assoc_id">
        <div class="gdlr-core-pbf-wrapper ">
            <div class="gdlr-core-pbf-wrapper-content gdlr-core-js ">
                <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-container">
                    <div class="gdlr-core-pbf-column gdlr-core-column-20 gdlr-core-column-first">
                        <div class="gdlr-core-pbf-column-content-margin gdlr-core-js " style="padding: 50px 20px 0px 20px;">
                            <div class="gdlr-core-pbf-background-wrap"></div>
                            <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js " data-gdlr-animation="fadeInUp" data-gdlr-animation-duration="600ms" data-gdlr-animation-offset="0.8">
                                <div class="gdlr-core-pbf-element">
                                    <div class="gdlr-core-icon-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-left-align" style="padding-bottom: 55px ;"><i class=" gdlr-core-icon-item-icon fa fa-phone" style="color: #454545 ;font-size: 40px ;min-width: 40px ;min-height: 40px ;"></i></div>
                                </div>
                                <div class="gdlr-core-pbf-element">
                                    <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-left-align gdlr-core-title-item-caption-top gdlr-core-item-pdlr" style="padding-bottom: 25px ;">
                                        <div class="gdlr-core-title-item-title-wrap ">
                                            <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " style="font-size: 26px ;letter-spacing: 0px ;text-transform: none ;">Phone<span class="gdlr-core-title-item-title-divider gdlr-core-skin-divider"></span></h3></div>
                                    </div>
                                </div>
                                <div class="gdlr-core-pbf-element">
                                    <div class="gdlr-core-text-box-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-left-align" style="padding-bottom: 0px ;">
                                        <div class="gdlr-core-text-box-item-content" style="font-size: 16px ;">
                                            <p>{{ $assoc_profile->number }}</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="gdlr-core-pbf-column gdlr-core-column-20">
                        <div class="gdlr-core-pbf-column-content-margin gdlr-core-js " style="padding: 50px 20px 0px 20px;">
                            <div class="gdlr-core-pbf-background-wrap"></div>
                            <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js " data-gdlr-animation="fadeInDown" data-gdlr-animation-duration="600ms" data-gdlr-animation-offset="0.8">
                                <div class="gdlr-core-pbf-element">
                                    <div class="gdlr-core-icon-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-left-align" style="padding-bottom: 55px ;"><i class=" gdlr-core-icon-item-icon fa fa-envelope-o" style="color: #454545 ;font-size: 40px ;min-width: 40px ;min-height: 40px ;"></i></div>
                                </div>
                                <div class="gdlr-core-pbf-element">
                                    <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-left-align gdlr-core-title-item-caption-top gdlr-core-item-pdlr" style="padding-bottom: 25px ;">
                                        <div class="gdlr-core-title-item-title-wrap ">
                                            <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " style="font-size: 26px ;letter-spacing: 0px ;text-transform: none ;">Email<span class="gdlr-core-title-item-title-divider gdlr-core-skin-divider"></span></h3></div>
                                    </div>
                                </div>
                                <div class="gdlr-core-pbf-element">
                                    <div class="gdlr-core-text-box-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-left-align" style="padding-bottom: 0px ;">
                                        <div class="gdlr-core-text-box-item-content" style="font-size: 16px ;">
                                            <p>{{ $assoc_profile->email }}</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="gdlr-core-pbf-column gdlr-core-column-20">
                        <div class="gdlr-core-pbf-column-content-margin gdlr-core-js " style="padding: 50px 20px 0px 20px;">
                            <div class="gdlr-core-pbf-background-wrap"></div>
                            <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js " data-gdlr-animation="fadeInUp" data-gdlr-animation-duration="600ms" data-gdlr-animation-offset="0.8">
                                <div class="gdlr-core-pbf-element">
                                    <div class="gdlr-core-icon-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-left-align" style="padding-bottom: 55px ;"><i class=" gdlr-core-icon-item-icon fa fa-location-arrow" style="color: #454545 ;font-size: 40px ;min-width: 40px ;min-height: 40px ;"></i></div>
                                </div>
                                <div class="gdlr-core-pbf-element">
                                    <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-left-align gdlr-core-title-item-caption-top gdlr-core-item-pdlr" style="padding-bottom: 25px ;">
                                        <div class="gdlr-core-title-item-title-wrap ">
                                            <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " style="font-size: 26px ;letter-spacing: 0px ;text-transform: none ;">Location<span class="gdlr-core-title-item-title-divider gdlr-core-skin-divider"></span></h3></div>
                                    </div>
                                </div>
                                <div class="gdlr-core-pbf-element">
                                    <div class="gdlr-core-text-box-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-left-align" style="padding-bottom: 0px ;">
                                        <div class="gdlr-core-text-box-item-content" style="font-size: 16px ;">
                                            <p>{{ $assoc_profile->address }}</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="gdlr-core-pbf-wrapper " style="padding: 95px 0px 90px 0px;" data-skin="Grey">
            <div class="gdlr-core-pbf-background-wrap" style="background-color: #f3f3f3 ;"></div>
            <div class="gdlr-core-pbf-wrapper-content gdlr-core-js ">
                <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-container">
                    <div class="gdlr-core-pbf-column gdlr-core-column-60 gdlr-core-column-first">
                        <div class="gdlr-core-pbf-column-content-margin gdlr-core-js ">
                            <div class="gdlr-core-pbf-background-wrap"></div>
                            <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js " style="max-width: 760px ;">
                                <div class="gdlr-core-pbf-element">
                                    <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-center-align gdlr-core-title-item-caption-bottom gdlr-core-item-pdlr">
                                        <div class="gdlr-core-title-item-title-wrap ">
                                            <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " style="font-size: 39px ;letter-spacing: 0px ;text-transform: none ;">Leave us your info <span class="gdlr-core-title-item-title-divider gdlr-core-skin-divider"></span></h3></div><span class="gdlr-core-title-item-caption gdlr-core-info-font gdlr-core-skin-caption" style="font-size: 19px ;font-style: normal ;">and we will get back to you.</span></div>
                                </div>
                                <div class="gdlr-core-pbf-element">
                                    <div class="gdlr-core-divider-item gdlr-core-divider-item-normal gdlr-core-item-pdlr gdlr-core-center-align" style="margin-bottom: 50px ;">
                                        <div class="gdlr-core-divider-container" style="max-width: 40px ;">
                                            <div class="gdlr-core-divider-line gdlr-core-skin-divider" style="border-color: #2b2b2b ;border-width: 2px;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="gdlr-core-pbf-element">
                                    <div class="gdlr-core-contact-form-7-item gdlr-core-item-pdlr gdlr-core-item-pdb ">
                                        <div role="form" class="wpcf7" id="wpcf7-f1319-p1964-o1" lang="en-US" dir="ltr">
                                            <div class="screen-reader-response"></div>
                                                <form class="quform" action="plugins/quform/process.php" method="post" enctype="multipart/form-data" onclick="">

                                                    <div class="quform-elements">
                                                        <div class="quform-element">
                                                            <p>

                                                                <span class="wpcf7-form-control-wrap your-name">
                                                                    <input id="full_name" type="text" name="full_name" size="40" class="input1 contactUs clearContactFormInputs" aria-required="true" aria-invalid="false" placeholder="Your-Name">
                                                                    <span id="error_full_name" ></span>

                                                                </span>
                                                            </p>
                                                        </div>
                                                        <div class="quform-element">
                                                            <p>

                                                                <span class="wpcf7-form-control-wrap your-email">
                                                                    <input id="email" type="text" name="email" size="40" class="input1 contactUs clearContactFormInputs" aria-required="true" aria-invalid="false" placeholder="Email">
                                                                    <span id="error_email" ></span>

                                                                </span>
                                                            </p>
                                                        </div>
                                                        <div class="quform-element">
                                                            <p>

                                                                <span class="wpcf7-form-control-wrap your-name">
                                                                    <input id="contact" type="text" name="contact" size="40" class="input1 contactUs clearContactFormInputs" aria-required="true" aria-invalid="false" placeholder="Contact">
                                                                    <span id="error_contact" ></span>

                                                                </span>
                                                            </p>
                                                        </div>
                                                        <div class="quform-element">
                                                            <p>

                                                                <span class="wpcf7-form-control-wrap your-name">
                                                                    <input id="subject" type="text" name="subject" size="40" class="input1 contactUs clearContactFormInputs" aria-required="true" aria-invalid="false" placeholder="Subject">
                                                                    <span id="error_subject" ></span>

                                                                </span>
                                                            </p>
                                                        </div>
                                                        <div class="quform-element">
                                                            <p>

                                                                <span class="wpcf7-form-control-wrap your-message">
                                                                    <textarea  id="message" name="message" cols="40" rows="10" class="input1 contactUs clearContactFormInputs" aria-invalid="false" placeholder="Write Your Message"></textarea>
                                                                    <span id="error_message" ></span>

                                                                </span>
                                                            </p>
                                                        </div>
                                                        <p>
                                                            <!-- Begin Submit button -->
                                                            <div class="quform-submit">
                                                                <div class="quform-submit-inner">
                                                                    <button type="button" class="submit-button" onclick="contactUs('assoc')"><span>Send</span></button>
                                                                </div>
                                                                <div class="quform-loading-wrap"><span class="quform-loading"></span></div>
                                                            </div>
                                                        </p>
                                                    </div>
                                                </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>
 
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

@endsection

  <!-- The Join TFI Modal -->
  <div class="modal " id="errorModal" >
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




  
 

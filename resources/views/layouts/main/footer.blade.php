<footer class="wf100 footer-three default-footer-bg">

    <!--Partner Logos Start-->
    <div class="partner-logos gradient">
      <div class="container">
        <div class="row">
          <ul class="row">
            <li class="col-md-2 col-sm-2"> <img src="{{ url('images/sitelogos1.png') }}" alt="Emeric Technologies"> </li>
            <li class="col-md-2 col-sm-2"> <img src="{{ url('images/sitelogos2.png') }}" alt="Emeric Technologies"></li>
            <li class="col-md-2 col-sm-2"><img src="{{ url('images/sitelogos3.png') }}" alt="Emeric Technologies"></li>
            <li class="col-md-2 col-sm-2"><img src="{{ url('images/sitelogos4.png') }}" alt="Emeric Technologies"></li>
            <li class="col-md-2 col-sm-2"><img src="{{ url('images/sitelogos5.png') }}" alt="Emeric Technologies"></li>
            <li class="col-md-2 col-sm-2"><img src="{{ url('images/sitelogos6.png') }}" alt="Emeric Technologies"> </li>
          </ul>
        </div>
      </div>
    </div>
    <!--Partner Logos End-->

    <!--Footer Widgets Start-->
    <div class="footer-widgets">
      <div class="container">
        <div class="row">
          <!--Footer Widget Start-->
          @if ($profile)
          <div class="col-lg-4 col-sm-6">
            <div class="footer-widget about-widget">
              <h4 class="text-dark">About {{ $profile->title }}</h4>
              <p class="a-tfi"> {{ $profile->smallDescription }}</p>
              <a href="{{ url('taekwondo') }}" class="read-about">More About</a>
            </div>
          </div>
          @else
          <div class="col-lg-4 col-sm-6">
            <div class="footer-widget about-widget ">
              <h4>About </h4>
              <p class="a-tfi"></p>
              <a href="{{ url('taekwondo') }}" class="read-about">More About</a>
            </div>
          </div>
          @endif

          <!--Footer Widget End-->
          <!--Footer Widget Start-->
          <div class="col-lg-3 col-sm-6">
            <div class="footer-widget">
              <h4 class="text-dark">Resources</h4>
              <ul class="quick-links">
                <li><a href="{{ url('/taekwondo') }}"><i class="fas fa-angle-double-right"></i> About Us </a></li>
                <li><a href="index-two.html#"><i class="fas fa-angle-double-right"></i> Terms And Conditions</a></li>
                <li><a href="index-two.html#"><i class="fas fa-angle-double-right"></i> Privacy Policy</a></li>
                <li><a href="index-two.html#"><i class="fas fa-angle-double-right"></i> Refund Policy</a></li>
                <li><a href="{{ url('contact') }}"><i class="fas fa-angle-double-right"></i> Contact Us</a></li>
                 {{-- <li><a href="index-two.html#"><i class="fas fa-angle-double-right"></i> Statistics</a></li>
                <li><a href="index-two.html#"><i class="fas fa-angle-double-right"></i> Contact us</a></li> --}}
              </ul>
            </div>
          </div>
          <!--Footer Widget End-->
          <!--Footer Widget Start-->
          {{-- <div class="col-lg-3 col-sm-6">
            <div class="footer-widget">
              <h4>Recent Instagram</h4>
              <ul class="instagram">
                <li><img src="{{ url('images/insta1.jpg') }}"></li>
                <li><img src="{{ url('images/insta2.jpg') }}"></li>
                <li><img src="{{ url('images/insta3.jpg') }}"></li>
                <li><img src="{{ url('images/insta4.jpg') }}"></li>
                <li><img src="{{ url('images/insta5.jpg') }}"></li>
                <li><img src="{{ url('images/insta6.jpg') }}"></li>
              </ul>
            </div>
          </div> --}}
          <!--Footer Widget End-->
          <!--Footer Widget Start-->
          <div class="col-lg-3 col-sm-6">
            <div class="footer-widget contact-widget">
              <h4 class="text-dark">Contact Detail</h4>
              @if ($profile)
              <address>
                <ul>
                  <li><i class="fas fa-map-marker-alt"></i> {{ $profile->address }} </li>
                  <li><i class="fas fa-phone"></i>{{ $profile->number }} </li>
                  <li><i class="fas fa-envelope"></i> {{ $profile->email }} </li>
                  <li><i class="fas fa-globe"></i><a href="https://www.taekwondoofindia.com "><i class="fas fa-angle-double-right"></i>www.taekwondoofindia.com</a></li>
                </ul>
                </address>
                @else
                <address>
                    <ul>
                      <li><i class="fas fa-map-marker-alt"></i> </li>
                      <li><i class="fas fa-phone"></i></li>
                      <li><i class="fas fa-envelope"></i> </li>
                      <li><i class="fas fa-globe"></i><a href="https://www.taekwondoofindia.com "><i class="fas fa-angle-double-right"></i>www.taekwondoofindia.com</a></li>
                    </ul>
                    </address>
                @endif
            </div>
          </div>
          <!--Footer Widget End-->
        </div>
      </div>
    </div>
    <!--Footer Widgets End-->

    <!--Newsletter Start-->
    {{-- <div class="footer-newsletter wf100">
      <div class="container">
        <div class="row">
          <div class="f-newsletter">
            <ul>
              <li class="col-md-5">
                <div class="input-group"> <i class="far fa-user"></i>
                  <input type="text" class="form-control" placeholder="Your Name">
                </div>
              </li>
              <li class="col-md-5">
                <div class="input-group"> <i class="far fa-envelope"></i>
                  <input type="text" class="form-control" placeholder="Your Emaill Address">
                </div>
              </li>
              <li class="col-md-2">
                <button><span>Subscribe</span></button>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div> --}}
    <!--Newsletter End-->
   

    <div class="wf100" style="padding: 10px; background-color: #20273F">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <ul class="topsocial">
            <li ><a href="https://www.facebook.com/taekwondoindiaofficial" class="fb" target="_blank" rel="noopener noreferrer"><i class="fab fa-facebook-f"></i></a></li>
              <!-- <li><a href="index-two.html#" class="tw"><i class="fab fa-twitter" target="_blank" rel="noopener noreferrer"></i></a></li> -->
              <li><a href="https://www.instagram.com/taekwondoindia/" class="insta" target="_blank" rel="noopener noreferrer"> <i class="fab fa-instagram" ></i></a></li>
              <!-- <li><a href="index-two.html#" class="in" target="_blank" rel="noopener noreferrer"><i class="fab fa-linkedin-in"> </i></a></li>
              <li><a href="index-two.html#" class="yt" target="_blank" rel="noopener noreferrer"><i class="fab fa-youtube"></i></a></li> -->
            </ul>
          </div>
          <div class="col-md-4">
            @if ($defaults)
            <div class="flogo"> <a href="{{ url('/') }}"><img src="{{ $defaults->logo }}" alt="TFI" style="width: 50px"></a> </div>
            @else
            <div class="flogo"> <a href="{{ url('/') }}"><img src="" alt="TFI" style="width: 50px"></a> </div>
            @endif
          </div>
          <div class="col-md-4">
            <p style="color: #999DA9; font-size: 15px; text-align:center;"> All Rights Reserved  © {{ now()->year }},  India Taekwondo</p>
          </div>
        </div>
      </div>
    </div>

    <button onclick="myFunction()" id="launch_toast_1" style="display:none" >Show Toast</button>
                <!-- <div id="toast" style="display:none" >
                       <div id="img">
                         TFI
                       </div>
                       <div id="mail_details">
                              Mail has been successfully sent, will get back to you soon..
                       </div>
                      </div> -->
                      <div id="snackbar" >Mail has been send, will contact you soon</div>

  </footer>

  <script>
 function myFunction() {
  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
  
}
</script>

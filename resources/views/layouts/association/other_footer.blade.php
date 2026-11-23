<footer>
                <div class="bigslam-footer-wrapper">
                    <div class="bigslam-footer-container bigslam-container clearfix">
                        <div class="bigslam-footer-column bigslam-item-pdlr bigslam-column-20">
                            <div id="text-11" class="widget widget_text bigslam-widget">
                                <h3 class="bigslam-widget-title">Contact Info</h3>
                                <div class="textwidget">
                                    <p><a href="index.html"><img src="{{ $assoc_profile->logo }}" alt="" width="50" height="50" title="logo"></a></p>
                                    <p>{{ $assoc_profile->address }}</p>
                                    <span>Email ID: {{ $assoc_profile->email }},</span><br />
                                    <span>Mobile No: {{ $assoc_profile->number }}</span>

                                       
                                </div>
                            </div>
                        </div>
                        <div class="bigslam-footer-column bigslam-item-pdlr bigslam-column-20">
                            <div id="gdlr-core-custom-menu-widget-2" class="widget widget_gdlr-core-custom-menu-widget bigslam-widget">
                                <h3 class="bigslam-widget-title">Resources</h3>
                                <div class="menu-resources-container">
                                    <ul id="menu-resources" class="gdlr-core-custom-menu-widget gdlr-core-menu-style-half">
                                        <li class="menu-item"><a href="index.html#">Marketplace</a></li>
                                        <li class="menu-item"><a href="index.html#">League Table</a></li>
                                        <li class="menu-item"><a href="index.html#">Media Kit</a></li>
                                        <li class="menu-item"><a href="index.html#">Schedule</a></li>
                                        <li class="menu-item"><a href="index.html#">Shop</a></li>
                                        <li class="menu-item"><a href="index.html#">Players</a></li>
                                        <li class="menu-item"><a href="index.html#">Blog</a></li>
                                        <li class="menu-item"><a href="index.html#">Forum</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="bigslam-footer-column bigslam-item-pdlr bigslam-column-20">
                            <div id="text-10" class="widget widget_text bigslam-widget">
                                <h3 class="bigslam-widget-title">Newsletter</h3>
                                <div class="textwidget">
                                    <p>{{ $assoc_profile->description }} <span class="gdlr-core-space-shortcode" style="margin-top: -40px ;"></span></p>
                                </div>
                            </div>
                            <div id="gdlr-core-newsletter-widget-2" class="widget widget_gdlr-core-newsletter-widget bigslam-widget">
                                <div class="gdlr-core-with-fa-send-o-button tnp tnp-subscription gdlr-core-style-2">
                                    <form method="post" action="#" onsubmit="return newsletter_check(this)">

                                        <input type="hidden" name="nlang" value="">
                                        <div class="tnp-field tnp-field-email">
                                            <input class="tnp-email" type="email" name="ne" placeholder="Enter Your Email Address" required="">
                                        </div>
                                        <div class="tnp-field tnp-field-button" style="color: #fff;">
                                            <input class="tnp-submit" type="submit" value="Subscribe" style="background-color:#f27052;">
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <div id="text-1" class="widget widget_text bigslam-widget">
                                <div class="textwidget"><span class="gdlr-core-space-shortcode" style="margin-top: -30px ;"></span>
                                    <!-- <a href="#" target="_blank" rel="noopener noreferrer"><i class="fa fa-twitter" style="font-size: 20px ;color: #8a99c0 ;margin-right: 20px ;"></i></a> -->
                                     <a href="{{ $assoc_profile->facebook }}" target="_blank" rel="noopener noreferrer"><i class="fa fa-facebook-official" style="font-size: 20px ;color: #8a99c0 ;margin-right: 20px ;"></i></a> 
                                     <a href="{{ $assoc_profile->instagram }}" target="_blank" rel="noopener noreferrer"><i class="fa fa-instagram" style="font-size: 20px ;color: #8a99c0 ;margin-right: 20px ;"></i></a> 
                                     <!-- <a href="#" target="_blank" rel="noopener noreferrer"><i class="fa fa-pinterest-p" style="font-size: 20px ;color: #8a99c0 ;margin-right: 20px ;"></i></a> 
                                     <a href="#" target="_blank" rel="noopener noreferrer"><i class="fa fa-linkedin" style="font-size: 20px ;color: #8a99c0 ;margin-right: 20px ;"></i></a> </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bigslam-copyright-wrapper">
                    <div class="bigslam-copyright-container bigslam-container">
                        <div class="bigslam-copyright-text bigslam-item-pdlr">Copyright 2020 GoodLayers, All Right Reserved</div>
                    </div>
                </div>
                <button onclick="myFunction()" id="launch_toast_1" style="display:none" >Show Toast</button>

                <div id="snackbar" >Mail has been send, will contact you soon</div>

            </footer>

            <script>
 function myFunction() {
  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
  
}
</script>
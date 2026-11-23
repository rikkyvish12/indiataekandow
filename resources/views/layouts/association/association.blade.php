<!DOCTYPE html>
<html lang="en-US" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $assoc_profile->assoc_name }}</title>
    <meta name="description" content="{{ $assoc_profile->description }}">
    @include('layouts.association.style') 

</head>


<body class="home page-template-default page page-id-4957 theme-bigslam gdlr-core-body woocommerce-no-js bigslam-body bigslam-body-front bigslam-full gdlr-core-link-to-lightbox">
    <div class="bigslam-mobile-header-wrap">
        <div class="bigslam-mobile-header bigslam-header-background bigslam-style-slide" id="bigslam-mobile-header">
            <div class="bigslam-mobile-header-container bigslam-container">
                <div class="bigslam-logo  bigslam-item-pdlr">
                    <div class="bigslam-logo-inner">
                        <a href="index.html"><img src="{{ $assoc_profile->logo }}" alt="" width="200" height="191" title="logo"></a>
                    </div>
                </div>
                <div class="bigslam-mobile-menu-right">
                    <div class="bigslam-overlay-menu bigslam-mobile-menu" id="bigslam-mobile-menu"><a class="bigslam-overlay-menu-icon bigslam-mobile-menu-button bigslam-mobile-button-hamburger" href="index.html#"><span></span></a>
                        <div class="bigslam-overlay-menu-content bigslam-navigation-font">
                            <div class="bigslam-overlay-menu-close"></div>
                            <div class="bigslam-overlay-menu-row">
                                <div class="bigslam-overlay-menu-cell">
                                @if ($assoc_type_id == 1)
                                   @include('layouts.association.state_mobile_menu')
                                   @elseif ($assoc_type_id == 2)
                                   @include('layouts.association.district_mobile_menu')
                                   @else
                                   @include('layouts.association.state_mobile_menu')

                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bigslam-body-outer-wrapper ">
        <div class="bigslam-body-wrapper clearfix  bigslam-with-transparent-header bigslam-with-frame">
            <div class="bigslam-header-background-transparent">
                <header class="bigslam-header-wrap bigslam-header-style-plain  bigslam-style-splitted-menu bigslam-sticky-navigation bigslam-style-slide">
                    <div class="bigslam-header-background"></div>
                    <div class="bigslam-header-container  bigslam-header-full">

                        <div class="bigslam-header-container-inner clearfix">
                            <div class="bigslam-navigation bigslam-item-pdlr clearfix ">
                                <div class="bigslam-main-menu" id="bigslam-main-menu">
                                @if ($assoc_type_id == 1)
                                    @include('layouts.association.state_web_menu')
                                @elseif ($assoc_type_id == 2)
                                   @include('layouts.association.district_web_menu')
                                @else
                                @include('layouts.association.other_web_menu')

                                @endif
                                    <div class="bigslam-navigation-slide-bar bigslam-style-2" id="bigslam-navigation-slide-bar"></div>
                                </div>
                            </div>
                            <!-- bigslam-navigation -->
                        </div>
                        <!-- bigslam-header-inner -->
                    </div>
                    <!-- bigslam-header-container -->

                </header>
                <!-- header -->
            </div>
           @yield('content')
           @if ($assoc_type_id == 1)
           @include('layouts.association.state_footer') 
           @elseif ($assoc_type_id == 2)
           @include('layouts.association.district_footer') 
           @else
           @include('layouts.association.other_web_menu')

           @endif
        </div>
    </div><a href="{{url()->current()}}#bigslam-top-anchor" class="bigslam-footer-back-to-top-button" id="bigslam-footer-back-to-top-button"><i class="fa fa-angle-up"></i></a>
    @include('layouts.association.script') 
   
</body>
</html>
<!DOCTYPE html>
<html lang="en-US" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $event_profile->event_name }}</title>
    <meta name="description" content="{{ $event_profile->description }}">
    @include('layouts.event.style')


</head>

<body data-rsssl="1" class="home page-template-default page page-id-2039 theme-bigslam gdlr-core-body woocommerce-no-js bigslam-body bigslam-body-front bigslam-full  bigslam-with-sticky-navigation  bigslam-sticky-navigation-no-logo gdlr-core-link-to-lightbox">
    <div class="bigslam-mobile-header-wrap">
        <div class="bigslam-mobile-header bigslam-header-background bigslam-style-slide" id="bigslam-mobile-header">
            <div class="bigslam-mobile-header-container bigslam-container">
                <div class="bigslam-logo  bigslam-item-pdlr">
                    <div class="bigslam-logo-inner">
                        <a href="{{ url('events/'.$event->id.'/'.$event_name) }}"><img src="{{ $default->logo }}" alt="" width="300" height="109" title="logo-mobile"></a>
                    </div>
                </div>
                <div class="bigslam-mobile-menu-right">
                    <div class="bigslam-mobile-menu"><a class="bigslam-mm-menu-button bigslam-mobile-menu-button bigslam-mobile-button-hamburger-with-border" href="index.html#bigslam-mobile-menu"><i class="fa fa-bars"></i></a>
                        <div class="bigslam-mm-menu-wrap bigslam-navigation-font" id="bigslam-mobile-menu" data-slide="right">
                           @include('layouts.event.mobile_menu')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bigslam-body-outer-wrapper ">
        <div class="bigslam-body-wrapper clearfix  bigslam-with-transparent-header bigslam-with-frame">
            <div class="bigslam-header-background-transparent">
                <header class="bigslam-header-wrap bigslam-header-style-plain  bigslam-style-menu-right bigslam-sticky-navigation bigslam-style-slide">
                    <div class="bigslam-header-background"></div>
                    <div class="bigslam-header-container  bigslam-header-full">

                        <div class="bigslam-header-container-inner clearfix">
                            <div class="bigslam-logo  bigslam-item-pdlr">
                                <div class="bigslam-logo-inner">
                                    <a href="{{ url('events/'.$event->id.'/'.$event_name) }}"><img src="{{ $default->logo }}" alt="" width="131" height="160" title="logo"></a>
                                </div>
                            </div>
                            <div class="bigslam-navigation bigslam-item-pdlr clearfix ">
                                <div class="bigslam-main-menu" id="bigslam-main-menu">
                                   @include('layouts.event.web_menu')
                                    <div class="bigslam-navigation-slide-bar" id="bigslam-navigation-slide-bar"></div>
                                    <div class="bigslam-navigation-slide-bar-small" id="bigslam-navigation-slide-bar-small"></div>
                                </div>
                            </div>
                            <!-- bigslam-navigation -->
                        </div>
                        <!-- bigslam-header-inner -->
                    </div>
                    <!-- bigslam-header-container -->

                    <div class="bigslam-navigation-slide-bar-long" id="bigslam-navigation-slide-bar-long"></div>
                </header>
                <!-- header -->
            </div>
         @yield('content')
         @include('layouts.event.footer')

        </div>
    </div><a href="#bigslam-top-anchor" class="bigslam-footer-back-to-top-button" id="bigslam-footer-back-to-top-button"><i class="fa fa-angle-up"></i></a>
    @include('layouts.event.script')
</body>
</html>
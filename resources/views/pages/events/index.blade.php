@extends('layouts.event.event')



@section('content')
<div class="bigslam-page-wrapper " id="bigslam-page-wrapper">
    <div class="gdlr-core-page-builder-body">
        <!----------------------------------------------------------------->
        <!------------------------Sliders Start---------------------------->
        <!----------------------------------------------------------------->
        <div class="gdlr-core-pbf-wrapper " style="padding: 0px 0px 0px 0px;">
            <div class="gdlr-core-pbf-background-wrap" style="background-color: #1c1c1c ;"></div>
            <div class="gdlr-core-pbf-wrapper-content gdlr-core-js ">
                <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-pbf-wrapper-full-no-space">
                    <div class="gdlr-core-pbf-element">
                        <div class="gdlr-core-revolution-slider-item gdlr-core-item-pdlr gdlr-core-item-pdb "
                            style="padding-bottom: 0px ;">
                            <!-- START Soccer 01 REVOLUTION SLIDER 6.1.5 -->
                            <p class="rs-p-wp-fix"></p>
                            <rs-module-wrap id="rev_slider_1_1_wrapper" data-source="gallery"
                                style="background:transparent;padding:0;margin:0px auto;margin-top:0;margin-bottom:0;">
                                <rs-module id="rev_slider_1_1" style="display:none;" data-version="6.1.5">
                                    <rs-slides>
                                        @foreach ($slider as $item)
                                        <rs-slide data-key="rs-1" data-title="Slide" data-thumb="#"
                                            data-anim="ei:d;eo:d;s:600;r:0;t:fade;sl:d;">
                                            <img src="{{ $item->image }}" title="slider-new-1" width="1920"
                                                height="1030" class="rev-slidebg" data-no-retina="">
                                        </rs-slide>
                                        @endforeach


                                    </rs-slides>
                                    <rs-static-layers>
                                        <!--
                -->
                                    </rs-static-layers>
                                    <rs-progress class="rs-bottom" style="visibility: hidden !important;"></rs-progress>
                                </rs-module>

                            </rs-module-wrap>
                            <!-- END REVOLUTION SLIDER -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!----------------------------------------------------------------->
        <!------------------------Sliders End------------------------------>
        <!----------------------------------------------------------------->

        <div class="gdlr-core-pbf-wrapper default-bg" style="padding: 90px 0px 30px 0px;" data-skin="Blog Carousel">
            <div class="gdlr-core-pbf-background-wrap">
                <div class="gdlr-core-pbf-background gdlr-core-parallax gdlr-core-js" data-parallax-speed="0"></div>
            </div>
            <div class="gdlr-core-pbf-wrapper-content gdlr-core-js ">
                <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-container">
                    <div class="gdlr-core-pbf-element">
                        <div
                            class="gdlr-core-blog-item gdlr-core-item-pdb clearfix  gdlr-core-style-blog-column-with-frame gdlr-core-item-pdlr">
                            <div class="gdlr-core-block-item-title-wrap gdlr-core-left-align">
                                <div class="gdlr-core-block-item-title-inner">
                                    <h3 class="gdlr-core-block-item-title" style="font-size: 22px ;"><i
                                            class="fa fa-newspaper-o" style="color: #ec4613 ;"></i>Latest News</h3>
                                </div>
                                <div
                                    class="gdlr-core-flexslider-nav gdlr-core-rectangle-style gdlr-core-large gdlr-core-absolute-center gdlr-core-right">
                                </div>
                            </div>
                            <div class="gdlr-core-flexslider flexslider gdlr-core-js-2 " data-type="carousel"
                                data-column="4" data-move="1" data-nav="navigation"
                                data-nav-parent="gdlr-core-blog-item" data-disable-autoslide="1">
                                <ul class="slides">
                                    @foreach ($news as $item)
                                    <li class="gdlr-core-item-mglr">
                                        <div class="gdlr-core-blog-grid gdlr-core-js  gdlr-core-blog-grid-with-frame gdlr-core-item-mgb gdlr-core-skin-e-background "
                                            data-sync-height="blog-item-1">
                                            <div
                                                class="gdlr-core-blog-thumbnail gdlr-core-media-image  gdlr-core-opacity-on-hover gdlr-core-zoom-on-hover">
                                                <a href="{{ $item->link }}" target="_blank"><img
                                                        src="{{ $item->coverImage }}" width="550" height="500" alt="">
                                                </a>
                                            </div>
                                            <div class="gdlr-core-blog-grid-frame">
                                                <div class="gdlr-core-blog-grid-date"><span
                                                        class="gdlr-core-blog-info gdlr-core-blog-info-font gdlr-core-skin-caption gdlr-core-blog-info-date"><span
                                                            class="gdlr-core-head"><i
                                                                class="fa fa-clock-o"></i></span><a
                                                            href="{{ $item->link }}" target="_blank">{{ date('d-M-Y',
                                                            strtotime($item->date)) }}</a></span>
                                                </div>
                                                <h3 class="gdlr-core-blog-title gdlr-core-skin-title"
                                                    style="font-size: 16px ;text-transform: uppercase ;"><a
                                                        href="{{ $item->link }}" target="_blank">{{ $item->title }}</a>
                                                </h3>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <br />
                            <div class="text-center">
                                <a class="gdlr-core-button"
                                    href="{{ url('events/'.$event->id.'/'.$event_name.'/news')}}">GO TO News and
                                    Blogs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="gdlr-core-pbf-wrapper " style="padding: 70px 0px 20px 0px;" data-skin="Port Carousel">
            <div class="gdlr-core-pbf-background-wrap" style="background-color: #181818 ;"></div>
            <div class="gdlr-core-pbf-wrapper-content gdlr-core-js ">
                <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-container">
                    <div class="gdlr-core-pbf-element">
                        <div
                            class="gdlr-core-portfolio-item gdlr-core-item-pdb clearfix  gdlr-core-portfolio-item-style-grid gdlr-core-item-pdlr">
                            <div class="gdlr-core-block-item-title-wrap  gdlr-core-left-align"
                                style="margin-bottom: 40px ;">
                                <div class="gdlr-core-block-item-title-inner">
                                    <h3 class="gdlr-core-block-item-title" style="font-size: 22px ;color: #ffffff ;"><i
                                            class="fa fa-image" style="color: #ec4613 ;"></i>Image Gallery</h3>
                                </div>
                                <div
                                    class="gdlr-core-flexslider-nav gdlr-core-rectangle-style gdlr-core-absolute-center gdlr-core-right">
                                </div>
                            </div>
                            <div class="gdlr-core-flexslider flexslider gdlr-core-js-2 " data-type="carousel"
                                data-column="6" data-nav="navigation" data-nav-parent="gdlr-core-portfolio-item"
                                data-disable-autoslide="1">
                                <ul class="slides">
                                    @foreach ($album as $item)
                                    <li class="gdlr-core-item-mglr">
                                        <div
                                            class="gdlr-core-portfolio-grid  gdlr-core-left-align gdlr-core-style-normal">
                                            <div
                                                class="gdlr-core-portfolio-thumbnail gdlr-core-media-image  gdlr-core-style-icon">
                                                <div
                                                    class="gdlr-core-portfolio-thumbnail-image-wrap  gdlr-core-zoom-on-hover">
                                                    <a href="{{ url('events/'.$event->id.'/'.$event_name.'/image_albums/'.$item->id.'/'.$item->album_name) }}"
                                                        data-options="width: 1280, height: 720"><img
                                                            src="{{ $item->coverImage }}" width="700" height="450"
                                                            alt=""><span
                                                            class="gdlr-core-image-overlay  gdlr-core-portfolio-overlay gdlr-core-image-overlay-center-icon gdlr-core-js"><span
                                                                class="gdlr-core-image-overlay-content"><span
                                                                    class="gdlr-core-portfolio-icon-wrap"><i
                                                                        class="gdlr-core-portfolio-icon fa fa-image"></i></span></span>
                                                        </span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="gdlr-core-portfolio-content-wrap gdlr-core-skin-divider">
                                                <h3 class="gdlr-core-portfolio-title gdlr-core-skin-title"><a
                                                        href="{{ url('events/'.$event->id.'/'.$event_name.'/image_albums/'.$item->id.'/'.$item->album_name) }}">{{
                                                        $item->album_name }}</a></h3><span
                                                    class="gdlr-core-portfolio-info gdlr-core-portfolio-info-date gdlr-core-info-font gdlr-core-skin-caption"><a
                                                        href="{{ url('events/'.$event->id.'/'.$event_name.'/image_albums/'.$item->album_name) }}">{{
                                                        date("M d, Y", strtotime($item->timestamp)) }}</a></span>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>

                            </div>
                            <div class="text-center">
                                <a class="gdlr-core-button"
                                    href="{{ url('events/'.$event->id.'/'.$event_name.'/image_albums')}}">GO TO
                                   Image Albums</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="gdlr-core-pbf-wrapper default-bg" style="padding: 40px 0px 35px 0px;">
            <div class="gdlr-core-pbf-background-wrap"></div>
            <div class="gdlr-core-pbf-wrapper-content gdlr-core-js ">
                <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-container">
                    <div class="gdlr-core-pbf-column gdlr-core-column-40 gdlr-core-column-first">
                        <div class="gdlr-core-pbf-column-content-margin gdlr-core-js ">
                            <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js ">
                                <div class="gdlr-core-pbf-element">
                                    <div class="gdlr-core-text-box-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-left-align"
                                        style="padding-bottom: 0px ;">
                                        <div class="gdlr-core-text-box-item-content">
                                            <div class="sportspress sp-widget-align-none">
                                                <div class="sp-template sp-template-event-list">
                                                    <div class="bigslam-sp-event-featured-holder clearfix">
                                                        <div class="bigslam-sp-event-featured-top bigslam-status-vs">
                                                            <div
                                                                class="bigslam-sp-event-featured-title bigslam-title-font clearfix">
                                                                <div class="bigslam-sp-event-featured-title-left"><span
                                                                        class="bigslam-sp-team-logo"></span><span
                                                                        class="bigslam-sp-team-name">Schedule</span>
                                                                </div><span
                                                                    class="bigslam-sp-event-result"><a>&</a></span>
                                                                <div class="bigslam-sp-event-featured-title-right"><span
                                                                        class="bigslam-sp-team-logo"></span><span
                                                                        class="bigslam-sp-team-name">Results</span>
                                                                </div>
                                                            </div>
                                                            {{-- <div class="bigslam-sp-event-featured-info"><span
                                                                    class="bigslam-sp-event-date">March 10,
                                                                    2022</span><span class="bigslam-sp-event-venue"><a
                                                                        href="index.html#" rel="tag">New Yorkers
                                                                        Stadium</a></span></div> --}}
                                                        </div>
                                                        @foreach ($pdf as $item)
     
                                                                <div class="bigslam-sp-event-featured-list clearfix">
                                                                    <div
                                                                        class="bigslam-sp-event-featured-title bigslam-title-font">
                                                                        <span class="bigslam-sp-team-logo">
                                                                            <img width="200" height="244"
                                                                                src="upload/team-1.png"
                                                                                class="attachment-sportspress-fit-medium size-sportspress-fit-medium wp-post-image"
                                                                                alt="">
                                                                        </span>
                                                                        <span class="bigslam-sp-event-result">
                                                                            <a href="index.html#">Event-></a>
                                                                        </span>
                                                                        <span class="bigslam-sp-team-name">{{$item->event_name}}</span>
                                                                        <!-- <span class="bigslam-sp-team-name">Oklahoma</span>
                                                                        <span class="bigslam-sp-team-logo">
                                                                            <img width="200" height="171"
                                                                                src="upload/team-7.png"
                                                                                class="attachment-sportspress-fit-medium size-sportspress-fit-medium wp-post-image"
                                                                                alt="">
                                                                        </span> -->
                                                                    </div>

                                                                    <div class="bigslam-sp-event-featured-info">
                                                                        <span class="bigslam-sp-event-date">{{date("M d, Y", strtotime($item->date))}}</span>
                                                                        <span class="bigslam-sp-event-venue"><a
                                                                                href="#" rel="tag">Round-{{$item->round}}
                                                                        </a></span>
                                                                        <span class="bigslam-sp-event-venue"><a
                                                                                href="#" rel="tag">Group-{{$item->group}}
                                                                        </a></span>
                                                                        <a class="bigslam-sp-event-link" href="{{$item->result_pdf}}" target="_blank">
                                                                            <div class="dashicons dashicons-video-alt"></div>
                                                                            Preview<i class="fa fa-long-arrow-right"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="gdlr-core-pbf-element">
                                    <div class="gdlr-core-button-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-center-align"
                                        style="margin-top: -37px ;"><a
                                            class="gdlr-core-button  gdlr-core-button-gradient gdlr-core-button-no-border gdlr-core-button-full-width"
                                            href="{{ url('events/'.$event->id.'/'.$event_name.'/schedule_and_results') }}"
                                            style="font-size: 13px ;color: #ec4613 ;border-radius: 0px;-moz-border-radius: 0px;-webkit-border-radius: 0px;background: #252525 ;"><span
                                                class="gdlr-core-content">View Schedule and Results</span></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gdlr-core-pbf-column gdlr-core-column-20 ">
                        <div class="gdlr-core-pbf-column-content-margin gdlr-core-js ">
                            <div class="gdlr-core-pbf-background-wrap"></div>
                            <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js ">
                                <div class="gdlr-core-pbf-element">
                                    <div class="gdlr-core-text-box-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-left-align"
                                        style="padding-bottom: 0px ;">
                                        <div class="gdlr-core-text-box-item-content">
                                            <div class="sportspress sp-widget-align-none">
                                                <div class="sp-template sp-template-event-list">
                                                    <h4 class="sp-table-caption">Important PDF</h4>
                                                    <div class="bigslam-sp-event-widget-holder clearfix">
                                                        <table
                                                            class="sp-league-table sp-data-table sp-sortable-table sp-scrollable-table sp-paginated-table"
                                                            data-sp-rows="10">
                                                            <tbody>
                                                                @foreach ($pdf as $item)
                                                                <tr class="odd sp-row-no-0">
                                                                    <td><a href="{{ $item->pdf }}" target="_blank">{{
                                                                            $item->pdf_name }}</a></td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="gdlr-core-pbf-element">
                                        <div class="gdlr-core-button-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-center-align"
                                            style="padding-bottom: 40px ;margin-top: -15px ;"><a
                                                class="gdlr-core-button  gdlr-core-button-transparent gdlr-core-button-no-border"
                                                href="index.html#"
                                                style="font-size: 13px ;color: #ec4613 ;padding: 0px 0px 0px 0px;"><span
                                                    class="gdlr-core-content">View All PDF's</span><i
                                                    class="gdlr-core-pos-right fa fa-long-arrow-right"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="gdlr-core-pbf-wrapper " style="padding: 70px 0px 20px 0px;" data-skin="Port Carousel">
        <div class="gdlr-core-pbf-background-wrap" style="background-color: #181818 ;"></div>
        <div class="gdlr-core-pbf-wrapper-content gdlr-core-js ">
            <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-container">
                <div class="gdlr-core-pbf-element">
                    <div
                        class="gdlr-core-portfolio-item gdlr-core-item-pdb clearfix  gdlr-core-portfolio-item-style-grid gdlr-core-item-pdlr">
                        <div class="gdlr-core-block-item-title-wrap  gdlr-core-left-align"
                            style="margin-bottom: 40px ;">
                            <div class="gdlr-core-block-item-title-inner">
                                <h3 class="gdlr-core-block-item-title" style="font-size: 22px ;color: #ffffff ;"><i
                                        class="fa fa-film" style="color: #ec4613 ;"></i>Video Gallery</h3>
                            </div>
                            <div
                                class="gdlr-core-flexslider-nav gdlr-core-rectangle-style gdlr-core-absolute-center gdlr-core-right">
                            </div>
                        </div>
                        <div class="gdlr-core-flexslider flexslider gdlr-core-js-2 " data-type="carousel"
                            data-column="6" data-nav="navigation" data-nav-parent="gdlr-core-portfolio-item"
                            data-disable-autoslide="1">
                            <ul class="slides">
                                @foreach ($video as $item)
                                <li class="gdlr-core-item-mglr">
                                    <div class="gdlr-core-portfolio-grid  gdlr-core-left-align gdlr-core-style-normal">
                                        <div
                                            class="gdlr-core-portfolio-thumbnail gdlr-core-media-image  gdlr-core-style-icon">
                                            <div
                                                class="gdlr-core-portfolio-thumbnail-image-wrap  gdlr-core-zoom-on-hover">
                                                <a href="{{ url('events/'.$event->id.'/'.$event_name.'/video_albums/'.$item->id.'/'.$item->album_name) }}"
                                                    data-options="width: 1280, height: 720"><img
                                                        src="{{ $item->cover_image }}" width="700" height="450"
                                                        alt=""><span
                                                        class="gdlr-core-image-overlay  gdlr-core-portfolio-overlay gdlr-core-image-overlay-center-icon gdlr-core-js"><span
                                                            class="gdlr-core-image-overlay-content"><span
                                                                class="gdlr-core-portfolio-icon-wrap"><i
                                                                    class="gdlr-core-portfolio-icon fa fa-film"></i></span></span>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="gdlr-core-portfolio-content-wrap gdlr-core-skin-divider">
                                            <h3 class="gdlr-core-portfolio-title gdlr-core-skin-title"><a  style="color: white !important;"
                                                    href="{{ url('events/'.$event->id.'/'.$event_name.'/video_albums/'.$item->id.'/'.$item->album_name) }}">{{
                                                    $item->album_name }}</a></h3><span
                                                class="gdlr-core-portfolio-info gdlr-core-portfolio-info-date gdlr-core-info-font gdlr-core-skin-caption"><a
                                                    href="{{ url('events/'.$event->id.'/'.$event_name.'/video_albums/'.$item->id.'/'.$item->album_name) }}">{{
                                                    date("M d, Y", strtotime($item->timestamp)) }}</a></span>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="text-center">
                            <a class="gdlr-core-button"
                                href="{{ url('events/'.$event->id.'/'.$event_name.'/image_albums')}}">GO TO
                                Video Albums</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
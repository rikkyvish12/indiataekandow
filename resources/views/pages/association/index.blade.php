@extends('layouts.association.association')


@section('content')

<div class="bigslam-page-wrapper" id="bigslam-page-wrapper">
    <div class="gdlr-core-page-builder-body " >
        <!----------------------------------------------------------------->
        <!------------------------Sliders Start---------------------------->
        <!----------------------------------------------------------------->
        <div class="gdlr-core-pbf-wrapper " style="padding: 0px 0px 0px 0px;">
            <div class="gdlr-core-pbf-background-wrap" style="background-color: #1c1c1c ;"></div>
            <div class="gdlr-core-pbf-wrapper-content gdlr-core-js ">
                <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-container">
                    <div class="gdlr-core-pbf-element">
                        <div class="gdlr-core-revolution-slider-item gdlr-core-item-pdlr gdlr-core-item-pdb " style="padding-bottom: 0px ;">
                            <!-- START Soccer 01 REVOLUTION SLIDER 6.1.5 -->
                            <p class="rs-p-wp-fix"></p>
                            <rs-module-wrap id="rev_slider_1_1_wrapper" data-source="gallery" style="background:transparent;padding:0;margin:0px auto;margin-top:0;margin-bottom:0;">
                                <rs-module id="rev_slider_1_1" style="display:none;" data-version="6.1.5">
                                    <rs-slides>
                                        @foreach ($slider as $item)
                                        <rs-slide data-key="rs-1" data-title="Slide" data-thumb="#" data-anim="ei:d;eo:d;s:600;r:0;t:fade;sl:d;">
                                            <img src="{{ $item->image }}" title="slider-new-1" width="1920" height="1030" class="rev-slidebg" data-no-retina="">
                                        </rs-slide>
                                        @endforeach
                                    </rs-slides>
                                    <rs-static-layers>
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

        <!----------------------------------------------------------------->
        <!------------------------Latest News start------------------------>
        <!----------------------------------------------------------------->
        <div class="gdlr-core-pbf-wrapper default-bg" style="padding: 100px 0px 70px 0px;">
            <div class="gdlr-core-pbf-background-wrap"></div>
            <div class="gdlr-core-pbf-background-wrap" style="bottom: 19px ;">
                <div class="gdlr-core-pbf-background gdlr-core-parallax gdlr-core-js" style="background-image;background-size: cover ;background-position: center ;" data-parallax-speed="0"></div>
            </div>
            <div class="gdlr-core-pbf-wrapper-content gdlr-core-js ">
                <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-container">
                    <div class="gdlr-core-pbf-column gdlr-core-column-60 gdlr-core-column-first">
                        <div class="gdlr-core-pbf-column-content-margin gdlr-core-js ">
                            <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js ">
                                <div class="gdlr-core-pbf-element">
                                    <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-left-align gdlr-core-title-item-caption-top gdlr-core-item-pdlr" style="padding-bottom: 60px ;">
                                        <div class="gdlr-core-title-item-title-wrap ">
                                            <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " style="font-size: 28px ;font-weight: 600 ;letter-spacing: 0px ;line-height: 1 ;text-transform: none ;"><span class="gdlr-core-title-item-left-divider" style="border-color: #f27052 ;border-left-width: 5px ;margin-right: 19px ;"></span>Latest News<span class="gdlr-core-title-item-title-divider gdlr-core-skin-divider"></span></h3></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gdlr-core-pbf-column gdlr-core-column-60 gdlr-core-column-first">
                        <div class="gdlr-core-pbf-column-content-margin gdlr-core-js ">
                            <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js ">
                                <div class="gdlr-core-pbf-element">
                                    <div class="gdlr-core-blog-item gdlr-core-item-pdb clearfix  gdlr-core-style-blog-column-with-frame" id="gdlr-core-blog-30337">
                                        <div class="gdlr-core-blog-item-holder gdlr-core-js-2 clearfix" data-layout="fitrows">
                                            @foreach ($news as $item)
                                            <div class="gdlr-core-item-list  gdlr-core-item-pdlr gdlr-core-column-20">
                                                <div class="gdlr-core-blog-grid gdlr-core-style-4 gdlr-core-js  gdlr-core-blog-grid-with-frame gdlr-core-item-mgb gdlr-core-skin-e-background  gdlr-core-outer-frame-element gdlr-core-with-thumbnail gdlr-core-move-up-with-shadow gdlr-core-outer-frame-element" style="box-shadow: 0px 20px 35px rgba(36, 38, 53,0.09); -moz-box-shadow: 0px 20px 35px rgba(36, 38, 53,0.09); -webkit-box-shadow: 0px 20px 35px rgba(36, 38, 53,0.09); border-width: 0px;border-color: #ffffff ;border-radius: 7px;-moz-border-radius: 7px;-webkit-border-radius: 7px;" data-sync-height="blog-item-1">
                                                    <div class="gdlr-core-blog-thumbnail gdlr-core-media-image  gdlr-core-opacity-on-hover gdlr-core-zoom-on-hover">
                                                        <a href="{{ $item->link }}"><img src="{{ $item->coverImage }}" alt="" width="550" height="500" title="shutterstock_706586722"></a>
                                                    </div>
                                                    <div class="gdlr-core-blog-grid-frame gdlr-core-sync-height-space-position clearfix">
                                                        <div class="gdlr-core-blog-grid-top-info clearfix">
                                                            <span class="gdlr-core-blog-info gdlr-core-blog-info-font gdlr-core-skin-caption gdlr-core-blog-info-date">
                                                                <span class="gdlr-core-head"><i class="fa fa-clock-o"></i></span><a href="index.html#">{{  date("M d, Y", strtotime($item->date)) }}</a></span>
                                                        <span class="gdlr-core-blog-info gdlr-core-blog-info-font gdlr-core-skin-caption gdlr-core-blog-info-tag">
                                                           </span>
                                                        </div>
                                                        <h3 class="gdlr-core-blog-title gdlr-core-skin-title" style="font-size: 20px ;font-weight: 500 ;letter-spacing: 0px ;"><a href="index.html#">{{ $item->title }}</a></h3>
                                                        <div class="gdlr-core-blog-content"> 
                                                            <div class="clear"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                           @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="gdlr-core-pbf-element">
                                    <div class="gdlr-core-button-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-center-align" style="padding-bottom: 0px ;">
                                        <a class="gdlr-core-button  gdlr-core-button-gradient gdlr-core-button-no-border" href="{{url('state/'.$assoc_id.'/'.$assoc_name.'/news')}}" style="background: #f27052 ;">
                                            <span class="gdlr-core-content">Visit News and Blogs</span></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
              </div>
        </div>
        <!----------------------------------------------------------------->
        <!------------------------Latest News end-------------------------->
        <!----------------------------------------------------------------->

        <!----------------------------------------------------------------->
        <!------------------------Image Gallery Start---------------------->
        <!----------------------------------------------------------------->
        <div class="gdlr-core-pbf-wrapper default-bg" style="padding: 90px 0px 30px 0px;" data-skin="Blog Carousel">
            <div class="gdlr-core-pbf-background-wrap">
                <div class="gdlr-core-pbf-background gdlr-core-parallax gdlr-core-js" style="background-image: url('upload/hp-blog-bg.jpg') ;background-size: cover ;background-position: center ;" data-parallax-speed="0"></div>
            </div>
            <div class="gdlr-core-pbf-wrapper-content gdlr-core-js ">
                <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-container">
                    <div class="gdlr-core-pbf-element">
                        <div class="gdlr-core-blog-item gdlr-core-item-pdb clearfix  gdlr-core-style-blog-column-with-frame gdlr-core-item-pdlr">
                            <div class="gdlr-core-block-item-title-wrap  gdlr-core-center-align">
                                <div class="gdlr-core-block-item-title-inner">
                                    <div class="gdlr-core-pbf-element">
                                        <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-left-align gdlr-core-title-item-caption-top gdlr-core-item-pdlr">
                                            <div class="gdlr-core-title-item-title-wrap ">
                                                <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " style="font-size: 28px ;font-weight: 600 ;letter-spacing: 0px ;line-height: 1 ;text-transform: none ; color:black"><span class="gdlr-core-title-item-left-divider" style="border-color: #f27052 ;border-left-width: 5px ;margin-right: 19px ;"></span>Image Gallery<span class="gdlr-core-title-item-title-divider gdlr-core-skin-divider"></span></h3></div>
                                        </div>
                                    </div>
                               <div class="gdlr-core-flexslider-nav gdlr-core-rectangle-style gdlr-core-large gdlr-core-absolute-center gdlr-core-right"></div>
                            </div>
                            <div class="gdlr-core-flexslider flexslider gdlr-core-js-2 " data-type="carousel" data-column="3" data-move="1" data-nav="navigation" data-nav-parent="gdlr-core-blog-item" data-disable-autoslide="1">
                                <ul class="slides">
                                    @foreach ($image as $item)
                                    <li class="gdlr-core-item-mglr">
                                        <div class="gdlr-core-sp-player-grid-3 gdlr-core-item-mgb">
                                            <div class="gdlr-core-sp-player-thumbnail gdlr-core-media-image gdlr-core-zoom-on-hover" style="color:#ffffff;">
                                                <a class="gdlr-core-sp-player-link" href="{{url('state/'.$assoc_id.'/'.$assoc_name.'/image_gallery/'.$item->id.'/'.$item->album_name)}}"><img src="{{ $item->coverImage}}" alt="" width="700" height="577" title="photodune-3281784-soccer-player-m-red-2">
                                                    <span class="gdlr-core-image-overlay  gdlr-core-portfolio-overlay gdlr-core-image-overlay-center-icon gdlr-core-js">
                                                        <span class="gdlr-core-image-overlay-content">
                                                            <span class="gdlr-core-portfolio-icon-wrap gdlr-core-portfolio-title gdlr-core-title-font " style=" color:#ffffff; font-size: 28px ;font-weight: 400 ;letter-spacing: 1px ;text-transform: none ;"><i class="gdlr-core-portfolio-icon fa fa-picture-o"></i>
                                                            </span>
                                                        </span>
                                                    </a>
                                            </div>
                                            <div class="gdlr-core-sp-player-content-wrap  gdlr-core-skin-e-background clearfix">
                                                <div class="gdlr-core-sp-player-content">
                                                    <h3 class="gdlr-core-sp-player-title gdlr-core-skin-title">
                                                        <a href="{{url('state/'.$assoc_id.'/'.$assoc_name.'/image_gallery/'.$item->id.'/'.$item->album_name)}}">{{$item->album_name }}</a>
                                                    </h3>
                                                    <div class="gdlr-core-sp-player-position gdlr-core-skin-caption">{{ date('d-m-Y', strtotime($item->timestamp))}} </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                        <div class="gdlr-core-pbf-element">
                            <div class="gdlr-core-button-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-center-align" style="padding-bottom: 0px ;">
                                <a class="gdlr-core-button  gdlr-core-button-gradient gdlr-core-button-no-border" href="{{url('state/'.$assoc_id.'/'.$assoc_name.'/image_albums')}}" style="background: #f27052 ;">
                                    <span class="gdlr-core-content">Visit Image Gallery</span></a></div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <!----------------------------------------------------------------->
        <!------------------------Image Gallery End------------------------>
        <!----------------------------------------------------------------->

        <!----------------------------------------------------------------->
        <!------------------------Video Gallery Start---------------------->
        <!----------------------------------------------------------------->
        <div class="gdlr-core-pbf-wrapper default-bg" style="padding: 90px 0px 30px 0px;" data-skin="Blog Carousel">
            <div class="gdlr-core-pbf-background-wrap">
                <div class="gdlr-core-pbf-background gdlr-core-parallax gdlr-core-js" style="background-image: url('upload/hp-blog-bg.jpg') ;background-size: cover ;background-position: center ;" data-parallax-speed="0"></div>
            </div>
            <div class="gdlr-core-pbf-wrapper-content gdlr-core-js ">
                <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-container">
                    <div class="gdlr-core-pbf-element">
                        <div class="gdlr-core-blog-item gdlr-core-item-pdb clearfix  gdlr-core-style-blog-column-with-frame gdlr-core-item-pdlr">
                            <div class="gdlr-core-block-item-title-wrap  gdlr-core-center-align">
                                <div class="gdlr-core-block-item-title-inner">
                                    <div class="gdlr-core-pbf-element">
                                        <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-left-align gdlr-core-title-item-caption-top gdlr-core-item-pdlr">
                                            <div class="gdlr-core-title-item-title-wrap ">
                                                <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " style="font-size: 28px ;font-weight: 600 ;letter-spacing: 0px ;line-height: 1 ;text-transform: none ; color:black"><span class="gdlr-core-title-item-left-divider" style="border-color: #f27052 ;border-left-width: 5px ;margin-right: 19px ;"></span>video Gallery<span class="gdlr-core-title-item-title-divider gdlr-core-skin-divider"></span></h3></div>
                                        </div>
                                    </div>
                               <div class="gdlr-core-flexslider-nav gdlr-core-rectangle-style gdlr-core-large gdlr-core-absolute-center gdlr-core-right"></div>
                            </div>
                            <div class="gdlr-core-flexslider flexslider gdlr-core-js-2 " data-type="carousel" data-column="3" data-move="1" data-nav="navigation" data-nav-parent="gdlr-core-blog-item" data-disable-autoslide="1">
                                <ul class="slides">
                                    @foreach ($video as $item)
                                    <li class="gdlr-core-item-mglr">
                                        <div class="gdlr-core-sp-player-grid-3 gdlr-core-item-mgb">
                                            <div class="gdlr-core-sp-player-thumbnail gdlr-core-media-image gdlr-core-zoom-on-hover" style="color:#ffffff;">
                                                <a class="gdlr-core-sp-player-link" href="{{ url('state/'.$assoc_id.'/'.$assoc_name.'/video_gallery/'.$item->id.'/'.$item->album_name)}}"><img src="{{ $item->cover_image}}" alt="" width="700" height="577" title="photodune-3281784-soccer-player-m-red-2">
                                                    <span class="gdlr-core-image-overlay  gdlr-core-portfolio-overlay gdlr-core-image-overlay-center-icon gdlr-core-js">
                                                        <span class="gdlr-core-image-overlay-content">
                                                            <span class="gdlr-core-portfolio-icon-wrap gdlr-core-portfolio-title gdlr-core-title-font " style=" color:#ffffff; font-size: 28px ;font-weight: 400 ;letter-spacing: 1px ;text-transform: none ;"><i class="gdlr-core-portfolio-icon fa fa-film"></i>
                                                            </span>
                                                        </span>
                                                    </a>
                                            </div>
                                            <div class="gdlr-core-sp-player-content-wrap  gdlr-core-skin-e-background clearfix">
                                                <div class="gdlr-core-sp-player-content">
                                                    <h3 class="gdlr-core-sp-player-title gdlr-core-skin-title">
                                                        <a href="{{ url('state/'.$assoc_id.'/'.$assoc_name.'/video_gallery/'.$item->id.'/'.$item->album_name)}}">{{$item->album_name }}</a>
                                                    </h3>
                                                    <div class="gdlr-core-sp-player-position gdlr-core-skin-caption">{{ date('d-m-Y', strtotime($item->timestamp))}} </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                        <div class="gdlr-core-pbf-element">
                            <div class="gdlr-core-button-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-center-align" style="padding-bottom: 0px ;">
                                <a class="gdlr-core-button  gdlr-core-button-gradient gdlr-core-button-no-border" href="{{url('state/'.$assoc_id.'/'.$assoc_name.'/video_albums')}}" style="background: #f27052 ;">
                                    <span class="gdlr-core-content">Visit Video Gallery</span></a></div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <!----------------------------------------------------------------->
        <!------------------------Video Gallery End------------------------>
        <!----------------------------------------------------------------->

    </div>
</div>
@endsection



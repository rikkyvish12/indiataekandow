@extends('layouts.event.event')

@section('content')
<div class="bigslam-page-title-wrap  bigslam-style-small bigslam-center-align default-banner">
    <div class="bigslam-header-transparent-substitute"></div>
    <div class="bigslam-page-title-overlay"></div>
    <div class="bigslam-page-title-container bigslam-container">
        <div class="bigslam-page-title-content bigslam-item-pdlr">
            <h1 class="bigslam-page-title">Image Gallery</h1>
            <div class="bigslam-page-caption">{{ $event_profile->event_name }}</div>
        </div>
    </div>
</div>
<div class="bigslam-page-wrapper default-bg" id="bigslam-page-wrapper">
    <div class="gdlr-core-page-builder-body">
        <div class="gdlr-core-portfolio-item-holder gdlr-core-js-2 clearfix" data-layout="masonry" style="margin:5%;">
            @foreach ($album as $item)
         
            <div class="gdlr-core-item-list class1 gdlr-core-item-pdlr gdlr-core-column-15 gdlr-core-column-first">
                <div class="gdlr-core-portfolio-grid  gdlr-core-center-align gdlr-core-style-normal">
                    <div class="gdlr-core-portfolio-thumbnail gdlr-core-media-image  gdlr-core-style-margin-icon">
                        <div class="gdlr-core-portfolio-thumbnail-image-wrap  gdlr-core-zoom-on-hover">
                            <a  href="{{ url('events/'.$event_id.'/'.$event_name.'/image_albums/'.$item->id.'/'.$item->album_name) }}" ><img src="{{ $item->coverImage }}" width="700" height="660"  alt=""><span class="gdlr-core-image-overlay  gdlr-core-portfolio-overlay gdlr-core-image-overlay-center-icon gdlr-core-js gdlr-core-with-margin">
                                <span class="gdlr-core-image-overlay-content"><span class="gdlr-core-portfolio-icon-wrap"><i class="gdlr-core-portfolio-icon icon_image"></i></span></span>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="gdlr-core-portfolio-content-wrap gdlr-core-skin-divider">
                        <h3 class="gdlr-core-portfolio-title gdlr-core-skin-title" style="font-size: 18px ;font-weight: 600 ;letter-spacing: 0px ;"><a href="{{ url('events/'.$event_id.'/'.$event_name.'/image_albums/'.$item->id.'/'.$item->album_name) }}">{{ $item->album_name }}</a></h3><span class="gdlr-core-portfolio-info gdlr-core-portfolio-info-tag gdlr-core-info-font gdlr-core-skin-caption">
                            <a href="{{ url('events/'.$event_id.'/'.$event_name.'/image_albums/'.$item->id.'/'.$item->album_name) }}" rel="tag"></a> <span class="gdlr-core-sep"></span> <a href="{{ url('events/'.$event_id.'/'.$event_name.'/image_albums/'.$item->id.'/'.$item->album_name) }}" rel="tag"></a></span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

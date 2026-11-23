@extends('layouts.event.event')

@section('content')
<div class="bigslam-page-title-wrap  bigslam-style-small bigslam-center-align default-banner">
    <div class="bigslam-header-transparent-substitute"></div>
    <div class="bigslam-page-title-overlay"></div>
    <div class="bigslam-page-title-container bigslam-container">
        <div class="bigslam-page-title-content bigslam-item-pdlr">
            <h1 class="bigslam-page-title">Video Gallery</h1>
            <div class="bigslam-page-caption">{{ $event_profile->event_name }}</div>
        </div>
    </div>
</div>
<div class="bigslam-page-wrapper default-bg" id="bigslam-page-wrapper">
    <div class="gdlr-core-page-builder-body">
        <div class="gdlr-core-pbf-wrapper " style="padding: 60px 15px 30px 15px;">
            <div class="gdlr-core-pbf-background-wrap"></div>
            <div class="gdlr-core-pbf-wrapper-content gdlr-core-js ">
                <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-pbf-wrapper-full">
                    <div class="gdlr-core-pbf-element">
                        <div class="gdlr-core-portfolio-item gdlr-core-item-pdb clearfix  gdlr-core-portfolio-item-style-grid" style="padding-bottom: 10px ;">
                            <div class="gdlr-core-portfolio-item-holder gdlr-core-js-2 filter-container clearfix" data-layout="masonry">
                                @foreach ($video_album as $item)
                                <div class="gdlr-core-item-list class1 gdlr-core-item-pdlr gdlr-core-column-15 gdlr-core-column-first">
                                    <div class="gdlr-core-portfolio-grid  gdlr-core-center-align gdlr-core-style-normal">
                                        <div class="gdlr-core-portfolio-thumbnail gdlr-core-media-image  gdlr-core-style-margin-icon">
                                            <div class="gdlr-core-portfolio-thumbnail-image-wrap  gdlr-core-zoom-on-hover">
                                                <a  href="{{ url('events/'.$event->id.'/'.$event_name.'/video_albums/'.$item->id.'/'.$item->album_name) }}" ><img src="{{ $item->cover_image }}" width="700" height="660"  alt=""><span class="gdlr-core-image-overlay  gdlr-core-portfolio-overlay gdlr-core-image-overlay-center-icon gdlr-core-js gdlr-core-with-margin"><span class="gdlr-core-image-overlay-content"><span class="gdlr-core-portfolio-icon-wrap"><i class="gdlr-core-portfolio-icon icon_film"></i></span></span>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="gdlr-core-portfolio-content-wrap gdlr-core-skin-divider">
                                            <h3 class="gdlr-core-portfolio-title gdlr-core-skin-title" style="font-size: 18px ;font-weight: 600 ;letter-spacing: 0px ;"><a href="portfolio-4-columns.html#">{{ $item->album_name }}</a></h3><span class="gdlr-core-portfolio-info gdlr-core-portfolio-info-tag gdlr-core-info-font gdlr-core-skin-caption"><a href="portfolio-4-columns.html#" rel="tag"></a> <span class="gdlr-core-sep"></span> <a href="portfolio-4-columns.html#" rel="tag"></a></span>
                                            {{-- <div class="gdlr-core-portfolio-content">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Nulla vitae elit libero, a pharetra augue. Morbi leo risus, [&hellip;]</div> --}}
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

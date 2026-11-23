@extends('layouts.event.event')

@section('content')
<div class="bigslam-page-title-wrap  bigslam-style-small bigslam-center-align default-banner">
    <div class="bigslam-header-transparent-substitute"></div>
    <div class="bigslam-page-title-overlay"></div>
    <div class="bigslam-page-title-container bigslam-container">
        <div class="bigslam-page-title-content bigslam-item-pdlr">
            <h1 class="bigslam-page-title">News</h1>
            <div class="bigslam-page-caption">{{ $event_name }}</div>
        </div>
    </div>
</div>
<div class="bigslam-page-wrapper default-bg" id="bigslam-page-wrapper">
    <div class="gdlr-core-page-builder-body">
        <div class="gdlr-core-pbf-wrapper ">
            <div class="gdlr-core-pbf-background-wrap" style="background-color: #f5f5f5 ;"></div>
            <div class="gdlr-core-pbf-wrapper-content gdlr-core-js ">
                <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-container">
                    <div class="gdlr-core-pbf-element">
                        <div class="gdlr-core-portfolio-item gdlr-core-item-pdb clearfix  gdlr-core-portfolio-item-style-grid" style="padding-bottom: 10px ;">


                            <div class="gdlr-core-portfolio-item-holder gdlr-core-js-2 filter-container clearfix" data-layout="masonry">
                                @foreach ($news as $item)
                                <div class="gdlr-core-item-list  gdlr-core-item-pdlr class1 gdlr-core-column-15 gdlr-core-column-first">
                                    <div class="gdlr-core-portfolio-grid  gdlr-core-left-align gdlr-core-style-with-frame gdlr-core-js" data-sync-height="portfolio-item-1">
                                        <div class="gdlr-core-portfolio-grid-frame gdlr-core-skin-e-background" style="opacity: 1 ;"></div>
                                        <div class="gdlr-core-portfolio-thumbnail gdlr-core-media-image  gdlr-core-style-icon">
                                            <div class="gdlr-core-portfolio-thumbnail-image-wrap  gdlr-core-zoom-on-hover">
                                                <a target="_blank" href="{{ $item->link }}" ><img src="{{ $item->coverImage }}" width="700" height="660"  alt=""><span class="gdlr-core-image-overlay  gdlr-core-portfolio-overlay gdlr-core-image-overlay-center-icon gdlr-core-js"><span class="gdlr-core-image-overlay-content"><span class="gdlr-core-portfolio-icon-wrap"><i class="gdlr-core-portfolio-icon icon_link"></i></span></span>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="gdlr-core-portfolio-content-wrap gdlr-core-skin-divider">
                                            <h3 class="gdlr-core-portfolio-title gdlr-core-skin-title" style="font-size: 17px ;font-weight: 600 ;letter-spacing: 0px ;"><a href="{{ $item->link }}">{{ $item->title }}</a></h3><span class="gdlr-core-portfolio-info gdlr-core-portfolio-info-tag gdlr-core-info-font gdlr-core-skin-caption"><a href="portfolio-4-columns-with-frame.html#" rel="tag">{{  date("M d, Y", strtotime($item->date)) }}</a> <span class="gdlr-core-sep"></span> <a href="portfolio-4-columns-with-frame.html#" rel="tag"></a></span>
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

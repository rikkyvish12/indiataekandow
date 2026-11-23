@extends('layouts.association.association')

@section('content')
<div class="bigslam-page-title-wrap  bigslam-style-small bigslam-center-align default-banner" >
    <div class="bigslam-header-transparent-substitute"></div>
    <div class="bigslam-page-title-overlay"></div>
    <div class="bigslam-page-title-container bigslam-container">
        <div class="bigslam-page-title-content bigslam-item-pdlr">
            <h1 class="bigslam-page-title">{{ $title }}</h1>
            <div class="bigslam-page-caption">{{ $assoc_name }}</div>
        </div>
    </div>
</div>

<div class="bigslam-page-wrapper default-bg" id="bigslam-page-wrapper">
    <div class="gdlr-core-page-builder-body">
        <div class="gdlr-core-pbf-section">
            <div class="gdlr-core-pbf-section-container gdlr-core-container clearfix">
                <div class="gdlr-core-pbf-element">
                    <div class="gdlr-core-portfolio-item gdlr-core-item-pdb clearfix  gdlr-core-portfolio-item-style-grid" style="padding-bottom: 10px ;">


                        <div class="gdlr-core-portfolio-item-holder gdlr-core-js-2 filter-container clearfix" data-layout="masonry">
                            @foreach ($gallery as $item)
                            <div class="gdlr-core-item-list class1 gdlr-core-item-pdlr gdlr-core-column-15">
                                <div class="gdlr-core-portfolio-grid  gdlr-core-left-align gdlr-core-style-normal">
                                    <div class="gdlr-core-portfolio-thumbnail gdlr-core-media-image  gdlr-core-style-title-icon">
                                        <div class="gdlr-core-portfolio-thumbnail-image-wrap  gdlr-core-zoom-on-hover">
                                            <img src="{{'http://img.youtube.com/vi/'.$item->youtube_code.'/mqdefault.jpg'}}" alt="" width="700" height="430" title="shutterstock_328424540">
                                            <span class="gdlr-core-image-overlay  gdlr-core-portfolio-overlay gdlr-core-image-overlay-center-icon gdlr-core-js">
                                                <span class="gdlr-core-image-overlay-content">
                                                    <span class="gdlr-core-portfolio-title gdlr-core-title-font " style="font-size: 18px ;font-weight: 400 ;letter-spacing: 1px ;text-transform: none ;">
                                                    <a href="portfolio-4-columns.html#"></a></span><span class="gdlr-core-portfolio-icon-wrap">
                                                        <a class="gdlr-core-ilightbox gdlr-core-js " href="{{ 'https://www.youtube.com/embed/'.$item->youtube_code }}" data-ilightbox-group="gdlr-core-img-group-1" data-type="iframe" data-options="width: 1280, height: 720">
                                                            <i class="gdlr-core-portfolio-icon fa fa-film"></i></a></span></span>
                                            </span>
                                        </div>
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
@endsection

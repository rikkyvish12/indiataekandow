@extends('layouts.association.association')

@section('content')


<div class="bigslam-page-title-wrap  bigslam-style-small bigslam-center-align default-banner">
    <div class="bigslam-header-transparent-substitute"></div>
    <div class="bigslam-page-title-overlay"></div>
    <div class="bigslam-page-title-container bigslam-container">
        <div class="bigslam-page-title-content bigslam-item-pdlr">
            <h1 class="bigslam-page-title">News</h1>
            <div class="bigslam-page-caption">{{ $assoc_name }}</div>
        </div>
    </div>
</div>
<div class="bigslam-page-wrapper default-bg" id="bigslam-page-wrapper" >
    <div class="gdlr-core-page-builder-body">
        <div class="gdlr-core-pbf-wrapper ">
            <div class="gdlr-core-pbf-background-wrap" style="background-color: #f5f5f5 ;"></div>
            <div class="gdlr-core-pbf-wrapper-content gdlr-core-js ">
                <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-container">
                    <div class="gdlr-core-pbf-element">
                        <div class="gdlr-core-portfolio-item gdlr-core-item-pdb clearfix  gdlr-core-portfolio-item-style-grid" style="padding-bottom: 10px ;">

                            <div class="gdlr-core-portfolio-item-holder filter-container gdlr-core-js-2 clearfix" data-layout="masonry">
                                @foreach ($news as $item)
                                <div class="gdlr-core-item-list class1 gdlr-core-item-pdlr gdlr-core-column-15 gdlr-core-column-first">
                                    <div class="gdlr-core-portfolio-grid  gdlr-core-left-align gdlr-core-style-with-frame gdlr-core-js" data-sync-height="portfolio-item-1">
                                        <div class="gdlr-core-portfolio-grid-frame gdlr-core-skin-e-background" style="opacity: 1 ;"></div>
                                        <div class="gdlr-core-portfolio-thumbnail gdlr-core-media-image  gdlr-core-style-title-icon">
                                            <div class="gdlr-core-portfolio-thumbnail-image-wrap  gdlr-core-zoom-on-hover"><img src="{{ $item->coverImage }}" alt="" width="700" height="430" title="shutterstock_232344658"><span class="gdlr-core-image-overlay  gdlr-core-portfolio-overlay gdlr-core-image-overlay-center-icon gdlr-core-js"><span class="gdlr-core-image-overlay-content"><span class="gdlr-core-portfolio-title gdlr-core-title-font " style="font-size: 18px ;font-weight: 400 ;letter-spacing: 1px ;text-transform: none ;"><a href="{{$item->link}}" target="_blank">{{ $item->title }}</a></span><span class="gdlr-core-portfolio-icon-wrap"><a href="{{$item->link}}" target="_blank" target="_blank"  data-options="width: 1280, height: 720"><i class="gdlr-core-portfolio-icon fa fa-news"></i></a></span></span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="gdlr-core-portfolio-content-wrap gdlr-core-skin-divider">
                                            <h3 class="gdlr-core-portfolio-title gdlr-core-skin-title" style="font-size: 18px ;font-weight: 600 ;letter-spacing: 0px ;"><a href="{{$item->link}}" target="_blank">{{ $item->title }}</a></h3><span class="gdlr-core-portfolio-info gdlr-core-portfolio-info-tag gdlr-core-info-font gdlr-core-skin-caption"><a href="{{$item->link}}" target="_blank" rel="tag">{{ $item->date }}</a> <span class="gdlr-core-sep"></span> <a href="{{$item->link}}" target="_blank" rel="tag"></a></span>
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

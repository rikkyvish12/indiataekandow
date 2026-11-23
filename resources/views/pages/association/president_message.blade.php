@extends('layouts.association.association')

@section('title')
{{ $title }} , {{ $assoc_name }}
@endsection


@section('content')

<div class="bigslam-page-title-wrap  bigslam-style-small bigslam-center-align default-banner">
    <div class="bigslam-header-transparent-substitute"></div>
    <div class="bigslam-page-title-overlay"></div>
    <div class="bigslam-page-title-container bigslam-container">
        <div class="bigslam-page-title-content bigslam-item-pdlr">
            <h1 class="bigslam-page-title">{{ $title }}</h1>
            <div class="bigslam-page-caption">{{ $assoc_name }}</div>
        </div>
    </div>
</div>
 

<div class="gdlr-core-pbf- " style="padding: 40px 0px 30px 0px;">
    <div class="gdlr-core-pbf-background-wrap">
        <div class="gdlr-core-pbf-background gdlr-core-parallax gdlr-core-js default-bg" ></div>
    </div>
    @if ($context !==null)
    <div class="gdlr-core-pbf-wrapper-content gdlr-core-js " >
        <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-container">
            <div class="gdlr-core-pbf-column gdlr-core-column-60 gdlr-core-column-first" data-skin="Grey" style="background-color: #ffffff ;">
                <div class="gdlr-core-pbf-column-content-margin gdlr-core-js " style="padding: 20px 0px 15px 0px;">
                    <div class="gdlr-core-pbf-background-wrap" style="background-color: #ffffff ;"></div>
                    <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js ">
                        <div class="gdlr-core-pbf-element">
                            <div class="gdlr-core-call-to-action-item gdlr-core-item-pdlr gdlr-core-item-pdb">
                                <div class="gdlr-core-call-to-action-item-inner">
                                    <div class="gdlr-core-call-to-action-item-content-wrap">
                                        <div class="gdlr-core-call-to-action-item-caption gdlr-core-title-font gdlr-core-skin-caption" style="font-size: 15px ;">
                                            {!! $context->description !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="gdlr-core-pbf-wrapper-content gdlr-core-js">
        <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-container">
            <div class="gdlr-core-pbf-column gdlr-core-column-60 gdlr-core-column-first" data-skin="Grey" style="background-color: #ffffff ;">
                <div class="gdlr-core-pbf-column-content-margin gdlr-core-js " style="padding: 70px 0px 35px 0px;">
                    <div class="gdlr-core-pbf-background-wrap" style="background-color: #ffffff ;"></div>
                    <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js ">
                        <div class="gdlr-core-pbf-element">
                            <div class="gdlr-core-call-to-action-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-style-center-align">
                                <div class="gdlr-core-call-to-action-item-inner">
                                    <div class="gdlr-core-call-to-action-item-content-wrap">
                                        <div class="gdlr-core-call-to-action-item-caption gdlr-core-title-font gdlr-core-skin-caption" style="font-size: 15px ;">
                                            <h6 >No Info Available</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>


@endsection


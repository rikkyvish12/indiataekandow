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
            <h1 class="bigslam-page-title">{{ $title }}</h1></div>
    </div>
</div>
<div class="bigslam-page-wrapper  default-bg" id="bigslam-page-wrapper" >
    <div class="gdlr-core-page-builder-body">
        <div class="gdlr-core-pbf-section">
            <div class="gdlr-core-pbf-section-container gdlr-core-container clearfix">
                <div class="gdlr-core-pbf-element">
                    <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-left-align gdlr-core-title-item-caption-top gdlr-core-item-pdlr">
                        <div class="gdlr-core-title-item-title-wrap ">
                            {{-- <h3 class="gdlr-core-title-item-title gdlr-core-skin-title " style="font-size: 26px ;">Barcelona vs Liverpool<span class="gdlr-core-title-item-title-divider gdlr-core-skin-divider"></span></h3> --}}
                        </div>
                    </div>
                </div>
                <div class="gdlr-core-pbf-element">
                    <div class="gdlr-core-text-box-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-left-align">
                        <div class="gdlr-core-text-box-item-content" style="text-transform: none ;">
                            <div class="sportspress sp-widget-align-none">
                                <div class="sp-template sp-template-event-details">
                                    <h4 class="sp-table-caption">AUDIT & ACCOUNTING</h4>
                                    <div class="sp-table-wrapper">
                                        <table class="sp-event-details sp-data-table sp-scrollable-table">
                                            <thead>
                                                <tr>

                                                    <th>PDF</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($audit as $item)
                                                <tr class="odd">
                                                    <td><a href="{{ $item->file }}" target="_blank">{{ $item->name }}</a></td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="gdlr-core-pbf-element">
                    <div class="gdlr-core-text-box-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-left-align">
                        <div class="gdlr-core-text-box-item-content" style="text-transform: none ;">
                            <div class="sportspress sp-widget-align-none">
                                <div class="sp-template sp-template-event-details">
                                    <h4 class="sp-table-caption">FORMS & CIRCULARS</h4>
                                    <div class="sp-table-wrapper">
                                        <table class="sp-event-details sp-data-table sp-scrollable-table">
                                            <thead>
                                                <tr>

                                                    <th>PDF</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($forms as $item)
                                                <tr class="odd">

                                                    <td><a href="{{ $item->file }}" target="_blank">{{ $item->name }}</a></td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="gdlr-core-pbf-element">
                    <div class="gdlr-core-text-box-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-left-align">
                        <div class="gdlr-core-text-box-item-content" style="text-transform: none ;">
                            <div class="sportspress sp-widget-align-none">
                                <div class="sp-template sp-template-event-details">
                                    <h4 class="sp-table-caption">DOCUMENTS</h4>
                                    <div class="sp-table-wrapper">
                                        <table class="sp-event-details sp-data-table sp-scrollable-table">
                                            <thead>
                                                <tr>

                                                    <th>PDF</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($documents as $item)
                                                <tr class="odd">
                                                    <td><a href="{{ $item->file }}" target="_blank">{{ $item->name }}</a></td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
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
@endsection

@extends('layouts.event.event')

@section('content')
<div class="bigslam-page-title-wrap  bigslam-style-small bigslam-center-align default-banner">
    <div class="bigslam-header-transparent-substitute"></div>
    <div class="bigslam-page-title-overlay"></div>
    <div class="bigslam-page-title-container bigslam-container">
        <div class="bigslam-page-title-content bigslam-item-pdlr">
            <h1 class="bigslam-page-title">Schedule & Results</h1></div>
    </div>
</div>
<div class="bigslam-page-wrapper default-bg" id="bigslam-page-wrapper">
    <div class="gdlr-core-page-builder-body">
        <div class="gdlr-core-pbf-section">
            <div class="gdlr-core-pbf-section-container gdlr-core-container clearfix">
                <div class="gdlr-core-pbf-element">
                    <div class="gdlr-core-text-box-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-left-align" style="padding-bottom: 0px ;">
                        <div class="gdlr-core-text-box-item-content">
                            <div class="sportspress sp-widget-align-none">
                                <div class="sp-template sp-template-event-list">
                                    <div class="sp-table-wrapper">
                                        <table class="sp-event-list sp-event-list-format-title sp-data-table sp-paginated-table sp-sortable-table sp-scrollable-table" data-sp-rows="10">
                                            <thead>
                                                <tr>
                                                    <th class="data-date">Date</th>
                                                    <th class="data-event">Event Name</th>
                                                    <th class="data-time">Group</th>
                                                    <th class="data-league">Time</th>
                                                    <th class="data-season">Round</th>
                                                    <th class="data-article">Result</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($results as $item)
                                               <tr>
                                                   <td>{{date('d-M-Y', strtotime( $item->date )) }}</td>
                                                   <td>{{ $item->event_name }}</td>
                                                   <td>{{ $item->group }}</td>
                                                   <td>{{date('h:i A', strtotime( $item->time )) }}</td>
                                                   <td>{{ $item->round }}</td>
                                                       <td class="data-article">
                                                           <a href="{{ $item->result_pdf }}" target="_blank">
                                                               <div class="dashicons dashicons-video-alt"></div>Preview</a>
                                                            </td>
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
    <div> <img style="display: block; margin-left: auto; margin-right: auto;" src="{{ url('images/placeyourbanner.png') }}" alt=""> </div>
</div>
@endsection

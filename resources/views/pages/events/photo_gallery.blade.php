@extends('layouts.event.event')

@section('content')
<div class="bigslam-page-title-wrap  bigslam-style-small bigslam-center-align default-banner">
    <div class="bigslam-header-transparent-substitute"></div>
    <div class="bigslam-page-title-overlay"></div>
    <div class="bigslam-page-title-container bigslam-container">
        <div class="bigslam-page-title-content bigslam-item-pdlr">
            <h1 class="bigslam-page-title">Image Gallery</h1>
            <div class="bigslam-page-caption">{{ $event_name }}</div>
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
                        <div class="gdlr-core-portfolio-item-holder gdlr-core-js-2 filter-container clearfix" data-layout="masonry" style="margin: 0% 6% 1% 6%;">
                            @if($nested == 1)
                            @if (count($folders)>0)
                            <a class="gdlr-core-button" href="../../image_albums">All Albums</a>
                                @foreach ($folders as $item)
                                    <div class="gdlr-core-item-list class1 gdlr-core-item-pdlr gdlr-core-column-15 gdlr-core-column-first" style="margin-top: 8%;">
                                        <div class="gdlr-core-portfolio-grid  gdlr-core-left-align gdlr-core-style-with-frame gdlr-core-js" data-sync-height="portfolio-item-1">
                                            <div class="gdlr-core-portfolio-grid-frame gdlr-core-skin-e-background" style="opacity: 0.8 ;"></div>
                                            <div class="gdlr-core-portfolio-thumbnail gdlr-core-media-image  gdlr-core-style-title-icon">
                                                <div class="gdlr-core-portfolio-thumbnail-image-wrap  gdlr-core-zoom-on-hover">
                                                    <center><img src="{{ $item->first_image_path }}"  alt="" style="width:320px;height:170px;">   
                                                       
                                                      
                                                    </center> 
                                                    <span class="gdlr-core-image-overlay  gdlr-core-portfolio-overlay gdlr-core-image-overlay-center-icon gdlr-core-js">
                                                        <span class="gdlr-core-image-overlay-content">
                                                            <span class="gdlr-core-portfolio-title gdlr-core-title-font " style="font-size: 18px ;font-weight: 400 ;letter-spacing: 1px ;text-transform: none ;">
                                                            <a href="?folder_id={{ $item->id }}"></a>
                                                           </span>
                                                            <span class="gdlr-core-portfolio-icon-wrap">
                                                                <a  href="?folder_id={{ $item->id }}">
                                                                    <i class="gdlr-core-portfolio-icon fa fa-film"></i>
                                                                </a>
                                                            </span>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="gdlr-core-portfolio-content-wrap gdlr-core-skin-divider">
                                                <h3 class="gdlr-core-portfolio-title gdlr-core-skin-title" style="font-size: 18px ;font-weight: 600 ;letter-spacing: 0px ;">
                                                <a href="?folder_id={{ $item->id }}"><center>{{$item->album_name }}</center></a>
                                            </h3>
                                           
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            @else
                            <div class="row" style="margin: 1% 6% 1% 6%;">
                                <div class="col-4">
                                    <a class="gdlr-core-button" href="../../image_albums">All Albums</a>
                                    @if($is_folder == 1)
                                    <a class="gdlr-core-button" href="{{ url('events/'.$event_id.'/'.$event_name.'/image_albums/'.$parent_album_id.'/'.$album_name) }}">Go to Folders</a>
                                    @endif
                                </div>
                                <div class="col-4"> <h4 class="text-center">Photo Gallery</h4></div>
                                <div class="col-4">

                                  
                                </div>

                            </div>
                           <br />
                             
                            @endif

                         

                        </div>
                        <!-- ### start of the gallery definition ### -->
<div class="gdlr-core-pbf-section-container gdlr-core-container clearfix" style="padding-top: 4% !important;">
    <div class="gdlr-core-pbf-element">
      <div id="nanogallery2" data-nanogallery2 = '{
        "thumbnailDisplayTransition":          "scaleUp",
        "thumbnailDisplayTransitionDuration":  500,
        "thumbnailDisplayInterval":            30  ,
        {{-- "thumbnailHoverEffect2": "toolsAppear", --}}
        "thumbnailHoverEffect2": "image_scale_1.00_1.20",

        "viewerToolbar":   {
            "display":    true,
            "standard":   "minimizeButton, label",
            "minimized":  "minimizeButton, label, fullscreenButton, downloadButton, infoButton"
          },
       "viewerTools":     {
            "topLeft":    "pageCounter,playPauseButton",
            "topRight":   "shareButton,zoomButton, fullscreenButton, closeButton"
          }

    }' >
    <!-- gallery content -->
     @if(isset($gallery))
    @foreach ($gallery as $item)
    <a href = "{{ $item->image_path }}"   data-ngThumb = "{{ $item->image_path }}" ></a>
    @endforeach
    @endif
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

@extends('layouts.association.association')

@section('content')
<div class="bigslam-page-title-wrap  bigslam-style-small bigslam-center-align default-banner" >
    <div class="bigslam-header-transparent-substitute"></div>
    <div class="bigslam-page-title-overlay"></div>
    <div class="bigslam-page-title-container bigslam-container">
        <div class="bigslam-page-title-content bigslam-item-pdlr">
            <h1 class="bigslam-page-title">{{ $title }}</h1>
            <div class="bigslam-page-caption">{{ $state_name }}</div>
        </div>
    </div>
</div>

 <div class="bigslam-page-wrapper" id="bigslam-page-wrapper">
    <div class="gdlr-core-page-builder-body">
        <div class="gdlr-core-pbf-section">
            <div class="gdlr-core-pbf-section-container gdlr-core-container clearfix">
                <div class="gdlr-core-pbf-element">
                    <div class="gdlr-core-portfolio-item gdlr-core-item-pdb clearfix  gdlr-core-portfolio-item-style-grid" style="padding-bottom: 10px ;">


                        <div class="gdlr-core-portfolio-item-holder gdlr-core-js-2 filter-container clearfix" data-layout="masonry">
                            @if($nested == 1)
                            @if (count($folders)>0)
                            <a class="gdlr-core-button" href="../../image_albums">All Albums</a>

                                @foreach ($folders as $item)
                            
                                    <div class="gdlr-core-item-list class1 gdlr-core-item-pdlr gdlr-core-column-15 gdlr-core-column-first" style="margin-top: 4.5%;">
                                        <div class="gdlr-core-portfolio-grid  gdlr-core-left-align gdlr-core-style-with-frame gdlr-core-js" data-sync-height="portfolio-item-1">
                                            <div class="gdlr-core-portfolio-grid-frame gdlr-core-skin-e-background" style="opacity: 1 ;"></div>
                                            <div class="gdlr-core-portfolio-thumbnail gdlr-core-media-image  gdlr-core-style-title-icon">
                                                <div class="gdlr-core-portfolio-thumbnail-image-wrap  gdlr-core-zoom-on-hover">
                                                    <center><img src="{{ $item->first_image_path }}"  alt="" style="width:280px;height:170px;">  
                                                        <br />     
                                                        <b></b>
                                                      </center> 
                                                    <span class="gdlr-core-image-overlay  gdlr-core-portfolio-overlay gdlr-core-image-overlay-center-icon gdlr-core-js">
                                                        <span class="gdlr-core-image-overlay-content"><span class="gdlr-core-portfolio-title gdlr-core-title-font " style="font-size: 18px ;font-weight: 400 ;letter-spacing: 1px ;text-transform: none ;"><a href="?folder_id={{ $item->id }}"></a></span><span class="gdlr-core-portfolio-icon-wrap"><a  href="?folder_id={{ $item->id }}"><i class="gdlr-core-portfolio-icon fa fa-film"></i></a></span></span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="gdlr-core-portfolio-content-wrap gdlr-core-skin-divider">
                                                <h3 class="gdlr-core-portfolio-title gdlr-core-skin-title" style="font-size: 18px ;font-weight: 600 ;letter-spacing: 0px ;"><a href="?folder_id={{ $item->id }}"><center>{{$item->album_name }}</center></a></h3><span class="gdlr-core-portfolio-info gdlr-core-portfolio-info-tag gdlr-core-info-font gdlr-core-skin-caption"><a href="?folder_id={{ $item->id }}"  rel=""></a> <span class="gdlr-core-sep"></span> <a href="?folder_id={{ $item->id }}"  rel="tag"></a></span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            @else
                            <h4 class="text-center">Photo Gallery</h4>
                            @endif

                         

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 

<!-- ### start of the gallery definition ### -->
<div class="gdlr-core-pbf-section-container gdlr-core-container clearfix" >
@if($is_folder == 1)
<a class="gdlr-core-button" href="../../image_albums">All Albums</a>
<a class="gdlr-core-button" href="{{ url('state/'.$assoc_id.'/'.$assoc_name.'/image_gallery/'.$parent_album_id.'/'.$album_name) }}">Go to Folders</a>
@endif
<br />
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
<br />
<!-- ### end of the gallery definition ### -->
@endsection

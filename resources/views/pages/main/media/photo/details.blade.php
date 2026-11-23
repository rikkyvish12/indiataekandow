@extends('layouts.main.main')
@section('title')
    {{ $title }} Photo Gallery
@endsection


@section('content')
@include('layouts.admin.title',['title'=>$title.' | Photo Gallery'])
<!--Main Content Start-->
<div class="main-content innerpagebg wf100 default-bg" >
   <!--Image Gallery Start-->
      <div class="container">
         <div class="row">
            <div class="col-lg-6 mt-4">
      <a href='/image_gallery' class="read-about btn" style="cursor: pointer;">All Albums</a> @if($is_folder == 1)<a href="{{ url('image_gallery/'.$parent_album_id.'/'.$album_name) }}" style="cursor: pointer;" class="read-about btn">Go to Folders</a>@endif
   </div>
   <div class="col-lg-6">
      <div class="mt-4">
              {!! $shareComponent !!}
      </div>
   </div>
   </div>
   <div class="container">
         <div class="row">

         @if($nested == 1)
            @if (count($folders)>0)
                @foreach ($folders as $item)
                     <!--box start-->
            <div class="col-sm-3">
            <center>
            <a href="?folder_id={{ $item->id }}" ><b style="text-transform: uppercase;color:black">{{$item->album_name}}</b></a>

                 </center> 
               <div class="gal-thumb"   >
                  <a href="?folder_id={{ $item->id }}">
                      <i class="fas fa-search"></i>
                   </a>
                  <center><img src="{{ $item->first_image_path }}"  alt="" style="width:220px;height:150px;"> 

                    <br />     
                  </center> 

                </div>
                

            </div>
            <!--box end-->
                @endforeach
            @else
                <div class="col-lg-12">
                  <div class="news-details-wrap">
                    <div class="news-large-post">
                    <div class="post-txt" style="text-align: center">

                     <p>
                       No Folders for Album {{ $title }}
                     </p>

                    </div>
                    </div>
                  </div>
                </div>
            @endif
            @else
            @if (count($gallery)>0)
         
              
               
 
            @else
                <div class="col-lg-12">
                  <div class="news-details-wrap">
                    <div class="news-large-post">
                    <div class="post-txt" style="text-align: center">

                     <p>
                       No Images Added in {{ $title }}
                     </p>

                    </div>
                    </div>
                  </div>
                </div>
            @endif  
            @endif
         </div>
        </div>
      </div>
      
       <!-- ### start of the gallery definition ### -->
       <center><h4 class="text-centered">Photo Gallery</h4></center>
    <div id="nanogallery2" class="container" data-nanogallery2 = '{
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
    @if(isset($gallery))
    {{ $gallery->appends(['folder_id' => $album_id])->links("pagination::bootstrap-4")}}
    @endif
    <br />
 
<br />
   </div>
   <!--Image Gallery End-->
  
<!--Main Content End-->

@endsection

@extends('layouts.main.main')

@section('title')
    Video Gallery
@endsection


@section('content')
@include('layouts.admin.title',['title'=>'Video Gallery'])
<!--Main Content Start-->
<div class="main-content innerpagebg wf100 default-bg">
   <!--Image Gallery Start-->
   <div class="image-gallery gallery p80">
      <div class="container">
         <div class="row">
            @if (count($album)>0)
                 <!--box start-->
           @foreach ($album as $item)
           <div class="col-sm-4">
            <div class="gallery-thumb"><span>{{$item->album_name }}</span> <a href="{{ url('video_gallery/'.$item->id.'/'.$item->album_name) }}" ><i class="fas fa-film"></i></a> <img src="{{ $item->cover_image }}" alt=""> </div>
         </div>
         <!--box end-->
           @endforeach
            @else
         <div class="col-lg-12">
          <div class="news-details-wrap">
            <div class="news-large-post">
            <div class="post-txt" style="text-align: center">

             <p>  No Album Added Yet   </p>

            </div>
            </div>
          </div>
        </div>
            @endif
         </div>
      </div>
   </div>
   <!--Image Gallery End-->
</div>


<!--Main Content End-->
@endsection

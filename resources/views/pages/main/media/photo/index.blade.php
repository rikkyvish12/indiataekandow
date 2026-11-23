@extends('layouts.main.main')

@section('title')
    Photo Gallery
@endsection


@section('content')
@include('layouts.admin.title',['title'=>'Photo Gallery'])
 <!--Main Content Start-->
 <div class="main-content innerpagebg wf100 default-bg" >
   <!--Image Gallery Start-->
   <div class="image-gallery gallery p80">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
                  <div class="isotope items">
                     <div class="row">
                     @forelse ($album as $item)
                      <!--box start-->
                      <div class="col-sm-3" style="margin-top: 1.5%;">
                     <div class="item">
                        <div class="gallery-thumb"> <span>{{ $item->album_name }}</span>
                           <a href="{{ url('image_gallery/'.$item->id.'/'.$item->album_name) }}"><i class="fas fa-image"></i></a>
                            <img  src="{{ $item->coverImage }}" alt="">
                        </div>
                     </div>
                     <br />
                  </div>
                 
                     @empty
                     <div class="col-lg-12">
                        <div class="news-details-wrap">
                          <div class="news-large-post">
                          <div class="post-txt" style="text-align: center">

                           <p>
                              No Albums Added Yet
                           </p>

                          </div>
                          </div>
                        </div>
                      </div>
                     @endempty
                  </div>
            </div>
         </div>
         </div>
      </div>
   </div>
   <!--Image Gallery End-->
</div>
@endsection

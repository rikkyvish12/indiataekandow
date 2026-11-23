@extends('layouts.main.main')

@section('title')
    {{ $title }} Video Gallery
@endsection
<style>
       div#social-links {
                /* margin-left: 125px; */
                text-align: right;
                /* max-width: 500px; */
            }
            div#social-links ul li {
                display: inline-block;
            }
            div#social-links ul li a {
                padding: 5px;
                border: 1px solid #ccc;
                margin: 1px;
                font-size: 30px;
                color: #222;
                background-color: #ccc;
            }
</style>

@section('content')
@include('layouts.admin.title',['title'=>$title.' | Video Gallery'])
<!--Main Content Start-->
<div class="main-content innerpagebg wf100 pt-4 default-bg" >
<!-- Grid row -->
<div class="image-gallery gallery p80">
<div class="container">
      <div class="container mt-4">
              {!! $shareComponent !!}
      </div>
<div class="row">
  <!-- Grid column -->
  @if (count($gallery)>0)
  @foreach ($gallery as $item)
  <div class="col-lg-4 col-md-12 mb-4">
    <!--Modal: Name-->
    <div class="modal fade" id="{{'modal'.$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style=" z-index: 9999" >

      <div class="modal-dialog modal-lg" role="document">
        <!--Content-->
        <div class="modal-content">

          <!--Body-->
          <div class="modal-body mb-0 p-0">

            <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
              <iframe class="embed-responsive-item" id="" src="{{ 'https://www.youtube.com/embed/'.$item->youtube_code }}"
                allowfullscreen>
              </iframe>
            </div>

          </div>
          <!--Footer-->
          <div class="modal-footer justify-content-center">
            <!-- <span class="mr-4">Spread the word!</span> -->
            <div class="container mt-4">
              {!!  \Share::page(
              $item->youtube_link
            )
            ->facebook()
            ->twitter()
            ->linkedin()
            ->telegram()
            ->whatsapp()
            ->reddit()

            !!}
              </div>

            <button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4" style=" text-align: left;" data-dismiss="modal" onclick="closeModalVideo('{{$item->id}}')" >Close</button>

          </div>

        </div>
        <!--/.Content-->

      </div>
    </div>

    <!--Modal: Name-->
        <div class="gallery-thumb" style="text-align: center">
          <a style="font-size:35px;" data-toggle="modal" data-target="#{{'modal'.$item->id}}" ><i class="fab fa-youtube" style="font-size:35px;color:red;"></i></a>
          {{-- <img class="" src="https://mdbootstrap.com/img/screens/yt/screen-video-1.jpg" alt="">  --}}
          <iframe class="embed-responsive-item" width="300" height="200" src="{{ 'https://www.youtube.com/embed/'.$item->youtube_code }}"
            allowfullscreen></iframe>
        </div>
  </div>
  @endforeach
  @else
  <div class="col-lg-12">
    <div class="news-details-wrap">
      <div class="news-large-post">
      <div class="post-txt" style="text-align: center">

       <p>  No Videos Added in {{ $title }}</p>

      </div>
      </div>
    </div>
  </div>  @endif
</div>
<!-- Grid row -->
</div>
</div>
</div>

<script>
  function closeModalVideo(id){
  // alert(id)
  console.log($("#modal"+id+" iframe").attr("src"));

    $("#modal"+id+" iframe").attr("src", $("#modal"+id+" iframe").attr("src"));
}
  </script>
@endsection

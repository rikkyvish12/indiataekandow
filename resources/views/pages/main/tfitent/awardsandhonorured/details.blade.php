@extends('layouts.main.main')

@section('title')
    {{ $title }} |
@endsection

@section('content')
<!--Main Slider Start-->
<div class="inner-banner-header wf100 default-banner"
  >
  <h1 > {{ $title }}</h1>
  <div class="gt-breadcrumbs">
    <ul>
      <li> <a href="news-details.html#"> <i class="fas fa-home"></i> Home </a> </li>
      <li> <a href="news-details.html#"  class="active">  {{ $title }} </a> </li>
    </ul>
  </div>
</div>
<!--Main Slider Start-->
<!--Main Content Start-->
<div class="main-content innerpagebg wf100 default-bg" >
    <!--Photo Gallery Start-->
    <div class="image-gallery gallery p40">
       <div class="container">
          <div class="row">
             <!--box start-->
             <div class="col-sm-4">
                <div class="gal-thumb">
                  <a href="{{ $award->coverImage1 }}" data-rel="prettyPhoto[gallery1]">
                    <i class="fas fa-search"></i></a>
                    <img src="{{ $award->coverImage1 }}" alt=""> </div>
             </div>
             <!--box end-->
              <!--box start-->
              <div class="col-sm-4">
                <div class="gal-thumb">
                  <a href="{{ $award->coverImage2 }}" data-rel="prettyPhoto[gallery1]">
                    <i class="fas fa-search"></i></a>
                    <img src="{{ $award->coverImage2 }}" alt=""> </div>
             </div>
             <!--box end-->
              <!--box start-->
              <div class="col-sm-4">
                <div class="gal-thumb">
                  <a href="{{$award->coverImage3 }}" data-rel="prettyPhoto[gallery1]">
                    <i class="fas fa-search"></i></a>
                    <img src="{{$award->coverImage3 }}" alt=""> </div>
             </div>
             <!--box end-->
          </div>
       </div>
    </div>
    <!--Image Gallery End-->
 </div>
<div class="main-content innerpagebg ">
  <!--News Large Page Start-->
  <!--Start-->
  <div class="news-details">
    <div class="container">
      <div class="row">
        <!--News Start-->
        <div class="col-lg-12">
          <div class="news-details-wrap">
            <div class="news-large-post">
              <div class="post-txt">
                {!! $award->description !!}
                <!--Post Tags End-->
              </div>
            </div>
          </div>
        </div>
        <!--News End-->
      </div>
    </div>
  </div>
  <!--End-->
</div>
<!--Main Content End-->
@endsection

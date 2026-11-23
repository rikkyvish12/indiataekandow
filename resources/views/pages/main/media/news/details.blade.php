@extends('layouts.main.main')


@section('title')
{{ $title }} |
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
<!--Main Slider Start-->
<div class="inner-banner-header wf100 default-banner">
  <h1>{{ $title }}</h1>
  <div class="gt-breadcrumbs">
    <ul>
      <li> <a href="{{ url('/') }}" class="active"> <i class="fas fa-home"></i> Home </a> </li>
      <li> <a >  News </a> </li>
      <li> <a> {{ $title }} </a> </li>
    </ul>
  </div>
</div>
<!--Main Slider Start-->
<!--Main Content Start-->
<div class="main-content innerpagebg wf100 p80 default-bg" >
  <!--News / Blog Start-->
  <div class="news-grid">
    <div class="container">
      <div class="row">
      <div class="col-sm-12 col-xs-12 pull-right">
        <div class="news-details-wrap">
          <div class="news-large-post">
          <div class="post-txt">
                    <div class="">
                      <div class="animated zoomIn" style="text-align: ;"><h2>{{ $news->title }}</h2>

                      {!! $shareComponent !!}
                    </div>

                         <hr>
                      {{-- <div class="animated zoomIn mr-3" style="float: left">
                          <div class="ng-">
                          <div class="thumb">
                            <img src="{{ $events->coverImage }}" alt="">
                          </div>
                          <div class="ng-txt">
                            <ul class="post-author">
                              <li ><strong><i class="fas fa-calendar-alt"></i> {{ date('d-M-Y', strtotime($events->date)) }}</strong></li>
                              <li style="float: right"> <strong>{{ $events->location }}</strong></li>
                            </ul>
                             <ul class="post-meta">
                             </ul>
                            </div>
                          </div>
                      </div>  --}}
                      {{-- <b>{{ $events->intro }}</b> --}}
                       <p style="font-size: 18px; line-height: 1.6;" class="animated slideInRight">
                        {!! $news->description !!}
                      </p>
                    </div>

          </div>
          {{-- <div class=" animated zoomIn mb-4" style="text-align: center; ">
            <h2><i class="fa fa-quote-left  fa-fw fa-lg" aria-hidden="true"></i>Come and join Goa Football Festival<i class="fa fa-quote-right fa-fw fa-lg" aria-hidden="true"></i></h2>
         </div> --}}
          </div>
        </div>
      </div>
      </div>
    </div>
  </div>
  <!--News / Blog End-->
</div>
<!--Main Content End-->
@endsection

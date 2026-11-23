@extends('layouts.main.main')


@section('title')
{{ $title }} |
@endsection


@section('content')
<!--Main Slider Start-->
<div class="inner-banner-header wf100 default-banner" >
  <h1 >{{ $title }}</h1>
  <div class="gt-breadcrumbs">
    <ul>
      <li> <a href="{{ url('/') }}" > <i class="fas fa-home"></i> Home </a> </li>
      <li> <a href="{{ url('/awardsandhonorured') }}" class="active"> {{ $title }} </a> </li>
    </ul>
  </div>
</div>
<!--Main Slider Start-->
<!--Main Content Start-->
<div class="main-content innerpagebg wf100 p80 default-bg">
  <!--News Large Page Start-->
  <!--Start-->
  <div class="news-list">
    <div class="container">
      <div class="row">
        <!--News Start-->
        <div class="col-lg-12">
          <!-- <div class="news-wrap">
            @foreach ($awards as $item) -->
                  <!--Post Start-->
            <!-- <div class="news-list-post">
              <div class="post-thumb">
                @if ($title=='Awards & Honours')
                <a href="{{ url('/awardsandhonorured/'.$item->title) }}">
                @else
                <a href="{{ url('/halloffame/'.$item->title) }}">
                @endif

                  <i class="fas fa-link"></i></a> <img src="{{ $item->coverImage }}" alt=""></div>
              <div class="post-txt">
                <ul class="post-author">
                  <li><strong>Award to : {{ $item->name }}</strong></li>
                </ul>
                <h4>
                  @if ($title=='Awards & Honours')
                  <a href="{{ url('/awardsandhonorured/'.$item->title) }}">{{ $item->title }}</a>
                  @else
                  <a href="{{ url('/halloffame/'.$item->title) }}">{{ $item->title }}</a>
                  @endif
                </h4>
                <ul class="post-meta">
                  <li><i class="fas fa-calendar-alt"></i> {{ $item->date }}</li>
                </ul>
                <p> {{ $item->intro }}</p>
                @if ($title=='Awards & Honours')
                <a href="{{ url('/awardsandhonorured/'.$item->title) }}" class="rm">Read More</a>
                @else
                <a href="{{ url('/halloffame/'.$item->title) }}" class="rm">Read More</a>
                @endif
              </div>
            </div> -->
            <!--Post End-->
            <!-- @endforeach

          </div> -->
          <div class="news-details-wrap">
            <div class="news-large-post">
              <div class="post-txt">
                <div class="point-table-widget">
                      <div class="outer" style="text-align: center;">
                              <div class="inner" style="display: inline-block;">
                                  <img src="/coming_soon.jpg" alt=""  style="height:150px;">
                              </div>
                          </div>
                 </div>
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

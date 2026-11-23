@extends('layouts.main.main')


@section('title')
{{ $title }}
@endsection

@section('content')
<!--Main Slider Start-->
<div class="inner-banner-header wf100 default-banner" >
  <h1>{{ $title }}</h1>
  <div class="gt-breadcrumbs">
    <ul>
      <li> <a href="news-grid.html#" class="active"> <i class="fas fa-home"></i> Home </a> </li>
      <li> <a href=""> {{ $title }} </a> </li>
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
        @if (count($news)>0)
            @foreach ($news as $item)
                 <!--Box Start-->
        <div class="col-lg-4 col-md-6">
          <div class="ng-box">
            <div class="thumb">
             @if($item->type == 'international_news')
              <a target="_blank" href="{{ $item->link }}"><i class="fas fa-link"></i></a>
            @else
            <a target="" href="{{ url('/'.$item->type.'/'.$item->id.'/'.$item->title) }}"><i class="fas fa-link"></i></a>
             @endif
              <img src="{{$item->coverImage}}" alt="">
            </div>
            <div class="ng-txt">
              <ul class="post-author">
              </ul>
              <ul class="post-meta">
                <li><i class="fas fa-calendar-alt"></i>{{ date('d-M-Y', strtotime($item->Date)) }}</li>
              </ul>
              <h4>
                @if($item->type == 'international_news')
                <a target="_blank" href="{{ $item->link }}">{{ \Illuminate\Support\Str::limit($item->title, 50, $end='...')  }}</a>
                @else
                <a target="" href="{{ url('/'.$item->type.'/'.$item->id.'/'.$item->title) }}">{{ \Illuminate\Support\Str::limit($item->title, 50, $end='...')  }}</a>
                 @endif
              </h4>
              @if($item->type == 'international_news')
              <a target="_blank" href="{{ $item->link }}" class="rm">Read More</a>
              @else
              <a target="" href="{{ url('/'.$item->type.'/'.$item->id.'/'.$item->title) }}" class="rm">Read More</a>
               @endif
            </div>
          </div>
        </div>
        <!--Box End-->
            @endforeach
        @else
        <div class="col-lg-12">
          <div class="news-details-wrap">
            <div class="news-large-post">
            <div class="post-txt" style="text-align: center">

             <p>  No {{ $title }}
              Added   </p>

            </div>
            </div>
          </div>
        </div>

        @endif


      </div>
    </div>
  </div>
  <!--News / Blog End-->
</div>
<!--Main Content End-->
@endsection

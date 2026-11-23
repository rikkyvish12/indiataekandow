@extends('layouts.main.main')


@section('title')
{{ $title }}
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
                font-size: 15px;
                color: #222;
                background-color: #ccc;
            }
</style>

@section('content')
<!--Main Slider Start-->
<div class="inner-banner-header wf100 default-banner"
  >
  <h1>{{ $title }}</h1>
  <div class="gt-breadcrumbs">
    <ul>
      <li> <a href="{{ url('/') }}" class="active"> <i class="fas fa-home"></i> Home </a> </li>
      <li> <a href="#"> {{ $title }} </a> </li>
    </ul>
  </div>
</div>
<!--Main Slider Start-->
<!--Main Content Start-->
<div class="main-content innerpagebg wf100 p80 default-bg">
  <!--News / Blog Start-->
  <div class="news-grid">
    <div class="container">
    <div class="container mt-4">
              {!! $shareComponent !!}
              </div>
      <div class="row">

      @if (count($events)>0)
       @foreach ($events as $item)
        <!--Box Start-->
        @if ($item->eventType_id=='1')
              <div class="col-lg-4 col-md-4">
                <div class="ng-box">
                  <div class="thumb">
                    <a href="{{ $item->link }}" target="_blank"><i class="fas fa-newspaper"></i></a>
                    <img src="{{ $item->coverImage }}" alt="">
                  </div>
                  <div class="ng-txt">
                    <ul class="post-author">
                      <li> <strong>{{ $item->location }}</strong></li>
                    </ul>
                    <h4>
                      <a href="{{ $item->link }}" target="_blank" data-toggle="tooltip" title="{{$item->title}}" data-placement="auto" >{{ \Illuminate\Support\Str::limit($item->title, 15, $end='...')  }}</a>
                    </h4>
                    <ul class="post-meta">
                      <li><i class="fas fa-calendar-alt"></i> {{ date('d-M-Y', strtotime($item->date)) }}</li>
                      {{--  <li><i class="far fa-comment"></i> 89 Comments</li>  --}}
                    </ul>
                    <p><span  data-toggle="tooltip" title="{{$item->intro}}" data-placement="auto">{{ \Illuminate\Support\Str::limit($item->intro, 15, $end='...')  }} </span></p>
                    <a href="{{ $item->link }}" target="_blank" class="rm">Read More</a>
                  </div>
                </div>
              </div>
          @elseif($item->eventType_id=='2')
            <div class="col-lg-4 col-md-4">
              <div class="ng-box">
              <div class="thumb">
              @if ($item->event_presentation=='1')
                <a href="{{ url('event/'.$item->id.'/'.$item->title) }}" target=""><i class="fas fa-newspaper"></i></a>
                @elseif($item->event_presentation =='2')
                <a href="{{ url('events/'.$item->id.'/'.$item->title) }}" target="_blank"><i class="fas fa-newspaper"></i></a>

                @else
                <a href="{{ url($item->link) }}" target=""><i class="fas fa-newspaper"></i></a>

                @endif
                <img src="{{ $item->coverImage }}" alt="">
              </div>
              <div class="ng-txt">
                <ul class="post-author">
                  <li> <strong>{{ $item->location }}</strong></li>
                </ul>
                <h4>
                  <a href="{{ url('events/'.$item->id.'/'.$item->title) }}" data-toggle="tooltip" title="{{$item->title}}" data-placement="auto" target="">{{ \Illuminate\Support\Str::limit($item->title, 15, $end='...')  }}</a>
                </h4>
                 <ul class="post-meta">
                  <li><i class="fas fa-calendar-alt"></i> {{ date('d-M-Y', strtotime($item->date)) }}</li>
                  {{--  <li><i class="far fa-comment"></i> 89 Comments</li>  --}}
                 </ul>
                 <p><span  data-toggle="tooltip" title="{{$item->intro}}" data-placement="auto">{{ \Illuminate\Support\Str::limit($item->intro, 15, $end='...')  }} </span></p>
                 @if ($item->event_presentation=='1')
                 <a href="{{ url('event/'.$item->id.'/'.$item->title) }}" target="" class="rm">Read More</a>
                @elseif($item->event_presentation =='2')
                <a href="{{ url('events/'.$item->id.'/'.$item->title) }}" target="_blank" class="rm">Read More</a>

                @else
                <a href="{{ url($item->link) }}" target=""><i class="fas fa-newspaper"></i></a>

                @endif
                </div>
              </div>
            </div>
          @else
          <div class="col-lg-4 col-md-4">
            <div class="ng-box">
            <div class="thumb">
              <a href="{{ url('event/'.$item->id.'/'.$item->title) }}" target=""><i class="fas fa-newspaper"></i></a>
              <img src="{{ $item->coverImage }}" alt="">
            </div>
            <div class="ng-txt">
              <ul class="post-author">
                <li> <strong>{{ $item->location }}</strong></li>
              </ul>
              <h4>
                <a href="{{ url('event/'.$item->id.'/'.$item->title) }}" data-toggle="tooltip" title="{{$item->title}}" data-placement="auto" target="">{{ \Illuminate\Support\Str::limit($item->title, 15, $end='...')  }}</a>
              </h4>
               <ul class="post-meta">
                <li><i class="fas fa-calendar-alt"></i> {{ date('d-M-Y', strtotime($item->date)) }}</li>
                {{--  <li><i class="far fa-comment"></i> 89 Comments</li>  --}}
               </ul>
               <p><span  data-toggle="tooltip" title="{{$item->intro}}" data-placement="auto">{{ \Illuminate\Support\Str::limit($item->intro, 15, $end='...')  }} </span></p>
               <a href="{{ url('event/'.$item->id.'/'.$item->title) }}" target="_blank" class="rm">Read More</a>
              </div>
            </div>
          </div>
            @endif
              <!--Box End-->
        @endforeach
       @else
        <div class="col-lg-12">
          <div class="news-details-wrap">
            <div class="news-large-post">
            <div class="post-txt" style="text-align: center">

             <p>  No {{ $title }}
              Added Yet   </p>

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

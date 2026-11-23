@extends('layouts.main.main')

@section('content')
<!--Main Slider Start-->
<div class="inner-banner-header wf100 default-banner">
  <h1>{{ $association->name }}</h1>
  <div class="gt-breadcrumbs">
    <ul>
      <li> <a href="{{ url('/') }}"> <i class="fas fa-home"></i> Home </a> </li>
      <li> <a href="#" class="active"> {{ $association->name }} </a> </li>
    </ul>
  </div>
</div>
<!--Main Slider Start-->
<!--Main Content Start-->
<div class="main-content innerpagebg wf100 p80 default-bg" >
  <!--News Large Page Start-->
  <!--Start-->
  <div class="news-details">
    <div class="container">
      <div class="row">
        <!--Player Box Start-->
        <div class="col-md-6 col-sm-6">
          <div class="player-box" style="width:100%;height: 300px;">
            <div class="player-thumb">
             <img src="{{ $association->presidentPhoto }}" alt=" TFI" style="width: 250px;height: 300px;"></div>
             <div class="player-txt">
              <h3>{{ $association->presidentName }}</h3>
              <strong class="player-desi"> President |  {{$association->name}} </strong>
              <p style="word-wrap: break-word">{!! $association->presidentDescription  !!}</p>
              <p>{{ $association->presidentEmail }}</p>
              <ul>
              </ul>
            </div>
          </div>
        </div>
        <!--Player Box End-->

        <!--Player Box Start-->
        <div class="col-md-6 col-sm-6">
          <div class="player-box" style="width:100%;height: 300px;">
            <div class="player-thumb">
            <img src="{{ $association->secretaryPhoto }}" alt=" TFI" style="width: 250px;height: 300px;"></div>
            <div class="player-txt">
              <h3>{{$association->secretaryName}} </h3>
              <strong class="player-desi"> Secretary |   {{$association->name}}  </strong>
              <p style="word-wrap: break-word">{!! $association->secretaryDescription !!} </p>
              <p>{{ $association->secretaryEmail }}</p>
              <ul>
              </ul>
            </div>
          </div>
        </div>
        </div>
        <!--Player Box End-->

              <!--Player Biography Start-->
                <div class="player-bio">
                  <h4 style="padding-right: 10px">About   {{ $association->name }}
                          @if ($association->type=='state_association')
                           <a href="{{ url('state/'.$association->id.'/'.$association->name) }}" class="float-right">Click here to view our website</a>
                           @elseif($association->type=='district_association')
                           <a href="{{ url('district/'.$association->id.'/'.$association->name) }}" class="float-right">Click here to view our website</a>
                           @else
                           <a href="{{ url('other_assoc/'.$association->id.'/'.$association->name) }}" class="float-right">Click here to view our website</a>
                          @endif

                                    </h4>
                  <div class="txt">
                    {!! $association->description !!}
                  </div>



                </div>
                <!--Player Biography End-->

    </div>
  </div>
  <!--End-->
</div>
<!--Main Content End-->
@endsection

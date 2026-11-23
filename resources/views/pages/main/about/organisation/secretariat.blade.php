@extends('layouts.main.main')

@section('title')
    Secretariat |
@endsection


@section('content')
<!--Main Slider Start-->
  <div class="inner-banner-header wf100 default-banner" >
    <h1 >Secretariat</h1>
    <div class="gt-breadcrumbs">
      <ul>
        <li> <a href="{{ url('/') }}"> <i class="fas fa-home"></i> Home </a> </li>
        <li> <a href="{{ url('/secretariat') }}"  class="active"> Secretariat </a> </li>
      </ul>
    </div>
  </div>
  <!--Main Slider Start-->
  <!--Main Content Start-->
<div class="main-content innerpagebg wf100 p80 default-bg">
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
              @if( !empty($msg->description))
              {!! $msg->description !!}
              @else
              <p style="text-align: center">No Secretariat Added
              </p>
              @endif
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

@extends('layouts.main.main')

@section('title')
{{ $title }}
@endsection

@section('content')
@include('layouts.admin.title',['title'=>$title])
<!--Main Content Start-->
<div class="main-content innerpagebg wf100 p80 default-bg">
  <!--News Large Page Start-->
  <!--Start-->
  <div class="news-details">
    <div class="container">
      <div class="row">
              <!--Player Biography Start-->
                <div class="player-bio">
                  <h4>About   {{ $title }}  <a href="{{ $rnr->pdf }}" class="float-right" style="margin-right: 20px; font-size: 18px;" target="_blank"><u>Click here to download .pdf</u> <i class="fas fa-download "></i></a></h4>
                  <div class="txt">
                   <p>
                   {!! $rnr->description !!}

                   </p>
                  </div>
                </div>
                <!--Player Biography End-->
      </div>
    </div>
  </div>
  <!--End-->
</div>
<!--Main Content End-->
@endsection


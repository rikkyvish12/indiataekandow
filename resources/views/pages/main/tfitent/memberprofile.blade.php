@extends('layouts.main.main')

@section('title')
    {{ $title }}
@endsection


@section('content')
      <!--Main Slider Start-->
  <div class="inner-banner-header wf100 default-banner"
    >
    <h1 data-generated="{{ $title }}">{{ $title }}</h1>
    <div class="gt-breadcrumbs">
      <ul>
        <li> <a href="{{ url('/') }}" class="active"> <i class="fas fa-home"></i> Home </a> </li>
        <li> <a href="#"> {{ $title }} </a> </li>
      </ul>
    </div>
  </div>
  <!--Main Slider Start-->

  <!--Main Content Start-->
  <div class="main-content innerpagebg wf100 default-bg" >

    <!--Product Page Start-->
    <div class="team wf100 p80">



      <!--Products Filter Start-->
      <div class="team-grid">
        <div class="container">
          <div class="row">
            <div class="player-bio">
              <h4><i class="fa fa-arrow-right" aria-hidden="true"></i> Comming Soon</h4>
            </div>
              {{-- @foreach ($member as $item)
                <!--Team Box Start-->
                <div class="col-lg-3 col-md-6">
                    <div class="team-squad-box">
                    <div class="num">{{ $no++ }}</div>
                    <div class="ts-cap">
                        <h4>{{ $item->name }}</h4>
                        <p>{{ $item->title }}</p>
                        <br><br>
                    </div>
                    <img src="{{ $item->image }}" style="width: 255px;heigh:350px" alt=""> </div>
                </div>
                <!--Team Box End-->
              @endforeach --}}
          </div>
        </div>
      </div>
      <!--Products Filter End-->

    </div>
    <!--Product Page End-->

  </div>
  <!--Main Content End-->
@endsection

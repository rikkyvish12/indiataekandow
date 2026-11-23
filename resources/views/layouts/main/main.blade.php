<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
@if ($profile)
<title>@yield('title') | {{ $profile->title }}</title>
@else
<title>@yield('title')</title>
@endif
@include('layouts.main.style')
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
      .read-about {
background: #33394e;
color: #fff;
border-radius: 3px;
font-size: 12px;
text-transform: uppercase;
font-weight: 800;
line-height: 33px;
padding: 0 15px;
}
.read-about:hover {
background: #e81f3e;
color: #fff;
}
</style>
</head>
<body>
<!--Wrapper Start-->
<div class="wrapper gray-bg">

  <!-- Match Counter Start -->
  {{-- <div class="h3-match-counter">
    <button class="hide"><i class="fas fa-times"></i></button>
    <div class="container">
      <div class="row">
        <ul>
          <li class="col-md-1">
            <div class="team-left"><img src="{{ url('images/nmf-logo1.png') }}" alt="Emeric Technologies"> <strong>FC Champs</strong></div>
          </li>
          <li class="col-md-3">
            <p class="mdate-time"> 20 December. 2018 <strong>04:00 PM GMT+</strong> </p>
          </li>
          <li class="col-md-4">
            <div class="defaultCountdown"></div>
          </li>
          <li class="col-md-3">
            <p class="match-loc"><i class="fas fa-location-arrow"></i> Expo Center Main Hall, NY</p>
          </li>
          <li class="col-md-1">
            <div class="team-right"><img src="{{ url('images/nmf-logo2.png') }}" alt="Emeric Technologies"> <strong>Tigers</strong></div>
          </li>
        </ul>
      </div>
    </div>
  </div> --}}
  <!-- Match Counter Start -->

  <!--Header Start-->
  <header id="main-header" class="main-header white-header">
    <!--topbar-->
    <div class="topbar">
      <div class="container">
        <div class="row">
          <div class="col-md-3 col-sm-3" >
            <ul class="topsocial">
              <li><a href="https://www.facebook.com/taekwondoindiaofficial" class="fb" target="_blank" rel="noopener noreferrer"><i class="fab fa-facebook-f"></i></a></li>
              <!-- <li><a href="index-two.html#" class="tw"><i class="fab fa-twitter" target="_blank" rel="noopener noreferrer"></i></a></li> -->
              <li><a href="https://www.instagram.com/taekwondoindia/" class="insta" target="_blank" rel="noopener noreferrer"> <i class="fab fa-instagram" ></i></a></li>
              <!-- <li><a href="index-two.html#" class="in" target="_blank" rel="noopener noreferrer"><i class="fab fa-linkedin-in"> </i></a></li>
              <li><a href="index-two.html#" class="yt" target="_blank" rel="noopener noreferrer"><i class="fab fa-youtube"></i></a></li> -->
              <li style="color:rgb(230, 34, 64); margin-left:10px;" > Top News
              </li>
            </ul>
          </div>
          <div class="col-md-9 col-sm-9">
            <marquee style="color: white" onmouseover="this.stop();" onmouseout="this.start();"><b> | </b>
            @if(count($latest_news)>0)
              @foreach ($latest_news as $news)
              <span><a href="{{ $news->link }}" target="_blank">{{ $news->title }}</a><span><b> | </b>
              @endforeach
            @else
            <span>Add news to display<span><b> | </b>

            @endif
             </marquee>
          </div>
        </div>
      </div>
    </div>
    <!--topbar end-->
    <!--Logo + Navbar Start-->
    <div class="logo-navbar">
      <div class="container">
        <div class="row">
          <div class="col-md-2 col-sm-5">
            @if ($defaults)
            <div><a href="{{ url('/') }}"><img src="{{ $defaults->logo }}" style="width: 150px" alt="TFI" class="mt-1"></a></div>
            @else
            <div><a href="{{ url('/') }}"><img src="" style="width: 75px" alt="TFI" class="mt-1"></a></div>
            @endif
          </div>
          <div class="col-md-10 col-sm-7">
           @include('layouts.main.navbar')
          </div>
        </div>
      </div>
    </div>
    <!--Logo + Navbar End-->
  </header>
  <!--Header End-->
  @yield('content')
  <!--Main Footer Start-->
  @include('layouts.main.footer')
  <!--Main Footer End-->
</div>
<!--Wrapper End-->
<!-- Optional JavaScript -->
@include('layouts.main.script')

</body>
</html>


@if ($defaults->logo)
<link rel="icon" href="{{ $defaults->logo }}" type="image/png">
@else
<link rel="icon" href="" type="image/png">
@endif
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="{{ url('css/custom.css') }}">
<link rel="stylesheet" href="{{ url('css/responsive.css') }}">
<link rel="stylesheet" href="{{ url('css/color.css') }}">
<link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ url('css/fontawesome.css') }}">
<link rel="stylesheet" href="{{ url('css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ url('css/prettyPhoto.css') }}">
<!-- <link rel="stylesheet" href="{{ url('css/normalize.css') }}">
<link rel="stylesheet" href="{{ url('css/main.css') }}">
<link rel="stylesheet" href="{{ url('css/jquery.steps.css') }}"> -->
<!--Rev Slider Start-->
<link rel="stylesheet" href="{{ url('js/rev-slider/css/settings.css') }}"  type='text/css' media='all' />
<link rel="stylesheet" href="{{ url('js/rev-slider/css/layers.css') }}"  type='text/css' media='all' />
<link rel="stylesheet" href="{{ url('js/rev-slider/css/navigation.css') }}"  type='text/css' media='all' />
<!--Rev Slider End-->
@if(\Request::is('image_gallery*'))
<!--Nano GALLERY plugins start-->
<link rel='stylesheet' href='{{ url('nanogallery/css/nanogallery2.min.css') }}' type='text/css' media='all'>
<link rel='stylesheet' href='{{ url('nanogallery/css/nanogallery2.woff.min.css') }}' type='text/css' media='all'>
<link rel='stylesheet' href='{{ url('nanogallery/css/animation.css') }}' type='text/css' media='all'>
<!--Nano GALLERY plugins end-->
@endif

@if($defaults->background != 'text')
<style>
  .default-bg{
    background: url({{ $defaults->background }});
    background-position: center ;


}
</style>
@else
    
@endif
@if ($defaults->footerBackground != 'text')
<style>
  .default-footer-bg{
  background-image:
    linear-gradient(grey, grey),
    url({{  $defaults->footerBackground  }});
  background-size: cover;
  background-blend-mode: saturation;

}
</style>
@else
    
@endif
@if ($defaults->banner != 'text')

<style>
  
  .default-banner{
    background: url({{ $defaults->banner }});
    background-position: center ;
    background-repeat: no-repeat; /* Do not repeat the image */
    background-size: cover cover; /* Resize the background image to cover the entire container */


}
</style>
@else
    
@endif
<style>
  .a-tfi {
    overflow: hidden;
   text-overflow: ellipsis;
   display: -webkit-box;
   -webkit-line-clamp: 4; /* number of lines to show */
   -webkit-box-orient: vertical;
}
.slider-descrip{
  word-wrap: normal;
}
.gradient{
    background: rgb(232,31,62);
    background: linear-gradient(180deg, rgba(232,31,62,1) 0%, rgba(232,31,62,1) 12%, rgba(94,22,48,1) 50%, rgba(0,11,48,0.011642156862745057) 100%);"
}


<style>
    .a-tfi {
      overflow: hidden;
     text-overflow: ellipsis;
     display: -webkit-box;
     -webkit-line-clamp: 4; /* number of lines to show */
     -webkit-box-orient: vertical;
  }
  .slider-descrip{
    word-wrap: normal;
  }
  .gradient{
      background: rgb(232,31,62);
      background: linear-gradient(180deg, rgba(232,31,62,1) 0%, rgba(232,31,62,1) 12%, rgba(94,22,48,1) 50%, rgba(0,11,48,0.011642156862745057) 100%);"
  }

  </style>
  <!--  // style for notification after sending email -->
  <style>
   #snackbar {
  visibility: hidden;
  min-width: 250px;
  margin-left: -125px;
  background-color: #333;
  color: #fff;
  text-align: center;
  border-radius: 2px;
  padding: 16px;
  position: fixed;
  z-index: 1;
  left: 50%;
  bottom: 30px;
  font-size: 17px;
}

#snackbar.show {
  visibility: visible;
  -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
  animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

@-webkit-keyframes fadein {
  from {bottom: 0; opacity: 0;}
  to {bottom: 30px; opacity: 1;}
}

@keyframes fadein {
  from {bottom: 0; opacity: 0;}
  to {bottom: 30px; opacity: 1;}
}

@-webkit-keyframes fadeout {
  from {bottom: 30px; opacity: 1;}
  to {bottom: 0; opacity: 0;}
}

@keyframes fadeout {
  from {bottom: 30px; opacity: 1;}
  to {bottom: 0; opacity: 0;}
}

/* loader box*/
.loader-box {
        background:rgba(0,0,0,0.8);
        position:fixed;
        bottom:0;
        left:0;
        top:0;
        width:100%;
        height:100%;
        z-index:100;
    }

/* start of loader div */
.lds-roller {
  display: inline-block;
  position: relative;
  width: 80px;
  height: 80px;
}
.lds-roller div {
  animation: lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
  transform-origin: 40px 40px;
}
.lds-roller div:after {
  content: " ";
  display: block;
  position: absolute;
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #E81F3E;
  margin: -4px 0 0 -4px;
}
.lds-roller div:nth-child(1) {
  animation-delay: -0.036s;
}
.lds-roller div:nth-child(1):after {
  top: 63px;
  left: 63px;
}
.lds-roller div:nth-child(2) {
  animation-delay: -0.072s;
}
.lds-roller div:nth-child(2):after {
  top: 68px;
  left: 56px;
}
.lds-roller div:nth-child(3) {
  animation-delay: -0.108s;
}
.lds-roller div:nth-child(3):after {
  top: 71px;
  left: 48px;
}
.lds-roller div:nth-child(4) {
  animation-delay: -0.144s;
}
.lds-roller div:nth-child(4):after {
  top: 72px;
  left: 40px;
}
.lds-roller div:nth-child(5) {
  animation-delay: -0.18s;
}
.lds-roller div:nth-child(5):after {
  top: 71px;
  left: 32px;
}
.lds-roller div:nth-child(6) {
  animation-delay: -0.216s;
}
.lds-roller div:nth-child(6):after {
  top: 68px;
  left: 24px;
}
.lds-roller div:nth-child(7) {
  animation-delay: -0.252s;
}
.lds-roller div:nth-child(7):after {
  top: 63px;
  left: 17px;
}
.lds-roller div:nth-child(8) {
  animation-delay: -0.288s;
}
.lds-roller div:nth-child(8):after {
  top: 56px;
  left: 12px;
}
@keyframes lds-roller {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

/* end of loader div */
    </style>

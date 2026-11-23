<link rel="shortcut icon" href="{{ $default->logo }}" type="image/x-icon">


<link rel='stylesheet' href='{{ url('members/plugins/goodlayers-core/plugins/fontawesome/font-awesome.css') }}' type='text/css' media='all'>
<link rel='stylesheet' href='{{ url('members/plugins/goodlayers-core/plugins/elegant/elegant-font.css') }}' type='text/css' media='all'>
<link rel='stylesheet' href='{{ url('members/plugins/goodlayers-core/plugins/style.css') }}' type='text/css' media='all'>
<link rel='stylesheet' href='{{ url('members/plugins/goodlayers-core/include/css/page-builder.css') }}' type='text/css' media='all'>
<link rel='stylesheet' href='{{ url('members/plugins/revslider/public/assets/css/rs6.css') }}' type='text/css' media='all'>
<link rel='stylesheet' href='{{ url('members/plugins/sportspress/assets/css/sportspress.css') }}' type='text/css' media='all'>
<link rel='stylesheet' href='{{ url('members/plugins/sportspress/assets/css/icons.css') }}' type='text/css' media='all'>
<link rel='stylesheet' href='{{ url('members/css/style-core.css') }}' type='text/css' media='all'>
<link rel='stylesheet' href='{{ url('members/css/bigslam-style-custom.css') }}' type='text/css' media='all'>
<link rel='stylesheet' href='{{ url('members/plugins/google-map-plugin/assets/css/frontend.css') }}' type='text/css' media='all'>
<link rel="stylesheet" href="{{ url('css/fontawesome.css') }}">
<!--Nano GALLERY plugins start-->
<link rel='stylesheet' href='{{ url('bootstrap/css/bootstrap.min.css') }}' type='text/css' media='all'>
<link rel='stylesheet' href='{{ url('nanogallery/css/nanogallery2.min.css') }}' type='text/css' media='all'>
<link rel='stylesheet' href='{{ url('nanogallery/css/nanogallery2.woff.min.css') }}' type='text/css' media='all'>
<link rel='stylesheet' href='{{ url('nanogallery/css/animation.css') }}' type='text/css' media='all'>
<!--Nano GALLERY plugins end-->
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300italic,regular,italic,700,700italic%7CRoboto:100,100italic,300,300italic,regular,italic,500,500italic,700,700italic,900,900italic%7CMerriweather:300,300italic,regular,italic,700,700italic,900,900italic%7CLora:regular,italic,700,700italic&subset=cyrillic-ext,vietnamese,latin,cyrillic,greek-ext,latin-ext,greek&ver=5.3' type='text/css' media='all'>
<style>
</style>

@if($assoc_defaults)
<style>

    .default-banner{
    background: url({{ $default->banner }});
    background-position: center ;
    background-repeat: no-repeat; /* Do not repeat the image */
    background-size: cover; /* Resize the background image to cover the entire container */



}
.default-bg{
    background: url({{ $default->background }});
    background-position: center ;

}
</style>

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

@endif

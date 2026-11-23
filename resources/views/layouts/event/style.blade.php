<link rel="shortcut icon" href="{{ $default->logo }}" type="image/x-icon">

<link rel='stylesheet' href='{{ url('../plugins/goodlayers-core/plugins/fontawesome/font-awesome.css') }}' type='text/css' media='all'>
<link rel='stylesheet' href='{{ url('../plugins/goodlayers-core/plugins/elegant/elegant-font.css') }}' type='text/css' media='all'>
<link rel='stylesheet' href='{{ url('../plugins/goodlayers-core/plugins/style.css') }}' type='text/css' media='all'>
<link rel='stylesheet' href='{{ url('../plugins/goodlayers-core/include/css/page-builder.css') }}' type='text/css' media='all'>
<link rel='stylesheet' href='{{ url('../plugins/revslider/public/assets/css/rs6.css') }}' type='text/css' media='all'>
<link rel='stylesheet' href='{{ url('../plugins/sportspress/assets/css/sportspress.css') }}' type='text/css' media='all'>
<link rel='stylesheet' href='{{ url('../plugins/sportspress/assets/css/icons.css') }}' type='text/css' media='all'>
<link rel='stylesheet' href='{{ url('../css/style-core.css') }}' type='text/css' media='all'>
<link rel='stylesheet' href='{{ url('../css/bigslam-style-custom.css') }}' type='text/css' media='all'>
<link rel='stylesheet' href='{{ url('../plugins/google-map-plugin/assets/css/frontend.css') }}' type='text/css' media='all'>

<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300italic,regular,italic,700,700italic%7CRoboto:100,100italic,300,300italic,regular,italic,500,500italic,700,700italic,900,900italic%7CMerriweather:300,300italic,regular,italic,700,700italic,900,900italic%7CLora:regular,italic,700,700italic&subset=cyrillic-ext,vietnamese,latin,cyrillic,greek-ext,latin-ext,greek&ver=5.3' type='text/css' media='all'>
<!--Nano GALLERY plugins start-->
<link rel='stylesheet' href='{{ url('bootstrap/css/bootstrap.min.css') }}' type='text/css' media='all'>
<link rel='stylesheet' href='{{ url('nanogallery/css/nanogallery2.min.css') }}' type='text/css' media='all'>
<link rel='stylesheet' href='{{ url('nanogallery/css/nanogallery2.woff.min.css') }}' type='text/css' media='all'>
<link rel='stylesheet' href='{{ url('nanogallery/css/animation.css') }}' type='text/css' media='all'>
<!--Nano GALLERY plugins end-->
@if($event_defaults)
<style>

    .default-banner{
    background: url({{ $default->banner }});
    background-position: center ;
    background-repeat: no-repeat; /* Do not repeat the image */
    background-size: cover cover; /* Resize the background image to cover the entire container */



}
.default-bg{
    background: url({{ $default->background }});
    background-position: center ;

}
</style>

@endif

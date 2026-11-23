@if ($defaults)
<link rel="icon" type="image/x-icon" href="{{ $defaults->logo }}"/>
@else
<link rel="icon" type="image/x-icon" href="#"/>
@endif
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="{{ url('/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('/assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    {{-- <link rel="stylesheet" href="{{ url('/assets/summernote/summernote-bs4.css') }}"/> --}}
    <!-- <link rel="stylesheet" href="{{ url('css/normalize.css') }}"> -->
    <link rel="stylesheet" href="{{ url('/css/jquery.steps.css') }}">
    <link rel="stylesheet" href="{{ url('/css/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ url('/css/simple-line-icon/css/simple-line-icons.css') }}">
    <!-- <link href="/plugins/loaders/custom-loader.css" rel="stylesheet" type="text/css" /> -->

<!-- BEGIN PAGE LEVEL STYLES -->
<link href="/assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
<link href=" /plugins/file-upload/file-upload-with-preview.min.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL STYLES -->
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="icon" type="image/x-icon" href="/assets/img/favicon.ico"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <!-- END GLOBAL MANDATORY STYLES -->
    <!--  BEGIN CUSTOM STYLE FILE  -->
    <!-- <link rel="stylesheet" type="text/css" href="/plugins/jquery-step/jquery.steps.css"> -->
    <link rel="stylesheet" type="text/css" href="/plugins/select2/select2.min.css">

     <style>
        #formValidate .wizard > .content {height: 50em;}
        #example-vertical.wizard > .content {height: 50em;}
        .wizard .content {

}
/* .wizard .content > .body {
    width: 100%;
    height: auto;
    padding: 15px;
    position: absolute;
}
.wizard .content .body.current {
    position: relative; */
}
    </style>
    <!--  END CUSTOM STYLE FILE  -->
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    @yield('head')


    <style>
        /*
            The below code is for DEMO purpose --- Use it if you are using this demo otherwise Remove it
        */
        /*.navbar .navbar-item.navbar-dropdown {
            margin-left: auto;
        }*/
        .layout-px-spacing {
            min-height: calc(100vh - 170px)!important;
        }

    </style>
<style>

   .loader {
    height: 100%;
    position: absolute;
    width: 100%;
    z-index: 1000;
    background: #fcfcfc url("http://www.mvgen.com/loader.gif") no-repeat scroll center center / 120px 120px;
    top: 0;
    left: 0;
    opacity: 0.5;

    
}
.table{
text-align: center;
    }
</style>
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

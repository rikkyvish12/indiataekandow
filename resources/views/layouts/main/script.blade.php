
<script src="{{ url('js/jquery-3.3.1.min.js') }}"></script> 
<script src="{{ url('js/jquery-migrate-3.0.1.js') }}"></script> 
<script src="{{ url('js/popper.min.js') }}"></script> 
<script src="{{ url('js/bootstrap.min.js') }}"></script> 
<script src="{{ url('js/mobile-nav.js') }}"></script> 
<script src="{{ url('js/owl.carousel.min.js') }}"></script> 
<script src="{{ url('js/isotope.js') }}"></script> 
<script src="{{ url('js/jquery.prettyPhoto.js') }}"></script> 
<script src="{{ url('js/jquery.countdown.js') }}"></script> 
<script src="{{ url('js/custom.js') }}"></script> 
<script src="{{ url('js/jquery.steps.js') }}"></script>






@if(\Request::is('admin/album*')) 

<script src="{{ url('js/image-album-wizard.js') }}"></script>
@elseif(\Request::is('image_gallery*'))
<!--Nano GALLERY plugins start-->
    
<script type='text/javascript' src='{{ url('bootstrap/js/bootstrap.min.js') }}'></script>
    <script type='text/javascript' src='{{ url('nanogallery/jquery.nanogallery2.min.js') }}'></script>
    <script type='text/javascript' src='{{ url('nanogallery/jquery.nanogallery2.core.min.js') }}'></script>
    <script type='text/javascript' src='{{ url('nanogallery/jquery.nanogallery2.data_flickr.min.js') }}'></script>
    <script type='text/javascript' src='{{ url('nanogallery/jquery.nanogallery2.data_google3.min.js') }}'></script>
    <script type='text/javascript' src='{{ url('nanogallery/jquery.nanogallery2.data_nano_photos_provider2.min.js') }}'></script>


    <script>
    $("#nanogallery2").nanogallery2({
        galleryTheme: {
          thumbnail : { background: rgba(0,0,0,0.5), borderColor: '#E81F3E' }
        },
        viewerTheme : { barColor: '#E81F3E' },
      });
      </script>
<!--Nano GALLERY plugins end-->
@elseif(\Request::is('admin/video_album*'))

  <script src="{{ url('js/video-album-wizard.js') }}"></script>
  <script>    
  $('#addYoutubeLinkToFinalObjectButton').trigger('click');
 </script> 
@elseif(\Request::is('admin/committee*'))

<script src="{{ url('js/committee-wizard.js') }}"></script>
<script>    
$('#addCommitteeMembersToFinalObjectButton').trigger('click');
</script> 
@endif


<!--Rev Slider Start--> 
<script type="text/javascript" src="{{ url('js/rev-slider/js/jquery.themepunch.tools.min.js') }}"></script> 
<script type="text/javascript" src="{{ url('js/rev-slider/js/jquery.themepunch.revolution.min.js') }}"></script> 
<script type="text/javascript" src="{{ url('js/rev-slider.js') }}"></script> 
<script type="text/javascript" src="{{ url('js/rev-slider/js/extensions/revolution.extension.actions.min.js') }}"></script> 
<script type="text/javascript" src="{{ url('js/rev-slider/js/extensions/revolution.extension.carousel.min.js') }}"></script> 
<script type="text/javascript" src="{{ url('js/rev-slider/js/extensions/revolution.extension.kenburn.min.js') }}"></script> 
<script type="text/javascript" src="{{ url('js/rev-slider/js/extensions/revolution.extension.layeranimation.min.js') }}"></script> 
<script type="text/javascript" src="{{ url('js/rev-slider/js/extensions/revolution.extension.migration.min.js') }}"></script> 
<script type="text/javascript" src="{{ url('js/rev-slider/js/extensions/revolution.extension.navigation.min.js') }}"></script> 
<script type="text/javascript" src="{{ url('js/rev-slider/js/extensions/revolution.extension.parallax.min.js') }}"></script> 
<script type="text/javascript" src="{{ url('js/rev-slider/js/extensions/revolution.extension.slideanims.min.js') }}"></script> 
<script type="text/javascript" src="{{ url('js/rev-slider/js/extensions/revolution.extension.video.min.js') }}"></script>
<script>
  $('#myCarousel').carousel({
  interval: 5000
})


</script>
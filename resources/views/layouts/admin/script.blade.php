   <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
   <script src="{{ url('/assets/js/libs/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ url('/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ url('/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ url('/assets/js/app.js') }}"></script>
    <script src="{{ url('/assets/ckeditor/ckeditor.js') }}"></script>
    
    {{-- <script src="{{ url('assets/summernote/summernote-bs4.js') }}"></script> --}}
    {{-- <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script> --}}

    
     <script>
        $(document).ready(function() {
            $('.loader').hide()
            $(".select_2").select2();

            // $('#addYoutubeLinkToFinalObjectButton').trigger('click');

            // App.init();
            // libxml_use_internal_errors(true);

    //     $('.summernote').summernote({
    //         styleTags: [
    // 'p',
    //     { title: 'Blockquote', tag: 'blockquote', className: 'blockquote', value: 'blockquote' },
    //     'pre', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'
	// ],
    //     });
    $(".noZeroAtStart").on("input", function() {
  if (/^0/.test(this.value)) {
    this.value = this.value.replace(/^0/, "")
  }
})
$('.noSpace').keyup(function() {
 this.value = this.value.replace(/^\s/g,'');
});

$('[data-toggle="tooltip"]').tooltip();   



   
        });
        function deleteEntry(e,formId){  
           

                e.preventDefault();
                var form = e.target.form;
                   swal({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        buttons:{
                            confirm: {
                                text : 'Yes, delete it!',
                                className : 'btn btn-success'
                            },
                            cancel: {
                                visible: true,
                                className: 'btn btn-danger'
                            }
                        }
                    }).then((Delete) => {
                      
                        console.log(Delete); //This will be true when delete is clicked
                        if (Delete) {
                            swal({
                            title: 'Deleting.., Please wait!',
                            text: 'Do not refresh or Press back button',
                            padding: '2em',
                            button:false,
                            onOpen: function () {
                            swal.showLoading()
                            }
                        });
                           // $form.submit();//Submit your Form Here. 
                           $('#'+formId).submit(); //Use same Form Id to submit the Form.
                        }
                    });
}

    function goBack(url) {
        window.location = url; //specify the url to redirect
    }
        </script> 
         <script src="/plugins/file-upload/file-upload-with-preview.min.js"></script>	
    <script src="{{ url('/assets/js/custom.js') }}"></script>
    <script src="{{ url('/js/jquery.steps.js') }}"></script>
   

    @if(\Request::is('admin/album/create')) 

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="/assets/js/scrollspyNav.js"></script>
    <script src="/plugins/jquery-step/jquery.steps.min.js"></script>
    <script src="/plugins/jquery-step/custom-jquery.steps.js"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <script src="{{ url('/js/image-album-wizard.js') }}"></script>
   
    <script>
    
        function resizeJquerySteps() {
     $('.wizard .content').animate({
        height: $('.body.current').outerHeight()
    }, 'slow');
}
</script>
@elseif(\Request::is('admin/album/*/edit'))
<script src="{{ url('/js/edit-image-album.js') }}"></script>
<script>
$('#addAllFoldersNameToArrayButton').trigger('click');

// $(window).resize($.debounce(250, resizeJquerySteps));
</script>

    @elseif(\Request::is('admin/video_album*'))

<script src="{{ url('/js/video-album-wizard.js') }}"></script>
  <script>    
  $('#addYoutubeLinkToFinalObjectButton').trigger('click');
 </script> 

@elseif(\Request::is('admin/committee*'))

<script src="{{ url('/js/committee-wizard.js') }}"></script>
<script>    
$('#addCommitteeMembersToFinalObjectButton').trigger('click');
</script> 
@elseif(\Request::is('admin/commission*'))

<script src="{{ url('/js/commission-wizard.js') }}"></script>
<script>    
$('#addCommissionMembersToFinalObjectButton').trigger('click');
</script> 
<!-- manage association js -->
@elseif(\Request::is('assoc_admin/committee*'))
<script src="{{ url('/js/association/committee-wizard.js') }}"></script>

@elseif(\Request::is('assoc_admin/album_image/create*'))

<script src="{{ url('/js/association/image-album-wizard.js') }}"></script>

@elseif(\Request::is('assoc_admin/album_image/edit*'))

<script src="{{ url('/js/association/edit-image-album.js') }}"></script> 
<script>
$('#addAllFoldersNameToArrayButton').trigger('click');

// $(window).resize($.debounce(250, resizeJquerySteps));
</script>

@elseif(\Request::is('assoc_admin/album_video*'))
<script src="{{ url('/js/association/video-album-wizard.js') }}"></script>

<script>    
  $('#addYoutubeLinkToFinalObjectButton').trigger('click');
 </script> 


 
<!-- manage event js -->
@elseif(\Request::is('event_admin/album_image/create*'))

<script src="{{ url('/js/event/image-album-wizard.js') }}"></script>

@elseif(\Request::is('event_admin/album_image/edit*'))

<script src="{{ url('/js/event/edit-image-album.js') }}"></script> 
<script>
$('#addAllFoldersNameToArrayButton').trigger('click');

// $(window).resize($.debounce(250, resizeJquerySteps));
</script>

@elseif(\Request::is('event_admin/album_video*'))
<script src="{{ url('/js/event/video-album-wizard.js') }}"></script>

<script>    
  $('#addYoutubeLinkToFinalObjectButton').trigger('click');
 </script> 




@endif

<script src="/plugins/select2/select2.min.js"></script>
<script src="/plugins/select2/custom-select2.js"></script>
<script>
          
         var Imagepreview1 = new FileUploadWithPreview('Imagepreview1')
         //Second upload
         var Imagepreview2 = new FileUploadWithPreview('Imagepreview2')
         // Third upload
         var Imagepreview3 = new FileUploadWithPreview('Imagepreview3')
        //Fourth upload
        var Imagepreview4 = new FileUploadWithPreview('Imagepreview4')

     </script>

    <!-- END GLOBAL MANDATORY SCRIPTS -->


    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
        @yield('script')
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->


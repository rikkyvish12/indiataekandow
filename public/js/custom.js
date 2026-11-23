jQuery(document).ready(function($) {
    "use strict"
    // Header scroll class
    if ($('#main-header').length) {
        $(window).scroll(function() {
            if ($(this).scrollTop() > 100) {
                $('#main-header').addClass('header-scrolled');
            } else {
                $('#main-header').removeClass('header-scrolled');
            }
        });
        if ($(window).scrollTop() > 100) {
            $('#main-header').addClass('header-scrolled');
        }
    }
    // Smooth scroll for the navigation and links with .scrollto classes
    if ($('.main-nav a').length) {
        $('.main-nav a, .mobile-nav a, .scrollto').on('click', function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                var target = $(this.hash);
                if (target.length) {
                    var top_space = 0;
                    if ($('#main-header').length) {
                        top_space = $('#main-header').outerHeight();
                        if (!$('#main-header').hasClass('header-scrolled')) {
                            top_space = top_space - 40;
                        }
                    }
                    $('html, body').animate({
                        scrollTop: target.offset().top - top_space
                    }, 1500, 'easeInOutExpo');
                    if ($(this).parents('.main-nav, .mobile-nav').length) {
                        $('.main-nav .active, .mobile-nav .active').removeClass('active');
                        $(this).closest('li').addClass('active');
                    }
                    if ($('body').hasClass('mobile-nav-active')) {
                        $('body').removeClass('mobile-nav-active');
                        $('.mobile-nav-toggle i').toggleClass('fa-times fa-bars');
                        $('.mobile-nav-overly').fadeOut();
                    }
                    return false;
                }
            }
        });
    }
    // ------- Pretty Photo Start ------- // 
    if ($('.gallery').length) {
        $("area[data-rel^='prettyPhoto']").prettyPhoto();
        $(".gallery:first a[data-rel^='prettyPhoto']").prettyPhoto({
            animation_speed: 'normal',
            theme: 'light_square',
            slideshow: 3000,
            autoplay_slideshow: false
        });
    }
    // ------- Pretty Photo End ------- // 
    // ------- Home Slider Start ------- //
    if ($('#home-slider').length) {
        $('#home-slider').owlCarousel({
            margin: 0,
            nav: false,
            dots: false,
            items: 1,
            autoplay: true,
            responsiveClass: true,
        })
    }
    // ------- Home Slider End ------- //
    // ------- Home Slider Start ------- //
    if ($('#awards-slider').length) {
        $('#awards-slider').owlCarousel({
            margin: 0,
            nav: false,
            dots: false,
            items: 1,
            autoplay: true,
            responsiveClass: true,
        })
    }
    // ------- Home Slider End ------- //
    // ------- Home Slider Start ------- //
    if ($('#post-slider').length) {
        $('#post-slider').owlCarousel({
            margin: 0,
            nav: true,
            dots: false,
            items: 1,
            autoplay: false,
            responsiveClass: true,
        })
    }
    // ------- Home Slider End ------- //
    // ------- Side Products Start ------- //
    if ($('#side-products').length) {
        $('#side-products').owlCarousel({
            margin: 0,
            nav: true,
            dots: false,
            items: 1,
            autoplay: true,
            responsiveClass: true,
        })
    }
    // ------- Side Products End ------- //
    // ------- Home Slider Start ------- //
    if ($('#pro-slider').length) {
        $('#pro-slider').owlCarousel({
            loop: true,
            margin: 30,
            dots: false,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: true
                },
                600: {
                    items: 2,
                    nav: false
                },
                1000: {
                    items: 3,
                    nav: true,
                    loop: false
                }
            }
        })
    }
    // ------- Home Slider End ------- //
    // ------- News Slider Start ------- //
    // var owlCarouselTimeout = 1000;

    if ($('#newsupdate-slider').length) {
        $('#newsupdate-slider').owlCarousel({
            items:4,
            loop:true,
            margin:30,
            autoplay:true,
            autoplayTimeout: 2000,
            autoplaySpeed: 1000,
            autoplayHoverPause:true,
            responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 2,
                },
                1000: {
                    items: 3,
                    loop: true
                }
            }
        })

        // $('#newsupdate-slider').on('mouseleave',function(){
        //     owl.trigger('stop.owl.autoplay'); //this is main line to fix it
        //     owl.trigger('play.owl.autoplay', [owlCarouselTimeout]);
        //  })
    }

    // ------- News Slider End ------- //
     // ------- News2 Slider Start ------- //
     if ($('#newsupdate-slider2').length) {
        $('#newsupdate-slider2').owlCarousel({
            items:4,
            loop:true,
            margin:30,
            autoplay:true,
            autoplayTimeout: 2000,
            autoplaySpeed: 1000,
            autoplayHoverPause:true,
            responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 2,
                },
                1000: {
                    items: 3,
                    loop: true
                }
            }
        })
    }
    // ------- News2 Slider End ------- //
      // ------- News2 Slider Start ------- //
      if ($('#newsupdate-slider3').length) {
        $('#newsupdate-slider3').owlCarousel({
            items:4,
            loop:true,
            margin:30,
            autoplay:true,
            autoplayTimeout: 2000,
            autoplaySpeed: 1000,
            autoplayHoverPause:true,
            responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 2,
                },
                1000: {
                    items: 3,
                    loop: true
                }
            }
        })
    }
    // ------- News2 Slider End ------- //
    // ------- News Slider Start ------- //
    if ($('#videonews-slider').length) {
        $('#videonews-slider').owlCarousel({
            loop: true,
            margin: 30,
            dots: true,
            responsiveClass: true,
            nav: false,
            responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 2,
                },
                1000: {
                    items: 3,
                    loop: false
                }
            }
        })
    }
    // ------- News Slider End ------- //
    // ------- Product Slider Start ------- //
    if ($('#top-stories').length) {
        $('#top-stories').owlCarousel({
            margin: 0,
            nav: true,
            dots: true,
            items: 1,
            responsiveClass: true,
        })
    }
    // ------- Product Slider End ------- //
    if ($('audio').length) {
        $(function() {
            $('audio').audioPlayer();
        });
    }
    // ------- countdown ------- //
    if ($('.defaultCountdown').length) {
        var austDay = new Date();
        austDay = new Date(austDay.getFullYear() + 1, 1 - 1, 26);
        $('.defaultCountdown').countdown({
            until: austDay
        });
        $('#year').text(austDay.getFullYear());
    }
    // ------- countdown End ------- // 

    // ------- News Grid ------- //
    if ($('.news-gallery .isotope').length) {
        if ($('.news-gallery .isotope').length) {
            var $container = $('.news-gallery .isotope');
            $container.isotope({
                itemSelector: '.item',
                transitionDuration: '0.6s',
                masonry: {
                    columnWidth: $container.width() / 12
                },
                layoutMode: 'masonry'
            });
            $(window).on('click', function() {
                $container.isotope({
                    masonry: {
                        columnWidth: $container.width() / 12
                    }
                });
            });
        }
    }
    // ------- News Grid ------- //
    if ($('.classic-gallery .isotope').length) {
        if ($('.classic-gallery .isotope').length) {
            var $container = $('.classic-gallery .isotope');
            $container.isotope({
                itemSelector: '.item',
                transitionDuration: '0.6s',
                masonry: {
                    columnWidth: $container.width() / 12
                },
                layoutMode: 'masonry'
            });
            $(window).on('click', function() {
                $container.isotope({
                    masonry: {
                        columnWidth: $container.width() / 12
                    }
                });
            });
        }
    }
    // ------- News Grid ------- //
    if ($('.massonry-gallery .isotope').length) {
        if ($('.massonry-gallery .isotope').length) {
            var $container = $('.massonry-gallery .isotope');
            $container.isotope({
                itemSelector: '.item',
                transitionDuration: '0.6s',
                masonry: {
                    columnWidth: $container.width() / 12
                },
                layoutMode: 'masonry'
            });
            $(window).on("click", function() {
                $container.isotope({
                    masonry: {
                        columnWidth: $container.width() / 12
                    }
                });
            });
        }
    }
    // ------- Home Slider Start ------- //
    if ($('#h3-twitter-slider').length) {
        $('#h3-twitter-slider').owlCarousel({
            margin: 0,
            dots: true,
            items: 1,
            autoplay: true,
            responsiveClass: true,
        })
    }
    // ------- Home Slider End ------- //
    if ($('.h3-match-counter .hide').length) {
        $(".h3-match-counter .hide").on('click', function() {
            $(this).parents(".h3-match-counter").hide("slow");
        });
    }
    // ------- Home Slider Start ------- //
    if ($('#player-slider').length) {
        $('#player-slider').owlCarousel({
            loop: true,
            margin: 30,
            dots: true,
            nav: false,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 2,
                },
                1000: {
                    items: 4,
                }
            }
        })
    }
    // ------- Home Slider End ------- //



    // ------- Search Overlay Start ------- //
    if ($('a[href="#search"]').length) {
        $(function() {
            $('a[href="#search"]').on('click', function(event) {
                event.preventDefault();
                $('#search').addClass('open');
                $('#search > form > input[type="search"]').focus();
            });
            $('#search, #search button.close').on('click keyup', function(event) {
                if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
                    $(this).removeClass('open');
                }
            });
            $('form').submit(function(event) {
                event.preventDefault();
                return false;
            })
        });
    }

    // ------- Search Overlay End ------- //




    // ------- Filter Gallery Start ------- //
    if ($('.filter-gallery').length) {
        if ($('.filter-gallery .isotope').length) {
            var $container = $('.filter-gallery .isotope');
            $container.isotope({
                itemSelector: '.item',
                transitionDuration: '0.6s',
                masonry: {
                    columnWidth: $container.width() / 12
                },
                layoutMode: 'masonry'
            });
            $(window).on("resize", function() {
                $container.isotope({
                    masonry: {
                        columnWidth: $container.width() / 12
                    }
                });
            });
        }
        if ($('.filter-gallery #filters').length) {
            $('.filter-gallery #filters').on('click', 'button', function() {
                var filterValue = $(this).attr('data-filter');
                $container.isotope({
                    filter: filterValue
                });
            });
            // change is-checked class on buttons
            $('.filter-gallery .button-group').each(function(i, buttonGroup) {
                var $buttonGroup = $(buttonGroup);
                $buttonGroup.on('click', 'button', function() {
                    $buttonGroup.find('.is-checked').removeClass('is-checked');
                    $(this).addClass('is-checked');
                });
            });
        }
    }
}); //End

function joinTFI(form_name){
// alert()
$('#error_email').val('')
            var allow= true;   
            var hasErrorArray=[];
            var removeErrorArray=[];
        
         $('.joinTfiInputs').each(function() {     //input text/number validation
          var sickfull = $(this).val().trim();
         
            if (sickfull == "")
            {
              hasErrorArray.push({'id':$(this).attr('id'),'placeholder':$(this).attr('placeholder')});       
            }
            else{
              removeErrorArray.push({'id':$(this).attr('id'),'placeholder':$(this).attr('placeholder')});       
              // $(this).removeClass('border border-danger');
              //  $('#error_'+id).html('')
            }                    
        
         });
          console.log(hasErrorArray)
          console.log(removeErrorArray)
        
          if(hasErrorArray.length > 0 ){
            // $('.error_span').html('');
            for (let index = 0; index < hasErrorArray.length; index++) {
            
              $('#'+hasErrorArray[index].id).addClass('border border-danger');
              $('#error_'+hasErrorArray[index].id).html('').append('<span class="text-danger" style="font-size:8pt;display:block;">'+hasErrorArray[index].placeholder+' input cannot be empty.</span>')
              
              // $('#'+hasErrorArray[0].id).focus();
              
              setTimeout(function() { document.getElementById(hasErrorArray[0].id).focus(); }, 10);
                }
                allow = false;   
            }
              
          
          if(removeErrorArray.length > 0 ){
              
                
                  for (let index = 0; index < removeErrorArray.length; index++) {
                    $('#'+removeErrorArray[index].id).removeClass('border border-danger');
                    $('#error_'+removeErrorArray[index].id).html('')
        
                        const index2 = removeErrorArray.indexOf(removeErrorArray[index].id)
                        if (index2 > -1) {
                          removeErrorArray.splice(index2, 1);
                        }
                  }
          }

          var email =$('#email').val().trim();
          if(email.length > 0){
            if (isEmailAddress(email)) {
                $('#error_email').val('').removeClass('border border-danger');
              }else{
                allow = false; 
    
                $('#email').addClass('border border-danger');
                setTimeout(function() { document.getElementById('email').focus(); }, 10);
                $('#error_email').val('').append('<span class="text-danger" style="font-size:8pt;display:block;">Not a valid Email-Address</span>')
                   
                    
    
              }
          }
         
          
        console.log(allow)

          
          
            if(!allow)
            {
              return allow;
            }

            makeData(form_name)

}

function makeData(form_name){
         

    var data = new FormData();
    
    data.append("_token", $("#_token").val()); 
    data.append("form_name", form_name);
    data.append("full_name",$('#full_name').val());
    data.append("address",$('#address').val());
    data.append("state",$('#state option:selected').text());
    data.append("contact",$('#contact').val());
    data.append("email",$('#email').val());

   


    
    switch(form_name) {
        case "individual":            
            data.append("identity",$('#identity').val());    
          break;
          
        case "sponsor":            
            data.append("org_name",$('#org_name').val());
            data.append("designation",$('#designation').val());          
            data.append("website",$('#website').val());
            data.append("message",$('#message').val());
          break;
       
          case 'academy':            
            data.append("full_name_club",$('#full_name_club').val());
            data.append("designation",$('#designation').val());           
            data.append("website",$('#website').val());
            data.append("social_media",$('#social_media').val());
            data.append("message",$('#message').val());
          break;
          case 'district':
            data.append("district",$('#district option:selected').text());           
            data.append("website",$('#website').val());
            data.append("social_media",$('#social_media').val());
            data.append("message",$('#message').val());
          break;

          case 'state':
            data.append("district",$('#district option:selected').text());            
            data.append("website",$('#website').val());
            data.append("social_media",$('#social_media').val());
            data.append("message",$('#message').val());
          break;
        //   case 'volunteer':
        //     data.append("full_name",$('#full_name').val());
        //     data.append("district",$('#district option:selected').text());            
        //     data.append("website",$('#website').val());
        //     data.append("social_media",$('#social_media').val());
        //   break;
        default:
            break;  
          // code block
      }




    sendData(data)
    
}
function sendData(data){
// alert("submitted")
// console.log()
//  data = data.entries();              
//         var obj = data.next();
//         var retrieved = {};             
//         while(undefined !== obj.value) {    
//             retrieved[obj.value[0]] = obj.value[1];
//             obj = data.next();
//         }
//         console.log('retrieved: ',retrieved);
      
//         return false;

$.ajax({

    type: "POST",
    
    url: "/tfiSendEmail",
    data: data,
    processData: false,
    contentType: false ,
    cache: false, 
    
      beforeSend: function(){
          $('#loader-modal').modal('show')
       
    },
    complete: function(){
    
        $('#loader-modal').modal('hide')

    
    },
    success:function(response){
      var data = JSON.parse(response);
        if(data != ""){
          if(data.status == "success"){
            
              console.log(data)
            //   alert()
            $('#launch_toast_1').trigger('click');
            // console.log($('#launch_toast_1'))

            $('.clearTfiFormInputs').val('');
            // $('.clearTfiFormSelects').val('').trigger('change');
            $(".clearTfiFormSelects").prop("selectedIndex", 15);


           
         } 
         if(data.status == "exist"){
            $('#tfi_modal_body').html('').append('<span class="text-danger" style="">You have already put a request with entered combination of Email-id and Contact, kindly use different inputs to proceed. </span>')
            $('#errorModal').modal('show')
         }
         else{
            
          console.log(data)
          
                // swal({
                //     title: "Edit Album ",
                //     text: "Failed to update product details",
                //     icon: "error"
                //   });             
                  
              } 
     
      
    }else{
     
    }
    }
     });
}

function isEmailAddress(str) {
    var pattern =/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    return pattern.test(str);  // returns a boolean 
 }

 function contactUs(type){
    // alert()
   
                var allow= true;   
                var hasErrorArray=[];
                var removeErrorArray=[];
            
             $('.contactUs').each(function() {     //input text/number validation
              var sickfull = $(this).val().trim();
             
                if (sickfull == "")
                {
                  hasErrorArray.push({'id':$(this).attr('id'),'placeholder':$(this).attr('placeholder')});       
                }
                else{
                  removeErrorArray.push({'id':$(this).attr('id'),'placeholder':$(this).attr('placeholder')});       
                  // $(this).removeClass('border border-danger');
                  //  $('#error_'+id).html('')
                }                    
            
             });
              console.log(hasErrorArray)
              console.log(removeErrorArray)
            
              if(hasErrorArray.length > 0 ){
                // $('.error_span').html('');
                for (let index = 0; index < hasErrorArray.length; index++) {
                
                  $('#'+hasErrorArray[index].id).addClass('border border-danger');
                  $('#error_'+hasErrorArray[index].id).html('').append('<span class="text-danger" style="font-size:8pt;display:block;">'+hasErrorArray[index].placeholder+' input cannot be empty.</span>')
                  
                  // $('#'+hasErrorArray[0].id).focus();
                  
                  setTimeout(function() { document.getElementById(hasErrorArray[0].id).focus(); }, 10);
                    }
                    allow = false;   
                }
                  
              
              if(removeErrorArray.length > 0 ){
                  
                    
                      for (let index = 0; index < removeErrorArray.length; index++) {
                        $('#'+removeErrorArray[index].id).removeClass('border border-danger');
                        $('#error_'+removeErrorArray[index].id).html('')
            
                            const index2 = removeErrorArray.indexOf(removeErrorArray[index].id)
                            if (index2 > -1) {
                              removeErrorArray.splice(index2, 1);
                            }
                      }
              }
    
              var email =$('#email').val().trim();
              if(email.length > 0){
                if (isEmailAddress(email)) {
                    $('#error_email').val('').removeClass('border border-danger');
                  }else{
                    allow = false; 
        
                    $('#email').addClass('border border-danger');
                    setTimeout(function() { document.getElementById('email').focus(); }, 10);
                    $('#error_email').val('').append('<span class="text-danger" style="font-size:8pt;display:block;">Not a valid Email-Address</span>')
                       
                        
        
                  }
              }
             
              
            console.log(allow)
    
              
              
                    if(!allow)
                    {
                    return allow;
                    }
    
                    var data = new FormData();
        
                    data.append("_token", $("#_token").val()); 
                    data.append("type",type);
                 if(type ==='assoc')
                    data.append("assoc_id",$('#assoc_id').val());

                    data.append("full_name",$('#full_name').val());
                    data.append("email",$('#email').val());
                    data.append("contact",$('#contact').val());
                    data.append("subject",$('#subject').val());
                    data.append("message",$('#message').val());
            
                    $.ajax({

                        type: "POST",
                        
                        url: "/contactUs",
                        data: data,
                        processData: false,
                        contentType: false ,
                        cache: false, 
                        
                          beforeSend: function(){
                              $('#loader-modal').modal('show')
                           
                        },
                        complete: function(){
                        
                            $('#loader-modal').modal('hide')
                    
                        
                        },
                        success:function(response){
                          var data = JSON.parse(response);
                            if(data != ""){
                              if(data.status == "success"){
                                
                                  console.log(data)
                                //   alert()
                                $('#launch_toast_1').trigger('click');
                                // console.log($('#launch_toast_1'))
                    
                                $('.clearContactFormInputs').val('');
                    
                               
                             } 
                             if(data.status == "exist"){
                                $('#contact_modal_body').html('').append('<span class="text-danger" style="">You have already put a request with entered combination of Email-id and Contact, kindly use different inputs to proceed. </span>')
                                $('#errorModal').modal('show')
                             }
                             else{
                                
                              console.log(data)
                              
                                    // swal({
                                    //     title: "Edit Album ",
                                    //     text: "Failed to update product details",
                                    //     icon: "error"
                                    //   });             
                                      
                                  } 
                         
                          
                        }else{
                         
                        }
                        }
                         });
    }
    
var originalFileNameInput = ""//"#{id:originalFileNameInput}";
var fileUpload = ""//"#{id:fileUpload}";
var uploadedByInput = ""//"#{id:uploadedByInput}";
var fileSizeInput = ""//"#{id:fileSizeInput}";
//var $fileDropDiv = $('#{id:fileDropDiv}');
var $uploadTableDiv = $("#uploadTableDiv");
var fileUploadUrl = "sharing";
var $fileUploadBtn = $("#fileUploadBtn");
var validExtensions = /png|jpg|jpeg/; // regular expression of allowed file types
var validVideoExtensions ;
var isImage = /image\/*/;
var maxFileSize = 10; //max files size in MB
var validFileList = []; //we need a global variable to modify the filelist
var validDocImage = []; //we need a global variable to modify the sellerImage
var $uploadQueueTable = $('#uploadQueueTable');
var uploadType = "gallery";
var _URL = window.URL || window.webkitURL;
var widthMax = 0;
var widthMin = 0;
var heightMax = 0;
var heightMin = 0;
var resWidth = 380;
var resHeight = 500;
var addRowCol="";

var counter = 1;
var youtubeLinkClassArray = [];
var finalYoutubeLinkClassArray=[];


var videoAlbumForm = $("#new_video_album");
 



videoAlbumForm.val({
  errorPlacement: function errorPlacement(error, element) {
    element.before(error);
  },
  rules: {
    confirm: {
      equalTo: "#password"
    }
  }
});
videoAlbumForm.children("div").steps({
  headerTag: "h5",
  bodyTag: "section",
  transitionEffect: "slideLeft",
  onStepChanging: function (event, currentIndex, newIndex) {
    if (currentIndex < newIndex) {
      if (stepValidation(currentIndex)) {
        videoAlbumForm.val({
          ignore: [":disabled", ":hidden"]
        })
        console.log(event)
        return videoAlbumForm.val();
      }
    }else{
      videoAlbumForm.val({
        ignore: [":disabled", ":hidden"]
      })
      console.log(event)
      return videoAlbumForm.val();
    }
  },
  onFinishing: function(event, currentIndex) {
    videoAlbumForm.val({
      ignore: [':disabled']
    })
    return videoAlbumForm.val();
  },
  onFinished: function(event, currentIndex) {
   
    if($(".youtubeLinkInputClass").length === 0 ){
      swal({
        title: "Are you sure?",
        text: "No youtubelink added yet. Still want to proceed \n Also, You can add youtube link in edit album option",
        icon: "warning",
        buttons: ["Cancel", "Yes"],
        dangerMode: false,
      })
      .then((proceed) => {
        if (proceed) {
           verifyYoutubeLinkBeforeSubmit()
        } else {
         
        }
      });	
    }else{
      verifyYoutubeLinkBeforeSubmit()
    }
  }
  
  
});

function stepValidation(currentIndex){
  // alert(currentIndex)
  console.log("currentIndex", currentIndex)
  // return true
  if (currentIndex == 0) {
 
    // console.log()
    var allow= true;   
    var hasErrorArray=[];
    var removeErrorArray=[];

 $('.create_album_require').each(function() {     //input text/number validation
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
  
console.log(allow)
  
      return allow;


                 
                  // return true;
    
  } 
  
  else{
    // return false;
  }

 

}

function updateSelectedAlbumDetails()
{
      //  alert()
        try {
            //  console.log(allFiles.length)

          
            var allow= true;   
            var hasErrorArray=[];
            var removeErrorArray=[];
        
         $('.edit_album_require').each(function() {     //input text/number validation
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
          
        console.log(allow)

          
          
            if(!allow)
            {
              return allow;
            }

              var album_type = $('#album_type').val()
              console.log(finalYoutubeLinkClassArray)
              const fileInput = document.getElementById('fileToUpload');
              const selectedFile = fileInput.files[0];            
    
              var data = new FormData();
    
              data.append("_token", $("#_token").val());  
              data.append("selected_album_id", $("#selected_album_id").val());
              data.append("album_name_input", $("#album_name_input").val());


              if(album_type ==="1"){
                data.append("album_type", album_type);                 
              }else if(album_type ==="2"){
                data.append("event_id", $("#event_id").val());         
                data.append("album_type", album_type);         
              }else{
    
              }
              // data.append('file[]', validFileList[0]);    
              
              if (selectedFile) {
                
                data.append("cover_image_file", selectedFile);
              }
             
              data.append("date_time", $("#date_time").val());
              // data.append('finalYoutubeLinkClassArray',JSON.stringify(finalYoutubeLinkClassArray));
    
    
             
              // data = data.entries();              
              // var obj = data.next();
              // var retrieved = {};             
              // while(undefined !== obj.value) {    
              //     retrieved[obj.value[0]] = obj.value[1];
              //     obj = data.next();
              // }
              // console.log('retrieved: ',retrieved);
            
              // return false;
            // alert()
              var request = new XMLHttpRequest();
      
              request.upload.addEventListener("progress", function (e) {
                // $('#new_image_album_add_images_button').hide();
              $('.loader').show()
      
      
            $('.hideWhenSubmitting').hide()
    
          
                if (e.lengthComputable) {
                  $("#process_div").show();
                  var progressWidth = Math.floor((e.loaded / e.total) * 100) + '%';
                  $("#outer_percent").html(progressWidth);
                  $("#percent").html(progressWidth);
                  $('#percent').
                    attr('style', 'width: ' + progressWidth);
                  if (progressWidth == "100%") {             
                  
                    $("#data_processing").show();
                  }
                }
                
              });
              request.addEventListener("load", function () {
              
                document.getElementById('fileToUpload').value = "";
                validFileList.length = 0;
                // validDocImage=[]
      
                youtubeLinkClassArray=[];
                 // reset cover image  hidden fields
                  // $('#getValueForAlbumCover').val('')
                  // $('#getValueForAlbumCoverIndex').val('')
              
              });
              request.addEventListener("error", function () {
              
              
          
                $('.hideWhenSubmitting').show()
                
              });
              request.addEventListener('readystatechange', function () {
                $('.loader').hide()
    
                if (this.readyState === 4) {
                  var response = [];
      //console.log(request.responseText);
                response = JSON.parse(request.responseText);
                //  var count = JSON.stringify(response);
                if (response != "") {
      
                    switch (response.status) {
                      case "success":
                        validDocImage = [];
                        // showSwal('added-new-product',"Success","Created Successfully");
                        swal({
                          title: "Update-Video-Album!",
                          text: "Update Successfully",
                          icon: "success",
                          timer: 1500,              
                          buttons: false
                          });
      
                          setTimeout(
                            function() {
                              window.location.href = window.location.href;
                              //redirect to add new route after interval of 2 sec-
                            }, 2000);
      
      
                       
                              break;
                      
                            }
                          }
                          
                      }
                          });
                   
                    request.open('POST', '/admin/updateSelectedAlbumDetails');
                 
    
              request.setRequestHeader('Cache-Control', 'no-cache');
              //  document.getElementById('upload_progress').style.display="block";
      
      
      
              request.send(data);
          
          
        } catch (e) {
      
        }
}

function createInputToAcceptYoutubeLink()
{
  var result = "";
  // result += '<table class="table" >';

  result += '<tr id="mainYoutubeInsertedRow_'+counter+'" class="hideWhenSubmitting">';

  result +='<td>';                              
  result += '<input type=text class="form-control youtubeLinkInputClass" id="youtubeInput_'+counter+'" placeholder="Youtube link" >'
  result += '</td>'; 
  
  result +='<td>';                              
  result += '<span id="emptySpan_'+counter+'" style="display:none"></span>';   
                             
  result += '<button type="button" class="btn btn-outline-success verifyYoutubeLinkButton"  id="verifyYoutubeLinkInsertedButton_'+counter+'"  onclick="verifyYoutubeLinkInserted('+counter+')">Verify</button>';                              
  result +='</td>'; 

  result +='<td>';                              
  result += '<button type="button" class="btn btn-outline-warning "  id="clearYoutubeLinkInput_'+counter+'"  onclick="clearYoutubeLinkInput('+counter+')"><i style="font-size:12px" class="fa">&#xf021;</i></button>';                              
  result +='</td>';  

  result +='<td>';                              
  result += '<button type="button" onclick="removeYoutubeLinkInputRow('+counter+')" class="btn btn-outline-danger" ><i class=" fa fa-trash  " ></i></button>';                              
  result +='</td>';                              


                              

                             
  

  result +='</tr>';                              
  // result += '</table>';                              
    
// console.log(result)
  $("#video_link_grid").append(result);
 

  
  counter++;
}
function createInputToAcceptYoutubeLinkEdit(object_count)
{
  if($('#fieldToSetCounterUsingObjectSize').val().trim() ==='0')
  
  {
    counter = parseInt(object_count) + 1;
    $('#fieldToSetCounterUsingObjectSize').val('1')
  };
  var result = "";
  // result += '<table class="table" >';

  result += '<tr id="mainYoutubeInsertedRow_'+counter+'" class="hideWhenSubmitting">';

  result +='<td>';                              
  result += '<input type=text class="form-control youtubeLinkInputClass" id="youtubeInput_'+counter+'" placeholder="Youtube link" >'
  result += '</td>'; 
  
  result +='<td>';                              
  result += '<span id="emptySpan_'+counter+'" style="display:none"></span>';   
  result += '<button type="button" class="btn btn-outline-success verifyYoutubeLinkButton"  id="verifyYoutubeLinkInsertedButton_'+counter+'"  onclick="verifyYoutubeLinkInserted('+counter+')">Verify</button>';                              

  result +='</td>'; 

 

  result +='<td>';                              
  result += '<button type="button" class="btn btn-outline-warning "  id="clearYoutubeLinkInput_'+counter+'"  onclick="clearYoutubeLinkInput('+counter+')"><i style="font-size:12px" class="fa">&#xf021;</i></button>';                              
  result +='</td>';  

  result +='<td>';                              
  result += '<button type="button" onclick="removeYoutubeLinkInputRow('+counter+')" class="btn btn-outline-danger" ><i class=" fa fa-trash  " ></i></button>';                              
  result +='</td>';                              


                              

                             
  

  result +='</tr>';                              
  // result += '</table>';                              
    
// console.log(result)
  $("#video_link_grid").prepend(result);
 

  
  counter++;
}

function verifyYoutubeLinkInserted(counter)
{
  var youtubeInputValue = $('#youtubeInput_'+counter).val();
  //console.log(youtubeInputValue)
  var videoid = youtubeInputValue.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);

    if(videoid != null) {
        validVideoId(videoid[1],counter)
    } else { 
      swal({
        title: "Insert youtube Link!",
        text: "Please enter a youtube link",
        icon: "error",
    
        });
    }
      
}

function validVideoId(id,counter) {
  var img = new Image();
  img.src = "http://img.youtube.com/vi/" + id + "/mqdefault.jpg";
  img.onload = function () {
    checkThumbnail(this.width,counter);
  }
}
function checkThumbnail(width,counter) {
  //HACK a mq thumbnail has width of 320.
  //if the video does not exist(therefore thumbnail don't exist), a default thumbnail of 120 width is returned.
  if (width === 120) {
    swal({
      title: "Insert youtube Link!",
      text: "This youtube link doesn't exist..",
      icon: "error",
   
      });
  }else{

    if(checkDuplicate($('#youtubeInput_'+counter).val(),finalYoutubeLinkClassArray) ){
      swal({
        title: "Verify youtube Link!",
        text: "Inserted link already present, please enter a different link",
        icon: "error",
     
        });
        $('#youtubeInput_'+counter).prop('disabled',false);
        $('#youtubeInput_'+counter).val('').trigger('focus');


    }else{
      finalYoutubeLinkClassArray.push($('#youtubeInput_'+counter).val());
      $('#verifyYoutubeLinkInsertedButton_'+counter).hide();

      $('#youtubeInput_'+counter).prop('disabled',true);

      // if (window.location.href.indexOf("edit") > -1) {
      //   // alert()
      //   $('#video_link_grid_from_db').find('#emptySpan_'+counter).show().empty().append('<span style="color:green"><i class="fas fa-check-circle fa-fw fa-lg" ></i>Verified</span>')
      // } 

      $('#video_link_grid').find('#emptySpan_'+counter).show().empty().append('<span style="color:green"><i class="fas fa-check-circle fa-fw fa-lg" ></i>Verified</span>')

    }
    

    console.log(finalYoutubeLinkClassArray)
  }
}

function checkDuplicate(value,array) 
{
  
  // call some function with callback function as argument
  
    
    for(var i=0; i<array.length; i++)  
  {  
      var name = array[i];  
      if(name == value){  
        return true;
      }  
    }  
    return false;
  
 


}

function clearYoutubeLinkInput(counter)
{
  console.log(finalYoutubeLinkClassArray)

  if($('#youtubeInput_'+counter).val() == ""){
    swal({
      title: "Clear youtube Link!",
      text: "Nothing to clear..",
      icon: "error",
   
      });
  }else{

    for (let index = 0; index < finalYoutubeLinkClassArray.length; index++) {
      if($('#youtubeInput_'+counter).val()  === finalYoutubeLinkClassArray[index]){
//alert("in if")
        finalYoutubeLinkClassArray.splice(index, 1);
       
      }      
    }

    for (let index = 0; index < youtubeLinkClassArray.length; index++) {
      if($('#youtubeInput_'+counter).val()  === youtubeLinkClassArray[index]){
        youtubeLinkClassArray.splice(index, 1);
        // alert()
      }      
    }

    $('#youtubeInput_'+counter).prop('disabled',false).val('')
    $('#verifyYoutubeLinkInsertedButton_'+counter).show()
    $('#emptySpan_'+counter).hide()
  }

console.log(finalYoutubeLinkClassArray)

}

function removeYoutubeLinkInputRow(counter)
{
// alert($('#youtubeInput_'+counter).val())
  swal({
    title: "Are you sure?",
    text: "Do you really want to delete this youtube link",
    icon: "warning",
    buttons: ["Cancel", "Yes"],
    dangerMode: false,
  })
  .then((proceed) => {
    if (proceed) {
        console.log(finalYoutubeLinkClassArray)
        
        for (let index = 0; index < finalYoutubeLinkClassArray.length; index++) {
          if($('#youtubeInput_'+counter).val()  === finalYoutubeLinkClassArray[index]){
    //alert("in if")
            finalYoutubeLinkClassArray.splice(index, 1);
           
          }      
        }

        for (let index = 0; index < youtubeLinkClassArray.length; index++) {
          if($('#youtubeInput_'+counter).val()  === youtubeLinkClassArray[index]){
            youtubeLinkClassArray.splice(index, 1);
            // alert()
          }      
        }
        $('#mainYoutubeInsertedRow_'+counter).remove();

        console.log(finalYoutubeLinkClassArray)

    } else {
     
    }
  });	

  
}

function verifyBeforeUpdatingSelectedAlbumYoutubeLinks(){
  if($(".youtubeLinkInputClass").length === 0 ){
    swal({
      title: "Are you sure?",
      text: "No youtubelink add yet. Please add 1 to update",
      icon: "error",
     
    });	
  }else{
    verifyYoutubeLinkBeforeSubmit()
  }
}

function updateSelectedAlbumYoutubeLinks(){
  event.preventDefault();
  event.stopPropagation();
  try {
    console.log(finalYoutubeLinkClassArray)
    
    var data = new FormData();

      // alert()
        data.append("_token", $("#_token").val());       
                     
        // data.append('file[]', validFileList[0]);     
        // data.append("event_name", $("#event_name").val());
        // data.append("album_name", $("#album_name").val());
        // data.append("date_time", $("#date_time").val());
        data.append('finalYoutubeLinkClassArray',JSON.stringify(finalYoutubeLinkClassArray));
        data.append("selected_album_id", $('#selected_album_id').val());
        data.append("event_id", $('#event_id').val());



        // data.append("getValueForAlbumCover", $("#getValueForAlbumCover").val());
        // data.append("getValueForAlbumCoverIndex", $("#getValueForAlbumCoverIndex").val());

        // data.append("model_id", $("#model_select").val());
        
          // data = data.entries();              
          // var obj = data.next();
          // var retrieved = {};             
          // while(undefined !== obj.value) {    
          //     retrieved[obj.value[0]] = obj.value[1];
          //     obj = data.next();
          // }
          // console.log('retrieved: ',retrieved);
        
          // return false;
      // alert()
        var request = new XMLHttpRequest();

        request.upload.addEventListener("progress", function (e) {
          // $('#new_image_album_add_images_button').hide();
        $('.loader').show()

      $('.hideWhenSubmitting').hide()
        
        });
        request.addEventListener("load", function () {
        
          document.getElementById('fileToUpload').value = "";
          validFileList.length = 0;
          // validDocImage=[]

          youtubeLinkClassArray=[];
          finalYoutubeLinkClassArray=[];                  
        });
        request.addEventListener("error", function () {
   
          $('.hideWhenSubmitting').show()
          
        });
        request.addEventListener('readystatechange', function () {
          $('.loader').hide()

          if (this.readyState === 4) {
            var response = [];
//console.log(request.responseText);
          response = JSON.parse(request.responseText);
          //  var count = JSON.stringify(response);
          if (response != "") {

              switch (response.status) {
                case "success":
                  validDocImage = [];
                  // showSwal('added-new-product',"Success","Created Successfully");
                  swal({
                    title: "Update Youtube Links!",
                    text: "Youtube Links has been updated successfully",
                    icon: "success",
                    timer: 1500,              
                    buttons: false
                    });

                    setTimeout(
                      function() {
                        window.location.href = window.location.href ;    //redirect to add new route after interval of 2 sec-
                      }, 2000);


                  
                        break;
                
                      }
                    }
                    
                }
                    });
             
              request.open('POST', '/admin/updateSelectedAlbumYoutubeLinks');
           

        request.setRequestHeader('Cache-Control', 'no-cache');
        //  document.getElementById('upload_progress').style.display="block";



        request.send(data);
    
    
  } catch (e) {

  }
}
//
function addYoutubeLinkToFinalObject(video_object)
{
  // console.log(JSON.parse(video_object))
  var productObj =  JSON.parse(video_object);

  // console.log(productObj)


  finalYoutubeLinkClassArray = [];
  for (let i=0; i < productObj.length ; i++) { 
    // console.log( productObj[i]);
    finalYoutubeLinkClassArray.push(productObj[i].youtube_link)
 }
  console.log(finalYoutubeLinkClassArray);
}

function verifyYoutubeLinkBeforeSubmit(){
  youtubeLinkClassArray = [];
  $(".youtubeLinkInputClass").each(function() {
    youtubeLinkClassArray.push($(this).val()); 
});

console.log(youtubeLinkClassArray)
if(youtubeLinkClassArray.includes(undefined)  || youtubeLinkClassArray.includes("") )
{
  swal({
    title: "Create Album",
    text: "Input can't be empty!! Please enter link, verify then proceed..",
    icon: "error",
  
  });
}else{
  if($('.verifyYoutubeLinkButton').is(":visible" )){
    swal({
      title: "Create Album",
      text: "Need to verify all youtube links before proceeding...",
      icon: "error",
    
    });
  }
  
  else{
    if (window.location.href.indexOf("edit") > -1) {
      updateSelectedAlbumYoutubeLinks()
    }else{
      handleUpload();
    }
   
    // alert("ready to submit")
  }
}

 //
  
  
        

}


function  handleUpload() {

    event.preventDefault();
    event.stopPropagation();
    try {
        //  console.log(allFiles.length)
          var album_type = $('#album_type').val()
          console.log(finalYoutubeLinkClassArray)
          const fileInput = document.getElementById('fileToUpload');
          const selectedFile = fileInput.files[0];

          var data = new FormData();

          data.append("_token", $("#_token").val());  
          data.append("album_name_input", $("#album_name_input").val());


          if(album_type ==="1"){
            data.append("album_type", album_type);                 
          }else if(album_type ==="2"){
            data.append("event_id", $("#event_id").val());         
            data.append("album_type", album_type);         
          }else{

          }
          // data.append('file[]', validFileList[0]);     
          data.append("cover_image_file", selectedFile);
          data.append("date_time", $("#date_time").val());
          data.append('finalYoutubeLinkClassArray',JSON.stringify(finalYoutubeLinkClassArray));


         
          // data = data.entries();              
          // var obj = data.next();
          // var retrieved = {};             
          // while(undefined !== obj.value) {    
          //     retrieved[obj.value[0]] = obj.value[1];
          //     obj = data.next();
          // }
          // console.log('retrieved: ',retrieved);
        
          // return false;
        // alert()
          var request = new XMLHttpRequest();
  
          request.upload.addEventListener("progress", function (e) {
            // $('#new_image_album_add_images_button').hide();
          $('.loader').show()
  
  
        $('.hideWhenSubmitting').hide()

      
            if (e.lengthComputable) {
              $("#process_div").show();
              var progressWidth = Math.floor((e.loaded / e.total) * 100) + '%';
              $("#outer_percent").html(progressWidth);
              $("#percent").html(progressWidth);
              $('#percent').
                attr('style', 'width: ' + progressWidth);
              if (progressWidth == "100%") {             
              
                $("#data_processing").show();
              }
            }
            
          });
          request.addEventListener("load", function () {
          
            document.getElementById('fileToUpload').value = "";
            validFileList.length = 0;
            // validDocImage=[]
  
            youtubeLinkClassArray=[];
             // reset cover image  hidden fields
              // $('#getValueForAlbumCover').val('')
              // $('#getValueForAlbumCoverIndex').val('')
          
          });
          request.addEventListener("error", function () {
          
          
      
            $('.hideWhenSubmitting').show()
            
          });
          request.addEventListener('readystatechange', function () {
            $('.loader').hide()

            if (this.readyState === 4) {
              var response = [];
  //console.log(request.responseText);
            response = JSON.parse(request.responseText);
            //  var count = JSON.stringify(response);
            if (response != "") {
  
                switch (response.status) {
                  case "success":
                    validDocImage = [];
                    // showSwal('added-new-product',"Success","Created Successfully");
                    swal({
                      title: "New-Video-Album!",
                      text: "Created Successfully",
                      icon: "success",
                      timer: 1500,              
                      buttons: false
                      });
  
                      setTimeout(
                        function() {
                          window.location.href = "/admin/video_album";    //redirect to add new route after interval of 2 sec-
                        }, 2000);
  
  
                    $("#data_processing").hide();
                    $("#images_grid").empty();
                    $("#process_div").hide();
                          break;
                  
                        }
                      }
                      
                  }
                      });
               
                request.open('POST', '/admin/createNewVideoAlbum');
             

          request.setRequestHeader('Cache-Control', 'no-cache');
          //  document.getElementById('upload_progress').style.display="block";
  
  
  
          request.send(data);
      
      
    } catch (e) {
  
    }
  }


  function checkResolution(){
    // alert()
    const fileInput = document.getElementById('fileToUpload');
    const file = fileInput.files[0];
   
  
  if( file ) {
  var img = new Image();
  
  img.src = window.URL.createObjectURL( file );
  
  img.onload = function() {
      var width = img.naturalWidth,
          height = img.naturalHeight;
   
      window.URL.revokeObjectURL( img.src );
  
      if((width < 355 && width > 345) && (height < 255 && height > 245) ) {
           
      }
      else {
       $('#clear_image').trigger('click');
        swal({
                  title: "Incorrect Resolution",
                  text: "Please upload cover image with Resolution specified 350X250",
                  icon: "error",
                
            });
        //  alert("Failed");
  
      }
  };
  
  }
  }

  function checkResolutionEdit(edit){
    const fileInput = document.getElementById('fileToUpload');
    const file = fileInput.files[0];
   
  
  if( file ) {
  var img = new Image();
  
  img.src = window.URL.createObjectURL( file );
  
  img.onload = function() {
      var width = img.naturalWidth,
          height = img.naturalHeight;
   
      window.URL.revokeObjectURL( img.src );
  
      if((width < 355 && width > 345) && (height < 255 && height > 245) ) {
        if(edit == 1)
             if (file) {
              covImg.src = URL.createObjectURL(file)
              }
           
      }
      else {
        document.getElementById('fileToUpload').value="";

        swal({
                  title: "Incorrect Resolution",
                  text: "Please upload cover image with Resolution specified 350X250",
                  icon: "error",
                
            });
        //  alert("Failed");
  
      }
  };
  
  }
  }
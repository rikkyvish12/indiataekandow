

var allCheckedImagesIds = new Array();
var existing_folders_name=[];
var existing_folders_id=[];
// var new_folders_ids=[];

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
var album_folders=[]
var selected_folder_id = "";

var assoc_id = $('#assoc_id').val();

function checkResolution(edit){
  const fileInput = document.getElementById('album_cover');
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
      document.getElementById('album_cover').value="";
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



function addAllFoldersNameToArray(album_folders){
  // alert()
  var existing_album_folders = JSON.parse(album_folders);
  console.log(existing_album_folders)

  for (let index = 0; index < existing_album_folders.length; index++){
    existing_folders_name.push(existing_album_folders[index].album_name)
    existing_folders_id.push(existing_album_folders[index].id)
  }
  console.log(existing_folders_name)
  console.log(existing_folders_id)
}
function addCheckedImagesToArray(inputs,id){
  console.log(inputs)
    if($(inputs).is(":checked")){
       
        allCheckedImagesIds.push(id);
    }else{
        const index = allCheckedImagesIds.indexOf(id)
        if (index > -1) {
            allCheckedImagesIds.splice(index, 1);
        }
    }
    console.log(allCheckedImagesIds)
}


function deleteSelectedImages(){
  if(allCheckedImagesIds.length ==0){
      swal({
        title: "Delete Album Images",
        text:"Please selecte atleast 1 image to proceed..",
        icon: "error",     
      });

  }else{
    swal({
      title: "Are you sure?",
      text: "Do you really want to delete the selected image(s)",
      icon: "warning",
      buttons: ["Cancel", "Yes"],
      dangerMode: false,
    })
    .then((proceed) => {
      if (proceed) {
         
        
      var data = new FormData();
      data.append("_token", $("#_token").val());
      data.append("assoc_id", assoc_id);

      // data.append("album_id",album_id);  
      data.append("allCheckedImagesIds",JSON.stringify(allCheckedImagesIds));
  
    
  //   data = data.entries();              
  // var obj = data.next();
  // var retrieved = {};             
  // while(undefined !== obj.value) {    
  //     retrieved[obj.value[0]] = obj.value[1];
  //     obj = data.next();
  // }
  // console.log('retrieved: ',retrieved);
  
  // return false;
    
      $.ajax({
    
        type: "POST",
        url: "/assoc_admin/deleteSelectedAlbumImages",
        data: data,
        processData: false,
        contentType: false ,
        cache: false, 
        
          beforeSend: function(){
          
        },
        complete: function(){
        
        //  $("#spin").addClass("w3-hide");
        
        },
        success:function(response){
          var data = JSON.parse(response);
            if(data != "")
            {
                if(data.status == "success")
                {     
                          swal({
                            title: "Update Image Album",
                            text: "Images for the selected album has been deleted from",
                            icon: "success",
                            timer: 1500,              
                            buttons: false
                          });
    
    
    
                          allCheckedImagesIds.forEach((element) => {
                             $('#imgCardId_'+element).remove();
                          });
                          // $("#album_images").load(location.href + " #album_images");
                          // window.location = window.location;
  
                          allCheckedImagesIds.length = 0;
                  
                }else if(data.status == "error"){
                  swal({
                    title: "Update Image Album",
                    text: "Problem updating album, contact your admin..",
                    icon: "error",
                    
                  });
                }
                
              else 
              {
                
                // alert("in else")
                
              }
           
        }else{
        
        }
    }
    });
      } else {
       
      }
    });	
  }
  
}

function deleteSelectedFolderImages(folder_id, folder_name)
{
  // alert(folder_name)
  // return false;

var finalImagesIds = new Array();
for (let index = 0; index < allCheckedImagesIds.length; index++) {
  var splitFolderId = allCheckedImagesIds[index].split('_');   
    if(splitFolderId[0] == folder_id){
      finalImagesIds.push(splitFolderId[1])
    }
  
}
console.log(finalImagesIds)

if(finalImagesIds.length ==0){
    swal({
      title: "Delete Album Images",
      text:"No images selected for folder '"+folder_name+"', please selecte atleast one image to proceed..",
      icon: "error",     
    });

}else{
  swal({
    title: "Are you sure?",
    text: "Do you really want to delete the selected image(s)",
    icon: "warning",
    buttons: ["Cancel", "Yes"],
    dangerMode: false,
  })
  .then((proceed) => {
    if (proceed) {
       
      
    var data = new FormData();
    data.append("_token", $("#_token").val());
    data.append("folder_name",folder_name);  
    data.append("allCheckedImagesIds",JSON.stringify(finalImagesIds));
    data.append("assoc_id", assoc_id);

//   data = data.entries();              
// var obj = data.next();
// var retrieved = {};             
// while(undefined !== obj.value) {    
//     retrieved[obj.value[0]] = obj.value[1];
//     obj = data.next();
// }
// console.log('retrieved: ',retrieved);

// return false;
  
    $.ajax({
  
      type: "POST",
      url: "/assoc_admin/deleteSelectedAlbumImages",
      data: data,
      processData: false,
      contentType: false ,
      cache: false, 
      
        beforeSend: function(){
        
      },
      complete: function(){
      
      //  $("#spin").addClass("w3-hide");
      
      },
      success:function(response){
        var data = JSON.parse(response);
          if(data != "")
          {
              if(data.status == "success")
              {     
                if(data.folder_name){
                  // swal({
                  //   title: "Update Image Album",
                  //   text: "Image(s) from album folder '"+folder_name+"' has been deleted successfully..",
                  //   icon: "success",
                  //   timer: 2500,              
                  //   buttons: false
                  // });

                  swal({title: "Success", text:"Image(s) from album folder '"+folder_name+"' has been deleted successfully..", type: 
                  "success"}).then(function(){ 
                      location.reload();
                    });

                }else{
                  // swal({
                  //   title: "Update Image Album",
                  //   text: "Image album has been updated successfully..",
                  //   icon: "success",
                  //   timer: 1500,              
                  //   buttons: false
                  // });
                  swal({title: "Success", text: "Image album has been updated successfully..!!", type: 
                  "success"}).then(function(){ 
                      location.reload();
                    });

                }
                      
  
  
                        finalImagesIds.forEach((element) => {
                           $('#imgCardId_'+element).remove();
                        });
                        // $("#album_images").load(location.href + " #album_images");
                        // window.location = window.location;

                        finalImagesIds.length = 0;
                
              }else if(data.status == "error"){
                swal({
                  title: "Update Image Album",
                  text: "Problem updating album, contact your admin..",
                  icon: "error",
                  
                });
              }
              
            else 
            {
              
              // alert("in else")
              
            }
         
      }else{
      
      }
  }
  });
    } else {
     
    }
  });	
}

}

function folderNameToModal(album_name,folder_id, folder_name){
  $('#renameFolderModalHeader').html("Album : "+album_name)
  $('#renameFolderModalInput').val(folder_name)
  $('#renameModalUpdateButton').attr('onclick','renameSelectedFolder('+folder_id+')')

  $('#renameModal').modal('show')

  
  
}

function renameSelectedFolder(folder_id){
var folder_name =$('#renameFolderModalInput').val().trim();

  if(folder_name ==""){
    swal({
      title: "Rename Album Folder",
      text:"Input can't be empty..",
      icon: "error",     
    });
  }else{
         
    if(checkDuplicateValueArray(folder_name,existing_folders_name) ){
      swal({
        title: "Update Image Album",
        text: "Folder name inserted already exist for the album, please try different name.",
        icon: "error",
        
      });

    }else{
      // return false;
         
      
    var data = new FormData();
    data.append("_token", $("#_token").val());
     data.append("folder_name",folder_name);  
     data.append("folder_id",folder_id);  
     data.append("assoc_id", assoc_id);

//   data = data.entries();              
// var obj = data.next();
// var retrieved = {};             
// while(undefined !== obj.value) {    
//     retrieved[obj.value[0]] = obj.value[1];
//     obj = data.next();
// }
// console.log('retrieved: ',retrieved);

// return false;
  
    $.ajax({
  
      type: "POST",
      url: "/assoc_admin/renameSelectedFolder",
      data: data,
      processData: false,
      contentType: false ,
      cache: false, 
      
        beforeSend: function(){
        
      },
      complete: function(){
      
      //  $("#spin").addClass("w3-hide");
      
      },
      success:function(response){
        var data = JSON.parse(response);
          if(data != "")
          {
              if(data.status == "success")
              {     
                
                $('#renameModal').modal('hide')
                resetRenameModal()  
                swal({title: "Success", text: "Album has been renamed successfully!", type: 
                "success"}).then(function(){ 
                    location.reload();
                  });
                        
                        
                    
                        // $("#album_images").load(location.href + " #album_images");
                        // window.location = window.location;

                        
                
              }else if(data.status == "unsuccess"){
                swal({
                  title: "Update Image Album",
                  text: "Unable to locate folder, contact your admin for detail",
                  icon: "error",
                  
                });
              }
              
              else if(data.status == "error"){
                swal({
                  title: "Update Image Album",
                  text: "Contact your admin for detail",
                  icon: "error",
                  
                });
              
              //
              
            }else{

            }
         
      }else{
      
      }
  }
  });
    }
  }

  
   

}

function resetRenameModal(){
  $('#renameFolderModalHeader').html('')
  $('#renameFolderModalInput').val('')

  $('#renameModalUpdateButton').attr('onclick','')

  
}

function deleteSelectedFolder(folder_id){
  swal({
    title: "Are you sure?",
    text: "You want to delete the clicked folder",
    icon: "warning",
    buttons: ["Cancel", "Yes"],
    dangerMode: false,
  })
  .then((proceed) => {
    if (proceed) {

      var data = new FormData();
       data.append("_token", $("#_token").val());
      //  data.append("folder_name",folder_name);  
       data.append("folder_id",folder_id);  
       data.append("assoc_id", assoc_id);

    $.ajax({
  
      type: "POST",
      url: "/assoc_admin/deleteSelectedFolder",
      data: data,
      processData: false,
      contentType: false ,
      cache: false, 
      
        beforeSend: function(){
        
      },
      complete: function(){
      
      //  $("#spin").addClass("w3-hide");
      
      },
      success:function(response){
        var data = JSON.parse(response);
          if(data != "")
          {
              if(data.status == "success")
              {     
                
                $('#renameModal').modal('hide')
                resetRenameModal()  
                swal({title: "Success", text: "Album folder '"+data.folder_name+"' has been deletd successfully!", type: 
                "success"}).then(function(){ 
                    location.reload();
                  });
                        
                        
                    
                        // $("#album_images").load(location.href + " #album_images");
                        // window.location = window.location;

                        
                
              }else if(data.status == "unsuccess"){
                swal({
                  title: "Update Image Album",
                  text: "Unable to locate folder, contact your admin for detail",
                  icon: "error",
                  
                });
              }
              
              else if(data.status == "error"){
                swal({
                  title: "Update Image Album",
                  text: "Contact your admin for detail",
                  icon: "error",
                  
                });
              
              //
              
            }else{

            }
         
      }else{
      
      }
  }
  });
    } else {
     
    }
  });
}






function selectImages(folder_id){
  $("#fileToUpload").click();
  selected_folder_id = folder_id;
  if(checkDuplicateValueArray(folder_id,existing_folders_id)){
    album_folders.push({'folder_id':folder_id,'exist':1})
  }
  
}


function uploadOnChange() {
  try {
   
    event.preventDefault();
    event.stopPropagation();

      validExtensions = /jpg|jpeg/
      maxFileSize = 5;
      widthMax = 1120;
      widthMin = 500;
      heightMax = 500;
      heightMin = 400;
      resWidth = 1080;
      resHeight = 720;

    
    

      var files = document.getElementById('fileToUpload').files;
     
        // show loader
        console.log(files.length)
    createValidFileList(files);

    
  


  } catch (e) {
    alert("ERROR ONCHANGE UPLOAD " + e)
    console.log("Upload from file input failed " + e);
  }
}

function createValidFileList(files) {

  var count = validFileList.length;
  console.log("count " + count);
  console.log("validFileList " + validFileList.length);

  [].forEach.call(files, function (file) {
    //  var currentFileExt = file.type;
    count++;
    var currentFileExt = file.name.substr(file.name.lastIndexOf('.') + 1).toLowerCase();

    if (isFileValid(file, currentFileExt)) {

      if (validFileList.length === 0) {
 
      }
      //we need to generate a random id for the file if we need to delete the file later
      file.id = Math.floor(Math.random() * 1000000000).toString(); //add a random number as the id property of the file object
      file.folder_id = selected_folder_id; //add a random number as the id property of the file object

     // file.sequence = count;
      
      if (file.type.match(isImage)) {
        isGoodImage(file).then(function (isGood) {
          if (isGood) {
            validFileList.push(file);
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = (function (file) {
              return function (e) {
                                
                  var image = '<img src=' + e.target.result + '   height="100" width="100" class="img-responsive center-block d-block mx-auto" >';
                  addUploadTableRow(image, file.name, file.size, file.id,file.sequence);
     
              };
            })(file);

            reader.error = function (e) {


              alert("something bad happened: " + e);
            };
            reader.onloadstart = function (e) {


            };
            reader.onloadend = function (data) {


            };
          }
        });
      } //end if image
      else { 
        alert("Only Images are allowed, Some non Image files are removed");
      } //end else
    } //end is fileValid
  }); // end forEach
 // console.log(validFileList)
}

function isFileValid(file, ext) {

  /** checks if the file has the proper extension
   * or not bigger than allowed
   * @file (object)
   * @return boolean
   */
  try {
    var validFile = true; //assume the file is good
    if (file.size / (1024 * 1024) > maxFileSize) {
      //  toastr.error(" ", "The file is bigger than 10 MB.", { "positionClass": "toast-top-center" });
      alert("The file is bigger than "+maxFileSize+"KB")

      validFile = false;
    }
    if (!validExtensions.test(ext)) {
      // toastr.error(" ", "This type of file is not allowed. "+ext, { "positionClass": "toast-bottom-center" });
      swal({
        title: "Invalid file Extension",
        text: "File type'" + ext + "' is not allowed. Supported File type is '" + validExtensions,
        icon: "error",         
        buttons: true
        });
   //   showSwal('title-and-text', "Invalid file Extension", "File type'" + ext + "' is not allowed. Supported File type is '" + validExtensions);
      // alert("This type of file is not allowed.")
      validFile = false;
    }
    //alert(validFile)
    return validFile;
  } catch (e) {
    //   toastr.error(" ", "ERROR " + e, { "positionClass": "toast-bottom-center" });
    console.log("Upload from file input failed " + e);
    return false
  }
}

function isGoodImage(file) {
  var deferred = jQuery.Deferred();
  var image = new Image();

  image.onload = function () {
    // Check if image is bad/invalid
    if (this.width + this.height === 0) {
      this.onerror();
      return;
    }

    // Check the image resolution
    // if ((this.width >= widthMin && this.width <= widthMax) && (this.height >= heightMin && this.height <= heightMax)) {
     // if (this.width < widthMin && this.height < heightMin) {
      if (false) {

        // showSwal('title-and-text',"Too small image Resolution","Some images are too small which are not listed");
        swal({
          title: "Too small image Resolution!",
          text: "Some images are too small which are not listed",
          icon: "error",
         
          });
        
          
        deferred.resolve(false);
     

    } else {
      deferred.resolve(true);

    }
  };

  image.onerror = function () {
    // alert("Invalid image. Please select an image file.");
    // showSwal('title-and-text', "Invalid image file", "Please select an image file.");
    swal({
      title: "Invalid image file!",
      text: "Please select an image file.",
      icon: "error",
     
      });
    deferred.resolve(false);
  }

  image.src = _URL.createObjectURL(file);
  
if(!$('.loader').is(":hidden"))
  $('.loader').hide()

  return deferred.promise();
}


function addUploadTableRow(icon, name, size, index,sequence) {
  $('.loader').show();

     
  var fileSize = parseInt(size / 1024, 10) + " kb";
/* I create the upload que table with JQuery. I tried plain Javascript but I lost the UIkit styling.
* I dynamically add a <tr>  element to the table and 5 <td> elements
*
* */
  var rowCol = $('<div />', {
    'class': 'col-12 col-xs-12 col-sm-6 col-md-2 col-lg-2',
    'style': 'margin-top:5px;margin-bottom:5px',
    attr: {
      'id': index
    }
  });

  if (name.length > 10) {

  }
 

  rowCol.append($('<div />', {
    'class': 'card',
  }).append($('<div />', {
    'style': 'text-align:center;',
  }).append($('<button />', {
    'class': 'btn btn-outline-danger hideWhenSubmitting fa-xs',
    'style':'',
    'type': 'button',
    'onclick': 'removeFile(' + index + ')',
    attr: {
      'data-file-id': index
    }
  }).append('<b><i class="fa fa-trash fa-lg fa-fw"></i></b>')))
  .append(icon)
    .append('<hr>')
    .append($('<div />', {
      'class': '',
    }).append($('<div />', {
      'style': 'text-align:center;font-size: 10px;',
    }).append(name+"<b>(" + fileSize + ")</b> "))
    ));


    if(checkDuplicateValueArray(selected_folder_id,existing_folders_id)){
      $("#new_section_"+selected_folder_id).append(rowCol);
    }else{
      $("#section_"+selected_folder_id).append(rowCol);
    }


  
  
   $('.loader').hide(); 
  


  jQuery('.onlyOneToNine').on('keyup',function () {       //applying image sequence to be between 1-9 only no zero allowed 
    
    this.value = this.value.replace(/[^1-9\.]/g,'1');
  });


  document.getElementById('fileToUpload').value = "";


}
function setAlbumCoverInput(index){
  // alert(index)

$('#getValueForAlbumCover').val($('#seq_'+index).val())
$('#getValueForAlbumCoverIndex').val(index)
}


function updateSequence(index){
  console.log("updateSequence index "+index)
  for (var i = 0; i < validFileList.length; i++) {
    var file = validFileList[i];
    var seq = parseInt($("#seq_"+index).val());
    if (validFileList[i].id == index) {
      validFileList[i].sequence = seq;
    }
  }
  console.log(validFileList);
}

function cleanUp() {
  // document.forms[0].reset();
  // validFileList = [];
  $uploadQueueTable.find("tbody").html("");
  document.getElementById('uploadTableDiv').style.display = "none";
  document.getElementById('file').value = "";
  validFileList.length = 0;
  $("#addFiles").show();
}

function removeFile(index) {
 
    var clickedId = index; // on click it removes the row fom the queue
    deletefileUploadRow(clickedId);
    removeFileFromValidFileList(clickedId);
    if (validFileList.length == 0 ) {
      $uploadTableDiv.addClass('hide'); //if there are no files to upload, hide the table
    }
   
  }
   
  // alert(validFileList.length)
  
 function deletefileUploadRow(id) {
   $('#' + id).
     removeClass("animated slideInUp").
     addClass("animated slideOutLeft").fadeOut().remove();
   $("#uploadButton").hide();
   $("#chooseButton").show();
   $("#remark").removeClass("w3-border w3-border-red")
 
   $("#uploadTableDiv").hide();  
   // document.getElementById('fileToUpload').value="";
   // validFileList.length = 0; 
 
 
 
 }

 function removeFileFromValidFileList(id) {

   for (var i = 0; i < validFileList.length; i++) {
    var file = validFileList[i];   
    if(file.id == id){
      validFileList.splice(i, 1); //remove the file from the array
      break;
    }
   
   
 
  }

  
   console.log(validFileList);

 
}

  function checkDuplicate(values) {
  
    let result = false;
    // call some function with callback function as argument
    result = values.some((element, index) => {return values.indexOf(element) !== index});
    if(result) {
       return true;
    } else {
       return false;
    }
  }
  
  function isSequential(data) {

  data.sort(function(a, b){return a-b});
  console.log(data);
  var expiry_date;
  // expiry_date = new Date($('#warrantyExpiration').val())
  // expiry_date.getDate();
 
  // console.log(expiry_date)

  for (var i = 0; i < data.length; i++) {
    // check if current value smaller than previous value
    var number = data[i]-1;
    if (number != i) {
       return true;
    }
  }
  
  return false;
}



function deleteSelectedImageFile(path,current_sequence)
{
  
    // alert(current_sequence)
    var filename = path.replace(/^.*[\\\/]/, '')
    // alert($('#selectedProductId').val());
    // alert(filename )


    var data = new FormData();
            data.append("_token", $("#_token").val());
            data.append("path", path);            
            data.append("filename", filename);
            data.append("assoc_id", assoc_id);
            data.append("current_sequence", current_sequence);
            data.append("album_id", $('#album_id').val());    //adding vendor ID, need to take vendor info from vendor table 

            // if (window.location.href.indexOf("admin/album") > -1) {
            //   console.log("if")
            //   data.append("album_type", "image_album");
            // } else if (window.location.href.indexOf("admin/video_album") > -1){
            //   console.log("else if")
            //   data.append("album_type", "video_album");
            // }else{
          
            // }

          //   for (var pair of data.entries()) {
          //     console.log(pair[0]+ ', ' + pair[1]); 
          // }
            $.ajax({

              type: "POST",
              url: "/admin/deleteSelectedImageFile",
              data: data,
              processData: false,
              contentType: false ,
              cache: false, 
              
                beforeSend: function(){
                
              },
              complete: function(){
              
              //  $("#spin").addClass("w3-hide");
              
              },
              success:function(response){
                var data = JSON.parse(response);
                  if(data != "")
                  {
                      if(data.status == "success")
                      {
                                             
                              swal({
                                  title: "Delete Image ",
                                  text: "Image Deleted Succesfully",
                                  icon: "success",
                                  timer: 1500,              
                                  buttons: false
                                  
                                });
                            // showSwal('success-message',"Delete Image","Image Deleted Succesfully",location.href + " #image_refreshal_div");                 

                              $("#image_refreshal_div").load(location.href + " #image_refreshal_div");//refreshing a div loacted on checkout after creating a address
        
                        // location.reload();
                        
                      }
                      else if(data.status == "no-such-product") 
                      {
                          swal({
                            title: "Delete Image ",
                            text: "No Such Product",
                            icon: "info"
                          
                              
                            
                          });
                      }
                      else if(data.status == "image-not-found") 
                      {
                          swal({
                            title: "Delete Image ",
                            text: "Unable to delete, image not found",
                            icon: "info"
                          
                              
                            
                          });
                      }
                      else if(data.status == "problemw-with-image-count" || data.status == "temp-exist") 
                      {
                          swal({
                            title: "Delete Image ",
                            text: "Contact your administrator",
                            icon: "info"
                          
                              
                            
                          });
                      }
                      
                    
                  
                    else 
                    {
                      
                      alert("unsuccess")
                      
                    }
                 
              }else{
              
              }
          }
     });
            
           

}


function validateUploadMoreImagesForSelectedAlbum(){

  var product_sequence=[];  
  var allFiles = validFileList;
    
    if (allFiles.length != 0) {
      
     
        if(!$("input:radio[name='radioForSettingAlbumCoverImage']").is(":checked") ){
          swal({
            title: "Create Album",
            text: "No album cover selected yet, please select one to proceed..",
            icon: "error",
          
          });
        }else{
              $('.product_sequence').each(function(){
                product_sequence.push(this.value ); 
              });
              console.log (product_sequence)
              if(checkDuplicate(product_sequence)){
                console.log("checkDuplicate")
                swal({
                  title: "Image Sequence",
                  text: "Sequence cannot have duplicate values",
                  icon: "error"    
                });
                console.log("checkDuplicate" +product_sequence)

              }else if(product_sequence.some(el => el > allFiles.length)) {
                console.log("else if(product_sequence")
                  swal({
                    title: "Invalid Sequence",
                    text: "Sequence of input can't be greater than image count. \n  For eg: if you have 3 images, you can't use values greater than 3 ",
                    icon: "error"    
                  });
                  console.log("product_sequence" +product_sequence)

              }
              else{
                updateSelectedAlbumUploadMoreImages(allFiles)
              }
            }
      
      }

    
          
  
  else {
    swal({
      title: "Upload more images!",
      text: "Please select atleast a image to proceed",
      icon: "error"
      
      });
  }
}
function  updateSelectedAlbumUploadMoreImages(allFiles) {
    
  try {
       
        var data = new FormData();
          
          // alert()
        var files_info = [];
        for (var i = 0; i < allFiles.length; ++i) {
         
          
          data.append('file[]', allFiles[i]);
          files_info.push({seq:allFiles[i].sequence,name:allFiles[i].name}); 
        }
        console.log(JSON.stringify(files_info));
        
      data.append("_token", $("#_token").val());         
      data.append('files_info',JSON.stringify(files_info));
      data.append("album_id", $("#album_id").val());
      data.append("total_count", allFiles.length);
      data.append("assoc_id", assoc_id);


      // if (window.location.href.indexOf("admin/album") > -1) {
      //   console.log("if")
        data.append("album_type", "image_album");
      // } else if (window.location.href.indexOf("admin/video_album") > -1){
      //   console.log("else if")
      //   data.append("album_type", "video_album");
      // }else{
    
      // }

     
      // data = data.entries();              
      // var obj = data.next();
      // var retrieved = {};             
      // while(undefined !== obj.value) {    
      //     retrieved[obj.value[0]] = obj.value[1];
      //     obj = data.next();
      // }
      // console.log('retrieved: ',retrieved);
    
      // return false;
    
      var request = new XMLHttpRequest();

      request.upload.addEventListener("progress", function (e) {
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
        $("#images_grid").empty();
       



      });
      request.addEventListener("error", function () {
        alert("In Error")

      });
      request.addEventListener('readystatechange', function () {
        if (this.readyState === 4) {
          var response = [];
    //console.log(request.responseText);
        response = JSON.parse(request.responseText);
        //  var count = JSON.stringify(response);
        if (response != "") {

            switch (response.status) {
              case "success":
                var image_count=  response.image_count;
                // showSwal('added-new-product',"Success","Created Successfully");
                document.getElementById('fileToUpload').value = "";
                validFileList.length = 0;
                swal({
                  title: "Upload more images!",
                  text: "You have succesfully added "+image_count+" images",
                  icon: "success",
                  timer: 1500,              
                  buttons: false
                  });
                  $("#image_refreshal_div").load(location.href + " #image_refreshal_div");//refreshing a div loacted on checkout after creating a address
                  
                $("#data_processing").hide();
                $("#images_grid").empty();
                $("#process_div").hide();
                      break;
               case "unsuccess":
                swal({
                  title: "Upload more images!",
                  text: "Unable to upload image(s), kindly contact administrator..",
                  icon: "success",
                  timer: 1500,              
                  buttons: false
                  });
                    }
                  }
                  
              }
                  });

      request.open('POST', '/assoc_admin/updateSelectedAlbumUploadMoreImages');
      request.setRequestHeader('Cache-Control', 'no-cache');
      //  document.getElementById('upload_progress').style.display="block";



                     request.send(data);
                  
                  
  
   


   
  } catch (e) {

  }
}

// function makeSelectedImageAsAlbumCover(img_path){
  

// }
function focusModalInput(addFolderModalForImages) {
  $(addFolderModalForImages).find("input:first").trigger('focus');
  $('#album_folder_name').val('')
}
//FOR MAIN FOLDER 
function checkAddFolderModalInput(folder_name,type){
  var random = Math.floor(Math.random() * 1000) + 1;

    if(folder_name ==""){
      swal({
        title: "Create Folder",
        text: "Folder name input can't be empty",
        icon: "error"    
      });
    }
  else{
    if(type ==="create"){
      // alert(" if")
      if(checkDuplicateValueArray(folder_name,existing_folders_name)){
        swal({
          title: "Create Folder",
          text: "Folder name already exist, please use some other name",
          icon: "error"    
        });
        $('#album_folder_name').trigger('focus')
      }else{
        
        album_folders.push({'folder_name':folder_name,'folder_id':random,'parent_id':0,'exist':0})
        existing_folders_name.push(folder_name)
        // new_folders_ids.push(random)
        console.log(album_folders)

        addFolderNameToTable(folder_name,random);
        createNewDivForEnteredFolderName(folder_name,random)   
        resetAddFolderNameModal('folder')
        $('#addFolderModalForImages').modal('hide')    


        
      }
     

    }
    else if(type ==="update")
    {
      // alert("else if")
        updateFolderNameModalInput(folder_name)
    }else{

    }
    
  }
  
}
function addFolderNameToTable(folder_name,id){

  // added_album_folder_tbody

 
  var result = "";
  
    result += '<tr id="'+id+'" class="hideWhenSubmitting"  >';
  
    result +='<td><span type=text class="form-control " id="folderNameInput_'+id+'" style="color:white">'+folder_name+'</span></td>'; 
  
   // result +='<td><button type="button" onclick="createSubFolderUnderMainFolder('+id+')" class="btn btn-outline-primary" >Sub-Folder</button></td>';
  
    result +='<td><button type="button" class="btn btn-outline-warning "  id="editFolderNameInput_'+id+'"  onclick="getFolderNameBackToModalInput('+id+')" style="float:right"><i class="far fa-edit fa-fw"></i></button></td>';  
  
    result +='<td><button type="button" onclick="removeFolderNameRow('+id+')" class="btn btn-outline-danger" ><i class="fas fa-trash-alt fa-fw"></i></button></td>';  
    
    result +='</tr>';  
  
    $("#added_album_folder_tbody").append(result);
  
  }

function createNewDivForEnteredFolderName(folder_name,random)
{
  var folder_image_template = $("#folder-image-template").html();
  folder_image_template = folder_image_template.replace(/!!!folder_template_id!!!/g, 'folder_template_id'+random);
  folder_image_template = folder_image_template.replace(/!!!folder-name!!!/g, folder_name);
  folder_image_template = folder_image_template.replace(/!!!UNID!!!/g, random);
  folder_image_template = folder_image_template.replace(/!!!header_id!!!/g, 'folderTemplateHeader_'+random);
  $("#mainFolderDiv").prepend(folder_image_template); 
  // alert()
  // $("#mainFolderDiv").empty()
  // var grep_result = $.grep(album_folders, function(e){ return e.parent_id == 0; });

  // for (let index = 0; index < grep_result.length; index++) {
  //   console.log(grep_result[index])  
  //       var sub_div = "";
  //       sub_div += '<div class="folderThreadDiv" id="folderThreadDiv_'+grep_result[index].unq_id+'" style=" font-weight: bold;font-size: 14px;float: left;cursor: pointer;margin: 5px;padding: 5px;text-align: center;width: 80px;">';
  //       sub_div += '<i class="fa fa-folder" style="font-size:36px; width: 50px;" onclick="promiseBeforeOpeningFolder('+grep_result[index].folder_name+','+grep_result[index].unq_id+')" id="folderIcon_'+grep_result[index].unq_id+'"></i>';
  //       sub_div += '<span style="display: block;" id="folderSpan_'+grep_result[index].unq_id+'">'+grep_result[index].folder_name+'</span>';
  //       sub_div += '<button class="btn btn-primary" style="display: block;" onclick="openUploadModal()" id="folderSpan_'+grep_result[index].unq_id+'">Upload Images</button>';
  //       sub_div += '</div>';
  //     console.log(sub_div)  
  //     $("#mainFolderDiv").append(sub_div); 
   
  // }
  swal({
    title: "Create Folder ",
    text: "Folder has been created successfully..",
    icon: "success",
    timer: 2000,              
    buttons: false
    });


}

function getFolderNameBackToModalInput(id){
  // alert(counter)
  // alert($('#folderNameInput_'+counter).html())
  
  $('#album_folder_name').val($('#folderNameInput_'+id).html());
  $('#addFolderCreateButton').hide()
  $('#addFolderUpdateButton').attr('onclick','updateFolderNameModalInput('+id+')').show()
  

  $('#addFolderModalForImages').modal('show')
  $('#editFolderNameInModalInputCounterNo').val(id)
}
function updateFolderNameModalInput(id){
  var fd_name = $('#album_folder_name').val()
  var old_name= $('#folderNameInput_'+id).html()
  const index = existing_folders_name.indexOf(old_name);
  if (index > -1) {
    existing_folders_name.splice(index, 1);
  }
  if(checkDuplicateValueArray(fd_name,existing_folders_name)){
    swal({
      title: "Update Folder Name",
      text: "Folder name already exist, please use some other name",
      icon: "error",
    
      });
  }else{


    existing_folders_name.push(fd_name)

    $('#folderNameInput_'+id).html(fd_name)
    $('#editFolderNameInModalInputCounterNo').val('') 
    $('#addFolderModalForImages').modal('hide')
    $('#folderSpan_'+id).html(fd_name)
    $('#album_folder_name').val('');
    $('#folderTemplateHeader_'+id).html(fd_name)
  for (let index = 0; index < album_folders.length; index++) {
    if( album_folders[index].folder_id  == id){
      // alert("if")
      album_folders[index].folder_name = fd_name;
  
    }
    
    console.log(album_folders)
    console.log(existing_folders_name)
  
  }
    resetAddFolderNameModal('folder')
  
    swal({
      title: "Update Folder Name",
      text: "Folder name has been updated successfully..",
      icon: "success",
      timer: 2000,              
      buttons: false
      });
    }
 

    
 }

// END OF MAIN FOLDER 


// START OF MAKE SUB FOLDER 


function createSubFolderUnderMainFolder(parent_id){
  $('#selectedMainFolder').val(parent_id);
  $('#addSubFolderModalForImages').modal('show')
}
function checkAddSubFolderModalInput(folder_name,type){
  var random = Math.floor(Math.random() * 1000) + 1;
  var parent_id=  $('#selectedMainFolder').val();


    if(folder_name ==""){
      swal({
        title: "Create SubFolder",
        text: "Sub Folder name input can't be empty",
        icon: "error"    
      });
    }
  else{
    if(type ==="sub_create"){
      // alert(" if")
      if(checkDuplicateValueArray(folder_name,existing_folders_name)){
        swal({
          title: "Create Folder",
          text: "Folder name already exist, please use some other name",
          icon: "error"    
        });
        $('#album_folder_name').trigger('focus')
      }else{
        $('#addSubFolderModalForImages').modal('hide')
        album_folders.push({'folder_name':folder_name,'unq_id':random,'parent_id':parent_id})
        existing_folders_name.push(folder_name)
        // new_folders_ids.push(random)

        addSubFolderUnderMainFolderInTable(folder_name,random,parent_id);
        resetAddFolderNameModal('sub_folder')
        $('#selectedMainFolder').val('')
      }
     

    }
    else if(type ==="sub_update")
    {
      // alert("else if")
        updateFolderNameModalInput(folder_name)
    }else{

    }
    
  }
  
}

function addSubFolderUnderMainFolderInTable(fd_name,id,parent_id){
  var result = "";

  result += '<tr id="'+id+'" class="hideWhenSubmitting"  >';
  // result += '<td></td>';

var empty_td_count = $('#'+parent_id+' td:empty').length
empty_td_count = empty_td_count + 1;
for (let index = 0; index < empty_td_count; index++) {
  result += '<td></td>';
  
}


  result +='<td><span type=text class="form-control " id="folderNameInput_'+id+'" style="color:white">'+fd_name+'</span></td>'; 

  result +='<td><button type="button" onclick="createSubFolderUnderMainFolder('+id+')" class="btn btn-outline-primary" >Sub-Folder</button></td>';

  result +='<td><button type="button" class="btn btn-outline-warning "  id="editFolderNameInput_'+id+'"  onclick="getFolderNameBackToModalInput('+id+')" style="float:right"><i class="far fa-edit fa-fw"></i></button></td>';  

  result +='<td><button type="button" onclick="removeFolderNameRow('+id+')" class="btn btn-outline-danger" ><i class="fas fa-trash-alt fa-fw"></i></button></td>';  
  
  result +='</tr>';  

  $("#"+parent_id).after(result);


}


function promiseBeforeOpeningFolder(fd_name,id){
  console.log("promiseBeforeOpeningFolder")
  Promise.resolve().then(openClickedFolder(fd_name,id));

}
function openClickedFolder(fd_name,id){
 
  console.log("openClickedFolder")

var grep_result = $.grep(album_folders, function(e){ return e.parent_id == id; });

console.log(grep_result)

if(grep_result.length == 0){
  alert("if")
  var result = "";
  result += '<div class="row" style="margin:-20px;">';  
  result += '<div class="col-3">';  
  result += '<input type="file" name="fileToUpload'+id+'" id="fileToUpload_'+id+'" style="display: none;" onchange="uploadOnChange()" multiple>';  
  result += '<button type="button" class="btn btn-primary btn-sm"   id="uploadNewImagesButton_'+id+'" onclick="$("#fileToUpload"'+id+').trigger("click");">Add Images</button>';  
  result += '</div>';  
  result += '<div class="col-9">';  
                           
  result += ' </div>';  
  result += ' </div>';  
  result += '<br />';  
  result += ' <div id="process_div'+id+'"" style="display: none;">';  
  result += '<br />';  
  result += '<div id="uploading">';  
  result += 'div class="d-flex justify-content-between">';  
  result += '<small>Uploading Images</small>';  
                           
  result += '</div>';  
  result += '<div class="progress progress-lg mt-2">';  
  result += '<div class="progress-bar bg-success" role="progressbar" style="width: 0%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" id="percent">0%</div>';  
  result += '</div>';  
  result += '</div>';  
  result += '<br /><br />';  
  result += '<div id="data_processing" style="display:none">';  
  result += '<div class="loading-label" style="text-align: center;">';  
  result += '<small>Please wait...</small>';                         
  result += '</div>';  
                       
                       
  result += '<div class="dot-opacity-loader">';  
  result += '<span></span>';  
  result += '<span></span>';  
  result += '<span></span>';  
  result += '</div>';  
  result += '</div>';  
  result += '</div>';  
  result += '<div id="images_grid_'+id+'"  class="row">';                           
  result += '</div>';  

        //  console.log(result)   

  $('#mainFolderDiv').empty().hide();    // hide folder div
  $("#mainSubFolderDiv").empty().hide();    

  $("#folderUploadImageMainDiv").empty().append(result).show();   // empty upload image button container and add latest 

  
}else{
  alert("else")
  $("#mainSubFolderDiv").empty();

  for (let index = 0; index < grep_result.length; index++) {
    console.log(grep_result[index])  
        var sub_div = "";
        sub_div += '<div class="folderThreadDiv" id="folderThreadDiv_'+grep_result[index].unq_id+'" style=" font-weight: bold;font-size: 14px;float: left;cursor: pointer;margin: 5px;padding: 5px;text-align: center;width: 80px;">';
        sub_div += '<i class="fa fa-folder" style="font-size:36px; width: 50px;" onclick="promiseBeforeOpeningFolder('+grep_result[index].folder_name+','+grep_result[index].unq_id+')" id="folderIcon_'+grep_result[index].unq_id+'"></i>';
        sub_div += '<span style="display: block;" id="folderSpan_'+grep_result[index].unq_id+'">'+grep_result[index].folder_name+'</span>';
        sub_div += '</div>';
      console.log(sub_div)  
      $("#mainSubFolderDiv").append(sub_div); 
      $("#folderUploadImageMainDiv").empty().hide();   
   
  }
  $("#mainFolderDiv").hide();

$("#mainSubFolderDiv").show();
}



}

function checkDuplicateValueArray(value,array) 
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

function resetAddFolderNameModal(type){

  if(type ==="folder"){
    $('#album_folder_name').val('');
    $('#addFolderCreateButton').show()
    $('#addFolderUpdateButton').hide()
  }else if(type ==="sub_folder"){
    $('#album_sub_folder_name').val('');
    $('#addFolderSubCreateButton').show()
    $('#addFolderSubUpdateButton').hide()
  }
    
  }

  // function hideWhenFolderAndImageDiv(){
  //   // alert()
    

  //     $('#folderUploadImageMainDiv').hide()
  //     $('#linkMainRowDiv').hide()
  //     $('#mainSubFolderDiv').hide()
  //     $('#mainFolderDiv').show()
   
  //          // return false;

  //   }

  function removeFolderNameRow(id){
    swal({
      title: "Are you sure?",
      text: "Do you really want to delete this folder",
      icon: "warning",
      buttons: ["Cancel", "Yes"],
      dangerMode: false,
    })
    .then((proceed) => {
      if (proceed) {
      //     console.log(finalYoutubeLinkClassArray)
          
      //     for (let index = 0; index < finalYoutubeLinkClassArray.length; index++) {
      //       if($('#youtubeInput_'+counter).val()  === finalYoutubeLinkClassArray[index]){
      // //alert("in if")
      //         finalYoutubeLinkClassArray.splice(index, 1);
             
      //       }      
      //     }
  
          var fd_name = $('#folderNameInput_'+id).html()
          const index = existing_folders_name.indexOf(fd_name);
          if (index > -1) {
            existing_folders_name.splice(index, 1);
          }

          // const index = new_folders_ids.indexOf(id);
          // if (index > -1) {
          //   new_folders_ids.splice(index, 1);
          // }
          
          
                for (let index = 0; index < album_folders.length; index++) {
                  if( album_folders[index].folder_id  == id){
                    // alert("if")
                    album_folders.splice(index, 1);
                
                  }

                }  
          $('#'+id).remove();
          $('#folderThreadDiv_'+id).remove();
          $('#folder_template_id'+id).remove();

       
  
          console.log(album_folders)
          console.log(existing_folders_name)
          // console.log(new_folders_ids)


          
  
      } else {
       
      }
    });	
  }
  function uploadNow() {
    if (validFileList.length == 0) {
      swal({
        title: "Upload more images",
        text: "No Images added yet, please add atleast one to proceed..",
        icon: "error"    
      });
    }else{
      var folder_name_array=[];
 
      for (let index = 0; index < album_folders.length; index++){
         if(album_folders[index].exist == 0){
           
          let div_check =  $('#section_' + album_folders[index].folder_id).html().trim()
         //  console.log(div_check)
           if(div_check.length  < 1) {       
             folder_name_array.push(album_folders[index].folder_name)        
           }else{       
             const index2 = folder_name_array.indexOf(album_folders[index].folder_name)
             if (index2 > -1) {
               folder_name_array.splice(index2, 1);
             }
             
           }
         }else{
     
         }
     }
      
     console.log(folder_name_array)
       
         if(folder_name_array.length > 0){
          var temp_array = folder_name_array.join(',')
           swal({
             title: "Create Folder",
             text: "Folder named '"+temp_array+"' seems to be empty kindly upload image and proceed",
             icon: "error"    
           });
     
         }else{
           uploadMoreImagesAndFolders(validFileList);
         }
     
      
    }
// return false;
 console.log(album_folders)
 

 
}

function  uploadMoreImagesAndFolders(allFiles) {
 console.log(allFiles)
 // return false;
// alert()
 $("#progress_modal").modal('show');
 //  console.log(allFiles.length)
   event.preventDefault();
   event.stopPropagation();
   try {
     var data = new FormData();
     data.append("_token", $("#_token").val());
     data.append("assoc_id", assoc_id);

     var coverImage = [];
     const fileInput = document.getElementById('album_cover');
       const selectedFile = fileInput.files[0];
      // console.log(selectedFile);
     
     //var cover_image_ar = 
     if (allFiles.length != 0) {
           var files_info = [];
           for (var i = 0; i < allFiles.length; ++i) {
                          
             data.append('file[]', allFiles[i],allFiles[i].id+'_'+allFiles[i].name);
             files_info.push({name:allFiles[i].id+'_'+allFiles[i].name,folder_id:allFiles[i].folder_id}); 
           }
         
           
           
          data.append('files_info',JSON.stringify(files_info));
          data.append('folders_info',JSON.stringify(album_folders));

 
     }
    
    // console.log(JSON.stringify(files_info));

        data.append("main_album_id", $("#album_id").val());
       //  data.append("getValueForAlbumCoverIndex", $("#getValueForAlbumCoverIndex").val());
          
       //   data = data.entries();              
       // var obj = data.next();
       // var retrieved = {};             
       // while(undefined !== obj.value) {    
       //     retrieved[obj.value[0]] = obj.value[1];
       //     obj = data.next();
       // }
       // console.log('retrieved: ',retrieved);

       // return false;
       
         var request = new XMLHttpRequest();
 
         request.upload.addEventListener("progress", function (e) {
           $('#new_image_album_add_images_button').hide();
         
 //to disable finish and prev after clicking finish button
       var finish_button = $("#new_image_album").find('a[href="#finish"]');   
       var previous_button = $("#new_image_album").find('a[href="#previous"]');     
   
       finish_button.parent().hide()
       previous_button.parent().hide()
 
 //to disable tab switching after clicking finish button
       var step_1 = $("#new_image_album").find('a[href="#steps-uid-0-h-0"]');   
       var step_2 = $("#new_image_album").find('a[href="#steps-uid-0-h-1"]'); 
       // var step_3 = $("#new_image_album").find('a[href="#steps-uid-0-h-2"]');   
   
 
       step_1.parent().addClass('disabled')
       step_2.parent().addClass('disabled')
       // step_3.parent().addClass('disabled')
 
 
 
 
           var els = document.getElementsByTagName("a");
           for (var i = 0, l = els.length; i < l; i++) {
             if (els[i].href === 'finish') {
                 console.log(els[i].href)
                 els[i].disabled = true;
 
               }
           }
 
           if (e.lengthComputable) {
            // $("#process_div").show();
             var progressWidth = Math.floor((e.loaded / e.total) * 100) + '%';
             console.log(progressWidth)
             $("#upload_percent").html(progressWidth);
             
             $('#image_upload_progressbar').attr('style', 'width: ' + progressWidth);
             if (progressWidth == "100%") {             
               
               $("#progress_div").hide();
               $("#please_wait").show();
             }
           }
           
         });
         request.addEventListener("load", function () {
           $("#images_grid").empty();
           document.getElementById('fileToUpload').value = "";
           validFileList.length = 0;
           // document.getElementById('album_cover').value = "";
  
         
           
         });
         request.addEventListener("error", function () {
         
           // var finish_button = $("#new_image_album").find('a[href="#finish"]');   
           // var previous_button = $("#new_image_album").find('a[href="#previous"]');     
       
           // finish_button.parent().show();
           // previous_button.parent().show();
 
           // var step_1 = $("#new_image_album").find('a[href="#steps-uid-0-h-0"]');   
           // var step_2 = $("#new_image_album").find('a[href="#steps-uid-0-h-1"]');   
     
           // step_1.parent().removeClass('disabled')
           // step_2.parent().removeClass('disabled')
     
           // $('.hideWhenSubmitting').show()
 
         });
         request.addEventListener('readystatechange', function () {
           if (this.readyState === 4) {
             var response = [];
 //console.log(request.responseText);
    try{
           response = JSON.parse(request.responseText);
           //  var count = JSON.stringify(response);
           if (response != "") {
        
               switch (response.status) {
                 case "success":
                   $("#progress_modal").modal('show');
                   validDocImage = [];
                 
                   swal({title: "Success", text: "Album has been updated successfully!", type: 
                   "success"}).then(function(){ 
                       location.reload();
                     }
);
 
           $('#no_folders').prop('checked', false)
 
                   $("#data_processing").hide();
                   $("#images_grid").empty();
                   $("#process_div").hide();
                         break;
                         default:
                           $("#progress_modal").modal('show');
                           swal({
                             title: "FAILED",
                             text: "Failed to create",
                             icon: "error",
                             buttons: false
                             });
                             setTimeout(
                               function() {
                                 window.location.href = window.location;    //redirect to add new route after interval of 2 sec-
                               }, 2000);
                         break;
                 
                       }
                     }
                   }catch(e){
                     swal({title: "Failed to Upload Album", text: "Error:Some Images are unable to upload.", type: 
                     "error"}).then(function(){ 
                        location.reload();
                        }
                     );
                   } 
                 }
                     });
             //  if (window.location.href.indexOf("album") > -1) {
               request.open('POST', '/assoc_admin/uploadMoreImagesAndFoldersAssoc');
             // } else if (window.location.href.indexOf("video_album") > -1){
             //   request.open('POST', '/admin/createNewVideoAlbum');
             // }else{
            
             //  }

         request.setRequestHeader('Cache-Control', 'no-cache');
         //  document.getElementById('upload_progress').style.display="block";
 
 
 
         request.send(data);
     
     
   } catch (e) {
 
   }
 }

 function updateSelectedAlbumDetails()
 {
      
         try {
             // alert()
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
               const fileInput = document.getElementById('album_cover');
               const selectedFile = fileInput.files[0];            
     
               var data = new FormData();
     
               data.append("_token", $("#_token").val());  
               data.append("assoc_id", $("#assoc_id").val());  

               data.append("selected_album_id", $("#album_id").val());
 
               if(album_type ==="1"){
                 data.append("album_name_input", $("#album_name_input").val());
                 data.append("album_type", album_type);                 
               }else if(album_type ==="2"){
                data.append("album_name_input", $("#album_name_input").val());
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
            //  alert()
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
                           title: "Update-Image-Album!",
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
                    
                     request.open('POST', '/assoc_admin/updateSelectedImageAlbumDetails');
                  
     
               request.setRequestHeader('Cache-Control', 'no-cache');
               //  document.getElementById('upload_progress').style.display="block";
       
       
       
               request.send(data);
           
           
         } catch (e) {
       
         }
 }
var originalFileNameInput = ""//"#{id:originalFileNameInput}";
var fileUpload = ""//"#{id:fileUpload}";
var uploadedByInput = ""//"#{id:uploadedByInput}";
var fileSizeInput = ""//"#{id:fileSizeInput}";
//var $fileDropDiv = $('#{id:fileDropDiv}');
var $uploadTableDiv = $("#uploadTableDiv");
var fileUploadUrl = "sharing";
var $fileUploadBtn = $("#fileUploadBtn");
var validExtensions = /jpg|jpeg/; // regular expression of allowed file types
var validVideoExtensions ;
var isImage = /image\/*/;
var maxFileSize = 10; //max files size in MB
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
var allImagesName= [];

var commissionMember= [];
var existingCommissionMember=[];
var validFileList = []; //we need a global variable to modify the filelist
var existingMemberValidFileList = []; //we need a global variable to modify the filelist
var removedExistingMemberIds=[];

var member_id=0;

var member_position= [];

var addImageToTable='';
var removedExistingMemberImage=[];


var new_commission_form = $("#new_commission_form");

new_commission_form.val({
  errorPlacement: function errorPlacement(error, element) {
    element.before(error);
  },
  rules: {
    confirm: {
      equalTo: "#password"
    }
  }
});
new_commission_form.children("div").steps({
  headerTag: "h5",
  bodyTag: "section",
  transitionEffect: "slideLeft",
  onStepChanging: function (event, currentIndex, newIndex) {
    if (currentIndex < newIndex) {
      if (stepValidation(currentIndex)) {
        new_commission_form.val({
          ignore: [":disabled", ":hidden"]
        })
        console.log(event)
        return new_commission_form.val();
      }
    }else{
      new_commission_form.val({
        ignore: [":disabled", ":hidden"]
      })
      console.log(event)
      return new_commission_form.val();
    }
  },
  onFinishing: function(event, currentIndex) {
    new_commission_form.val({
      ignore: [':disabled']
    })
    return new_commission_form.val();
  },
  onFinished: function(event, currentIndex) {
   
    if(commissionMember.length == 0 ){
      swal({
        title: "Are you sure?",
        text: "No members added yet. Still want to proceed \n Also, You can add members in edit Commission option",
        icon: "warning",
        buttons: ["Cancel", "Yes"],
        dangerMode: false,
      })
      .then((proceed) => {
        if (proceed) {
           handleUpload()
        } else {
         
        }
      });	
    }else{
      handleUpload()
    }
  }
  
  
});
function hasError(){

}
function removeError(){

}
function stepValidation(currentIndex){
  // alert(currentIndex)
  console.log("currentIndex", currentIndex)
  // return true
  if (currentIndex == 0) {
 
    // console.log()
    var allow= true;   
    var hasErrorArray=[];
    var removeErrorArray=[];

 $('.create_commission_require').each(function() {     //input text/number validation
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


    var com_name = $('#commission_name').val();
    $('#commission_name_step2_header').html(com_name)
    $('#commission_modal_heading').html("COMMISSION : "+com_name)

    
  
      return allow;
   // return true;
    
  } else if(currentIndex == 1){
    var  allow= true; 
    if(commissionMember.length == 0){ 
      swal({
        title: "Create Member",
        text: "No members added yet, please add atleast 1 to proceed...",
        icon: "error",
      
      });
   
      allow= false;   

     }
     
       return allow
     
  }
  
  else{
    // return false;
  }

 

}

function genarateRandomMemberIdForImageObjectRef(){
  member_id = Math.floor(Math.random() * 1000000000).toString();

  addImageToTable='';
}

function verifyEmptyInputsBeforeProceeding(){
  var allow= true;   
  var hasErrorArray=[];
  var removeErrorArray=[];
  
  $('.add_member_require').each(function() {     //input text/number validation
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
  
    for (let index = 0; index < hasErrorArray.length; index++) {
     
      $('#'+hasErrorArray[index].id).addClass('border border-danger');
      $('#error_'+hasErrorArray[index].id).html('').append('<span class="text-danger" style="font-size:8pt;display:block;">'+hasErrorArray[index].placeholder+' input cannot be empty.</span>')
      $('#'+hasErrorArray[0].id).trigger('focus');
        
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

  console.log(validFileList.length)
  // const fileInput = document.getElementById('fileToUpload');
  // const selectedFile = fileInput.files[0];

  // if(selectedFile){

  // }else{

  // }
    
console.log(allow)


  if(!allow){
    return allow;
  }else{
    verifyPostionsBeforeAddingMember()
  }

 
}

function verifyPostionsBeforeAddingMember(){
  console.log(member_id)
  var comm_member_position = $('#comm_member_position').val()
  console.log(member_position)
    if(member_position.includes(comm_member_position)){
      swal({
            title: "Add Commission Members",
            text: "Member with postion already exist",
            icon: "error",
         
            });
    }else{
      addCommissionMember()
    }
 
}
function addCommissionMember(){
  if(commissionMember.length == 0){
    $("#commission_member_grid").empty();
   }
   
  var comm_member_name = $('#comm_member_name').val();
  var comm_member_designation = $('#comm_member_designation').val();
  var comm_member_position=  $('#comm_member_position').val();
  member_position.push(comm_member_position);

  commissionMember.push({id:member_id, member_name: comm_member_name, member_designation:comm_member_designation,member_position: comm_member_position});
  
  console.log(commissionMember)
  console.log(validFileList)

  resetAddMemberModal();

  createMemberEntryInDiv(member_id,comm_member_name,comm_member_designation,comm_member_position);
  
  
}

function createMemberEntryInDiv(mem_id,mem_name,mem_desg,mem_pos)
{
// console.log(mem_name)
  $('#myModal').modal('hide');


  var result = "";
 

  result += '<tr id="mainAddCommissionMemberRow_'+mem_id+'" class="hideWhenSubmitting" >';

  result +='<td>';                              
  result += '<input type="text" class="form-control"  id="memberName_'+mem_id+'" placeholder="Member-Name" value="'+mem_name+'" disabled style="color:white">'
  result += '</td>'; 
  
  result +='<td>';                              
  result += '<input type="text" class="form-control" id="memberDesg_'+mem_id+'" placeholder="Member-Designation" value="'+mem_desg+'" disabled style="color:white">'
  result += '</td>'; 

  result +='<td>';                              
  result += '<input type="text" class="form-control" id="memberPos_'+mem_id+'" placeholder="Member-Position" value="'+mem_pos+'" disabled style="color:white">'
  result += '</td>'; 

  result +='<td style="max-height:50px;"><span id="memberImage_'+mem_id+'">'+addImageToTable+'</span></td>';


  
  result +='<td>';                              
  result += '<button type="button" class="btn btn-outline-primary hideWhenSubmitting confirmAddMemberButton"  id="editCommissionMemberButton_'+mem_id+'"  onclick="editCommissionMember('+mem_id+')"><i class=" fa fa-edit fa-lg fa-fw " ></i></button>';                              
  result +='</td>'; 


  result +='<td>';                              
  result += '<button type="button" onclick="removeCommissionMemberInputRow('+mem_id+')" class="btn btn-outline-danger hideWhenSubmitting" ><i class=" fa fa-trash fa-fw fa-lg " ></i></button>';                              
  result +='</td>';                              


  result +='</tr>';                              
                           
    
// console.log(result)
  $("#commission_member_grid").prepend(result);

var elem = document.getElementById('mainAddCommissionMemberRow_'+mem_id);  
elem.scrollIntoView(true); 
  // alert()
}

  function editCommissionMember(mem_id){
    addImageToTable = '';
    var member_position_before_edit = 0;
        $('#current_member_edit_id').val(mem_id)
    for (let index = 0; index < commissionMember.length; index++) {   //filling modal input
        if(commissionMember[index].id ==  mem_id){
          
          $('#commission_member_name_in_modal_heading').html(commissionMember[index].name)
          $('#comm_member_name').val(commissionMember[index].member_name)         
          $('#comm_member_designation').val(commissionMember[index].member_designation)         
          $('#comm_member_position').val(commissionMember[index].member_position)  
          member_position_before_edit = commissionMember[index].member_position;
        }      
    }

    for (var i = 0; i < validFileList.length; i++) {             //filling modal image
        if (validFileList[i].parent_id == mem_id) {
          // $('#'+validFileList[i].id).remove();
          console.log(validFileList[i])
          reuploadImageInModal(validFileList[i])
        }
    }
    $('#addMemberButton').html('<i class="fa fa-refresh fa-fw"></i> Update')   //updating modal button text and onclick function
    $('#addMemberButton').attr('onclick','updateCommissionMember("'+mem_id+'", "'+member_position_before_edit+'")')
    $('#addMemberCloseButton').hide();   //hide close to avoid
    $('#myModal').modal('show');
    member_id = mem_id;   // so that when user change the image parent id wont change

  }

function updateCommissionMember(mem_id,postion_before_edit){
  // alert(postion_before_edit)
  var comm_member_position = $('#comm_member_position').val()

    if(comm_member_position == postion_before_edit)
    {
           if(checkImageExistence(mem_id)) {  
             
            updateObjectAndTableData(mem_id)
              
            }else{
              swal({
                title: "Add Commission Members",
                text: "Please select a file/image to proceed...",
                icon: "error",
            
                });
            } 
        
    }else{
      const index = member_position.indexOf(postion_before_edit);          
        member_position.splice(index,1)
        console.log(member_position)
        if(member_position.includes(comm_member_position)){
          swal({
                title: "Add Commission Members",
                text: "Member with entered postion already exist",
                icon: "error",
            
                });
        }else{

          if(checkImageExistence(mem_id)) {      
            updateObjectAndTableData(mem_id) 
            
          } else{
            swal({
              title: "Add Commission Members",
              text: "Please select a file/image to proceed...",
              icon: "error",
          
              });
          }   
        }

     
    }
  
    

}

function checkImageExistence(mem_id){
  // alert(mem_id)
      var exist = false;
      for (var i = 0; i < validFileList.length; i++) {
                
        if (validFileList[i].parent_id == mem_id) {
          
          exist = true;
        }
      } 

    //  alert(exist)
       return exist;
      
}
function updateObjectAndTableData(mem_id){
  // console.log(addImageToTable)
    var comm_member_position = $('#comm_member_position').val()
        for (let index = 0; index < commissionMember.length; index++) {
          if(commissionMember[index].id ==  mem_id){
            commissionMember[index].member_name =  $('#comm_member_name').val()         
            commissionMember[index].member_designation=  $('#comm_member_designation').val()         
            commissionMember[index].member_position =  $('#comm_member_position').val()  

            $('#mainAddCommissionMemberRow_'+mem_id).find('#memberName_'+mem_id).val('').val($('#comm_member_name').val())
            $('#mainAddCommissionMemberRow_'+mem_id).find('#memberDesg_'+mem_id).val('').val($('#comm_member_designation').val())
            $('#mainAddCommissionMemberRow_'+mem_id).find('#memberPos_'+mem_id).val('').val($('#comm_member_position').val())
            $('#mainAddCommissionMemberRow_'+mem_id).find('#memberImage_'+mem_id).html('').html(addImageToTable)
            member_position.push(comm_member_position)

          }      
      }
      console.log(commissionMember)
      console.log(validFileList)

      $('#myModal').modal('hide');
      resetAddMemberModal();
}
function uploadOnChange() {
  try {
    // alert()
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

           //we need to generate a random id for the file if we need to delete the file later
      file.id = Math.floor(Math.random() * 1000000000).toString(); //add a random number as the id property of the file object
      file.parent_id = member_id;
    
              //   if(allImagesName.includes(file.name)){
              //     alert("if")
              //  } else{
              //     alert("else")
              //  } 
              //  abc= file.name;
              //  allImagesName.push(abc) 
      if (file.type.match(isImage)) {
        isGoodImage(file).then(function (isGood) {
          if (isGood) {
            validFileList.push(file);
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = (function (file) {
              return function (e) {
                

                    
                  var image = '<img src=' + e.target.result + '   height="180" width="180" class="img-responsive center-block d-block mx-auto" >';
                  file.name=Math.floor(Math.random() * 1000000000).toString()
                  // console.log(file.name)
                  addUploadTableRow(image, file.name, file.size, file.id);

                
                 

                
              };
            })(file);
            // reader = "";

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
function reuploadImageInModal(file) {

 console.log(file);
    //  var currentFileExt = file.type;
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = (function (file) {
              return function (e) {
                                
                  var image = '<img src=' + e.target.result + '   height="180" width="180" class="img-responsive center-block d-block mx-auto" >';
                  addUploadTableRow(image, file.name, file.size, file.id);

                
                  
                
              };
            })(file);

            reader.error = function (e) {


              alert("something bad happened: " + e);
            };
            reader.onloadstart = function (e) {


            };
            reader.onloadend = function (data) {


            };
          
        
      //end else
  

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
      
      });
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
      var width = image.naturalWidth,
         height = image.naturalHeight;

    // Check the image resolution
    // if ((this.width >= widthMin && this.width <= widthMax) && (this.height >= heightMin && this.height <= heightMax)) {
      if((width < 355 && width > 345) && (height < 255 && height > 245) ) {
        
        
          
        deferred.resolve(true);
     

    } else {
      $('#docImageUploadPrevDiv').empty();
        swal({
                  title: "Incorrect Resolution",
                  text: "Please upload cover image with Resolution specified 350X250",
                  icon: "error",
                
            });
      deferred.resolve(false);

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


function addUploadTableRow(icon, name, size, index) {
  $('.loader').show();
  addImageToTable = icon;
     
  var fileSize = parseInt(size / 1024, 10) + " kb";
/* I create the upload que table with JQuery. I tried plain Javascript but I lost the UIkit styling.
* I dynamically add a <tr>  element to the table and 5 <td> elements
*
* */
  var rowCol = $('<div />', {
    // 'class': 'col-12 col-xs-12 col-sm-6 col-md-4 col-lg-3',
    'style': 'margin:0px auto',
    attr: {
      'id': index
    }
  });

 
 

  rowCol.append($('<div />', {
    'class': 'card',
  }).append($('<div />', {
    'class': '',
  }))
  .append(icon)
    .append('<hr>')
    .append($('<div />', {
      'class': '',
    }).append($('<div />', {
      'style': 'text-align:center;font-size: 10px;',
    }).append(name+"<b>(" + fileSize + ")</b> ")
    .append($('<button />', {
      'class': 'btn btn-outline-danger hideWhenSubmitting fa-xs',
      'style':'float:right',
      'type': 'button',
      'onclick': 'removeFile(' + index + ')',
      attr: {
        'data-file-id': index
      }
    }).append('<b><i class="fa fa-trash fa-lg fa-fw"></i></b>'))
    
    )
    
    
    ));

    

  $("#docImageUploadPrevDiv").append(rowCol).show();
  $("#uploadImageCommissionMemberButtonDiv").hide();

  

  

  $('.loader').hide(); 
  


  jQuery('.onlyOneToNine').on('keyup',function () {       //applying image sequence to be between 1-9 only no zero allowed 
    
    this.value = this.value.replace(/[^1-9\.]/g,'1');
  });


  


}



function removeFile(index) {
 // alert(validFileList.length)
  var clickedId = index; // on click it removes the row fom the queue
  deletefileUploadRow(clickedId);
  removeFileFromValidFileList(clickedId);
  if (validFileList.length == 0 ) {
    $uploadTableDiv.addClass('hide'); //if there are no files to upload, hide the table
  }
 // alert(validFileList.length)
}
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
console.log(id)

for (var i = 0; i < validFileList.length; i++) {
 
  
  if (validFileList[i].id == id) {
    var index = i;
    seq = 1;
  }
}

validFileList.splice(index, 1);

 console.log(validFileList)
   
   
 if(validFileList.length == 0){
  document.getElementById('fileToUpload').value = "";
 }
 
   $("#docImageUploadPrevDiv").hide();
   $("#uploadImageCommissionMemberButtonDiv").show();
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


function removeCommissionMemberInputRow(mem_id)
  {
  // alert($('#commissionMemberInput_'+counter).val())
    swal({
      title: "Are you sure?",
      text: "Do you really want to delete clicked member",
      icon: "warning",
      buttons: ["Cancel", "Yes"],
      dangerMode: false,
    })
    .then((proceed) => {
      if (proceed) {
          
       
  
          for (let index = 0; index < commissionMember.length; index++) {
            if(commissionMember[index].id ==  mem_id){
              var index1 = member_position.indexOf(commissionMember[index].member_position);
              if (index1 !== -1) {
                member_position.splice(index1, 1);
              }
              commissionMember.splice(index, 1);             
            }      
          }
          $('#mainAddCommissionMemberRow_'+mem_id).remove();
  
          console.log(commissionMember)

          for (var i = 0; i < validFileList.length; i++) {
            
            if (validFileList[i].parent_id == mem_id) {
              // $('#'+validFileList[i].id).remove();
              validFileList.splice(i, 1);
            }
          }
       
          console.log(commissionMember)
          console.log(validFileList)

          addEmptyRowToTableIfObejectIsEmpty()
  
      } else {
       
      }
    });	
  
    
  }
  
function resetAddMemberModal(){
  $('.add_member_require').val('');

  $('#docImageUploadPrevDiv').html('')
  $('#uploadImageCommissionMemberButtonDiv').show()
  $('#docImageUploadPrevDiv').hide()

  $('#current_member_edit_id').val('')
  $('#addMemberButton').html('<i class="fa fa-plus fa-fw"></i> Add')
  $('#addMemberButton').attr('onclick','verifyEmptyInputsBeforeProceeding()')
  $('#addMemberCloseButton').show();

}

function addEmptyRowToTableIfObejectIsEmpty(){
  if(commissionMember.length == 0){
    var result = "";
    result += '<tr>';
    result +=  '<td colspan="6" style="text-align:center">';
    result +=  'No new members added yet';
    result +=  '</td>';
    result +=  '</tr>';
    $("#commission_member_grid").append(result);
   }
   
}


function  handleUpload() {
  
    try {


// alert()
          event.preventDefault();
          event.stopPropagation();
          var commission_name =  $("#commission_name").val()
          var files_info = [];
          var data = new FormData();

        
          data.append("_token", $("#_token").val());       
          data.append("commission_name",commission_name);
        
            for (var i = 0; i < validFileList.length; ++i) {            
              
              data.append('file[]', validFileList[i],validFileList[i].id+'_'+validFileList[i].name);
              // files_info.push({parent_id:validFileList[i].parent_id,name:validFileList[i].name}); 
              files_info.push({parent_id:validFileList[i].parent_id,name:validFileList[i].id+'_'+validFileList[i].name}); 
            }

          data.append('commissionMember',JSON.stringify(commissionMember));
          data.append('files_info',JSON.stringify(files_info));

               
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
  //to disable finish and prev after clicking finish button
        var finish_button = $("#new_commission_form").find('a[href="#finish"]');   
        var previous_button = $("#new_commission_form").find('a[href="#previous"]');     
    
        finish_button.parent().hide()
        previous_button.parent().hide()
  
  //to disable tab switching after clicking finish button
        var step_1 = $("#new_commission_form").find('a[href="#steps-uid-0-h-0"]');   
        var step_2 = $("#new_commission_form").find('a[href="#steps-uid-0-h-1"]'); 
        // var step_3 = $("#new_image_album").find('a[href="#steps-uid-0-h-2"]');   
    
  
        step_1.parent().addClass('disabled')
        step_2.parent().addClass('disabled')
        // step_3.parent().addClass('disabled')
  
  
        $('.hideWhenSubmitting').hide()

  
            var els = document.getElementsByTagName("a");
            for (var i = 0, l = els.length; i < l; i++) {
              if (els[i].href === 'finish') {
                  console.log(els[i].href)
                  els[i].disabled = true;
  
                }
            }
  
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
            $("#commission_member_grid").empty();
            document.getElementById('fileToUpload').value = "";
            validFileList.length = 0;
            commissionMember= [];
            addImageToTable=''
            member_id=0;            
            member_position=[];
            resetAddMemberModal()
  
            
             // reset cover image  hidden fields
              // $('#getValueForAlbumCover').val('')
              // $('#getValueForAlbumCoverIndex').val('')
          
          });
          request.addEventListener("error", function () {
          
            var finish_button = $("#new_video_album").find('a[href="#finish"]');   
            var previous_button = $("#new_video_album").find('a[href="#previous"]');     
        
            finish_button.parent().show();
            previous_button.parent().show();
  
            var step_1 = $("#new_video_album").find('a[href="#steps-uid-0-h-0"]');   
            var step_2 = $("#new_video_album").find('a[href="#steps-uid-0-h-1"]');   
      
            step_1.parent().removeClass('disabled')
            step_2.parent().removeClass('disabled')
      
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
                    validFileList = [];
                    // showSwal('added-new-product',"Success","Created Successfully");
                    swal({
                      title: "Added-new-Commission!",
                      text: "Created Successfully",
                      icon: "success",
                      timer: 1500,              
                      buttons: false
                      });
  
                      setTimeout(
                        function() {
                          window.location.href = "/admin/commission";    //redirect to add new route after interval of 2 sec-
                        }, 2000);
  
  
                    $("#data_processing").hide();
                    $("#images_grid").empty();
                    $("#process_div").hide();
                          break;
                  
                        }
                      }
                      
                  }
                      });
               
                request.open('POST', '/admin/createNewCommission');
             

          request.setRequestHeader('Cache-Control', 'no-cache');
          //  document.getElementById('upload_progress').style.display="block";
  
  
  
          request.send(data);
      
      
    } catch (e) {
  
    }
  }

//existing members functions

function getAllMembersForSelectedCommission(comm_id){
  $.ajax({
    type: "GET",
    url: "/admin/getAllMembersForSelectedCommission/"+comm_id,
     beforeSend: function(){
  $('.loader').show()
      },
      complete: function(){
        $('.loader').hide()
      },
    success: function(response){
      // console.log(response);
   var data = JSON.parse(response);
    if(data!=""){
    console.log(data)
    // validFileList.length = 0;
    // commissionMember;
    // addImageToTable=''
    // member_id=0;            
    member_position= []
    existingCommissionMember= []
         $.each(data, function(i, item) {  

      var result = "";

      
      result += '<tr id="existingMainAddCommissionMemberRow_'+item.id+'" class="hideWhenSubmitting" >';
    
      result +='<td>';                              
      result += '<input type="text" class="form-control"  id="existingMemberName_'+item.id+'" placeholder="Member-Name" value="'+item.name+'" disabled style="color:white">'
      result += '</td>'; 
      
      result +='<td>';                              
      result += '<input type="text" class="form-control" id="existingMemberDesg_'+item.id+'" placeholder="Member-Designation" value="'+item.designation+'" disabled style="color:white">'
      result += '</td>'; 
    
      result +='<td>';                              
      result += '<input type="text" class="form-control" id="existingMemberPos_'+item.id+'" placeholder="Member-Position" value="'+item.position+'" disabled style="color:white">'
      result += '</td>'; 
    
      result +='<td style="max-height:50px;"><span id="existingMemberImage_'+item.id+'"><img src="'+item.image+'" height="180" width="180" class="img-responsive center-block d-block mx-auto" ></span></td>';
    
    
      
      result +='<td>';                              
      result += '<button type="button" class="btn btn-outline-primary hideWhenSubmitting confirmAddMemberButton"  id="editExistingCommissionMemberButton_'+item.id+'"  onclick="editExistingCommissionMember('+item.id+')"><i class=" fa fa-edit fa-lg fa-fw " ></i></button>';                              
      result +='</td>'; 
    
    
      result +='<td>';                              
      result += '<button type="button" onclick="removeExistingCommissionMemberInputRow('+item.id+')" class="btn btn-outline-danger hideWhenSubmitting" ><i class=" fa fa-trash fa-fw fa-lg " ></i></button>';                              
      result +='</div>';                              
    
    
      result +='</tr>';   
     
                         
      existingCommissionMember.push(item)
      member_position.push(item.position)

      $("#existing_commission_member_grid").append(result); 

     

        
   

     });    
     console.log(member_position)
 
      }
      else{    
        result= "";  
        result +='<tr>';
        result +='<td colspan="6" style="text-align:center">'; 
        result +=' No existing member present, add new';  
        result +='<td>';
        result +='<tr>'; 
        $("#existing_commission_member_grid").append(result); 

        
      }
    
    }
  });
}

// function verifyExistingMemberEmptyInputsBeforeProceeding(){
//   var allow= true;   
//   $('.existing_member_add_member_require').each(function() {//input text validation
//     var sickfull = $(this).val().trim();
//       if (!sickfull)
//       {
//         $(this).addClass('border border-danger');
        
//         $(this).trigger('focus')     
//         allow= false;  
        
//         swal({
//           title: "Existing Commission Members",
//           text: "Inputs can't be empty",
//           icon: "error",
       
//           });
           
//       }
//       else{
        
//         $(this).removeClass('border border-danger');
//       }                    

//   });
  
//   if($("#existingDocImageUploadPrevDiv").text().length < 1  ) {
//     allow= false;     
//     swal({
//       title: "Existing Commission Members",
//       text: "Please select a file/image to proceed...",
//       icon: "error",
   
//       });
//   }   

//   if(!allow){
//     return allow;
//   }else{
//     verifyExistingMemberPostionsBeforeAddingMember()
//   }

 
// }

// function verifyExistingMemberPostionsBeforeAddingMember(){
//   console.log(member_id)
//   var existing_comm_member_position = $('#existing_comm_member_position').val()
//   console.log(member_position)
//     if(member_position.includes(existing_comm_member_position)){
//       swal({
//             title: "Existing Commission Members",
//             text: "Member with postion already exist",
//             icon: "error",
         
//             });
//     }else{
//       addExistingCommissionMember()
//     }
 
// }
// function addExistingCommissionMember(){
//   if(commissionMember.length == 0){
//     $("#commission_member_grid").empty();
//    }
   
//   var comm_member_name = $('#comm_member_name').val();
//   var comm_member_designation = $('#comm_member_designation').val();
//   var comm_member_position=  $('#comm_member_position').val();
//   member_position.push(comm_member_position);

//   existingCommissionMember.push({id:member_id, member_name: comm_member_name, member_designation:comm_member_designation,member_position: comm_member_position});
  
//   console.log(commissionMember)
//   console.log(validFileList)

//   resetAddMemberModal();

//   createExistingMemberEntryInDiv(member_id,comm_member_name,comm_member_designation,comm_member_position);
  
  
// }

// function createExistingMemberEntryInDiv(mem_id,mem_name,mem_desg,mem_pos)
// {
// // console.log(mem_name)
//   $('#myModal').modal('hide');


//   var result = "";
 

//   result += '<tr id="mainAddCommissionMemberRow_'+mem_id+'" class="hideWhenSubmitting" >';

//   result +='<td>';                              
//   result += '<input type="text" class="form-control"  id="memberName_'+mem_id+'" placeholder="Member-Name" value="'+mem_name+'" disabled style="color:white">'
//   result += '</td>'; 
  
//   result +='<td>';                              
//   result += '<input type="text" class="form-control" id="memberDesg_'+mem_id+'" placeholder="Member-Designation" value="'+mem_desg+'" disabled style="color:white">'
//   result += '</td>'; 

//   result +='<td>';                              
//   result += '<input type="text" class="form-control" id="memberPos_'+mem_id+'" placeholder="Member-Position" value="'+mem_pos+'" disabled style="color:white">'
//   result += '</td>'; 

//   result +='<td style="max-height:50px;"><span id="memberImage_'+mem_id+'">'+addImageToTable+'</span></td>';


  
//   result +='<td>';                              
//   result += '<button type="button" class="btn btn-outline-primary hideWhenSubmitting confirmAddMemberButton"  id="editCommissionMemberButton_'+mem_id+'"  onclick="editCommissionMember('+mem_id+')"><i class=" fa fa-edit fa-lg fa-fw " ></i></button>';                              
//   result +='</td>'; 


//   result +='<td>';                              
//   result += '<button type="button" onclick="removeCommissionMemberInputRow('+mem_id+')" class="btn btn-outline-danger hideWhenSubmitting" ><i class=" fa fa-trash fa-fw fa-lg " ></i></button>';                              
//   result +='</div>';                              


//   result +='</tr>';                              
                           
    
// // console.log(result)
//   $("#commission_member_grid").append(result);
  
// }
  
  function removeExistingCommissionMemberInputRow(mem_id)
  {
  // alert($('#commissionMemberInput_'+counter).val())
  swal({
    title: "Are you sure?",
    text: "Do you really want to delete clicked member",
    icon: "warning",
    buttons: ["Cancel", "Yes"],
    dangerMode: false,
  })
  .then((proceed) => {
    if (proceed) {
        
     
      
        for (let index = 0; index < existingCommissionMember.length; index++) {
          if(existingCommissionMember[index].id ==  mem_id){
            const index1 = member_position.indexOf(existingCommissionMember[index].position);          
            member_position.splice(index1,1)    
            removedExistingMemberIds.push({id:existingCommissionMember[index].id,name:existingCommissionMember[index].name })
            existingCommissionMember.splice(index, 1); 
                   
          }      
        }
        $('#existingMainAddCommissionMemberRow_'+mem_id).remove();
  
  
        for (var i = 0; i < existingMemberValidFileList.length; i++) {
          
          if (existingMemberValidFileList[i].parent_id == mem_id) {
            // $('#'+validFileList[i].id).remove();
            existingMemberValidFileList.splice(i, 1);
          }
        }
     
        console.log(existingCommissionMember)
        console.log(existingMemberValidFileList)
  
        addEmptyRowToTableIfExistingMemberObjectIsEmpty()
  
    } else {
     
    }
  });	
  
  
  }
  
  
  function addEmptyRowToTableIfExistingMemberObjectIsEmpty(){
    if(existingCommissionMember.length == 0){
      var result = "";
      result += '<tr>';
      result +=  '<td colspan="6" style="text-align:center">';
      result +=  'No existing members to display';
      result +=  '</td>';
      result +=  '</tr>';
      $("#existing_commission_member_grid").append(result);
     }
     
  }

function editExistingCommissionMember(mem_id){
  
  var member_position_before_edit = 0;
  var allowExistingMemberImageToEditUsingFileObject =$('#allowExistingMemberImageToEditUsingFileObject').val()
      $('#current_member_edit_id').val(mem_id)
      for (let index = 0; index < existingCommissionMember.length; index++) {   //filling modal input
          if(existingCommissionMember[index].id ==  mem_id){
            $('#existing_commission_member_name_in_modal_heading').html(existingCommissionMember[index].name) 
            $('#existing_comm_member_name').val(existingCommissionMember[index].name)         
            $('#existing_comm_member_designation').val(existingCommissionMember[index].designation)         
            $('#existing_comm_member_position').val(existingCommissionMember[index].position)  
            
            addImageToTable = '<span id="existingMemberImage_'+existingCommissionMember[index].id+'"><img src="'+existingCommissionMember[index].image+'" height="180" width="180" class="img-responsive center-block d-block mx-auto" ></span>';
            member_position_before_edit = existingCommissionMember[index].position;
            if(allowExistingMemberImageToEditUsingFileObject === '0'){
              reuploadImageFirstTimeInModalForExistingMembers(existingCommissionMember[index].image,mem_id)
            }else{
                for (var i = 0; i < existingMemberValidFileList.length; i++) {             //filling modal image
                  if (existingMemberValidFileList[i].parent_id == mem_id) {
                    // $('#'+validFileList[i].id).remove();
                    console.log(existingMemberValidFileList[i])
                    reuploadImageInModalForExistingMembers(existingMemberValidFileList[i])
                  }
            }
          
          }      
      }

 

}
  $('#existingAddMemberButton').html('<i class="fa fa-refresh fa-fw"></i> Update')   //updating modal button text and onclick function
  $('#existingAddMemberButton').attr('onclick','updateExistingCommissionMember("'+mem_id+'", "'+member_position_before_edit+'")')
  $('#existingAddMemberCloseButton').hide();   //hide close to avoid
  $('#uploadImageButtonForExistingCommissionMemberDiv').hide()
  $('#myModal2').modal('show');
  member_id = mem_id;   // so that when user change the image parent id wont change


}
function reuploadImageFirstTimeInModalForExistingMembers(path,mem_id){

  $('.loader').show();
  // var name = path.replace(/\.[^/.]+$/, "");
  var index = path.lastIndexOf("/") + 1;
  var filename = path.substr(index);
     
/* I create the upload que table with JQuery. I tried plain Javascript but I lost the UIkit styling.
* I dynamically add a <tr>  element to the table and 5 <td> elements
*
* */
  var rowCol = $('<div />', {
    // 'class': 'col-12 col-xs-12 col-sm-6 col-md-4 col-lg-3',
    'style': 'margin:0px auto',
    attr: {
      'id': 'existinMemberImageDiv_'+mem_id
    }
  });

 
 

  rowCol.append($('<div />', {
    'class': 'card',
  }).append($('<div />', {
    'class': '',
  }))
  .append('<img src="'+path+'" height="180" width="180" class="img-responsive center-block d-block mx-auto" >')
    .append('<hr>')
    .append($('<div />', {
      'class': '',
    }).append($('<div />', {
      'style': 'text-align:center;font-size: 10px;',
    }).append(filename)
    .append($('<button />', {
      'class': 'btn btn-outline-danger hideWhenSubmitting fa-xs',
      'style':'float:right',
      'type': 'button',
      'onclick': 'removeExistingMemberImageFile(' + mem_id + ')',
      attr: {
        'data-file-id': mem_id
      }
    }).append('<b><i class="fa fa-trash fa-lg fa-fw"></i></b>'))
    
    )
    
    
    ));

    

  $("#existingDocImageUploadPrevDiv").append(rowCol).show();
  $("#uploadImageButtonForExistingCommissionMemberDiv").hide();

  

  

  $('.loader').hide(); 
}

 function reuploadImageInModalForExistingMembers(file) {

  console.log(file);
     //  var currentFileExt = file.type;
             var reader = new FileReader();
             reader.readAsDataURL(file);
             reader.onload = (function (file) {
               return function (e) {
                                 
                   var image = '<img src=' + e.target.result + '   height="180" width="180" class="img-responsive center-block d-block mx-auto" >';
                   addUploadTableRowForExistingMember(image, file.name, file.size, file.id);
 
                 
                   
                 
               };
             })(file);
 
             reader.error = function (e) {
 
 
               alert("something bad happened: " + e);
             };
             reader.onloadstart = function (e) {
 
 
             };
             reader.onloadend = function (data) {
 
 
             };
           
         
       //end else
   
 
  // console.log(validFileList)
 }
function updateExistingCommissionMember(mem_id,postion_before_edit){
  // alert(postion_before_edit)

  var allow= true;   
  var hasErrorArray=[];
  var removeErrorArray=[];

$('.existing_member_add_member_require').each(function() {     //input text/number validation
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
if(!allow){
  return allow;

}else{
  var comm_member_position = $('#existing_comm_member_position').val()

    if(comm_member_position == postion_before_edit)
    {
           if(checkImageExistenceForExistingMembers()) {  
            $('#error_existingFileToUpload').html('')
            updateExistingMemberObjectAndTableData(mem_id)
           

              
            }else{
              $('#error_existingFileToUpload').html('').append('<span class="text-danger" style="font-size:8pt;display:block;"> Upload-Image input cannot be empty.</span>')
              
            } 
        
    }else{
      const index = member_position.indexOf(postion_before_edit);          
        member_position.splice(index,1)
        console.log(member_position)
        if(member_position.includes(comm_member_position)){
          swal({
                title: "Add Commission Members",
                text: "Member with entered postion already exist",
                icon: "error",
            
                });
        }else{

          if(checkImageExistenceForExistingMembers()) {   
            $('#error_existingFileToUpload').html('')
            updateExistingMemberObjectAndTableData(mem_id) 
          
            
          } else{
            $('#error_existingFileToUpload').html('').append('<span class="text-danger" style="font-size:8pt;display:block;"> Upload-Image input cannot be empty.</span>')
           
          }   
        }

     
    }

}

  
  
    

}
function checkImageExistenceForExistingMembers(){
  // alert($("#existingDocImageUploadPrevDiv").text().length)
      var exist = false;
      if($("#existingDocImageUploadPrevDiv").text().length > 0 ) {
        exist= true;     
     
      }  
      
      

    //  alert(exist)
       return exist;
      
}
function updateExistingMemberObjectAndTableData(mem_id){
  // console.log(addImageToTable)
  var existing_comm_member_position = $('#existing_comm_member_position').val() 
        for (let index = 0; index < existingCommissionMember.length; index++) {
          if(existingCommissionMember[index].id ==  mem_id){
            existingCommissionMember[index].name =  $('#existing_comm_member_name').val()         
            existingCommissionMember[index].designation=  $('#existing_comm_member_designation').val()         
            existingCommissionMember[index].position =  $('#existing_comm_member_position').val()  
            member_position.push(existing_comm_member_position)
            $('#existingMainAddCommissionMemberRow_'+mem_id).find('#existingMemberName_'+mem_id).val('').val($('#existing_comm_member_name').val())
            $('#existingMainAddCommissionMemberRow_'+mem_id).find('#existingMemberDesg_'+mem_id).val('').val($('#existing_comm_member_designation').val())
            $('#existingMainAddCommissionMemberRow_'+mem_id).find('#existingMemberPos_'+mem_id).val('').val($('#existing_comm_member_position').val())

            $('#existingMainAddCommissionMemberRow_'+mem_id).find('#existingMemberImage_'+mem_id).html('').html(addImageToTable)

         
          }      
      }
      console.log(existingCommissionMember)
      console.log(existingMemberValidFileList)

      

      $('#myModal2').modal('hide');
      resetExistingMemberEditMemberModal();
}
function removeExistingMemberImageFile(id){
  // alert(mem_id)
    // removedExistingMemberImage.push(mem_id)
    $('#existinMemberImageDiv_' + id).
      removeClass("animated slideInUp").
      addClass("animated slideOutLeft").fadeOut().remove();
      $("#uploadImageButtonForExistingCommissionMemberDiv").show();
      var allowExistingMemberImageToEditUsingFileObject =  $('#allowExistingMemberImageToEditUsingFileObject').val()
      if(allowExistingMemberImageToEditUsingFileObject ==="0")
      {
        addImageToTable= '';
        $('#allowExistingMemberImageToEditUsingFileObject').val('1')
            for (let index = 0; index < existingCommissionMember.length; index++) {
              if(existingCommissionMember[index].id ==  id){
                existingCommissionMember[index].image="";             
              }      
            
           
          }  
          console.log(existingCommissionMember)
    }else{

      for (var i = 0; i < existingMemberValidFileList.length; i++) {
              
        if (existingMemberValidFileList[i].id == id) {
          existingMemberValidFileList.splice(i, 1);      
        }
      }
      console.log(existingMemberValidFileList)
    
    }
   
  }
function uploadOnChangeForExistingMember() {
  try {
    // alert()
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

    
    

      var files = document.getElementById('existingFileToUpload').files;
     
        // show loader
     
    createValidFileListForExistingMember(files);

    
  


  } catch (e) {
    alert("ERROR ONCHANGE UPLOAD " + e)
    console.log("Upload from file input failed " + e);
  }
}

function createValidFileListForExistingMember(files) {

  var count = existingMemberValidFileList.length;
  console.log("count " + count);
  console.log("validFileList " + existingMemberValidFileList.length);

  [].forEach.call(files, function (file) {
    //  var currentFileExt = file.type;
    count++;
    var currentFileExt = file.name.substr(file.name.lastIndexOf('.') + 1).toLowerCase();

    if (isFileValid(file, currentFileExt)) {

           //we need to generate a random id for the file if we need to delete the file later
      file.id = Math.floor(Math.random() * 1000000000).toString(); //add a random number as the id property of the file object
      file.parent_id = member_id;
    
              //   if(allImagesName.includes(file.name)){
              //     alert("if")
              //  } else{
              //     alert("else")
              //  } 
              //  abc= file.name;
              //  allImagesName.push(abc) 
      if (file.type.match(isImage)) {
        isGoodImage(file).then(function (isGood) {
          if (isGood) {
           existingMemberValidFileList.push(file);
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = (function (file) {
              return function (e) {
                

                    
                  var image = '<img src=' + e.target.result + '   height="180" width="180" class="img-responsive center-block d-block mx-auto" >';
                  file.name=Math.floor(Math.random() * 1000000000).toString()
                  // console.log(file.name)
                  addUploadTableRowForExistingMember(image, file.name, file.size, file.id);

                
                 

                
              };
            })(file);
            // reader = "";

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


function addUploadTableRowForExistingMember(icon, name, size, index) {
  $('.loader').show();
  addImageToTable = icon;
     
  var fileSize = parseInt(size / 1024, 10) + " kb";
/* I create the upload que table with JQuery. I tried plain Javascript but I lost the UIkit styling.
* I dynamically add a <tr>  element to the table and 5 <td> elements
*
* */
  var rowCol = $('<div />', {
    // 'class': 'col-12 col-xs-12 col-sm-6 col-md-4 col-lg-3',
    'style': 'margin:0px auto',
    attr: {
      'id': 'existinMemberImageDiv_'+index
    }
  });

 
 

  rowCol.append($('<div />', {
    'class': 'card',
  }).append($('<div />', {
    'class': '',
  }))
  .append(icon)
    .append('<hr>')
    .append($('<div />', {
      'class': '',
    }).append($('<div />', {
      'style': 'text-align:center;font-size: 10px;',
    }).append(name+"<b>(" + fileSize + ")</b> ")
    .append($('<button />', {
      'class': 'btn btn-outline-danger hideWhenSubmitting fa-xs',
      'style':'float:right',
      'type': 'button',
      'onclick': 'removeExistingMemberImageFile(' + index + ')',
      attr: {
        'data-file-id': index
      }
    }).append('<b><i class="fa fa-trash fa-lg fa-fw"></i></b>'))
    
    )
    
    
    ));

    

  $("#existingDocImageUploadPrevDiv").append(rowCol).show();
  $("#uploadImageButtonForExistingCommissionMemberDiv").hide();

  

  

  $('.loader').hide(); 
  
  


}

function resetExistingMemberEditMemberModal(){
  $('.existing_member_add_member_require').val('');

  $('#existingDocImageUploadPrevDiv').html('')
  $('#uploadImageButtonForExistingCommissionMemberDiv').show()
  $('#existingDocImageUploadPrevDiv').hide()

  $('#current_member_edit_id').val('')

  $('#existingAddMemberButton').html('<i class="fa fa-plus fa-fw"></i> Add')
  $('#existingAddMemberButton').attr('onclick','verifyEmptyInputsBeforeProceeding()')
  $('#existingAddMemberCloseButton').show();

}

function  handleEditMemberUpload() {
  
  try {


if(existingCommissionMember.length == 0  && commissionMember == 0){ // verf
  swal({
          title: "Update Commission Member!",
          text: "Nothing to update, Add member(s) to proceed",
          icon: "error",
        
          });

}else{
  var selected_commission_id =  $("#selected_commission_id").val()
  var files_info = [];
  var existing_member_files_info = []

  var data = new FormData();


  data.append("_token", $("#_token").val());       
  data.append("selected_commission_id",selected_commission_id);

  if(removedExistingMemberIds.length > 0)
  data.append('removedExistingMemberIds',JSON.stringify(removedExistingMemberIds));

  if(existingCommissionMember.length > 0 && existingMemberValidFileList.length   == 0){
    data.append('existingCommissionMember',JSON.stringify(existingCommissionMember));
  }



  if(existingCommissionMember.length > 0  && existingMemberValidFileList.length  > 0){
    for (var i = 0; i < existingMemberValidFileList.length; ++i) {            
        
      data.append('existingFile[]', existingMemberValidFileList[i],existingMemberValidFileList[i].id+'_'+existingMemberValidFileList[i].name);
      existing_member_files_info.push({parent_id:existingMemberValidFileList[i].parent_id,name:existingMemberValidFileList[i].id+'_'+existingMemberValidFileList[i].name}); 

     
    }
    data.append('existingCommissionMember',JSON.stringify(existingCommissionMember));

    data.append('existing_member_files_info',JSON.stringify(existing_member_files_info));

  }
  
  
 


  if(commissionMember.length > 0 && validFileList.length >  0){
    for (var i = 0; i < validFileList.length; ++i) {            
      
         
      data.append('file[]', validFileList[i],validFileList[i].id+'_'+validFileList[i].name);
      // files_info.push({parent_id:validFileList[i].parent_id,name:validFileList[i].name}); 
      files_info.push({parent_id:validFileList[i].parent_id,name:validFileList[i].id+'_'+validFileList[i].name}); 
    }
    data.append('files_info',JSON.stringify(files_info));
    data.append('commissionMember',JSON.stringify(commissionMember));
  }
 
    
 

     
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
  $("#commission_member_grid").empty();
  document.getElementById('fileToUpload').value = "";
  validFileList.length = 0;
  commissionMember= [];
  addImageToTable=''
  member_id=0;            
  member_position=[];
  existingMemberValidFileList=[];
  existingCommissionMember=[];
  removedExistingMemberIds=[];
  resetAddMemberModal()
  resetExistingMemberEditMemberModal

  
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
// console.log(request.responseText);
  response = JSON.parse(request.responseText);
  //  var count = JSON.stringify(response);
  console.log(response);
  if (response != "") {

    var operation_completed=JSON.parse(response.final_updation); //all task completed like delete, update, add new members

    if(response.member_removed_array){
      var member_removed_array=JSON.parse(response.member_removed_array);  //fetching array of name where unable to complete task 
    }

    if(response.existing_member_array){
      var existing_member_array=JSON.parse(response.existing_member_array); //fetching array of name where unable to complete task 
    }


    if(response.existing_member_with_images_array){
      var existing_member_with_images_array=JSON.parse(response.existing_member_with_images_array); //fetching array of name where unable to complete task 
    }


    if(response.new_member_added_array){
      var new_member_added_array=JSON.parse(response.new_member_added_array); //fetching array of name where unable to complete task 
    }

    // alert(operation_completed)
    // var operation_completed=  JSON.parse(operation_completed);
     
    
    var result = "";
    result += '<ul>';   //creating UL for swal listing all the task/operation completed using switch case
    for (let index = 0; index < operation_completed.length; index++) {
      console.log(operation_completed[index])
              
              switch(operation_completed[index])
              {
                case "Existing Member Removed":
                  result += '<li style="list-style-type: circle;font-weight: bold"><u>'+operation_completed[index]+'</u></li>';   
                    if(member_removed_array.length > 0){
                      member_removed_array = member_removed_array.join(',')
                      result += '<ul  class="inside">';
                      result += '<li style="list-style-type: disc;">Problem removing member "'+member_removed_array+'"</li>';          // adding name of members to list whose operation wasn't completed                      
                      result += '</ul>';
                    }
                    break;

                    case "Existing Member Updated":
                    result += '<li style="list-style-type: circle;font-weight: bold"><u>'+operation_completed[index]+'</<u></li>';   
                    if(existing_member_array.length > 0){
                      existing_member_array = existing_member_array.join(',')
                      result += '<ul  class="inside">';
                      result += '<li style="list-style-type: disc;">Problem Updating member "'+existing_member_array+'"</li>';       // adding name of members to list whose operation wasn't completed                         
                      result += '</ul>';
                    }
                    break;


                    case "Existing Member Updated With Image Change":
                     result += '<li style="list-style-type: circle;font-weight: bold"><u>'+operation_completed[index]+'</u></li>';   
                    if(existing_member_with_images_array.length > 0){
                      existing_member_with_images_array = existing_member_with_images_array.join(',')
                      result += '<ul  class="inside">';
                      result += '<li style="list-style-type: disc;">Problem Updating member images"'+existing_member_with_images_array+'"</li>';  // adding name of members to list whose operation wasn't completed                         
                      result += '</ul>';
                    }
                    break;


                    case "New Member Added":
                     result += '<li style="list-style-type: circle;font-weight: bold"><u>'+operation_completed[index]+'</u></li>';   
                    if(new_member_added_array.length > 0){
                      new_member_added_array = new_member_added_array.join(',')
                      result += '<ul  class="inside">';
                      result += '<li style="list-style-type: disc;"> Problem Adding new member "'+new_member_added_array+'"</li>';          // adding name of members to list whose operation wasn't completed                 
                      result += '</ul>';
                    }
                    break;

                    default:
                      result += '<ul  >';
                      result += '<li style="list-style-type: disc;;font-weight: bold">Something went wrong, in case default</li>';                                
                      result += '</ul>';
                      break;

              }
              
                   
    }
    result += '</ul>';

    var span = document.createElement("span");
    span.innerHTML = result;

    
 
            swal({
              title: "Update Commission Member: Operations completed are as follows",
              content: span,
              icon: "success",
              
            })
            .then(function(){ 
              location.reload();
              });
          

            //     $("#data_processing").hide();
            //     $("#images_grid").empty();
            //     $("#process_div").hide();
            //           break;
              
            //         }
            }
            
        }
            });
     
      request.open('POST', '/admin/updateCommissionMembers');
   

request.setRequestHeader('Cache-Control', 'no-cache');
//  document.getElementById('upload_progress').style.display="block";



request.send(data);
}
          
    
    
  } catch (e) {

  }
}

function updateSelectedCommission(){
var commission_name = $('#commission_name').val().trim();
  if(commission_name ===""){
    $('#commission_name').addClass('border border-danger');
    $('#error_edit_commission_name').html('').append('<span class="text-danger" style="font-size:8pt;display:block;">Commission Member input cannot be empty.</span>')
    $('#commission_name').trigger('focus');

  }else{
    $('#commission_name').removeClass('border border-danger');
    $('#error_edit_commission_name').html('')
    var data = new FormData();
    data.append("_token", $("#_token").val());
    data.append("selected_commission_id",$('#selected_commission_id').val());  
    data.append("commission_name",commission_name);  

  
  
  
    $.ajax({
  
      type: "POST",
      url: "/admin/updateCommission",
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
                          title: "Update commission",
                          text: "Commission has been updated successfully..",
                          icon: "success",
                          timer: 1500,              
                          buttons: false
                        });
  
  
  
                       
  
              
                
              }else if(data.status == "unsuccess"){
                swal({
                  title: "Update commission",
                  text: "Problem updating commission, contact your admin..",
                  icon: "error",
                  
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
  
}
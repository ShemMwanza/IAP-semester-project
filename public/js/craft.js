function clearMessageField() {
    $(".error").text("");
    $(".success").text("");
}

//For Craft uploading button
function uploadCraft() {
    document.getElementById("photo").click();
}

// Adding a craft
$(document).ready(function(){
    $("#addCraft").submit(function(event){
      let formEmpty;
      event.preventDefault();
      clearMessageField();
      let formData = new FormData($(this)[0]);
      for (var value of formData.entries()) {
        formEmpty = (value[1] == "") ? true : false;
        if (formEmpty) {
            break;
        }
    }
    if (!formEmpty) {
        $.ajax({
            url: "addCraft",
            enctype: 'multipart/form-data',
            data: formData,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function(data){
                for (const type in data) {
                    if (type=="success") {
                        $("#craftUploadSuccess").text(data[type]);
                        break;
                    } 
                }
            },
            error: function (e) {
                 let errors= e['responseJSON']['errors'];
                for (const type in errors) {
                     $("#craftUploadError").text(errors[type]);
                     break;
                }
            }
            });
    } else {
        $("#craftUploadError").text("All fields are required")
    }        
      });
    });
  

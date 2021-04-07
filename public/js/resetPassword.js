function clearMessageField() {
    $(".error").text("");
    $(".success").text("");
}
// Changing password using AJAX
$(document).ready(function () {
    $("#resestPassword").submit(function (event) {
        console.log("called");
        event.preventDefault();
        clearMessageField();
        let formData = new FormData($(this)[0]);
        let formEmpty = false;

        //Checking if there is any empty field 
        for (var value of formData.entries()) {
            formEmpty = (value[1] == "") ? true : false;
            if (formEmpty) {
                break;
            }
        }
        if (!formEmpty) {
            //checking if the new password and the confirmation password are the same
            if (formData.get('password')==formData.get('password_confirmation')) {
                $.ajax({
                    url: 'reset_password',
                    enctype: 'multipart/form-data',
                    data: formData,
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        console.log(data);
                        $("#resetPasswordSuccess").text("Password Changed Successfully.");
                        // let delayInMilliseconds = 900; //1 second  
                        // setTimeout(function() {
                        // window.location.href="login_&_register"
                        // }, delayInMilliseconds);
                    },
                    error: function (e) {
                        console.log(e);
                        let errors= e['responseJSON']['errors'];
                        for (const type in errors) {
                             $("#resetPasswordError").text(errors[type]);
                             break;
                        }
                    }
                });
            }else{
                $("#resetPasswordError").text("Password Mismatch");
            }
           
        } else {
            $("#resetPasswordError").text("All fields are required");
        }
    });
});
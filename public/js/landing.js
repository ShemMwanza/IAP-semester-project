function clearMessageField() {
    $(".error").text("");
    $(".success").text("");
}
$(document).ready(function () {
    var small = { width: "240px", height: "205px" };
    var large = { width: "400px", height: "375px" };
    var count = 2;

    $(".video").css(small).on('click', function () {
        $(this).animate((count == 2) ? large : small);
        count = 2 - count;
        console.log("called");
    });
});

    var modalSettings = document.getElementById("settings");

    var btnSettings = document.getElementById("editProfile");

    var spanSettings = document.getElementsByClassName("closeSettings")[0];

    btnSettings.onclick = function () {
      modalSettings.style.display = "block";

    }


    spanSettings.onclick = function () {
      modalSettings.style.display = "none";
    }


    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
      if (event.target == modalSettings) {
        modalSettings.style.display = "none";
      }
    }


var container = document.getElementById("container");

var btnContainer = document.getElementById("scPassword");

var spanContainer = document.getElementsByClassName("closePasswords")[0];

btnContainer.onclick = function () {
container.style.display = "block";

}

spanContainer.onclick = function () {
    clearMessageField();
    container.style.display = "none";
}

window.onclick = function (event) {
    if (event.target == container) {
        container.style.display = "none";
    }
}



var imageModal = document.getElementById("imageModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("img");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function () {
    imageModal.style.display = "block";
    modalImg.src = this.src;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("closeImage")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function () {
    imageModal.style.display = "none";
}

window.onclick = function () {
    imageModal.style.display = "none";
}



function AddReadMore() {

    var carLmt = 80;
    var readMoreTxt = " ... read more";
    var readLessTxt = " read less";


    //Traverse all selectors with this class and manupulate HTML part to show Read More
    $(".ReadMore").each(function () {
        if ($(this).find(".firstSec").length)
            return;

        var allstr = $(this).text();
        if (allstr.length > carLmt) {
            var firstSet = allstr.substring(0, carLmt);
            var secdHalf = allstr.substring(carLmt, allstr.length);
            var strtoadd = firstSet + "<span class='SecSec'>" + secdHalf + "</span><span class='readMore'  title='Click to Show More'>" + readMoreTxt + "</span><span class='readLess' title='Click to Show Less'>" + readLessTxt + "</span>";
            $(this).html(strtoadd);
        }

    });
    //Read More and Read Less C$(this).closest(".addReadMore").toggleClass("showlesscontent showmorecontent");lick Event binding
    $(document).on("click", ".readMore,.readLess", function () {
        $(this).closest(".ReadMore").toggleClass("showlesscontent showmorecontent");
    });

    $( ".readMore" ).click(function() {
  $( ".body_div" ).animate({
   height: "50%", 
    }, 150 );
});

$( ".readLess" ).click(function() {
  $( ".body_div" ).animate({
   height: "50vh",    
    }, 500 );
});


}
$(function () {
    //Calling function after Page Load
    AddReadMore();
});


// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("editProfile1");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function () {
    modal.style.display = "block";

}

// When the user clicks on <span> (x), close the modal
span.onclick = function () {
    clearMessageField();
    modal.style.display = "none";
}


// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}


//For editing event
var modal2 = document.getElementById("editModal");

var btn1 = document.getElementById("editCraft");
var span2 = document.getElementsByClassName("closeEvent")[0];

btn1.onclick = function () {
modal2.style.display = "block";

}
span2.onclick = function () {
    modal2.style.display = "none";
    clearMessageField();
}

window.onclick = function (event) {
    if (event.target == modal2) {
        modal2.style.display = "none";
    }
    clearMessageField();
}

//For Craft uploading button
function uploadCraft() {
    document.getElementById("photo").click();

}
//For Craft changing button
function changeCraft() {
    document.getElementById("craft_file").click();

}
//For event file changing button
function changeEvent() {
    document.getElementById("event_file").click();
}


$(document).ready(function () {
    $("#profile_photo_upload").click(function () {
        $("#profile_photo").click();
    });
});

function craftDelete() {
    if (confirm("Do you really want to delete this craft?")) {
        let craftId = document.querySelector("#craft_id").value;
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText == "Successful") {
                    $("#eventEdit_success").text("Craft Deleted Successfully");
                } else {
                    $("#eventEdit_error").text(this.responseText);
                }
            }
        };
        xmlhttp.open("POST", "Logic/logic2.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var data = "craft_id=" + craftId + "&type=deleteCraft";
        xmlhttp.send(data);
    }
}

$(document).ready(function () {
    $("#formCPassword").submit(function (event) {
        console.log("called");
        event.preventDefault();
        clearMessageField();
        let formData = new FormData($(this)[0]);
        let formEmpty = false;
        for (var value of formData.entries()) {
            formEmpty = (value[1] == "") ? true : false;
            if (formEmpty) {
                break;
            }
        }
        if (!formEmpty) {
            if (formData.get('nPassword')==formData.get('confirmPassword')) {
                console.log("called2");
                $.ajax({
                    url: 'changePassword',
                    enctype: 'multipart/form-data',
                    data: formData,
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        //data= JSON.parse(data);
                        for (const type in data) {
                            if (type=="success") {
                                $("#changePasswordSuccess").text(data[type]);
                            } else {
                                $("#changePasswordError").text(data[type]);
                            }
                        }
                    },
                    error: function (e) {
                        console.log("ERROR : ", e);
                    }
                });
            }else{
                $("#changePasswordError").text("Password Mismatch");
            }
           
        } else {
            $("#changePasswordError").text("All fields are required");
        }
    });
});

//chnage Password
$(document).ready(function () {
    $("#updateProfile").submit(function (event) {
        event.preventDefault();
        clearMessageField();
        let formData = new FormData($(this)[0]);
        let formEmpty = false;
        for (var value of formData.entries()) {
            formEmpty = (value[1] == "") ? true : false;
            if (formEmpty) {
                break;
            }
        }
        if (!formEmpty) {
            $.ajax({
                url: 'updateProfile',
                enctype: 'multipart/form-data',
                data: formData,
                processData: false,
                contentType: false,
                type: 'POST',
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    if (data == "success") {
                        $("#profileUpload_success").text("Profile Updated Successfully");
                    } else {
                        console.log(data);  
                        $("#profileUpload_error").text(data);
                    }
                },
                error: function (e) {
                    console.log("ERROR : ", e);
                }
            });
        } else {
            $(".error").text("All fields are required");
        }
    });
});

// 
$(document).ready(function () {
    $('#craftEdit').submit(function (event) {
        event.preventDefault();
        clearMessageField();
        let formData = new FormData($(this)[0]);
        formData.append("type", "updateCraft");
        let formEmpty = false;
        for (var value of formData.entries()) {
            formEmpty = (value[1] == "") ? true : false;
        }
        if (!formEmpty) {
            $.ajax({
                url: 'Logic/logic2.php',
                enctype: 'multipart/form-data',
                data: formData,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function (data) {
                    if (data == "Successful") {
                        $("#craftEdit_success").text("Craft Updated Successfully");
                    } else {
                        $("#craftEdit_error").text(data);
                    }
                },
                error: function (e) {
                    alert(e.responseText);
                    console.log("ERROR : ", e);
                }
            });
        } else {
            $(".error").text("All fields are required");
        }
    });
});

document.getElementById("image_upload_file").onclick= function() {
    document.getElementById('photo').click();
}








// function deleteEvent() {
//     if (confirm("Do you really want to delete this event?")) {
//         let eventId = document.querySelector("#event_id").value;
//         let xmlhttp = new XMLHttpRequest();
//         xmlhttp.onreadystatechange = function () {
//             if (this.readyState == 4 && this.status == 200) {
//                 if (this.responseText == "Successful") {
//                     $("#eventEdit_success").text("Event Deleted Successfully");
//                 } else {
//                     $("#eventEdit_error").text(this.responseText);
//                 }
//             }
//         };
//         xmlhttp.open("POST", "Logic/logic2.php", true);
//         xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//         var data = "event_id=" + eventId + "&type=deleteEvent";
//         xmlhttp.send(data);
//     }

// }

//$(document).ready(function () {
    //     $('#eventEdit').submit(function (event) {
    //         event.preventDefault();
    //         clearMessageField();
    //         let formData = new FormData($(this)[0]);
    //         formData.append("type", "updateEvent");
    //         let formEmpty = false;
    //         for (var value of formData.entries()) {
    //             formEmpty = (value[1] == "") ? true : false;
    //         }
    //         if (!formEmpty) {
    //             $.ajax({
    //                 url: 'Logic/logic2.php',
    //                 enctype: 'multipart/form-data',
    //                 data: formData,
    //                 processData: false,
    //                 contentType: false,
    //                 type: 'POST',
    //                 success: function (data) {
    //                     if (data == "Successful") {
    //                         $("#eventEdit_success").text("Event Updated Successfully");
    //                     } else {
    //                         $("#eventEdit_error").text(data);
    //                     }
    //                 },
    //                 error: function (e) {
    //                     alert(e.responseText);
    //                     console.log("ERROR : ", e);
    //                 }
    //             });
    //         } else {
    //             $(".error").text("All fields are required");
    //         }
    //     });
    // });
// //For editing event
// var modal2 = document.getElementById("editModal");

// // var btn2 = document.getElementsByClassName("
// // ");

// var span2 = document.getElementsByClassName("closeEvent")[0];

// function editEvent(eventId) {
//     modal2.style.display = "block";
//     let xmlhttp = new XMLHttpRequest();
//     xmlhttp.onreadystatechange = function () {
//         if (this.readyState == 4 && this.status == 200) {
//             // console.log(this.responseText);
//             let eventObject = JSON.parse(this.responseText);
//             document.querySelector("#event_name").value = eventObject.event_name;
//             document.querySelector("#event_description").value = eventObject.event_description;
//             document.querySelector("#event_id").value = eventId;
//         }
//     };
//     xmlhttp.open("POST", "Logic/logic2.php", true);
//     xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//     var data = "event_id=" + eventId + "&type=getEventData";
//     xmlhttp.send(data);
// }

// span2.onclick = function () {
//     modal2.style.display = "none";
//     clearMessageField();
// }

// window.onclick = function (event) {
//     if (event.target == modal2) {
//         modal2.style.display = "none";
//     }
//     clearMessageField();
// }

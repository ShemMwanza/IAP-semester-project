document.getElementById("forgotP").onclick = function () {
    window.location.href = "r_password";
  };


//For Login
$(document).ready(function () {
  $("#formLogin").submit(function (event) {
      event.preventDefault();
      var email = $("input[name = 'email']").val();
      var password = $("input[name = 'password']").val();
      $.post("", {
          email: email,
          password: password
      },
          function (data, status) {
              $("#Message").html(data);

          });
  });
});

// For Sign Up
$(document).ready(function () {
  $("#formRegister").submit(function (event) {
      event.preventDefault();
      var name = $("input[name = 'name']").val();
      var email = $("input[name = 'email']").val();
      var password = $("input[name = 'password']").val();
      var password1 = $("input[name = 'password1']").val();

      $.post("", {
          name: name,
          email: email,
          password: password,
          password1: password1
       
      },
          function (data, status) {
              $("#Message").html(data);

          });
  });
});

$(document).ready(function () {
  $("#rFormLogin").submit(function (event) {
      event.preventDefault();
      clearMessageField();
      var email = $("input[name = 'recruitor_email']").val();
      var password = $("input[name = 'recruitor_password']").val();
      var type = "login";
      $.post("Logic/logic.php", {
          email: email,
          password: password,
          type: type
      },
      function (data, status) {
          if (data=="Successful") {
              window.location.href="dashboard.php";
              $(".success").text(data);
          } else {
              $(".error").text(data);
          }
      });
  });
});

$(document).ready(function () {
  $("#rFormRegister").submit(function (event) {
      event.preventDefault();
      clearMessageField();
      let form=$("#rFormRegister")[0];
      let formData= new FormData(form);
      formData.append("type","register");
      let formEmpty= false;
      for(var value of formData.entries()){
          formEmpty= (value[1]=="")? true:false;
      }
      if(!formEmpty){
          $.ajax({
              url: 'Logic/logic.php',
              enctype: 'multipart/form-data',
              data: formData,
              processData: false,
              contentType: false,
              type: 'POST',
              success: function(data){
                  if (data=="success") {
                      $(".success").text("Account Created Successfully");
                  } else {
                      $(".error").text(data);
                  }
              },
              error: function (e) {
                  alert(e.responseText);
                  console.log("ERROR : ", e);
              }
              });        
      }else{
          $(".error").text("All fields are required");
      } 
  });
});

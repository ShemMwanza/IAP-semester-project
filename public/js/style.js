const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
    container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
    container.classList.remove("right-panel-active");
});
$(document).ready(function(){
    if ($('.error').text()=="") {
        $('.error').css('display','none');
    }
    if ($('#emailError').text()=="") {
        $('#emailError').css('display','none');
    }
    if ($('#passwordError').text()=="") {
        $('#passwordError').css('display','none');
    }
    if ($('#confPasswordError').text()=="") {
        $('#confPasswordError').css('display','none');
    }
    if ($('#loginEmailError').text()=="") {
        $('#loginEmailError').css('display','none');
    }
    if ($('#loginPasswordError').text()=="") {
        $('#loginPasswordError').css('display','none');
    }
  });






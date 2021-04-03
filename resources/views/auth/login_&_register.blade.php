<!DOCTYPE html>
<html lang>
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link

        />
    <link href="{{url('/css/style.css')}}" type="text/css" rel="stylesheet"/>
    <title>Login & SignUp</title>
</head>

<body>
<div class="container" id="container">
    <div class="form-container sign-up-container">
        <form id="formRegister" action="{{url('/auth/register')}}" method="post">
            @csrf   
            <h1 id="title">Create Account</h1>
            <div class="social-container">
                <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social"><i class="fab fa-google"></i></a>
                <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <span>or use your email for registration</span>
            <label>
                <input name="firstName" placeholder="First Name" type="Name" value="{{old('firstName')}}"/>
                <input name="lastName" placeholder="Last Name" type="Name" value="{{old('lastName')}}"/>
                <input name="email" type="email" placeholder="Email" value="{{old('email')}}"/>
                <p class="error" id="emailError">@error('email'){{$message}} @enderror</p>
                <input name="password" type="password" placeholder="Password" />
                <p class="error"  id="passwordError">@error('password'){{$message}} @enderror</p>
                <input name="confPassword" placeholder="Confirm Password" type="password"/>
                <p class="error"  id="confPasswordError">@error('confPassword'){{$message}} @enderror</p>
            </label>
            @if(Session::get('success'))
            <p class="success"  id="success">{{Session::get('success')}}</p>
            @endif
            @if(Session::get('error'))
            <p class="error"  id="error">{{Session::get('error')}}</p>
            @endif
            <button type="submit" >Sign Up</button>
            <p id="Message" style='color:red; margin-left: 39px;'></p>
        </form>
    </div>
    <div class="form-container sign-in-container">
        <form id="formLogin" action="{{url('/auth/login')}}" method="POST">
            @csrf   
            <h1 id="title">Sign in</h1>
            <div class="social-container">
                <a href="{{url('.idea/Pictures/facebook-f-brands.svg')}}" class="social"><i class="fab fa-facebook-f"></i></a>
                <a href="{{url('.idea/Pictures/google-brands.svg')}}" class="social"><i class="fab fa-google-plus-g"></i></a>
                <a href="{{url('.idea/Pictures/linkedin-in-brands.svg')}}" class="social"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <span>or use your account</span>
            <label>
                <input type="email" name="loginEmail" placeholder="Email" />
                <p class="error" id="loginEmailError">@error('loginEmail'){{$message}} @enderror</p>
                <input type="password"  name="loginPassword" placeholder="Password" />
                <p class="error" id="loginPasswordError">@error('loginPassword'){{$message}} @enderror</p>
            </label>
            @if(Session::get('loginError'))
            <p class="error"  id="loginError">{{Session::get('loginError')}}</p>
            @endif
            <button type="submit">Sign In</button>
            <button id="forgotP">Trouble logging in? Click here for reset</button>
            <p id="Message" style='color:red; margin-left: 39px;'></p>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <img id="user" src="{{url('.idea\Pictures\round-account-button-with-user-inside.svg')}}" alt="Avatar">
                <br>
                <h1>Hello, Friend!</h1>
                <p>Join and start your journey with us by sharing your work with the masses</p>
                <button class="ghost" id="signIn">Sign In</button>
                <a href="{{url('/')}}"><button class="ghost" id="Quit">Cancel</button></a>
            </div>
            <div class="overlay-panel overlay-right">
                <img id="user" src="{{url('.idea\Pictures\round-account-button-with-user-inside.svg')}}" alt="Avatar">
                <br>
                <h1>Welcome Back!</h1>
                <p>To keep connected with us please login with your personal info</p>
                <button class="ghost" id="signUp">Sign Up</button>
                <a href="{{url('/')}}"><button class="ghost" id="cancel">Cancel</button></a>
            </div>
        </div>
    </div>
</div>

<script src="{{ url('/js/style.js')}}"></script>
<!-- <script src="{{ url('/js/script.js')}}"></script> -->
<script src="https://kit.fontawesome.com/d728f4e8e5.js" crossorigin="anonymous"></script>
</body>

</html>

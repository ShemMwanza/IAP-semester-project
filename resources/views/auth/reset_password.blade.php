<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link href="{{url('css/resetPassword.css')}}" type="text/css" rel="stylesheet" />
    <title>Reset Password</title>

</head>
<body>
<div class="container" id="container">
    <div class="containerContent" id="containerContent">
        <div class="form-container sign-up-container">
            <form id="resetPassword" action="{{url('/auth/reset_password')}}" method="post">
                 @csrf
                <h1 id="title">Reset Password</h1>
    
                <label>
                    <input id="newPassword" name="password" type="password" placeholder="New Password" />
                    <input id="password_confirmation " name="password_confirmation" type="password"  placeholder="Confirm New Password" />
                    <input id="token" name="token"  type="text" value="{{$token}}"/>
                    <input id="email" name="email"  type="email" value="{{$email}}"/>
                </label>
                <p id="resetPasswordSuccess" class="success"></p>
                <p id="resetPasswordError" class="error"></p>
                <button type="submit" name="resetPasswordButton" id="resetPasswordButton">Confirm</button>
                <p id="Message" style='color:red; margin-left: 39px;'></p>
                @if (session('status'))
                <div>{{ session('status') }}</div>
                @endif 
                @if (session('email'))
                <div>{{ session('email') }}</div>
                @endif 
                @if (session('password'))
                <div>{{ session('password') }}</div>
                @endif 
            </form>
        </div>
    </div>
</div>
<script src="{{url('/js/resetPassword.js')}}"></script>
</body>
</html>
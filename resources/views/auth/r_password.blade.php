<!DOCTYPE html>
<html lang>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="{{url('/css/rPassword.css')}}" type="text/css" rel="stylesheet" />
    <title>Reset Password</title>
</head>

<body>
    <div class="container" id="container">
        <span class="closeReset" id="closeReset">&times;</span>
        <div class="form-container reset-container">
            <form id="formReset" action="#">
                <h1 id="title">Reset Password</h1>
                
                <label>
                    <input name="email" placeholder="Email" type="email" id="email" />
                </label>

                <button type="submit" name="rPassword" id="rPassword">Send link</button>
                <p id="Message" style='color:red; margin-left: 39px;'></p>
            </form>
        </div> 
        <div id="text">
            <p>Enter your email to receive a reset link</p>
        </div>  
    </div>


    <script src="{{url('/js/rPassword.js')}}"></script>
    <script src="https://kit.fontawesome.com/d728f4e8e5.js" crossorigin="anonymous"></script>
</body>

</html>
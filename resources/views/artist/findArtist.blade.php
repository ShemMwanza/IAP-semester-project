<!DOCTYPE html>
<html>
    <head>
        <title>Find Artist</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{url('/css/findArtist.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    </head>
    <body>
        <!--navbar-->
        <div class="div_nav">
            <nav  class="nav">
                <div class="logo">
                    
                   <img id="logo" title="Go Back" src=".idea\Pictures\emoticon-square-smiling-face-with-closed-eyes.svg" alt="LOGO"> 
                </div>
                
                <form class="search_form" id="search_form" method="get">
                     @csrf 
                    <div class="search">
                        <button class="button_search" id="button_search" type="button"><i class="fa fa-search" name="search"></i></button>
                        <input id="search_text" class="input" type="text"  placeholder="Search..." name="search">
                    </div>
                </form>
            </nav>
        </div>

        <!--body-->

        <div class="wrapper">
        <div id="search_results" class="body">
            @if($users != null)
            @foreach($users as $user)
            <div class='profile' onclick='checkProfile()'>
                <div class='profile_img'>
                    <img class='img' src="{{url($user->profile_photo)}}" alt='Profile_photo'>
                </div>
                <div class='profile_content'>
                    <span class='profile_name'>
                        <p>{{$user->first_name}}  {{$user->last_name}}</p>
                    </span>
                    <span class='profile_info'>
                        <p>{{$user->description}}</p>
                    </span>
                </div>

            </div>
        
          @endforeach
          @else
          <p>No results found</p>
          @endif  
           
                       
            
    
         <p id="Nothing"></p>   
        </div>
        </div>
        <script src="{{url('js/findArtist.js')}}"></script>
    </body>
</html>
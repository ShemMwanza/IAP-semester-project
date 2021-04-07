<!DOCTYPE html>
<html lang="en">

<head>
    <title>View Artist</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{url('css/landing.css')}}" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head> 
<style>

</style>

<body>
    <section>
        @php
        $firstName=$artistInfo['first_name'];
        $lastName=$artistInfo['last_name'];
        $fullName= $firstName." ".$lastName;
        $description=$artistInfo['description'];
        $talent=($artistInfo['talent']);
        $email=($artistInfo['email']);
        $profilePhoto=($artistInfo['profile_photo']);
        @endphp

        <article>
            <div class="profile">
                <img src="{{asset('/storage/Image/'.$profilePhoto)}}" alt="man">
                <div class="profile-1">
                    <div class="profile-2">
                    <h1>{{$fullName}}</h1>
                    
                    </div>
                              
                    <p>{{$description}}</p>
                </div>
                <br>
                  <div id="back" class="back">
                <i id="back_arrow" title="Go Back" class="fa fa-arrow-left"></i>  
                </div>
            </div>
           



            <div class="body">
                @if(count($artistCraftInfo) == 0)
                <center><h3>No Uploads Yet</h3></center>
                @else
                @foreach ($artistCraftInfo as $craft)
                <div class="body_div">
                    <div>
                        <img id="img" class="img" onclick=zoomImage(this) src="{{asset('/storage/Image/'.$craft->art_path)}}" />
                    </div>
                    <div>
                        <p class="ReadMore showlesscontent">{{$craft->art_caption}}</p>
                    </div>
                    <!-- <div>

                        <button id="editCraft" onclick="editCraft({{$craft->id}})">Edit</button>

                    </div> -->
                </div>
                @endforeach
                @endif
<!-- 
                <div class="body_div">
                    <div>
                        <img 
                        id="img"class="img" src=".idea\Pictures\burger.jpg" />
                    </div>
                    <div>
                        <p>A burger a day keeps the tummy awake</p>
                    </div>
                    

                </div> -->
                
            </div>
            



        </article>
    </section>


    <script src="{{('js/artistProfile.js')}}"></script>
      
</body>

</html>
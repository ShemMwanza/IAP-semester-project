<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" />
  <link rel="stylesheet" href="{{url('css/dashboard.css')}}" />
  <title>DASHBOARD</title>
</head>

<body id="body">
{{
        $firstName=($loggedUserInfo['first_name']),
        $lastName= ($loggedUserInfo['last_name']),
        $fullName= $loggedUserInfo['first_name']." ".$loggedUserInfo['last_name']
    }}
  <div class="container">

    <nav class="navbar">
      <div class="nav_icon" onclick="toggleSidebar()">
        <i class="fa fa-bars" aria-hidden="true"></i>
      </div>
      <div class="logo">
        <img id="logo" src="{{url('.idea\Pictures\emoticon-square-smiling-face-with-closed-eyes.svg')}}" title="Go Back"alt="logo">

      </div>
      <div class="navbar__left">
        

      </div>

      <div class="navbar__right">
        <p>{{$fullName}}</p>

        <img src="{{url('.idea\Pictures\profile.svg')}}" alt="Avatar" class="avatar">

        
      </div>
    </nav>
    
    <main>


      <div class="iframe">
        <iframe src="{{url('/artist/landing')}}" height="800" width="1110" name="frame"></iframe>
      </div>






    </main>

    <div id="sidebar">
      <div class="sidebar__title">
        <div class="sidebar__img">

        </div>
        <i onclick="closeSidebar()" class="fa fa-times" id="sidebarIcon" aria-hidden="true"></i>
      </div>

      <div class="sidebar__menu">
        <div class="sidebar__link ">
          <i class="fa fa-home"></i>
          <a id="myPage" href="{{url('artist/landing')}}" target="frame">My Page</a>
        </div>
        <div class="sidebar__link">
          <i class="fa fa-plus"></i>
          <a href="{{url('artist/craft')}}" target="frame">Upload Craft</a>
        </div>
        <!-- <div class="sidebar__link">
          <i class="fa fa-plus"></i>
          <a href="uEvents.html" target="frame">Upload Event</a>
        </div> -->



      </div>
      <div class="logout">
        <i class="fa fa-power-off"></i>
        <button id="logout">Logout</button>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <!-- <script src="{{url('js/script.js')}}"></script> -->
  <script src="{{url('js/dash.js')}}"></script>
</body>

</html>
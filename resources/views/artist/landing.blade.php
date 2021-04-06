<!DOCTYPE html>
<html lang="en">

<head>
    <title>landing</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{url('css/landing.css')}}"  type="text/css" rel="stylesheet" />
    <link href="{{url('css/editCraft.css')}}" type="text/css" rel="stylesheet" />
    <link href="{{url('css/cPassword.css')}}" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
<style>

</style>

<body>
    <section>
    <!-- {{
        $firstName=$loggedUserInfo['first_name'],
        $lastName=$loggedUserInfo['last_name'],
        $fullName= $firstName." ".$lastName,
        $description=$loggedUserInfo['description'],
        $talent=($loggedUserInfo['talent']),
        $email=($loggedUserInfo['email']),
        $profilePhoto=($loggedUserInfo['profile_photo'])
        
    }} -->
        <article>
            <div class="profile">
                <img src="{{asset('/storage/Image/'.$profilePhoto)}}" alt="man">
                <div class="profile-1">
                    <div class="profile-2">
                    <h1>{{$fullName}}</h1>
                        <button id="editProfile"><i class="fa fa-cog"></i></button>
                        <div id="settings" class="settings">

                            <div class="settings-content">
                                <span class="closeSettings">&times;</span>
                                <h1>Settings</h1>
                                <hr>
                                <button class="sProfile" id="editProfile1"><i
                                        class="fa fa-user"></i>&nbsp;&nbsp;&nbsp;&nbsp;Profile</button>
                                <div id="myModal" class="modal">

                                    <div class="modal-content">
                                        <span class="close">&times;</span>
                                        <br>
                                        <nav class="navbar">
                                            <div class="logo">
                                                <img id="logo"
                                                    src="{{url('.idea\Pictures\emoticon-square-smiling-face-with-closed-eyes.svg')}}"
                                                    alt="logo">
                                            </div>

                                            <div class="navbar__right">
                                                <p>{{$fullName}}</p>

                                                <img src="{{url('.idea\Pictures\profile.svg')}}" alt="Avatar" class="avatar">


                                            </div>
                                        </nav>
                                        <br>

                                        <div class="profile1">
                                            <img id="pic"  alt="man" src="{{asset('/storage/Image/'.$profilePhoto)}}"/>
                                            <div class="profile-1">
                                                <div class="profile-2-1">
                                                    <h1>{{$fullName}}</h1>
                                                </div>
                                            </div>


                                        </div>
                                        
                                        <div class="in-content">

                                            <div class="in-content-1">
                                            <form id="updateProfile" method="post">
                                                <h3>First Name</h3>
                                                <input type="text" id="fNameProfile" name="firstName" value="{{$firstName}}">
                                                <h3>Email</h3>
                                                <input type="text" id="emailProfile" name="email" value="{{$email}}">
                                                <h3>Description</h3>
                                                <textarea type="text" id="descriptionProfile" name="description" cols="30" rows="9">{{$description}}</textarea>
                                            </div>
                                            <div class="in-content-2">
                                            <h3>Last Name</h3>
                                                <input type="text" id="lNameProfile" name="lastName" value="{{$lastName}}">
                                            
                                                <h3>Talent</h3>
                                                <input type="text" id="talentProfile" name="talent" value="{{$talent}}">
                                                <h3>Change Photo</h3>
                                                <input type="file" id="photo" name="photo">
                                                <button type="button" id="image_upload_file">Choose File</button>
                                                <br>
                                                <br>
                                                <button id="updateProfileBtn">Update</button>
                                                <p id="profileUpload_success" class="success"></p>
                                                <p id="profileUpload_error" class="error"></p>
                                            </div>
                                        </div>
                                        {!! csrf_field() !!}
                                        </form>

                                    </div>
                                </div>
                                <br>
                                <br>
                                <button class="scPassword" id="scPassword"><i class="fa fa-exchange"></i>&nbsp;&nbsp;&nbsp;&nbsp;Change
                                    Password</button>
                                <br>
                                <div class="container" id="container">
                                <div class="containerContent" id="containerContent">
                                    <span class="closePasswords">&times;</span>
                                    <div class="form-container sign-up-container">
                                        <form id="formCPassword" action="changePassword" method="post">
                                            <h1 id="title">Change Password</h1>
                                
                                            <label>
                                                <input id="current" name="current" placeholder="Current Password" type="password" />
                                                <input id="nPassword" name="nPassword" type="password" placeholder="New Password" />
                                                <input id="confirmPassword" name="confirmPassword" placeholder="Confirm New Password" type="password" />
                                            </label>
                                            <p id="changePasswordSuccess" class="success"></p>
                                                <p id="changePasswordError" class="error"></p>
                                            <button type="submit" name="cPassword" id="cPassword">Confirm</button>
                                            <p id="Message" style='color:red; margin-left: 39px;'></p>
                                        </form>
                                    </div>
                                </div>
                                </div>
                                


                            </div>
                        </div>

                    </div>
                    <p>{{$description}}</p>
                </div>
                <br>

            </div>




            <div class="body">
                <div class="body_div">
                    <div>
                        <img id="img" class="img" src="{{url('.idea\Pictures\burger.jpg')}}" />
                    </div>
                    <div>

                        <p class="ReadMore showlesscontent">A burger a day keeps the tummy awake Lorem ipsum dolor sit
                            amet consectetur adipisicing elit. Quidem dolorum, quaerat ratione nihil quo distinctio
                            assumenda delectus at deserunt, ipsa eligendi magni. Ex asperiores optio,
                            fugiat repellendus aspernatur rem consequatur. Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Iusto optio magni maxime, fuga neque nobis esse unde cumque porro minima
                            excepturi, natus atque reprehenderit eaque pariatur ipsa facilis vel. Rem. Lorem ipsum dolor
                            sit, amet consectetur adipisicing elit. Repudiandae debitis quisquam architecto culpa
                            corporis fugit natus vitae incidunt quis?
                            Exercitationem error dolorem, omnis quo voluptatem quasi modi illum assumenda nulla?</p>
                    </div>
                    <div>

                        <button id='editCraft'>Edit</button>
                        <div id='editModal' class='modal'>

                            <div class='modal-content12'>
                                <span class='closeEvent'>&times;</span>
                                <br>
                                <nav class='navbar12'>
                                    <div class='logo'>
                                        <h1>vivart</h1>
                                    </div>

                                    <div class='navbar__right12'>
                                        <p>{{$fullName}}</p>

                                        <img src="{{url('.idea\Pictures\profile.svg')}}" alt='Avatar' class='avatar1'>


                                    </div>
                                </nav>
                                <br>


                                <form id='craftEdit'>
                                    <div class='in-content12'>


                                        <div class='in-content-212'>
                                            <h3>Change Name</h3>
                                            <input type='text' id='craft_name' name='craft_name'>
                                            <h3>Change Media File</h3>
                                            <input type='file' id='craft_file' name='craft_file'>
                                            <button type='button' class='file_selector'
                                                onclick='changeCraft()'>Change</button>
                                            <h3>Change Caption</h3>
                                            <textarea type='text' id='craft_description'
                                                name='craft_description'></textarea>
                                            <input type='text' id='craft_id' name='craft_id'>
                                            <br>
                                            <p class='error' id='eventEdit_error'></p>
                                            <p class='success' id='eventEdit_success'></p>
                                            <br>
                                            <br>
                                            <div class="btns">
                                                <button id='update1'>Update</button>
                                                <br>
                                                <button type='button' id='craft_delete'
                                                    onclick='deleteEvent()'>Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>

                </div>

                <div class="body_div">
                    <div>
                        <img id="img" class="img" src="{{url('.idea\Pictures\burger.jpg')}}" />
                        <div id="imageModal" class="imageModal">

                            <!-- The Close Button -->
                            <span class="closeImage">&times;</span>

                            <!-- Modal Content (The Image) -->
                            <img class="image_modal-content" id="img01" class="img01">

                        </div>
                    </div>
                    <div>
                        <p class="">A burger a day keeps the tummy awake</p>
                    </div>
                    <div>
                        <button id='editEvent'>Edit</button>
                        <div id='editModal' class='modal'>

                            <div class='modal-content12'>
                                <span class='closeEvent'>&times;</span>
                                <br>
                                <nav class='navbar12'>
                                    <div class='logo'>
                                        <img id='logo'
                                            src="{{url('.idea\Pictures\emoticon-square-smiling-face-with-closed-eyes.svg')}}"
                                            alt='logo'>
                                    </div>

                                    <div class='navbar__right12'>
                                        <p>{{$fullName}}</p>

                                        <img src="{{url('.idea\Pictures\profile.svg')}}" alt='Avatar' class='avatar1'>


                                    </div>
                                </nav>
                                <br>


                                <form id='eventEdit'>
                                    <div class='in-content12'>


                                        <div class='in-content-212'>
                                            <h3>Change Name</h3>
                                            <input type='text' id='name' name='Name'>
                                            <h3>Change Photo</h3>
                                            <input type='file' id='eventPhoto' name='eventPhoto'>
                                            <h3>Change Caption</h3>
                                            <input type='text' id='description' name='description'>
                                            <br>
                                            <button id='update'>Update</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>

                </div>

                <div class="body_div">
                    <div>
                        <img class="img" id="img" src="{{url('.idea\Pictures\burger.jpg')}}" />
                    </div>
                    <div>
                        <p>A burger a day keeps the tummy awake</p>
                    </div>
                    <div>
                        <button>Edit</button>
                    </div>

                </div>

                <div class="body_div">
                    <div>
                        <img class="img" id="img" src="{{url('.idea\Pictures\burger.jpg')}}" />
                    </div>
                    <div>
                        <p>A burger a day keeps the tummy awake</p>
                    </div>
                    <div>
                        <button>Edit</button>
                    </div>

                </div>

                <div class="body_div">
                    <div>
                        <img class="img" id="img" src="{{url('.idea\Pictures\burger.jpg')}}" />
                    </div>
                    <div>
                        <p>A burger a day keeps the tummy awake</p>
                    </div>
                    <div>
                        <button>Edit</button>
                    </div>

                </div>
                <div class="body_div">
                    <div>
                        <img class="img" id="img" src="{{url('.idea\Pictures\burger.jpg')}}" />
                    </div>
                    <div>
                        <p>A burger a day keeps the tummy awake</p>
                    </div>
                    <div>
                        <button>Edit</button>
                    </div>

                </div>
                <div class="body_div">
                    <div>
                        <img id="img" class="img" src="{{url('.idea\Pictures\burger.jpg')}}" />
                    </div>
                    <div>
                        <p>A burger a day keeps the tummy awake</p>
                    </div>
                    <div>
                        <button>Edit</button>
                    </div>

                </div>
                <div class="body_div">
                    <div>
                        <img id="img" class="img" src="{{url('.idea\Pictures\burger.jpg')}}" />
                    </div>
                    <div>
                        <p>A burger a day keeps the tummy awake</p>
                    </div>
                    <div>
                        <button>Edit</button>
                    </div>

                </div>
                <div class="body_div">
                    <div>
                        <img id="img" class="img" src="{{url('.idea\Pictures\burger.jpg')}}" />
                    </div>
                    <div>
                        <p>A burger a day keeps the tummy awake</p>
                    </div>
                    <div>
                        <button>Edit</button>
                    </div>

                </div>

            </div>




        </article>
    </section>


    <script src="{{url('js/landing.js')}}"></script>
   
</body>

</html>

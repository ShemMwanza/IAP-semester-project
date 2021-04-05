<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Art;
class MainController extends Controller
{
    protected $password;

    /*Login Logic */
    function Login(Request $request)
    {
        $request->validate([
            'loginEmail'=>'required|email',
            'loginPassword'=>'required|min:5|max:12'
        ]);

        $userInfo= User::where('email','=',$request->loginEmail)->first();

        if (!$userInfo) {
            return back()->with('loginError',"We don't recognize your email");
        }else {
            if (Hash::check($request->loginPassword, $userInfo->password)) {
                $request->session()->put('userId',$userInfo->id);
                return redirect('/artist/dashboard');
            }else {
                return back()->with('loginError',"Password not correct");
            }
        }
    }

    /*Registeration Logic */
    function register(Request $request)
    {
        $this->password=$request->input('password');
        
        //Validating the inputs
        $request->validate([
            "firstName"=>"required",
            "lastName"=>"required",
            "email"=>"required|email|unique:users",
            "password"=>"required|min:5|max:12",
            "confPassword"=>["required","min:5","max:12",
                function($attribute,$value,$fail){
                    global $password;
                    if ($value!=$this->password) {
                        $fail("Password Mismatch");
                    }
                }
            ]
        ]);
        
        //using the User model to interact with the database 
        $user= new User;
        $user->first_name=$request->input('firstName'); // alternatrive: $request->firstName
        $user->last_name=$request->input('lastName'); // alternatrive: $request->lastName
        $user->email=$request->input('email');// alternatrive: $request->email
        $user->user_type="Artist";
        $user->password=Hash::make($request->input('password'));
        $user->email=$request->input('email');
        $save= $user->save();
        
        //confirmation message logic
        if ($save) {
            return back()->with('success','New user has been successfully added to the database');
        }else {
            return back()->with('error','Oops, something went wrong!');
        }
    }

    /*Logout Logic*/
    function logout(){
        if (session()->has('userId')) {
            session()->pull('userId');
            return redirect('auth/login_&_register');
        }
    }

    /*logic for updating a profile*/
    function updateProfile(Request $request){
        
        $request->validate([
            "firstName"=>"required",
            "lastName"=>"required",
            "email"=>"required|email",
            "talent"=>"required",
            "description"=>"required",
            ]
        );
        
        $firstName=$request->firstName;
        $lastName=$request->lastName;
        $description= $request->description;
        $photo=$request->file('photo');
        $talent=$request->talent;
        $lastData= User::latest()->first();
        $lastId=$lastData->id;
        $email=$request->email;
       
        // dd($fileExtension);
        if ($photo!=null) {
            $fileExtension= $photo->extension();
            $fileName='profilePhoto'.$lastId.'.'.$fileExtension;
            $profilePhotoPath = $photo->storeAs(
                'public/Image', ($fileName)
            );
            // unlink()
            //$profilePhotoPath=$photo->store('file');
            $user= User::where('id',session('userId'))->update([
                'first_name'=>$firstName,
                'last_name'=>$lastName,
                'description'=>$description,
                'profile_photo'=>$fileName,
                'talent'=>$talent,
                'email'=>$email
            ]) ;
            if ($user) {
                return response("success");
            }else {
                return response("Upload Error");
            }
        }else {
            $user= User::where('id',session('userId'))->update([
                'first_name'=>$firstName,
                'last_name'=>$lastName,
                'description'=>$description,
                'talent'=>$talent,
                'email'=>$email
            ]) ;
            if ($user) {
                return response("success");
            }else {
                return response("Upload Error");
            }
        }

        // $data=['loggedUserInfo'=>User::where('id','=',session('userId'))->first()];
        // return view('artist.dashboard',$data);
    }
    /*Chnage Password */
    function changePassword(Request $request){
        $currentPassword= $request->current;
        $newPassword= $request->nPassword;
        $confirmNewPassword= $request->confirmPassword;
        $user=User::where('id','=',session('userId'))->first();
        if ($newPassword!=$confirmNewPassword) {
            return response()->json(["error"=>"Password Mismatch"], 200);
        }else {
            if(Hash::check($currentPassword, $user->password) ){
                return response()->json(['error'=>'wrong current password'], 200);
            }else {
                $update= User::where('id','=',session('userId'))->update([
                    "password"=>Hash::make($newPassword)
                ]);
                if ($update) {
                    return response()->json(["success"=>"Password updated Successfully"], 200);
                }else {
                    return response()->json(["error"=>"Oops! Something went wrong"], 200);
                }
            }    
        }
        
    }

    function addCraft(Request $request){
        // $request->validate([
        //     // "art_type"=>"required",
        //     "photo"=>"required",
        //     "caption"=>"required|email",
        //     ]
        // );

        $craft_file = $request->file('photo');
        $lastId= Art::latest()->first();

        //dd($request);
        //$array = explode( ".", $craft_file);
        //$craft_type = get_content_type($array[1]);
        // if($craft_type == "Decline"){
        //     return response()->json("Ensure your upload is an image/video/audio");
        // }else{
               
        // }
        if($lastId == null){
            $lastId = 0;
        }
         // $profilePhotoPath = $photo->storeAs(
         //        'file', ('profilePhoto'.$lastId)
         //    );
        //dd($craft_file);
        $craft_upload_path = $craft_file->storeAs('file', ('craft'.$lastId));
        $art = new Art;
        $art->user_id=session('userId');
        $art->art_type="Drawing"; // alternatrive: $request->firstName
        $art->art_caption=$request->input('caption'); // alternatrive: $request->lastName
        $art->art_path=$craft_upload_path;// alternatrive: $request->email
        $save = $art->save();         

        //confirmation message logic
        if ($save) {
            return response()->json('success');
        }else {
            return response()->json('Oops, Something went wrong');
        }       
    }


    /*routing to the dashboard*/
    function dashboard(){
        $data=['loggedUserInfo'=>User::where('id','=',session('userId'))->first()];
        return view('artist.dashboard',$data);
    }

    /*routing to the login and signup page */
    function display_login_register(){
        return view('auth.login_&_register');
    }
    /*routing to the reset password page*/
    function getResetPasswordPage()
    {
        return view('auth.r_password');
    }
    /*routing to the beautiful index page -_-*/
    function getIndexPage()
    {
        return view('index');
    }
    /*routing to the Landing page */
    function getLandingPage()
    {
        $data=['loggedUserInfo'=>User::where('id','=',session('userId'))->first()];
        return view('artist.landing',$data);
    }
    /*routing to the craft uploading page */
    function getCraftPage()
    {
        return view('artist.craft');
    }
    /*routing to the dashboard page */
    function getDashboardPage()
    {
        return view('artist.dashboard');
    }
}

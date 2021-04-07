<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Art;
use DB;
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
            if(!Hash::check($currentPassword, $user->password) ){
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
        $data=[
            'loggedUserInfo'=>User::where('id','=',session('userId'))->first(),
            'usersCraftInfo'=>Art::where('user_id','=',session('userId'))->get()
             ];
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
    function addCraft(Request $request){
       
        //validating logic
        $request->validate([
            "photo"=>"required",
            "caption"=>"required",
            ]
        );

        $craft_file = $request->file('photo');
        $lastId= (Art::latest()->first()); //last craft Id
        if($lastId == null){
            $lastId = 1;
        }else {
            $lastId= ($lastId->id+1);
        }

        //File storing logic
        $fileExtension= $craft_file->extension();
        $craftFileName='craft'.session('userId').$lastId.'.'.$fileExtension;
        $craftUploadPath = $craft_file->storeAs(
            'public/Image', ($craftFileName)
        );
        
        // database saving logic
        $art = new Art;
        $art->user_id=session('userId');
        $art->art_type=$request->type; 
        $art->art_caption=$request->caption; 
        $art->art_path=$craftFileName;
        $save = $art->save();         

        //confirmation message logic
        if ($save) {
            return response()->json(['success'=>"Craft Uploaded Successfully"]);
        }else {
            return response()->json('Oops, Something went wrong');
        }       
    }
    
    function editCraft(Request $request)
    {       
        //return response()->json(['data'=>$craftId]);
        $craftId=$request->craft_id;
        $craft= Art::where("id","=",$craftId)->first();
        return response()->json(
            ["artType" => $craft->art_type,
            "artCaption" =>$craft->art_caption,
            "artPath" =>$craft->art_path 
            ]
            , 200);
    }

    function craftUpdate(Request $request)
    {

        $request->validate([
            "craft_type"=>"required",
            "craft_description"=>"required"
            ]
        );
        $craftId=$request->craft_id;
        $craftType=$request->craft_type;
        $craftFile=$request->file('craft_file');
        $craftDescription= $request->craft_description;
       
        if ($craftFile!=null) {
            //File storing logic
            $fileExtension= $craftFile->extension();
            $craftFileName='craft'.session('userId').$craftId.'.'.$fileExtension;
            $craftUploadPath = $craftFile->storeAs(
                'public/Image', ($craftFileName)
            );
            
            $art= Art::where('id',$craftId)->update([
                'art_type'=>$craftType,
                'art_caption'=>$craftDescription,
                'art_path'=>$craftFileName
            ]);
            if ($art) {
                return response()->json(['success'=>"Craft Updated Successfully"]);
            }else {
                return response()->json(['error'=>"Oops, Something went wrong"]);
            }       
        }else {
            $art= Art::where('id',$craftId)->update([
                'art_type'=>$craftType,
                'art_caption'=>$craftDescription,
            ]);
            if ($art) {
                return response()->json(['success'=>"Craft Updated Successfully"]);
            }else {
                return response()->json(['error'=>"Oops, Something went wrong"]);
            }       
        }
    }
    function deleteCraft(Request $request)
    {
       $craftId=$request->craftId;
       $craft= Art::where("id","=",$craftId)->delete();
    if ($craft) {
        return response()->json(['success'=>"Craft deleted Successfully"]);
    }else {
        return response()->json(['error'=>"Oops, Something went wrong"]);
    }      

    }

    /*routing to the find artist page */
    function getFindArtistPage()
    {
        $users = DB::table('users')->select('id', 'first_name', 'last_name', 'description', 'profile_photo')->get();
        return view('artist.findArtist', ['users' => $users]);
    }

    function searchArtist(Request $request){
        $search = $request->search;        
        $users = DB::table('users')->select('id', 'first_name', 'last_name', 'description', 'profile_photo')->where("talent","LIKE","%{$search}%")->orWhere("description","LIKE","%{$search}%")->get();        
        $output = array();
        foreach ($users as $user) {
            array_push($output, "<div class='profile' onclick='checkProfile()'>
                            <div class='profile_img'>
                                <img class='img' src='$user->profile_photo' alt='Profile_photo'>
                            </div>
                            <div class='profile_content'>
                                <span class='profile_name'>
                                    <p>$user->first_name  $user->last_name</p>
                                </span>
                                <span class='profile_info'>
                                    <p>$user->description</p>
                                </span>
                            </div>

                        </div>");
        }
        return response()->json($output);
        
    }        
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
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
                        $fail("Password Mismatch Value= ".$value." Password= ".$password);
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

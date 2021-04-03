<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class MainController extends Controller
{
    protected $password;
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
       
        return ($request->input());
        // return view('auth.login');
    }
    function register(Request $request)
    {
       //return ($request->input());
        // return view('register');
        $this->password=$request->input('password');
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

        $user= new User;
        $user->first_name=$request->input('firstName'); // $request->firstName
        $user->last_name=$request->input('lastName'); // $request->lastName
        $user->email=$request->input('email');// $request->email
        $user->user_type="Artist";
        $user->password=Hash::make($request->input('password'));
        $user->email=$request->input('email');

        $save= $user->save();

        if ($save) {
            return back()->with('success','New user has been successfully added to the database');
        }else {
            return back()->with('error','Oops, something went wrong!');
        }
    }

    function dashboard(){
        $data=['loggedUserInfo'=>User::where('id','=',session('userId'))->first()];
       // return session('userId');
        return view('artist.dashboard',$data);

    }


    function display_login_register(){
        return view('auth.login_&_register');
    }
    function getResetPasswordPage()
    {
        return view('auth.r_password');
    }
    function getIndexPage()
    {
        return view('index');
    }
    function getLandingPage()
    {
        $data=['loggedUserInfo'=>User::where('id','=',session('userId'))->first()];
        return view('artist.landing',$data);
    }
    function getCraftPage()
    {
        return view('artist.craft');
    }
    function getDashboardPage()
    {
        return view('artist.dashboard');
    }
}

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/register', function () {
//     return view('register');
// });
Route::get('auth/login_&_register',[MainController::class,'display_login_register']);
Route::get('auth/r_password',[MainController::class,'getResetPasswordPage']);
Route::get('/',[MainController::class,'getIndexPage']);
Route::get('artist/landing',[MainController::class,'getLandingPage']);
Route::get('artist/craft',[MainController::class,'getCraftPage']);
Route::post('/auth/login',[MainController::class,'login']);
Route::post('/auth/register',[MainController::class,'register']);
Route::get('artist/dashboard',[MainController::class,'dashboard']);
Route::get('artist/logout',[MainController::class,'logout']);
Route::post('artist/updateProfile',[MainController::class,'updateProfile']);
Route::post('artist/changePassword',[MainController::class,'changePassword']);
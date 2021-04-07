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
Route::get('auth/forgot_password',[MainController::class,'getForgotPasswordPage'])->middleware('guest');
Route::post('auth/forgot_password',[MainController::class,'forgotPassword'])->middleware('guest')->name('password.forgotPassword');
Route::get('/',[MainController::class,'getIndexPage']);
Route::get('artist/landing',[MainController::class,'getLandingPage']);
Route::get('artist/craft',[MainController::class,'getCraftPage']);
Route::post('/auth/login',[MainController::class,'login']);
Route::post('/auth/register',[MainController::class,'register']);
Route::get('artist/dashboard',[MainController::class,'dashboard']);
Route::get('artist/logout',[MainController::class,'logout']);
Route::post('artist/updateProfile',[MainController::class,'updateProfile']);
Route::post('artist/changePassword',[MainController::class,'changePassword']);
Route::post('artist/addCraft',[MainController::class,'addCraft']);
Route::post('artist/editCraft',[MainController::class,'editCraft']);
Route::post('artist/craftUpdate',[MainController::class,'craftUpdate']);
Route::post('artist/deleteCraft',[MainController::class,'deleteCraft']);
Route::get('auth/reset_password',[MainController::class,'getResetPasswordPage'])->middleware('guest');
Route::post('auth/reset_password',[MainController::class,'resetPassword'])->middleware('guest')->name('password.reset');
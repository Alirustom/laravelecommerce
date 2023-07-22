<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\userRegistration;
use App\Http\Controllers\userProfile;


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

Route::get('/', function () {
    return view('usermain_page');
})->name('home');
// Route::get('/register',[AuthController::class, 'userRegistrationform']);
// Route::post('/register',[AuthController::class, 'userRegistration'])->name('userRegistration');
Route::controller(App\Http\Controllers\userRegistration::class)->group(function(){
  Route::get('/register', 'userRegistration')->name('register');
  Route::post('/user_register', 'userRegistrationForm')->name('user_register');
  Route::get('/login', 'userLogin')->name('login');
  Route::post('login','UserLoginForm')->name('login')->name('user_login');
  Route::get('logout','UserLogout')->name('logout');
  Route::get('resetpassword','UserResetPassword')->name('resetpassword');
    Route::post('resetpassword','UserResetPasswordForm')->name('login')->name('resetpasswordform');
});
Route::controller(App\Http\Controllers\UserProfile::class)->group(function(){
  Route::get('/user_profile','UserProfile')->name('user_profile');
});
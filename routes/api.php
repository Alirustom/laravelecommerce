<?php

use App\Http\Controllers\userReadDataApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('users_read_data', userReadDataApi::class);
Route::post('register_user_by_api', [\App\Http\Controllers\UserRegistrationApi::class, 'addUserByApi'])->name('register_user_by_api');


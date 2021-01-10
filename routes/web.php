<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/abc', function () {
//     return view('admin.dashboard');
// });
// Route::get('/pqr', function () {
//     return view('user.personalinfo');
// });



Route::get('login', 'AuthController@index');
Route::post('post-login', 'AuthController@postLogin'); 
Route::get('registration', 'AuthController@registration');
Route::post('post-registration', 'AuthController@postRegistration'); 

Route::get('auth/google', 'AuthController@redirectToGoogle');
Route::get('auth/google/callback', 'AuthController@handleGoogleCallback');


// Route::get('edit-user','UserController@editUser');
Route::get('/user-list/{id}/edit', 'UserController@editUser');
Route::post('store', 'UserController@userStore');

Route::group( ['middleware' => 'auth' ], function()
{
    Route::get('dashboard', 'AuthController@dashboard'); 
    Route::get('logout', 'AuthController@logout');
    Route::get('/usermanage','UserController@userManage');
    Route::get('contact/deleteuser/{id}','UserController@deleteUser');  
    Route::get('/abc','UserController@adminUser');
    Route::get('/pqr','UserController@normalUser');
    Route::post('/searchdetails','UserController@searchDetails');

});
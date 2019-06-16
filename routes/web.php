<?php

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
    return view('welcome');
});

Auth::routes(['verify' => true]);  

Route::group(['middleware' => ['auth', 'verified']], function() {

    // user route
    Route::get('/user', 'UsersController@user')->name('user');  

    Route::get('/nopermission', 'UsersController@nopermission')->name('nopermission');

    Route::get('/dashboard', 'UsersController@dashboard')->name('dashboard');
 
    Route::get('/adminprofile', 'UsersController@adminProfile')->name('admin.profile');    
    Route::post('/adminprofile/update', 'UsersController@adminProfileUpdate')->name('admin.profile.update');  

    // manage users 
    Route::get('/users', 'UsersController@users')->name('users');    

    // Manage Roles
    Route::get('/roles/user', 'RolesController@roleuser')->name('roles.roleuser');    
    
    Route::get('/roles/roleusercreate', 'RolesController@roleusercreate')->name('roles.roleusercreate');  
    Route::post('/roles/roleuserstore', 'RolesController@roleuserstore')->name('roles.roleuserstore');  

    Route::resource('roles', 'RolesController');        
});

Route::get('/home', 'HomeController@index')->name('home'); 

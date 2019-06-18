<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/**
 * Auth routes with email verified
 */
Auth::routes(['verify' => true]);  

/**
 * Authenticated routes for admin panel 
 */
Route::group(['middleware' => ['auth', 'verified']], function() {  

    /**
     * User custom auth routes
     */ 
    Route::get('/user', 'UsersController@user')->name('user');  
    
    Route::get('/nopermission', 'UsersController@nopermission')->name('nopermission');

    Route::get('/dashboard', 'UsersController@dashboard')->name('dashboard');
 
    Route::get('/admin/profile', 'UsersController@adminProfile')->name('admin.profile');    
    Route::post('/admin/profile/update', 'UsersController@adminProfileUpdate')->name('admin.profile.update');  

    /**
     * User CRUD Routes 
     */
    Route::get('/users', 'UsersController@users')->name('users');    
    Route::resource('users', 'UsersController');    


    /**
     * Roles Routes
     */
    Route::get('/roles/user', 'RolesController@roleuser')->name('roles.roleuser');    
    
    Route::get('/roles/roleusercreate', 'RolesController@roleusercreate')->name('roles.roleusercreate');  
    Route::post('/roles/roleuserstore', 'RolesController@roleuserstore')->name('roles.roleuserstore');  

    /**
     * Role CRUD Routes
     */
    Route::resource('roles', 'RolesController');   
       
    
    /**
     * Permission Routes
     */
    Route::resource('permission', 'PermissionsController');            
});     

/**
 * User home route
 */
Route::get('/home', 'HomeController@index')->name('home');   

/** Social Login */
Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');  

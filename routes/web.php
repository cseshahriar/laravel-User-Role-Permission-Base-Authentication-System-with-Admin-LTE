<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Admin Login Route 
Route::get('admin', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');  
Route::get('admin/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');  
Route::post('admin/login', 'Auth\AdminLoginController@login')->name('admin.login');     

/* Auth routes with email verified */
Auth::routes(['verify' => true]);   
 
/** Authenticated routes for admin panel */
Route::group(['middleware' => ['auth', 'verified']], function() {    

    Route::get('/user', 'UsersController@user')->name('user');  
    
    Route::get('/nopermission', 'UsersController@nopermission')->name('nopermission');

    Route::get('/dashboard', 'UsersController@dashboard')->name('dashboard');
    
    /** Admin Profile Routes */
    Route::get('/profile', 'UsersController@adminProfile')->name('admin.profile');    
    Route::post('/profile/update', 'UsersController@adminProfileUpdate')->name('admin.profile.update');  

    /** User Profile Routes */
    Route::get('/user/profile', 'UsersController@userProfile')->name('user.profile');     
    Route::post('/user/profile/update', 'UsersController@userProfileUpdate')->name('user.profile.update');      

    /**
     * User CRUD Routes 
     */
    Route::get('/users', 'UsersController@users')->name('users');    
    Route::resource('users', 'UsersController');    


    /* Roles Routes */
    Route::get('/role', 'RolesController@index')->name('role.index');       
    
       
    
    /* Permission Routes */
    Route::resource('permission', 'PermissionsController');  

    /* Category routes */          
    Route::resource('category', 'CategoryController');   


    Route::get('/media', 'MediaController@index')->name('media');      

    Route::get('/laravel-filemanager', '\UniSharp\LaravelFilemanager\Controllers\LfmController@show');
    Route::post('/laravel-filemanager/upload', '\UniSharp\LaravelFilemanager\Controllers\UploadController@upload');
    // list all lfm routes here... 
    
        /* Social profile routes */          
    Route::resource('social', 'SocialProfileController');  


    /* Menu Routes */
    Route::get('menu/{id}/builder', 'MenuController@builder')->name('menu.builder');    
    Route::get('menu/{id}/builder/create', 'MenuController@builderCreate')->name('menu.builder.create');  
    Route::post('menu/{id}/builder/store', 'MenuController@builderStore')->name('menu.builder.store');  
    
    Route::get('menu/{id}/builder/edit', 'MenuController@builderEdit')->name('menu.builder.edit'); 
    Route::put('menu/{id}/builder/update', 'MenuController@builderUpdate')->name('menu.builder.update');   

    Route::delete('menu/{id}/builder/destroy', 'MenuController@builderDestroy')->name('menu.builder.destroy');  

    Route::resource('menu', 'MenuController');      

    /* product routes */  
    Route::resource('attribute', 'AttributeController');         
    Route::resource('option', 'OptionController');          
    Route::resource('product', 'ProductController');        
    Route::resource('tax', 'TaxController');           
  
              
});     


/**
 * User home route
 */
Route::get('/home', 'HomeController@index')->name('home');   

/** Social Login */
Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');  

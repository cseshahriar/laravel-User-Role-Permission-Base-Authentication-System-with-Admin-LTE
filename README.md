# laravel User Role Permission Base Authenticationn System with Admin LTE

This is a startup laravel admin panel. I believe anybody can use it, who want to save time.

Author
Name : MD Shahriar Hosen  <br>
Email : cse.shahriar.hosen@gmail.com  <br> 
URL: http://codershahriar.com <br>

Version
v1.0.0 beta

Technologies
Laravel v5.8.*

<div style="width:100%">
    <div style="width:25%;float:left">
        <img src="https://photos.google.com/album/AF1QipNAPFFcWdO9z1rNc5DHJ2bchT1qRyLpg_9Iojq3/photo/AF1QipPjoc7Y1jJfWIaCnfr1L3LQafCxRnt3ZZbm0y5q">
    </div>  
    
     <div style="width:25%;float:left">
        <img src="https://photos.google.com/album/AF1QipNAPFFcWdO9z1rNc5DHJ2bchT1qRyLpg_9Iojq3/photo/AF1QipOm0IGP39yW1KSwoAuopnk91b7qwViX2fsLvhaz">
    </div>
    
    <div style="width:25%;float:left">
        <img src="https://photos.google.com/album/AF1QipNAPFFcWdO9z1rNc5DHJ2bchT1qRyLpg_9Iojq3/photo/AF1QipM9rERxWvir2Fkd8RxaDACxR4EDZQHnaXLGIxrI">
    </div>
    
    
     <div style="width:25%;float:left">
        <img src=" https://photos.google.com/album/AF1QipNAPFFcWdO9z1rNc5DHJ2bchT1qRyLpg_9Iojq3/photo/AF1QipMiyh4_tqD1T1pKgbrCmyiqBU50KIt77wezQN_J">
    </div>
    
</div>



Getting Started
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

What things you need to install the software and how to install them

Clone the repo and cd into it

composer install

Rename or copy .env.example file to .env

php artisan key: generate

Set your database credentials in your .env file

php artisan migrate

php artisan db:seed

Set .Env Mail configuration with Gmail

Set social login configuration in .env file <br>

FACEBOOK_CLIENT_ID= <br>
FACEBOOK_CLIENT_SECRET= <br>
FACEBOOK_CLIENT_CALLBACK= <br>

GOOGLE_CLIENT_ID= <br>
GOOGLE_CLIENT_SECRET= <br>
GOOGLE_CLIENT_CALLBACK= <br>

php artisan serve or use Laravel Valet or Laravel Homestead

Visit localhost:8000 in your browser

Visit for admin login /admin/login if you want to access the admin panel. Default Admin User/Password: admin@admin.com/shahriar

Visit user login /login if you want to access the admin panel. Default Admin User/Password: user@user.com/shahriar

{{ 'Happy Coding' }}  


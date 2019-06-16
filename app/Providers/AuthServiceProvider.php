<?php

namespace App\Providers;

use Auth; 
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // check admin  
        Gate::define('admin', function () {

            $userRoles = Auth::user()->roles->pluck('name'); 

            if($userRoles->contains('admin')) {
                return true;
            } else {
                return false; 
            }
            
        });
    }
}

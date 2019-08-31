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

        /** Gates for user crud  */
        Gate::define('user-read', function () { 

            $userPermissions = Auth::user()->permissions->pluck('name');   

            if($userPermissions->contains('user-read')) { 
                return true;
            } else {
                return false;  
            }
            
        });

        Gate::define('user-write', function () { 

            $userPermissions = Auth::user()->permissions->pluck('name');   

            if($userPermissions->contains('user-write')) { 
                return true;
            } else {
                return false;  
            }
            
        });

        Gate::define('user-edit', function () { 

            $userPermissions = Auth::user()->permissions->pluck('name');   

            if($userPermissions->contains('user-edit')) { 
                return true;
            } else {
                return false;  
            }
            
        });

        Gate::define('user-delete', function () { 

            $userPermissions = Auth::user()->permissions->pluck('name');   

            if($userPermissions->contains('user-delete')) { 
                return true;
            } else {
                return false;  
            }
            
        }); 

              /**
         * Gates for permissions crud  
         */
        Gate::define('permission-read', function () { 

            $userPermissions = Auth::user()->permissions->pluck('name');   

            if($userPermissions->contains('permission-read')) { 
                return true;
            } else {
                return false;  
            }
            
        });

        Gate::define('permission-write', function () { 

            $userPermissions = Auth::user()->permissions->pluck('name');   

            if($userPermissions->contains('permission-write')) { 
                return true;
            } else {
                return false;  
            }
            
        });

        Gate::define('permission-edit', function () { 

            $userPermissions = Auth::user()->permissions->pluck('name');   

            if($userPermissions->contains('permission-edit')) { 
                return true;
            } else {
                return false;  
            }
            
        });

        Gate::define('permission-delete', function () { 

            $userPermissions = Auth::user()->permissions->pluck('name');   

            if($userPermissions->contains('permission-delete')) {   
                return true;
            } else {
                return false;  
            }
        }); 
    }
}

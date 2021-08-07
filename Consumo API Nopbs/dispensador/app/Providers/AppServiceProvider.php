<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Gate::define('ManageUserPermissions', function ($user) {
            if ($user->type_user == '2') {
                return true;
            }
            return false;
        });
        
        Gate::define('ManageAdminPermissions', function ($user) {
            if ($user->type_user == '1') {
                return true;
            }
            return false;
        });
    }
}

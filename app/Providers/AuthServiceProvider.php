<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
       
        $this->userGate();

        // cooperate with @can('ability) @endcan in blade view
        // this->authorize('ability') in controller
        // Keywords: policy
        // php artisan make:policy
    }

    public function userGate(){
        Gate::define('view-user', 'App\Policies\UserPolicy@view');
        Gate::define('create-user', 'App\Policies\UserPolicy@create');
        Gate::define('update-user', 'App\Policies\UserPolicy@update');
    }

    public function otpGate(){
        Gate::define('view-otp', 'App\Policies\OTPPolicy@view');
        Gate::define('set-otp', 'App\Policies\OTPPolicy@create');
        Gate::define('delete-otp', 'App\Policies\OTPPolicy@update');
    }
}

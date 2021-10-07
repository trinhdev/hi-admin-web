<?php

namespace App\Providers;

use App\Policies\HiCustomerPolicy;
use App\Policies\HiHdiPolicy;
use App\Policies\UserPolicy;
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
        User::class => HiHdiPolicy::class,
        User::class => HiCustomerPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
       
        $this->bootHdiPolicy();
        $this->bootHiCustomerPolicy();

        Gate::define('read-user', 'App\Policies\UserPolicy@readUser');
    }

    public function bootHdiPolicy(){
        Gate::define('read-analyze','App\Policies\HiHdiPolicy@readAnalysis');
        Gate::define('write-analyze', 'App\Policies\HiHdiPolicy@writeAnalysis');
        Gate::define('delete-analyze', 'App\Policies\HiHdiPolicy@destroyAnalysis');
    }

    public function bootHiCustomerPolicy(){
        Gate::define('read-otp','App\Policies\HiCustomerPolicy@readOTP');
        Gate::define('write-otp', 'App\Policies\HiCustomerPolicy@writeOTP');
        Gate::define('delete-otp', 'App\Policies\HiCustomerPolicy@destroyOTP');
    }

}

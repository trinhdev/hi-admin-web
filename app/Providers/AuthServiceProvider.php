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
        User::class => HiCustomerPolicy::class,
        User::class => HdiPolicy::class,
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
        $this->hiCustomerGate();
        $this->hdiGate();

        // cooperate with @can('ability) @endcan in blade view
        // this->authorize('ability') in controller
        // Keywords: policy
        // php artisan make:policy
    }

    public function userGate(){
        Gate::define('view-user', 'App\Policies\UserPolicy@view');
        Gate::define('manage-users', 'App\Policies\UserPolicy@manage');
        Gate::define('force-del-user', 'App\Policies\UserPolicy@forceDelete');
    }

    public function hiCustomerGate(){
        Gate::define('check-otp', 'App\Policies\HiCustomerPolicy@lookup');
        Gate::define('manage-otp', 'App\Policies\HiCustomerPolicy@manage');
        Gate::define('delete-otp', 'App\Policies\HiCustomerPolicy@delete');
    }

    public function hdiGate(){
        Gate::define('lookup-hdi', 'App\Policies\HdiPolicy@lookup');
        Gate::define('manage-hdi', 'App\Policies\HdiPolicy@manage');
        Gate::define('analyze-hdi', 'App\Policies\HdiPolicy@analyze');
        Gate::define('del-hdi', 'App\Policies\HdiPolicy@delete');
    }
}

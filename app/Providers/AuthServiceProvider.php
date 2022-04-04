<?php

namespace App\Providers;

use App\Policies\RolePermissionPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

use App\Models\Settings;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('role-permission', [RolePermissionPolicy::class, 'rolePermissionPolicy']);
        
        // Check auth hidepayment
        Gate::define('hide-payment', function ($user) {
            $list_allow_user = Settings::where('name', 'allow_hide_payment_user')->get();
            if(in_array($user->email, json_decode($list_allow_user[0]['value'], true))) {
                return true;
            }
            return false;
        });

        // Check id Icon check data
        Gate::define('icon-check-data-permission', function($user) {
            $role = Auth::user()->role_id;
            return $role === 8;
        });
        Gate::define('icon-approve-data-permission', function($user) {
            $role = Auth::user()->role_id;
            return $role === 7;
        });
    }
}

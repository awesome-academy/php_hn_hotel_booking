<?php

namespace App\Providers;

use App\Policies\BookingPolicy;
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
         'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('login.admin', UserPolicy::class . '@loginAdmin');
        Gate::define('login.partner', UserPolicy::class . '@loginPartner');
        Gate::define('comment', BookingPolicy::class . '@comment');
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;

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
    public function boot(GateContract $gateContract)
    {
        $this->registerPolicies();
        Passport::routes();

        $this->registerPolicies($gateContract);

        $gateContract->define('isAdmin', function ($user){
            return $user->role == 'admin';

        });
        $gateContract->define('isDeliveryMan', function ($user){
            return $user->role == 'delivery';

        });

        //
    }
}

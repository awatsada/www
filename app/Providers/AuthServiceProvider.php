<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        // App\Board::class => App\Policies\BoardPolicy::class,
    ];


    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define('show', function($user,$comment) {            
            return $user->owns($user,$comment);   // and define owns method in User model     
        }); 

        $gate->before(function ($user, $ability) {
           if($user->isSuperAdmin($user)) {
               return true;
           }
        });  


    }
}

<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use App\Policies\StaffingTablePolicy;
use App\StaffingTable;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
       // StaffingTable::class => StaffingTablePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /*LOG::debug("REGISTER POLICIES");
        Gate::define('is_admin', function($user){
            LOG::debug("roles:".$user);
            return $user->role === 'admin';
        });

        Gate::define('is_moderator', function($user){
            LOG::debug("roles:".$user);
            return $user->role === 'moderator';
        });
*/
        


        //
    }
}

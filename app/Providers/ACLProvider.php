<?php

namespace App\Providers;

use App\Models\User;
use Nematollahi\ACL\ACL;
use Illuminate\Support\Facades\Gate;
use App\Models\Admin\User\Permission;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Translation\Provider\Dsn;

class ACLProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        // Permission::all()->map(function($permission){
        //     Gate::define($permission->name , function(User $user) use($permission){
        //        return $user->hasPermission($permission->name);
        //     });
        // });

        ACL::run();

    }
}

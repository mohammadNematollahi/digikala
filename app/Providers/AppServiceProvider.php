<?php

namespace App\Providers;

use App\Models\CartItem;
use App\Models\Admin\Comment;
use Illuminate\Support\Composer;
use App\Models\Admin\Content\Menu;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
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

        Paginator::useBootstrap();
        
        View::composer("admin.layouts.header", function ($view) {
            $view->with(["currentComments" => Comment::where("seen", 0)->latest()->get()]);
        });

        View::composer("customer.layouts.header", function ($view) {
            $user = auth()->user() ?? null;
            if ($user) {

                $view->with(["carts" => CartItem::where("user_id", $user->id)->get()]);

            }
        });

        view()->composer('customer.layouts.header', function($view){

            $view->with(["menus" => Menu::whereNull("parent_id")->get()]);
            
        });
    }
}

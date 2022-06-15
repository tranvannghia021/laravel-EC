<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\View\Composers\CartComposer;
use App\Http\View\Composers\GroupProductComposer;
use App\Http\View\Composers\NotificationComposer;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
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
        View::composer('client.cart',CartComposer::class);
        View::composer('client.checkout.checkout',CartComposer::class);
        View::composer('client.header',GroupProductComposer::class);
        View::composer('client.products.list',GroupProductComposer::class);
        View::composer('client.banner',GroupProductComposer::class);
        View::composer('client.footer',GroupProductComposer::class);
        View::composer('admin.layout.narbar',NotificationComposer::class);
    }
}

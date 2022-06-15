<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
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
    public function boot(Request $request)
    {
        $html='';
        if ($request->is('admin/staffs/*')) {
            $html='menu-is-opening menu-open ';
        }
        View::share('className', $html); // <= ngoài view bạn gọi biến $NAME_VIEW_SHARE
    }
}

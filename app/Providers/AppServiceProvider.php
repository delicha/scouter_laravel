<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Point;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.navigation', function ($view) {
            $auth = auth()->user();
            $point = null;

            if ($auth) {
                $point = Point::where('user_id', $auth->id)->first();
            }

            $view->with('point', $point);
        });
    }
}

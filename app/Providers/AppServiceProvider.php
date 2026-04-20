<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Gate;
use Illuminate\Pagination\Paginator;

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
        if (config('app.env') === 'production') {
             URL::forceScheme('https');
         }
         Paginator::useBootstrapFive();

         Gate::define('is-admin', function ($user) {
             return $user->hasRole('admin');
         });

         Gate::define('is-investor', function ($user) {
             return $user->hasRole('investor');
         });
    }
}

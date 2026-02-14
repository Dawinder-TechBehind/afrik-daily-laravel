<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Interfaces\Admin\UserInterface',
            'App\Repositories\Admin\UserRepository'
        );
        
    }
}
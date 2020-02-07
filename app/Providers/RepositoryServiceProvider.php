<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    public function boot()
    {

    }

    public function register()
    {
        $this->app->bind('App\Interfaces\UsersInterface', 'App\Repositories\UsersRepository');
        $this->app->bind('App\Interfaces\TasksInterface', 'App\Repositories\TasksRepository');
    }
}

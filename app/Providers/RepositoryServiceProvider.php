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
        $this->app->bind('App\Interfaces\StaffsInterface', 'App\Repositories\StaffsRepository');
        $this->app->bind('App\Interfaces\NotificationsInterface', 'App\Repositories\NotificationsRepository');
        $this->app->bind('App\Interfaces\UserInvitationInterface', 'App\Repositories\UserInvitationRepository');
        $this->app->bind('App\Interfaces\TaskHistoryInterface', 'App\Repositories\TaskHistoryRepository');
    }
}

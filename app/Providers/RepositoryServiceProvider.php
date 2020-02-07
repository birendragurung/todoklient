<?php


namespace App\Providers;


use App\Interfaces\TasksInterface;
use App\Repositories\TasksRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    public function boot()
    {

    }

    public function register()
    {
        $this->app->bind(TasksInterface::class, TasksRepository::class);
        $this->app->bind(TasksInterface::class, TasksRepository::class);
    }
}

<?php


namespace App\Repositories;


use App\Entities\Task;
use App\Interfaces\TasksInterface;

class TasksRepository extends BaseRepository implements TasksInterface
{
    public function __construct(Task $model)
    {
        $this->model = $model;
    }
}

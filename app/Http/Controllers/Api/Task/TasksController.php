<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateTaskRequest;
use App\Interfaces\TasksInterface;
use Illuminate\Http\Request;

class TasksController extends Controller
{

    /**
     * @var \App\Interfaces\TasksInterface
     */
    private $tasks;

    /**
     * TasksController constructor.
     *
     * @param \App\Interfaces\TasksInterface $tasks
     */
    public function __construct(TasksInterface $tasks)
    {
        $this->tasks = $tasks;
    }

    public function create(CreateTaskRequest $request)
    {
        return $this->responseOk($this->tasks->create($request->all()));
    }
}

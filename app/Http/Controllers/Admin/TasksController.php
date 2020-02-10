<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

    public function index()
    {
        $tasks = $this->tasks->list();

        return view('admin.tasks.index' , $this->withUserData([
            'tasks' => $tasks,
        ]));
    }
}

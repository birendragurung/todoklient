<?php

namespace App\Http\Controllers\Staff;

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

        return view('staffs.tasks.index', $this->withUserData([
            'tasks' => $tasks
        ]));
    }
}

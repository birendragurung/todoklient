<?php

namespace App\Http\Controllers\Staff;

use App\Constants\AppConstants;
use App\Constants\DBConstants;
use App\Events\TaskCompleted;
use App\Http\Controllers\Controller;
use App\Interfaces\TasksInterface;
use Illuminate\Support\Str;

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
        $tasks = $this->tasks->tasksForUser(auth()->id() );

        return view('staffs.tasks.index', $this->withUserData([
            'tasks' => $tasks
        ]));
    }

    public function updateStatus(int $id)
    {
        $this->tasks->updateById($id, request()->all() );

        return redirect()->back();
    }
}

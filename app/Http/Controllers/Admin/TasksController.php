<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateTaskRequest;
use App\Interfaces\StaffsInterface;
use App\Interfaces\TasksInterface;
use Illuminate\Http\Request;

class TasksController extends Controller
{

    /**
     * @var \App\Interfaces\TasksInterface
     */
    private $tasks;

    /**
     * @var \App\Interfaces\StaffsInterface
     */
    private $staffs;

    /**
     * TasksController constructor.
     *
     * @param \App\Interfaces\TasksInterface $tasks
     * @param \App\Interfaces\StaffsInterface $staffs
     */
    public function __construct(TasksInterface $tasks, StaffsInterface $staffs)
    {
        $this->tasks = $tasks;
        $this->staffs = $staffs;
    }

    public function index()
    {
        $tasks = $this->tasks->listTasks();

        return view('admin.tasks.index' , $this->withUserData([
            'tasks' => $tasks,
        ]));
    }

    public function create()
    {
        return view('admin.tasks.create' , $this->withUserData(['staffs' => $this->staffs->getStaffs()  ]));
    }

    public function store(CreateTaskRequest $request)
    {
        $task = $this->tasks->create($request->all());

        return redirect()->route('admin.manage.tasks.list');
    }
}

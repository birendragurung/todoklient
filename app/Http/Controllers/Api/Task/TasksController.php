<?php

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateTaskRequest;
use App\Http\Requests\Admin\UpdateTaskRequest;
use App\Http\Requests\Task\UpdateTaskAssigneeRequest;
use App\Http\Requests\Task\UpdateTaskStatusRequest;
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

    public function index(Request $request)
    {
        return $this->responseOk($this->tasks->list() );
    }

    public function store(CreateTaskRequest $request)
    {
        return $this->responseOk($this->tasks->create($request->all()));
    }

    public function show(Request $request, int $id)
    {
        return $this->responseOk($this->tasks->findById($id));
    }

    public function update(UpdateTaskRequest $request, int $id)
    {
        return $this->responseOk($this->tasks->updateById($id, $request->all()));
    }

    public function updateStatus(UpdateTaskStatusRequest $request, int $id)
    {
        return $this->responseOk($this->tasks->updateById($id, $request->all()));
    }

    public function updateAssignee(UpdateTaskAssigneeRequest $request, int $id)
    {
        return $this->responseOk($this->tasks->updateById($id, $request->all()));
    }

    public function delete(int $id)
    {
        return $this->responseOk($this->tasks->deleteById($id));
    }

    public function todoList(Request $request)
    {
        return $this->responseOk($this->tasks->getTodoList());
    }
}

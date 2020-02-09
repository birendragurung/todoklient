<?php

namespace App\Http\Controllers\Api\TaskHistory;

use App\Http\Controllers\Controller;
use App\Interfaces\TaskHistoryInterface;
use Illuminate\Http\Request;

class TaskHistoryController extends Controller
{

    /**
     * @var \App\Interfaces\TaskHistoryInterface
     */
    private $taskHistory;

    /**
     * TaskHistoryController constructor.
     *
     * @param \App\Interfaces\TaskHistoryInterface $taskHistory
     */
    public function __construct(TaskHistoryInterface $taskHistory)
    {
        $this->taskHistory = $taskHistory;
    }

    public function index(int $id)
    {
        return $this->responseOk($this->taskHistory->findByTaskId($id));
    }
}

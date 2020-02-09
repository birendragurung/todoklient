<?php


namespace App\Repositories;


use App\Entities\TaskHistory;
use App\Interfaces\TaskHistoryInterface;
use Illuminate\Database\Eloquent\Model;

class TaskHistoryRepository extends BaseRepository implements TaskHistoryInterface
{
    public function __construct(TaskHistory $model)
    {
        parent::__construct($model);
    }

    public function findByTaskId(int $taskId)
    {
        return $this->model->where('task_id' , $taskId)->paginate(15);
    }
}

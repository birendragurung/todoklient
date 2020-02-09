<?php


namespace App\Repositories;


use App\Entities\Task;
use App\Events\TaskAssignedToUser;
use App\Events\TaskAssigneeChanged;
use App\Interfaces\TasksInterface;

class TasksRepository extends BaseRepository implements TasksInterface
{
    public function __construct(Task $model)
    {
        parent::__construct($model);
    }

    public function create(array $attributes)
    {
        $attributes['created_by'] = auth()->id();
        $attributes['updated_by'] = auth()->id();
        $task = parent::create($attributes);

        if ($task->assignee){
            event(new TaskAssignedToUser($task));
        }
        return $task;
    }

    public function updateById(int $id , array $attributes)
    {
        $attributes['updated_by'] = auth()->id();
        $task = $this->findById($id);
        $oldAssignee = $task->assignee;
        if ($oldAssignee != $attributes['assignee']){
            $task->update([
                'assignee'   => $attributes['assignee'] ,
                'updated_by' => auth()->id() ,
            ]);

            event(new TaskAssigneeChanged($task));
        }
        parent::updateById($id , $attributes);

        $task = $this->findById($id);


        return $result;
    }
}

<?php


namespace App\Repositories;


use App\Constants\AppConstants;
use App\Constants\DBConstants;
use App\Entities\Task;
use App\Entities\User;
use App\Events\TaskAssignedToUser;
use App\Events\TaskAssigneeChanged;
use App\Interfaces\TasksInterface;
use Illuminate\Support\Facades\DB;

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
        $task                     = parent::create($attributes);

        if ($task->assignee){
            /* @var User $user */
            $user = auth()->user();
            /* @var \App\Entities\Notification $notification */
            //DB::listen(function($q){
            //    dd($q);
            //});

            $notificationData = [
                'id'          => DB::raw('uuid()') ,
                'title'       => 'A task has been assigned to you' ,
                'type'        => AppConstants::NOTIFICATION_TYPE_TASK_ASSIGNED_TO_USER ,
                'data'        => NULL ,
                'extra'       => NULL ,
                'entity_type' => DBConstants::TASKS ,
                'entity_id'   => $task->id ,
            ];

            $notification = $user->notifications()->create($notificationData);
            event(new TaskAssignedToUser($task , $user , $notification));
        }
        return $task;
    }

    public function updateById(int $id , array $attributes)
    {
        $attributes['updated_by'] = auth()->id();
        /* @var Task $task */
        $task        = $this->findById($id);
        $oldAssignee = $task->assignee;
        if ($attributes['assignee'] != NULL && $oldAssignee != $attributes['assignee']){
            $task->update([
                'assignee'   => $attributes['assignee'] ,
                'updated_by' => auth()->id() ,
            ]);

            /* @var \App\Entities\Notification $notification */
            $notification = $task->assignedUser->notifications()->create([
                'title'       => 'Task' . $task->title . ' has been assigned to you' ,
                'type'        => AppConstants::NOTIFICATION_TYPE_TASK_ASSIGNED_TO_USER ,
                'data'        => NULL ,
                'extra'       => NULL ,
                'entity_type' => DBConstants::TASKS ,
                'entity_id'   => $task->id ,
            ]);

            event(new TaskAssigneeChanged($task , $task->assignedUser , $notification));
        }
        parent::updateById($id , $attributes);

        $task = $this->findById($id);

        return $task;
    }
}

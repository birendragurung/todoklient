<?php


namespace App\Repositories;


use App\Constants\AppConstants;
use App\Constants\DBConstants;
use App\Entities\Task;
use App\Entities\TaskHistory;
use App\Entities\User;
use App\Events\TaskAssignedToUser;
use App\Events\TaskCompleted;
use App\Interfaces\TasksInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

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
        $taskHistories            = [];

        $taskHistories[] = [
            'title'   => auth()->user()->name . ' created a task' ,
            'task_id' => $task->id ,
            'user_id' => auth()->id() ,
            'type'    => AppConstants::TASK_HISTORY_TYPE_NEWLY_CREATED ,
        ];
        if ($task->assignee){
            /* @var User $user */
            $user = auth()->user();
            /* @var \App\Entities\Notification $notification */
            $notificationData = [
                'id'          => Str::uuid() ,
                'title'       => 'A task has been assigned to you' ,
                'type'        => AppConstants::NOTIFICATION_TYPE_TASK_ASSIGNED_TO_USER ,
                'data'        => NULL ,
                'extra'       => NULL ,
                'entity_type' => DBConstants::TASKS ,
                'entity_id'   => $task->id ,
            ];

            $taskHistories[] = [
                'title'   => auth()->user()->name . ' assigned task to ' . $task->assignedUser->name,
                'task_id' => $task->id ,
                'user_id' => auth()->id() ,
                'type'    => AppConstants::TASK_HISTORY_TYPE_ASSIGNED_TO_USER ,
                'data' => [
                    'assignee' => $task->assignee
                ]
            ];

            $notification = $user->notifications()->create($notificationData);
            event(new TaskAssignedToUser($task , $user , $notification));
        }

        foreach ($taskHistories as $taskHistory){
            TaskHistory::create($taskHistory);
        }
        return $task;
    }

    public function updateById(int $id , array $attributes)
    {
        $attributes['updated_by'] = auth()->id();
        /* @var Task $task */
        $task        = $this->findById($id);
        $oldState = $task->state;
        $oldAssignee = $task->assignee;
        $task->fill($attributes)->save() ;
        $taskHistories = [];

        if (isset($attributes['assignee']) && $attributes['assignee'] != NULL && $oldAssignee != $attributes['assignee']){
            /* @var \App\Entities\Notification $notification */
            $notification = $task->assignedUser->notifications()->create([
                'id'          => Str::uuid() ,
                'title'       => 'Task' . $task->title . ' has been assigned to you' ,
                'type'        => AppConstants::NOTIFICATION_TYPE_TASK_ASSIGNED_TO_USER ,
                'data'        => NULL ,
                'extra'       => NULL ,
                'entity_type' => DBConstants::TASKS ,
                'entity_id'   => $task->id ,
            ]);


            $taskHistories[] = [
                'title'   => auth()->user()->name . ' assigned task to ' . $task->assignedUser->name,
                'task_id' => $task->id ,
                'user_id' => auth()->id() ,
                'type'    => AppConstants::TASK_HISTORY_TYPE_ASSIGNED_TO_USER ,
                'data' => [
                    'oldAssignee' => $oldAssignee,
                    'newAssignee' => $attributes['assignee']
                ]
            ];
            event(new TaskAssignedToUser($task , $task->assignedUser , $notification));
        }

        if (isset($attributes['state']) && auth()->id() != $task->created_by && $attributes['state'] != $task->state && $attributes['state'] == AppConstants::TASK_STATE_COMPLETED){
            /* @var \App\Entities\Notification $notification */
            $notification = $task->creator->notifications()->create([
                'id'          => Str::uuid() ,
                'title'       => 'Task has been completed' ,
                'type'        => AppConstants::NOTIFICATION_TYPE_TASK_STATUS_COMPLETED ,
                'data'        => NULL ,
                'extra'       => NULL ,
                'entity_type' => DBConstants::TASKS ,
                'entity_id'   => $task->id ,
            ]);


            $taskHistories[] = [
                'title'   => auth()->user()->name . ' assigned task to ' . $task->assignedUser->name,
                'task_id' => $task->id ,
                'user_id' => auth()->id() ,
                'type'    => AppConstants::TASK_HISTORY_TYPE_ASSIGNED_TO_USER ,
                'data' => [
                    'previous_state' => $oldState ,
                    'new_state' => $attributes['state']
                ]
            ];
            event(new TaskCompleted($task , $task->creator , $notification));
        }

        foreach ($taskHistories as $taskHistory){
            TaskHistory::create($taskHistories);
        }

        return $task;
    }

    public function getTodoList()
    {
        return $this->model->where('assignee' , auth()->id())
            ->where('state' , AppConstants::TASK_STATE_NEW)
            ->paginate(20);
    }

    public function taskCountStatistics()
    {
        $query = $this->model->newQuery();
        $total = $this->model->count();
        $stateCount = $query->selectRaw('count(*) as count, state')
            ->groupBy('state')
            ->get()
            ->reduce(function($carry , $item){
                return $carry += [$item->state=>$item->count];
            }, []) ;

        return [
            'total' => $total,
            'completed_count' => Arr::get($stateCount,AppConstants::TASK_STATE_COMPLETED, 0),
            'new_count' => Arr::get($stateCount,AppConstants::TASK_STATE_NEW, 0),
        ];
    }

    public function updateStateById(int $id , $state)
    {
        $task = $this->model->findOrFail($id);

        $task->update(['state' => $state]);

        return $task;
    }

    public function taskCountStatisticsForStaff($id)
    {
        $query = $this->model->newQuery();
        $total = $this->model->where('assignee' , $id) ->count();
        $stateCount = $query->selectRaw('count(*) as count, state')
            ->groupBy('state')
            ->get()
            ->reduce(function($carry , $item){
                return $carry += [$item->state=>$item->count];
            }, []) ;

        return [
            'total' => $total,
            'completed_count' => Arr::get($stateCount,AppConstants::TASK_STATE_COMPLETED, 0),
            'new_count' => Arr::get($stateCount,AppConstants::TASK_STATE_NEW, 0),
        ];    }

    public function listTasks()
    {
        return $this->model->paginate(15);
    }

    public function tasksForUser(int $id)
    {
        return $this->model->where('assignee' , $id)->paginate();
    }
}

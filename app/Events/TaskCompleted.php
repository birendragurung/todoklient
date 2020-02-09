<?php

namespace App\Events;

use App\Entities\Notification;
use App\Entities\Task;
use App\Entities\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TaskCompleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var \App\Entities\Task
     */
    private $task;

    /**
     * @var \App\Entities\User
     */
    private $user;

    /**
     * @var \App\Entities\Notification
     */
    private $notification;

    /**
     * Create a new event instance.
     *
     * @param \App\Entities\Task $task
     * @param \App\Entities\User $user
     * @param \App\Entities\Notification $notification
     */
    public function __construct(Task $task, User $user, Notification $notification)
    {
        //
        $this->task = $task;
        $this->user = $user;
        $this->notification = $notification;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }

    /**
     * @return \App\Entities\Notification
     */
    public function getNotification(): Notification
    {
        return $this->notification;
    }

    /**
     * @return \App\Entities\Task
     */
    public function getTask(): Task
    {
        return $this->task;
    }

    /**
     * @return \App\Entities\User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}

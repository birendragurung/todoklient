<?php

namespace App\Listeners;

use App\Entities\User;
use App\Events\TaskAssignedToUser;
use App\Notifications\TaskAssignedToUserNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TaskAssignedToUserListener
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param \App\Events\TaskAssignedToUser $event
     *
     * @return void
     */
    public function handle(TaskAssignedToUser $event)
    {
        /* @var User $user */
        $user = $event->getTask()->assignedUser()->first();

        $user->notify(new TaskAssignedToUserNotification($event->getTask(), $event->getNotification() ));
    }
}

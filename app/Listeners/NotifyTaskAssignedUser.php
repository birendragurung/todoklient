<?php

namespace App\Listeners;

use App\Events\TaskAssigneeChanged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyTaskAssignedUser implements ShouldQueue
{
    use InteractsWithQueue;
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
     * @param \App\Events\TaskAssigneeChanged $event
     *
     * @return void
     */
    public function handle(TaskAssigneeChanged $event)
    {

    }
}

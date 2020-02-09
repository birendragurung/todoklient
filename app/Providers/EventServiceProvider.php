<?php

namespace App\Providers;

use App\Events\Staff\NewStaffCreated;
use App\Events\TaskAssignedToUser;
use App\Events\TaskAssigneeChanged;
use App\Events\TaskCompleted;
use App\Events\UserInvitedEvent;
use App\Listeners\NotifyTaskAssignedUser;
use App\Listeners\Staff\SendEmailInvitationToStaff;
use App\Listeners\TaskAssignedToUserListener;
use App\Listeners\TaskCompletedListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UserInvitedEvent::class => [
            SendEmailInvitationToStaff::class
        ] ,
        NewStaffCreated::class => [] ,
        TaskAssigneeChanged::class => [
            NotifyTaskAssignedUser::class
        ],
        TaskAssignedToUser::class => [
            TaskAssignedToUserListener::class,
        ] ,
        TaskCompleted::class => [
            TaskCompletedListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}

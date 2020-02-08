<?php

namespace App\Listeners\Staff;

use App\Events\Staff\NewStaffCreated;
use App\Events\UserInvitedEvent;
use App\Jobs\SendMail;
use App\Mail\StaffInvitationMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailInvitationToStaff
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
     * @param \App\Events\UserInvitedEvent $event
     *
     * @return void
     */
    public function handle(UserInvitedEvent $event)
    {
        $mailable = new StaffInvitationMail($event->getUserInvitation());
        dispatch(new SendMail($mailable));
    }
}

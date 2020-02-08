<?php

namespace App\Events;

use App\Entities\UserInvitation;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserInvitedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var \App\Entities\UserInvitation
     */
    private $userInvitation;

    /**
     * Create a new event instance.
     *
     * @param \App\Entities\UserInvitation $userInvitation
     */
    public function __construct(UserInvitation $userInvitation)
    {
        //
        $this->userInvitation = $userInvitation;
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

    public function getUserInvitation() : UserInvitation
    {
        return $this->userInvitation;
    }
}

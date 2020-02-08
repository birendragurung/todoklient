<?php

namespace App\Mail;

use App\Entities\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminInvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var \App\Entities\User
     */
    private $user;

    /**
     * Create a new message instance.
     *
     * @param \App\Entities\User $user
     */
    public function __construct(User $user)
    {
        //
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('view.name');
    }

    /**
     * @return \App\Entities\User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}

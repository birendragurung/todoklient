<?php

namespace App\Mail;

use App\Entities\User;
use App\Entities\UserInvitation;
use App\Entities\UserInvitation as UserInvitationAlias;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StaffInvitationMail extends Mailable
{

    use Queueable , SerializesModels;

    /**
     * @var \App\Entities\UserInvitation
     */
    private $invitation;

    /**
     * Create a new message instance.
     *
     * @param \App\Entities\UserInvitation $invitation
     */
    public function __construct(UserInvitationAlias $invitation)
    {
        $this->invitation = $invitation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('admin@todoklient.com')
            ->to([$this->invitation->email])
            ->subject('Invitation to TODO app')
            ->view('mail.invitation')
            ->with([
                'invitation' => $this->invitation
            ]) ;
    }

    /**
     * @return \App\Entities\UserInvitation
     */
    public function getUserInvitation(): UserInvitation
    {
        return $this->invitation;
    }
}

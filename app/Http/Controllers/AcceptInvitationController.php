<?php

namespace App\Http\Controllers;

use App\Http\Requests\AcceptInvitationRequest;
use App\Interfaces\UserInvitationInterface;
use App\Interfaces\UsersInterface;
use Illuminate\Http\Request;

class AcceptInvitationController extends Controller
{

    /**
     * @var \App\Interfaces\UserInvitationInterface
     */
    private $userInvitations;

    /**
     * @var \App\Interfaces\UsersInterface
     */
    private $users;

    /**
     * AcceptInvitationController constructor.
     *
     * @param \App\Interfaces\UserInvitationInterface $userInvitations
     * @param \App\Interfaces\UsersInterface $users
     */
    public function __construct(UserInvitationInterface $userInvitations, UsersInterface $users)
    {
        $this->userInvitations = $userInvitations;
        $this->users = $users;
    }

    public function showAcceptForm(Request $request)
    {
        return view('invitation.confirm', [
            'token' => $request->token
        ]);
    }

    public function accept(AcceptInvitationRequest $request)
    {
        $token = $request->token;
        $attributes = $request->all();
        $invitation = $this->userInvitations->findByToken($token);
        $this->users->create([
            'password' => bcrypt($attributes['password']) ,
            'email' => $invitation->email,
            'role' => $invitation->role,
            'name' => $attributes['name']
        ]);

        $this->userInvitations->deleteByEmail($invitation->email);
        return redirect()->route('web-app');
    }
}

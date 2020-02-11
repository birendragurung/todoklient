<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AcceptInvitationRequest;
use App\Http\Requests\Invitation\InviteUserRequest;
use App\Interfaces\UserInvitationInterface;
use App\Interfaces\UsersInterface;
use Illuminate\Http\Request;

class InvitationController extends Controller
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
     * StaffInvitationController constructor.
     *
     * @param \App\Interfaces\UserInvitationInterface $userInvitations
     * @param \App\Interfaces\UsersInterface $users
     */
    public function __construct(UserInvitationInterface $userInvitations, UsersInterface $users)
    {
        $this->userInvitations = $userInvitations;
        $this->users = $users;
    }

    public function invite(InviteUserRequest $request)
    {
        if ($this->users->findByEmail($request->email)){
            session()->flash('message' , 'User already added');
            return redirect()->back()->withInput($request->all() ) ;
        }
        ($this->userInvitations->invite($request->all()));

        return redirect()->route('manage.staffs.index');
    }
}

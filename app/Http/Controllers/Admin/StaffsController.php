<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateStaffRequest;
use App\Interfaces\StaffsInterface;
use App\Interfaces\UserInvitationInterface;
use App\Interfaces\UsersInterface;
use Illuminate\Http\Request;

class StaffsController extends Controller
{

    /**
     * @var \App\Interfaces\UsersInterface
     */
    private $staffs;

    /**
     * @var \App\Interfaces\UsersInterface
     */
    private $users;

    /**
     * @var \App\Interfaces\UserInvitationInterface
     */
    private $userInvitation;

    /**
     * StaffsController constructor.
     *
     * @param \App\Interfaces\StaffsInterface $staffs
     * @param \App\Interfaces\UserInvitationInterface $userInvitation
     */
    public function __construct(StaffsInterface $staffs, UserInvitationInterface $userInvitation)
    {
        $this->staffs = $staffs;
        $this->userInvitation = $userInvitation;
    }

    public function index()
    {

    }

    public function allStaffs()
    {
        $staffs = $this->staffs->getStaffs();
        return view('admin.manage.staffs.index', $this->withUserData([
            'staffs' => $staffs
        ]));
    }

    public function store(CreateStaffRequest $request )
    {
        $this->userInvitation->invite($request->all());

        return redirect()->route('admin.manage.staffs');
    }

    public function delete(int $id)
    {
        $this->staffs->deleteById($id);
        return redirect()->back();
    }

    public function createForm()
    {
        return view('admin.manage.staffs.create', $this->withUserData([]));
    }
}

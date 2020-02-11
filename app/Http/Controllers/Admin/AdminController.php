<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateStaffRequest;
use App\Interfaces\UsersInterface;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    /**
     * @var \App\Interfaces\UsersInterface
     */
    private $users;

    /**
     * AdminController constructor.
     *
     * @param \App\Interfaces\UsersInterface $users
     */
    public function __construct(UsersInterface $users)
    {
        $this->users = $users;
    }

    public function allAdmins()
    {
        $staffs = $this->users->listAdmins();
        return view('admin.manage.staffs.index', $this->withUserData([
            'staffs' => $staffs
        ]));
    }

    public function store(CreateStaffRequest $request )
    {
        $staff = $this->users->create($request->all());

        return redirect()->route('admin.manage.staffs');
    }

    public function delete(int $id)
    {
        $this->users->deleteById($id);
        return redirect()->back();
    }
}

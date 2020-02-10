<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateStaffRequest;
use App\Interfaces\StaffsInterface;
use App\Interfaces\UsersInterface;
use Illuminate\Http\Request;

class StaffsController extends Controller
{

    /**
     * @var \App\Interfaces\UsersInterface
     */
    private $users;

    /**
     * StaffsController constructor.
     *
     * @param \App\Interfaces\StaffsInterface $users
     */
    public function __construct(StaffsInterface $users)
    {
        $this->users = $users;
    }

    public function index()
    {

    }

    public function store(CreateStaffRequest $request )
    {
        $staff = $this->users->create($request->all());

        return redirect()->route('admin.manage.staffs');
    }
}

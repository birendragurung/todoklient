<?php

namespace App\Http\Controllers;

use App\Interfaces\UsersInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * @var \App\Interfaces\UsersInterface
     */
    private $users;

    public function __construct(UsersInterface $users)
    {
        $this->users = $users;
    }

    public function index()
    {
        return $this->users->all();
    }
}

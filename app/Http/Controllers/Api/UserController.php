<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

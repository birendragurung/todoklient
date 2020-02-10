<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\NotificationsInterface;
use App\Interfaces\TasksInterface;
use App\Interfaces\UsersInterface;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    /**
     * @var \App\Interfaces\TasksInterface
     */
    private $tasks;

    /**
     * @var \App\Interfaces\UsersInterface
     */
    private $users;

    /**
     * @var \App\Interfaces\NotificationsInterface
     */
    private $notifications;

    /**
     * DashboardController constructor.
     *
     * @param \App\Interfaces\TasksInterface $tasks
     * @param \App\Interfaces\UsersInterface $users
     * @param \App\Interfaces\NotificationsInterface $notifications
     */
    public function __construct(TasksInterface $tasks , UsersInterface $users , NotificationsInterface $notifications)
    {
        $this->tasks         = $tasks;
        $this->users         = $users;
        $this->notifications = $notifications;
    }

    public function index()
    {
        $taskData                                = $this->tasks->taskCountStatistics();
        $totalStaffs = $this->users->countStaff();
        return view('home' , $this->withUserData([
            'taskData'         => $taskData ,
            'totalStaffs' => $totalStaffs
        ]));
    }
}

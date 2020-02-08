<?php

namespace App\Http\Controllers\Api\Notification;

use App\Http\Controllers\Controller;
use App\Http\Requests\Notification\UpdateSeenStatusRequest;
use App\Interfaces\NotificationsInterface;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{

    /**
     * @var \App\Interfaces\NotificationsInterface
     */
    private $notifications;

    /**
     * NotificationsController constructor.
     *
     * @param \App\Interfaces\NotificationsInterface $notifications
     */
    public function __construct(NotificationsInterface $notifications)
    {
        $this->notifications = $notifications;
    }

    public function index()
    {
        return $this->responseOk($this->notifications->listForUser(auth()->id()));
    }

    public function show(Request $request, int $id)
    {
        return $this->responseOk($this->notifications->findById($id));
    }

    public function seen(UpdateSeenStatusRequest $request, int $id)
    {
        return $this->responseOk($this->notifications->updateSeedById($id , $request->all()));
    }
}

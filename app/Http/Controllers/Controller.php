<?php

namespace App\Http\Controllers;

use App\Interfaces\NotificationsInterface;
use App\Traits\ApiResponser;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    use ApiResponser;

    public function withUserData(array $data)
    {
        $notificationRepo = app(NotificationsInterface::class);
        $authUser                                = auth()->user();
        $unreadNotficationCount                  = $notificationRepo->unreadCount($authUser->id);
        $notificationData['total']               = $notificationRepo->totalForUser($authUser->id);
        $notificationData['unreadCount']         = $unreadNotficationCount;
        $notificationData['latestNotifications'] = $notificationRepo->list();

        $adminData = [
            'authUser' => auth()->user() ,
            'notificationData' => $notificationData ,
        ];
        return $adminData += $data;
    }
}

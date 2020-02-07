<?php


namespace App\Constants;


class AppConstants
{

    const TASK_STATE_NEW = "new";

    const TASK_STATE_COMPLETED = "completed";

    const TASK_STATE_IN_PROGRESS = "in_progress";

    const TASK_STATES = [
        self::TASK_STATE_COMPLETED ,
        self::TASK_STATE_NEW ,
        self::TASK_STATE_IN_PROGRESS ,
    ];
}

<?php


namespace App\Repositories;


use App\Interfaces\NotificationsInterface;
use Illuminate\Database\Eloquent\Model;

class NotificationsRepository extends BaseRepository implements NotificationsInterface
{
    public function __construct(Model $model)
    {
        parent::__construct($model);
    }
}

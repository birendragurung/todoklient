<?php


namespace App\Repositories;


use App\Entities\Notification;
use App\Interfaces\NotificationsInterface;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class NotificationsRepository extends BaseRepository implements NotificationsInterface
{

    public function __construct(Notification $model)
    {
        parent::__construct($model);
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function updateSeedById(int $id , array $attributes)
    {
        $notification = $this->findById($id);

        if (!auth()->id() == $notification->id){
            throw new UnauthorizedHttpException();
        }
        $notification->update(['seen' => $attributes['seen']]);

        return $notification;
    }
}

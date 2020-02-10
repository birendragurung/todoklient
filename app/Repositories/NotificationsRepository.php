<?php


namespace App\Repositories;


use App\Entities\Notification;
use App\Interfaces\NotificationsInterface;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use function GuzzleHttp\Promise\task;

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

    public function listForUser(int $id)
    {
        return $this->model->where('user_id' , $id)->orderByDesc('id')->paginate(15);
    }

    public function findById(int $id)
    {
        return $this->model->where('user_id' , auth()->id())
            ->where('id' , $id)
            ->firstOrFail();
    }

    public function unreadCount(int $id)
    {
        return $this->model->whereNull('read_at')->where('user_id' , $id)->count();
    }

    public function totalForUser($id)
    {
        return $this->model->where('user_id' , $id)->count();
    }
}

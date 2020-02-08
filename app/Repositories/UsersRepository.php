<?php


namespace App\Repositories;


use App\Entities\User;
use App\Interfaces\UsersInterface;

class UsersRepository extends BaseRepository implements UsersInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function all()
    {
        return $this->model->all();
    }

    public function findByEmail(string $email)
    {
        return $this->model->where('email' , $email)->first();
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }
}

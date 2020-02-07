<?php


namespace App\Repositories;


use App\Entities\User;
use App\Interfaces\UsersInterface;
use Illuminate\Database\Eloquent\Model;

class UsersRepository extends BaseRepository implements UsersInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}

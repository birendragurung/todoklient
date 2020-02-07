<?php


namespace App\Repositories;


use App\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements RepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create(array $attributes)
    {
        // TODO: Implement create() method.
    }

    public function delete(int $id)
    {
        // TODO: Implement delete() method.
    }

    public function findById(int $id)
    {
        // TODO: Implement findById() method.
    }

    public function update(int $id , array $attributes)
    {
        // TODO: Implement update() method.
    }
}

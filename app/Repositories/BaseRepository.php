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

    public function list(array $params = [])
    {
        return $this->model->get();
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function deleteById(int $id)
    {
        return $this->model->where('id' , $id)->delete();
    }

    public function findById(int $id)
    {
        return $this->model->find($id);
    }

    public function updateById(int $id , array $attributes)
    {
        return $this->model->where('id' , $id)->update($attributes);
    }

    public function updateBy(array $conditions, array $attributes)
    {
        return $this->model->where($conditions)->update($attributes);
    }
}

<?php


namespace App\Repositories;


use App\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements RepositoryInterface
{
    protected $model;

    const DEFAULT_SORT_FIELD = 'id';

    const DEFAULT_SORT_ORDER = 'DESC';

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function list(array $params = [], array $attributes = [] , array $options = [])
    {
        return $this->model->orderByDesc(self::DEFAULT_SORT_FIELD)->get();
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

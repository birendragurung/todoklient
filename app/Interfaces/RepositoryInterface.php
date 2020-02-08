<?php


namespace App\Interfaces;


interface RepositoryInterface
{

    public function create(array $attributes);

    public function deleteById(int $id);

    public function findById(int $id);

    public function updateById(int $id , array $attributes);

    public function updateBy(array $conditions , array $attributes);
}

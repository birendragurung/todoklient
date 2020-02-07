<?php


namespace App\Interfaces;


interface RepositoryInterface
{

    public function create(array $attributes);

    public function delete(int $id);

    public function findById(int $id);

    public function update(int $id , array $attributes);
}

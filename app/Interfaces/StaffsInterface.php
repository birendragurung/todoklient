<?php


namespace App\Interfaces;


use App\Interfaces\RepositoryInterface;

interface StaffsInterface extends RepositoryInterface
{

    public function create(array $attributes);

    public function getStaffs();

    public function findByEmail(string $email);
}

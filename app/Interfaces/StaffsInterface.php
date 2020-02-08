<?php


namespace App\Interfaces;


interface StaffsInterface extends RepositoryInterface
{

    public function create(array $attributes);

    public function getStaffs();

    public function findByEmail(string $email);
}

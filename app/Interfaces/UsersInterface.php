<?php


namespace App\Interfaces;


interface UsersInterface extends RepositoryInterface
{

	public function all();

    public function findByEmail(string $email);

	public function countStaff();
}

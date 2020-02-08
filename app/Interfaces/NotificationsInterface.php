<?php


namespace App\Interfaces;


interface NotificationsInterface extends RepositoryInterface
{

    public function listForUser(int $id);
    public function updateSeedById(int $id , array $attributes);
}

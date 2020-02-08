<?php


namespace App\Interfaces;


interface NotificationsInterface extends RepositoryInterface
{

    public function updateSeedById(int $id , array $attributes);
}

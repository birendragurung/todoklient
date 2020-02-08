<?php


namespace App\Interfaces;


interface UserInvitationInterface extends RepositoryInterface
{

    public function invite(array $attributes);

    public function findByToken(string $token);

    public function deleteByEmail(string $email);
}

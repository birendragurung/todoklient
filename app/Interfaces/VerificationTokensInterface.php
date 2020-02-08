<?php


namespace App\Interfaces;


interface VerificationTokensInterface extends RepositoryInterface
{

    public function createUniqueToken();
}

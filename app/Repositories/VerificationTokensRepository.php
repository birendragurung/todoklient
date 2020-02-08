<?php


namespace App\Repositories;


use App\Entities\User;
use App\Entities\VerificationToken;
use App\Interfaces\VerificationTokensInterface;
use Illuminate\Support\Str;

class VerificationTokensRepository extends BaseRepository implements VerificationTokensInterface
{
    public function __construct(VerificationToken $model)
    {
        parent::__construct($model);
    }

    public function createUniqueToken()
    {
        do {
            $token = hash_hmac('sha256', Str::random(40), 'secret');
        } while ($this->model->where('token', $token)->first() !== null);
        return $token;
    }

    public function createInvitationToken(User $user)
    {
        return $this->model->create(
            [
                'type' => 'staff_invitation',
                'email' => $user->email,
                'token' => $this->createUniqueToken() ,
            ]
        ) ;
    }
}

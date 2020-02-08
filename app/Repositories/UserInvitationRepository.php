<?php


namespace App\Repositories;


use App\Entities\UserInvitation;
use App\Events\UserInvitedEvent;
use App\Interfaces\UserInvitationInterface;
use Illuminate\Support\Str;

class UserInvitationRepository extends BaseRepository implements UserInvitationInterface
{
    public function __construct(UserInvitation $model)
    {
        parent::__construct($model);
    }

    public function invite(array $attributes)
    {
        $invitation =  $this->model->create([
            'email' => $attributes['email'],
            'role' => $attributes['role'] ,
            'token' => $this->createUniqueToken(),
            'expiry_date' => now()->addDays(7) ,
        ]);

        event(new UserInvitedEvent($invitation));

        return $attributes;
    }

    public function createUniqueToken()
    {
        do {
            $token = hash_hmac('sha256', Str::random(40), 'secret');
        } while ($this->model->where('token', $token)->first() !== null);
        return $token;
    }

    public function findByToken(string $token)
    {
        $invitation = $this->model->where('token' , $token)
            ->where('expiry_date' , '>=' , now())->firstOrFail() ;
        return $invitation;
    }

    public function deleteByEmail(string $email)
    {
        return $this->model->where('email' , $email)->delete();
    }
}

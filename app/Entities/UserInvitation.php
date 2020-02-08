<?php

namespace App\Entities;

use App\Constants\DBConstants;
use Illuminate\Database\Eloquent\Model;

class UserInvitation extends BaseModel
{
    protected $table = DBConstants::USER_INVITATIONS;

    protected $fillable = ['role' , 'email' ,'token' , 'expiry_date'];
}

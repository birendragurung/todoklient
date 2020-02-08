<?php

namespace App\Entities;

use App\Constants\DBTables;
use Illuminate\Database\Eloquent\Model;

class UserInvitation extends Model
{
    protected $table = DBTables::USER_INVITATIONS;

    protected $fillable = ['role' , 'email' ,'token' , 'expiry_date'];
}

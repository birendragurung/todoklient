<?php

namespace App\Entities;

use App\Constants\DBConstants;
use Illuminate\Database\Eloquent\Model;

class VerificationToken extends Model
{
    protected $table = DBConstants::VERIFICATION_TOKEN;
}

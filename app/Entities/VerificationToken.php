<?php

namespace App\Entities;

use App\Constants\DBConstants;
use Illuminate\Database\Eloquent\Model;

class VerificationToken extends BaseModel
{
    protected $table = DBConstants::VERIFICATION_TOKEN;
}

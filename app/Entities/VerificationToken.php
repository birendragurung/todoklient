<?php

namespace App\Entities;

use App\Constants\DBTables;
use Illuminate\Database\Eloquent\Model;

class VerificationToken extends Model
{
    protected $table = DBTables::VERIFICATION_TOKEN;
}

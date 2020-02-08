<?php

namespace App\Entities;

use App\Constants\DBConstants;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    protected $table = DBConstants::TASKS;

    protected $connection = 'todo_db';
}

<?php

namespace App\Entities;

use App\DBTables;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    protected $table = DBTables::TASKS;

    protected $connection = 'todo_db';
}

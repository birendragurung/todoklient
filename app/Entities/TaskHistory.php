<?php

namespace App\Entities;

use App\Constants\DBConstants;
use Illuminate\Database\Eloquent\Model;

class TaskHistory extends Model
{

    protected $table = DBConstants::TABLE_TASK_HISTORIES;

    protected $connection = 'todo_db';

    protected $fillable = ['task_id' , 'title' , 'user_id' , 'type' , 'data' ,'extra'];

    protected $casts = [
        'data'  => 'array' ,
        'extra' => 'array' ,
    ];
}

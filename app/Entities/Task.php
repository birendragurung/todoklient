<?php

namespace App\Entities;

use App\Constants\DBConstants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends BaseModel
{

    protected $table = DBConstants::TASKS;

    protected $connection = 'todo_db';

    protected $fillable = ['title' , 'description' , 'state' , 'assignee', 'created_by' , 'updated_by'];

    /*
     * Model relations
     * */
    public function assignedUser(): BelongsTo
    {
        return $this->belongsTo(User::class , 'assignee' , 'id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class , 'created_by' , 'id');
    }
}

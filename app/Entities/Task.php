<?php

namespace App\Entities;

use App\Constants\DBConstants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
        $foreignKey = 'assignee';
        $ownerKey = 'id';
        $relation = 'assignedUser';

        $instance = tap(new User(), function (Model $instance) {
            if (! $instance->getConnectionName()) {
                $instance->setConnection($instance->connection );
            }
        });

        return $this->newBelongsTo(
            $instance->newQuery(), $this, $foreignKey, $ownerKey, $relation
        );
    }

    public function creator(): BelongsTo
    {
        $foreignKey = 'created_by';
        $ownerKey = 'id';
        $relation = 'creator';

        $instance = tap(new User(), function (Model $instance) {
            if (! $instance->getConnectionName()) {
                $instance->setConnection($instance->connection );
            }
        });

        return $this->newBelongsTo(
            $instance->newQuery(), $this, $foreignKey, $ownerKey, $relation
        );
    }
}

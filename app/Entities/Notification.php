<?php

namespace App\Entities;

use App\Constants\DBConstants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\DatabaseNotification;

class Notification extends DatabaseNotification
{

    protected $table = DBConstants::NOTIFICATIONS;

    protected $fillable = ['id', 'title' , 'description' , 'type' , 'user_id' , 'seen' , 'extra', 'entity_type', 'entity_id' ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'array',
        'read_at' => 'datetime',
        'extra' => 'array'
    ];

    /*
     * Model relations
     * */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class , 'user_id' , 'id');
    }
}

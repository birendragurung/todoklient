<?php

namespace App\Entities;

use App\Constants\DBConstants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{

    protected $table = DBConstants::NOTIFICATIONS;

    protected $fillable = ['title' , 'description' , 'type' , 'user_id' , 'seen' , 'extra'];

    /*
     * Model relations
     * */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class , 'user_id' , 'id');
    }
}

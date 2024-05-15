<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Chat model
 */
class Chat extends Model
{
    use HasFactory;
    /**
     * Attributes that can be mass assigned
     *
     * @var string[]
     */
    protected $fillable = [
      "user1_id", "user2_id", "unread"
    ];

    /**
     * Receives all messages associated with this chat room
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class, 'chat_id');
    }

    /**
     * Gets the first user associated with this chat room
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user1()
    {
        return $this->belongsTo(User::class, 'user1_id');
    }

    /**
     * Gets the second user associated with this chat room
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user2()
    {
        return $this->belongsTo(User::class, 'user2_id');
    }
}

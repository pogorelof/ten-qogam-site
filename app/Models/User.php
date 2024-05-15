<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * User model
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'photo_path',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Gets the verification code associated with the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function verification_code()
    {
        return $this->hasOne(VerificationCode::class);
    }

    /**
     * Gets all the ads posted by the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ad()
    {
        return $this->hasMany(Ad::class);
    }

    /**
     * Gets the ads added to favorites by the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function favorite_ads()
    {
        return $this->belongsToMany(Ad::class, 'favorites', 'user_id', 'ad_id');
    }

    /**
     * Receives chats in which the user is participating
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function chats()
    {
        return $this->belongsToMany(Chat::class, "chats", "user1_id", "user2_id");
    }

    /**
     * Receives messages sent by the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    /**
     * Receives messages received by the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'recipient_id');
    }
}

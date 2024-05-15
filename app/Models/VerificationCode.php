<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Verification code model
 */
class VerificationCode extends Model
{
    use HasFactory;
    /**
     * Attributes that can be mass assigned
     *
     * @var string[]
     */
    protected $fillable = ['user_id', 'code'];

    /**
     * Gets the user associated with the given verification code
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

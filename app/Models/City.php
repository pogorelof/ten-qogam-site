<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * City model
 */
class City extends Model
{
    use HasFactory;
    /**
     * Attributes that can be mass assigned
     *
     * @var string[]
     */
    protected $fillable = ['name'];

    /**
     * Gets the ads associated with the given city
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ad()
    {
        return $this->hasOne(Ad::class);
    }
}

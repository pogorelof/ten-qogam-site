<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Category model
 */
class Category extends Model
{
    use HasFactory;
    /**
     * Attributes that can be mass assigned
     *
     * @var string[]
     */
    protected $fillable = ['name', 'photo_path'];

    /**
     * Gets the ads associated with the given category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ad()
    {
        return $this->hasOne(Ad::class);
    }
}

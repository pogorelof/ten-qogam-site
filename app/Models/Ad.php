<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Ad model
 */
class Ad extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Attributes that can be mass assigned
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id', 'category_id', 'title', 'description',
        'phone_number', 'photo_path', 'price', 'status',
        'city_id'
    ];
    /**
     * Attributes that should be converted to Carbon instances
     *
     * @var string[]
     */
    protected $dates = ['deleted_at'];

    /**
     * Gets the category of this ad
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Gets the user who posted this ad
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Gets the city in which this ad is placed
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Gets the users who have added this ad to their favorites
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function user_favorited()
    {
        return $this->belongsToMany(User::class, 'favorites', 'ad_id', 'user_id');
    }
}

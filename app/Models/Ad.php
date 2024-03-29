<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ad extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id', 'category_id', 'title', 'description',
        'phone_number', 'photo_path', 'price', 'status',
        'city_id'
    ];
    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function user_favorited()
    {
        return $this->belongsToMany(User::class, 'favorites', 'ad_id', 'user_id');
    }
}

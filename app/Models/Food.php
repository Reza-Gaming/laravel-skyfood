<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Review;

class Food extends Model
{
    protected $fillable = [
        'nama', 'deskripsi', 'harga', 'gambar', 'category_id'
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }

    public function getReviewsCountAttribute()
    {
        return $this->reviews()->count();
    }

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }
}

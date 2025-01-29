<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $appends = ['product_image_url'];

    protected $fillable = [
        'title',
        'description',
        'price',
        'status',
        'image'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    public function getProductImageUrlAttribute()
    {
        if ($this->product_image) {
            return asset('storage/' . $this->product_image);
        } else {
            return asset('images/users/defualt_user.jpg');
        }
    }
}

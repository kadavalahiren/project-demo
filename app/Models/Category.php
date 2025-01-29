<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $appends = ['category_image_url'];

    public function getCategoryImageUrlAttribute()
    {
        if ($this->category_image) {
            return asset('storage/' . $this->category_image);
        } else {
            return asset('images/users/defualt_user.jpg');
        }
    }
}

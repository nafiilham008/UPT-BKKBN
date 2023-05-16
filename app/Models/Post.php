<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    
    public function categories()
    {
        return $this->hasOne(Category::class, 'id', 'categories_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function galleries()
    {
        return $this->hasOne(Gallery::class, 'post_id', 'id');
    }
}

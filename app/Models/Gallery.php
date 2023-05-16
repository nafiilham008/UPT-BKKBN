<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function posts()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

    public function categories()
    {
        return $this->hasOne(Category::class, 'id');
    }
}

<?php

namespace App\Models\Remaja;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailUser extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function userRemaja()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }
}

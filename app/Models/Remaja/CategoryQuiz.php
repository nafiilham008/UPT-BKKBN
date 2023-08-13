<?php

namespace App\Models\Remaja;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryQuiz extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function quiz()
    {
        return $this->hasMany(Quiz::class, 'id', 'category_quiz_id');
    }
}

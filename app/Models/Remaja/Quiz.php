<?php

namespace App\Models\Remaja;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'quiz_id', 'id');
    }

    public function category_quiz()
    {
        return $this->belongsTo(CategoryQuiz::class, 'category_quiz_id', 'id');
    }
}

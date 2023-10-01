<?php

namespace App\Models;

use App\Models\Remaja\DetailUser;
use App\Models\Remaja\Question;
use App\Models\Remaja\Ranking;
use App\Models\Remaja\ResultQuiz;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, TwoFactorAuthenticatable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'verification_code',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'verification_code',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime:d/m/Y H:i',
        'created_at' => 'datetime:d/m/Y H:i',
        'updated_at' => 'datetime:d/m/Y H:i',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'id', 'user_id');
    }

    public function detailUser()
    {
        return $this->hasOne(DetailUser::class, 'id', 'user_id');
    }

    public function quiz()
    {
        return $this->hasMany(Post::class, 'id', 'user_id');
    }

    public function question()
    {
        return $this->hasMany(Question::class, 'id', 'user_id');
    }

    public function results() {
        return $this->hasMany(ResultQuiz::class, 'user_id', 'id');
    }

    public function ranking() {
        return $this->hasOne(Ranking::class, 'user_id', 'id');
    }

}

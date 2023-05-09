<?php

namespace App\Models\Profile;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationHistory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function employees()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}

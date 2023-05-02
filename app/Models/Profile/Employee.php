<?php

namespace App\Models\Profile;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function educationHistories()
    {
        return $this->hasMany(EducationHistory::class);
    }

    public function employeeHistories()
    {
        return $this->hasMany(EmployeeHistory::class);
    }
}

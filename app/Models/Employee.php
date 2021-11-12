<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employee';
    protected $fillable = [
        'name',
        'address',
        'gender',
        'role_id',
        'birth_date',
        'birth_place',
        'phone',
        'email',
        'password',
        'token',
    ];
}

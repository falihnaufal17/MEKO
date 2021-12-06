<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu';
    protected $fillable = [
        'name', 
        'status_stock', 
        'status', 
        'price', 
        'image', 
        'reason', 
        'created_by', 
        'updated_by',
        'approved_by',
        'approved_at',
        'rejected_by',
        'rejected_at',
        'category_id',
        'description'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'condition',
        'price',
        'image',
        'owner_name',
        'publish',
        'owner_phone',
        'owner_address'
    ];
}

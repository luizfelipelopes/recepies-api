<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Recipie extends Model
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'title',
        'image',
        'ingredients',
        'instructions',
        'category',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikePage extends Model
{
    use HasFactory;

    protected $table = 'like_page';
    protected $fillable = [
        'user_id',
        'house_id',
    ];
}

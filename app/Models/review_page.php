<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class review_page extends Model
{
    use HasFactory;

    protected $table = 'review_page';
    protected $fillable = [
        'review_rating',
        'review_comment',
        'user',
        'house_id',
    ];
}

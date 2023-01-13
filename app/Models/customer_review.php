<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer_review extends Model
{
    use HasFactory;

    protected $table = 'customer_review';
    protected $fillable = [
        'review_rating',
        'review_comment',
        'user',
        'house_id',
    ];
}

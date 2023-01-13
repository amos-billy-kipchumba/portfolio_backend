<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fifty extends Model
{
    use HasFactory;
    protected $table = 'fifty';
    protected $fillable = [
        'max_no_of_guests',
        'number_of_bedrooms',
        'number_of_beds',
        'number_of_bathtubs',
        'user_id',
        'house_id',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseDetails extends Model
{
    use HasFactory;
    protected $table = 'house_details';
    protected $fillable = [
        'cover',
        'title',
        'description',
        'location',
        'user_id',
        'price',
        'house_type',
    ];
}

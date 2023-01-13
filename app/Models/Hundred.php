<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hundred extends Model
{
    use HasFactory;
    protected $table = 'hundred';
    protected $fillable = [
        'sitting_room',
        'dinning_room',
        'kitchen',
        'bathroom',
        'bedroom',
        'swimming_pool',
        'lake',
        'beach',
        'ocean_view',
        'balcony',
        'parking',
        'front',
        'right',
        'left',
        'back',
        'aerial',
        'user',
        'house_id',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeventyFive extends Model
{
    use HasFactory;
    protected $table = 'seventy_five';
    protected $fillable = [
        'bathtub',
        'hair_drier',
        'washer',
        'drier',
        'iron',
        'tv',
        'air_condition',
        'heating',
        'wifi',
        'refrigeration',
        'microwave',
        'dishes_silverware',
        'kitchen',
        'blender',
        'coffee_maker',
        'fire_extinguisher',
        'bread_toaster',
        'patio_balcony',
        'backyard',
        'outdoor_grill',
        'beach_essential',
        'Pool',
        'Parking',
        'long_term',
        'private_entrance',
        'user',
        'essentials',
        'house_id',

        'oven',
        'cinema',
        'children_play',
        'farm',
        'ranch',
        'office_equipment',
        'shower',
        'beach_front',
        'games_court',
        'chef',
        'shopping',
        'toilet',

        'baby_cot',
        'mini_bar',
    ];
}

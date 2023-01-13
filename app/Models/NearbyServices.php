<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NearbyServices extends Model
{
    use HasFactory;

    protected $table = 'nearby_services';
    protected $fillable = [
        'butchery',
        'butchery_distance',
        'mini_mart',
        'mini_mart_distance',
        'supermarket',
        'supermarket_distance',
        'grocery_store',
        'grocery_store_distance',
        'spice_mart',
        'spice_mart_distance',
        'maasai_market',
        'maasai_market_distance',
        'cake_baker',
        'cake_baker_distance',
        'tent_hire',
        'tent_hire_distance',
        'event_planner',
        'event_planner_distance',
        'organic_farm',
        'organic_farm_distance',
        'ranch',
        'ranch_distance',
        'aqua_farm',
        'aqua_farm_distance',
        'chemist',
        'chemist_distance',
        'bookshop',
        'bookshop_distance',
        'library',
        'library_distance',
        'chef',
        'chef_distance',
        'pizza_inn',
        'pizza_inn_distance',
        'creamy_inn',
        'creamy_inn_distance',
        'kfc',
        'kfc_distance',
        'petrol_station',
        'petrol_station_distance',
        'java',
        'java_distance',
        'hotel',
        'hotel_distance',
        'salon',
        'salon_distance',
        'barber',
        'barber_distance',
        'user_id',
        'house_id',

    ];
}

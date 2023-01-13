<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NearbyServices;

class NearbyServicesController extends Controller
{
    //
    public function storeNearbyServices(Request $request)
    {
        $NearbyServices = new NearbyServices;
        $NearbyServices->butchery = $request->input('butchery');
        $NearbyServices->butchery_distance = $request->input('butchery_distance');
        $NearbyServices->mini_mart = $request->input('mini_mart');
        $NearbyServices->mini_mart_distance = $request->input('mini_mart_distance');
        $NearbyServices->supermarket = $request->input('supermarket');
        $NearbyServices->supermarket_distance = $request->input('supermarket_distance');
        $NearbyServices->grocery_store = $request->input('grocery_store');
        $NearbyServices->grocery_store_distance = $request->input('grocery_store_distance');
        $NearbyServices->spice_mart = $request->input('spice_mart');
        $NearbyServices->spice_mart_distance = $request->input('spice_mart_distance');
        $NearbyServices->maasai_market = $request->input('maasai_market');
        $NearbyServices->maasai_market_distance = $request->input('maasai_market_distance');
        $NearbyServices->cake_baker = $request->input('cake_baker');
        $NearbyServices->cake_baker_distance = $request->input('cake_baker_distance');
        $NearbyServices->tent_hire = $request->input('tent_hire');
        $NearbyServices->tent_hire_distance = $request->input('tent_hire_distance');
        $NearbyServices->event_planner = $request->input('event_planner');
        $NearbyServices->event_planner_distance = $request->input('event_planner_distance');
        $NearbyServices->organic_farm = $request->input('organic_farm');
        $NearbyServices->organic_farm_distance = $request->input('organic_farm_distance');
        $NearbyServices->ranch = $request->input('ranch');
        $NearbyServices->ranch_distance = $request->input('ranch_distance');
        $NearbyServices->aqua_farm = $request->input('aqua_farm');
        $NearbyServices->aqua_farm_distance = $request->input('aqua_farm_distance');
        $NearbyServices->chemist = $request->input('chemist');
        $NearbyServices->chemist_distance = $request->input('chemist_distance');

        $NearbyServices->bookshop = $request->input('bookshop');
        $NearbyServices->bookshop_distance = $request->input('bookshop_distance');
        $NearbyServices->library = $request->input('library');
        $NearbyServices->library_distance = $request->input('library_distance');
        $NearbyServices->chef = $request->input('chef');
        $NearbyServices->chef_distance = $request->input('chef_distance');
        $NearbyServices->pizza_inn = $request->input('pizza_inn');
        $NearbyServices->pizza_inn_distance = $request->input('pizza_inn_distance');
        $NearbyServices->creamy_inn = $request->input('creamy_inn');
        $NearbyServices->creamy_inn_distance = $request->input('creamy_inn_distance');
        $NearbyServices->kfc = $request->input('kfc');
        $NearbyServices->kfc_distance = $request->input('kfc_distance');

        $NearbyServices->petrol_station = $request->input('petrol_station');
        $NearbyServices->petrol_station_distance = $request->input('petrol_station_distance');
        $NearbyServices->java = $request->input('java');
        $NearbyServices->java_distance = $request->input('java_distance');
        $NearbyServices->hotel = $request->input('hotel');
        $NearbyServices->hotel_distance = $request->input('hotel_distance');
        $NearbyServices->salon = $request->input('salon');
        $NearbyServices->salon_distance = $request->input('salon_distance');

        $NearbyServices->barber = $request->input('barber');
        $NearbyServices->barber_distance = $request->input('barber_distance');

        $NearbyServices->user_id = $request->input('user_id');
        $NearbyServices->house_id = $request->input('house_id');
        $NearbyServices->save();

        return response()->json([
            'status'=> 200,
            'message'=> 'House details added Successfully',
        ]);
    }

    public function getNearbyServices($house_id)
    {
        $NearbyServices = new NearbyServices;
        $NearbyServices = NearbyServices::where('house_id', '=', $house_id)->get();
        if($NearbyServices)
        {
            return response()->json([
                'status'=> 200,
                'NearbyServices'=>$NearbyServices
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message'=> 'No record with such id found!',
            ]);
        }
    }

    public function updateNearbyServices(Request $request, $house_id)
    {

        $NearbyServices = NearbyServices::where('house_id', '=', $house_id)->first();

        if($NearbyServices)
        {
        $NearbyServices->butchery = $request->input('butchery');
        $NearbyServices->butchery_distance = $request->input('butchery_distance');
        $NearbyServices->mini_mart = $request->input('mini_mart');
        $NearbyServices->mini_mart_distance = $request->input('mini_mart_distance');
        $NearbyServices->supermarket = $request->input('supermarket');
        $NearbyServices->supermarket_distance = $request->input('supermarket_distance');
        $NearbyServices->grocery_store = $request->input('grocery_store');
        $NearbyServices->grocery_store_distance = $request->input('grocery_store_distance');
        $NearbyServices->spice_mart = $request->input('spice_mart');
        $NearbyServices->spice_mart_distance = $request->input('spice_mart_distance');
        $NearbyServices->maasai_market = $request->input('maasai_market');
        $NearbyServices->maasai_market_distance = $request->input('maasai_market_distance');
        $NearbyServices->cake_baker = $request->input('cake_baker');
        $NearbyServices->cake_baker_distance = $request->input('cake_baker_distance');
        $NearbyServices->tent_hire = $request->input('tent_hire');
        $NearbyServices->tent_hire_distance = $request->input('tent_hire_distance');
        $NearbyServices->event_planner = $request->input('event_planner');
        $NearbyServices->event_planner_distance = $request->input('event_planner_distance');
        $NearbyServices->organic_farm = $request->input('organic_farm');
        $NearbyServices->organic_farm_distance = $request->input('organic_farm_distance');
        $NearbyServices->ranch = $request->input('ranch');
        $NearbyServices->ranch_distance = $request->input('ranch_distance');
        $NearbyServices->aqua_farm = $request->input('aqua_farm');
        $NearbyServices->aqua_farm_distance = $request->input('aqua_farm_distance');
        $NearbyServices->chemist = $request->input('chemist');
        $NearbyServices->chemist_distance = $request->input('chemist_distance');

        $NearbyServices->bookshop = $request->input('bookshop');
        $NearbyServices->bookshop_distance = $request->input('bookshop_distance');
        $NearbyServices->library = $request->input('library');
        $NearbyServices->library_distance = $request->input('library_distance');
        $NearbyServices->chef = $request->input('chef');
        $NearbyServices->chef_distance = $request->input('chef_distance');
        $NearbyServices->pizza_inn = $request->input('pizza_inn');
        $NearbyServices->pizza_inn_distance = $request->input('pizza_inn_distance');
        $NearbyServices->creamy_inn = $request->input('creamy_inn');
        $NearbyServices->creamy_inn_distance = $request->input('creamy_inn_distance');
        $NearbyServices->kfc = $request->input('kfc');
        $NearbyServices->kfc_distance = $request->input('kfc_distance');

        $NearbyServices->petrol_station = $request->input('petrol_station');
        $NearbyServices->petrol_station_distance = $request->input('petrol_station_distance');
        $NearbyServices->java = $request->input('java');
        $NearbyServices->java_distance = $request->input('java_distance');
        $NearbyServices->hotel = $request->input('hotel');
        $NearbyServices->hotel_distance = $request->input('hotel_distance');
        $NearbyServices->salon = $request->input('salon');
        $NearbyServices->salon_distance = $request->input('salon_distance');

        $NearbyServices->barber = $request->input('barber');
        $NearbyServices->barber_distance = $request->input('barber_distance');

        $NearbyServices->user_id = $request->input('user_id');
        $NearbyServices->house_id = $request->input('house_id');
        $NearbyServices->save();

        return response()->json([
            'status'=> 200,
            'message'=> 'House details updated Successfully',
        ]);
        }
        else {
            return response()->json([
                'status'=> 404,
                'message'=> 'No such record found',
            ]);
        }
    }
}

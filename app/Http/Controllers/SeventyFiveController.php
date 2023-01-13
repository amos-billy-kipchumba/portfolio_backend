<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use App\Models\SeventyFive;
use Illuminate\Support\Facades\DB;

class SeventyFiveController extends Controller
{
    //
    public function storeSeventyFive(Request $request)
    {
        $validator = FacadesValidator::make($request->all(), [
            'bathtub'=>'required|max:191',
            'hair_drier'=>'required|max:191',
            'washer'=>'required|max:191',
            'drier'=>'required|max:191',
            'iron'=>'required|max:191',
            'tv'=>'required|max:191',
            'air_condition'=>'required|max:191',
            'heating'=>'required|max:191',
            'wifi'=>'required|max:191',
            'refrigeration'=>'required|max:191',
            'microwave'=>'required|max:191',
            'dishes_silverware'=>'required|max:191',
            'kitchen'=>'required|max:191',
            'blender'=>'required|max:191',
            'coffee_maker'=>'required|max:191',
            'fire_extinguisher'=>'required|max:191',
            'bread_toaster'=>'required|max:191',
            'patio_balcony'=>'required|max:191',
            'backyard'=>'required|max:191',
            'outdoor_grill'=>'required|max:191',
            'beach_essential'=>'required|max:191',
            'pool'=>'required|max:191',
            'parking'=>'required|max:191',
            'long_term'=>'required|max:191',
            'private_entrance'=>'required|max:191',
            'userId'=>'required|max:191',
            'essentials'=>'required|max:191',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=> 422,
                'errors'=> $validator->messages(),
            ]);
        }

        else
        {
            $SeventyFive = new SeventyFive;
            $SeventyFive->bathtub = $request->input('bathtub');
            $SeventyFive->hair_drier = $request->input('hair_drier');
            $SeventyFive->washer = $request->input('washer');
            $SeventyFive->drier = $request->input('drier');
            $SeventyFive->iron = $request->input('iron');
            $SeventyFive->tv = $request->input('tv');
            $SeventyFive->air_condition = $request->input('air_condition');
            $SeventyFive->heating = $request->input('heating');
            $SeventyFive->wifi = $request->input('wifi');
            $SeventyFive->refrigeration = $request->input('refrigeration');
            $SeventyFive->microwave = $request->input('microwave');
            $SeventyFive->dishes_silverware = $request->input('dishes_silverware');
            $SeventyFive->kitchen = $request->input('kitchen');
            $SeventyFive->blender = $request->input('blender');
            $SeventyFive->coffee_maker = $request->input('coffee_maker');
            $SeventyFive->fire_extinguisher = $request->input('fire_extinguisher');
            $SeventyFive->bread_toaster = $request->input('bread_toaster');
            $SeventyFive->patio_balcony = $request->input('patio_balcony');
            $SeventyFive->backyard = $request->input('backyard');
            $SeventyFive->outdoor_grill = $request->input('outdoor_grill');
            $SeventyFive->beach_essential = $request->input('beach_essential');
            $SeventyFive->pool = $request->input('pool');
            $SeventyFive->parking = $request->input('parking');
            $SeventyFive->long_term = $request->input('long_term');
            $SeventyFive->private_entrance = $request->input('private_entrance');
            $SeventyFive->essentials = $request->input('essentials');

            $SeventyFive->oven = $request->input('oven');
            $SeventyFive->cinema = $request->input('cinema');
            $SeventyFive->children_play = $request->input('children_play');
            $SeventyFive->farm = $request->input('farm');
            $SeventyFive->ranch = $request->input('ranch');
            $SeventyFive->office_equipment = $request->input('office_equipment');
            $SeventyFive->shower = $request->input('shower');
            $SeventyFive->beach_front = $request->input('beach_front');
            $SeventyFive->games_court = $request->input('games_court');
            $SeventyFive->chef = $request->input('chef');
            $SeventyFive->shopping = $request->input('shopping');
            $SeventyFive->toilet = $request->input('toilet');

            $SeventyFive->baby_cot = $request->input('baby_cot');
            $SeventyFive->mini_bar = $request->input('mini_bar');

            $SeventyFive->user = $request->input('userId');
            $SeventyFive->house_id = $request->input('house_id');
            $SeventyFive->save();

            return response()->json([
                'status'=> 200,
                'message'=> 'House details added Successfully',
            ]);
        }

    }

    public function getSeventyFiveDetails($id)
    {
        $SeventyFive = SeventyFive::find($id);

        if($SeventyFive)
        {
            return response()->json([
                'status'=> 200,
                'sevenFive'=>$SeventyFive
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

    public function getJoinFiveDetails($id)
    {
        $SeventyFive = DB::table('seventy_five')
        ->join('house_details','seventy_five.house_id',"=",'house_details.id')
        ->where('house_details.id',"=",$id)
        ->select('seventy_five.*')
        ->get();

        return response()->json([
            'status'=> 200,
            'joinSeventyFive'=>$SeventyFive,
        ]);
    }

    public function getStarsDetails($user_id)
    {
        $SeventyFive = SeventyFive::where('house_id', '=', $user_id)->first();

        if($SeventyFive)
        {
            return response()->json([
                'status'=> 200,
                'stars'=>$SeventyFive
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

    public function updateSeventyFiveDetails(Request $request, $user_id)
    {
        $SeventyFive = SeventyFive::where('house_id', '=', $user_id)->first();
        if($SeventyFive)
        {
            $SeventyFive->bathtub = $request->input('bathtub');
            $SeventyFive->hair_drier = $request->input('hair_drier');
            $SeventyFive->washer = $request->input('washer');
            $SeventyFive->drier = $request->input('drier');
            $SeventyFive->iron = $request->input('iron');
            $SeventyFive->tv = $request->input('tv');
            $SeventyFive->air_condition = $request->input('air_condition');
            $SeventyFive->heating = $request->input('heating');
            $SeventyFive->wifi = $request->input('wifi');
            $SeventyFive->refrigeration = $request->input('refrigeration');
            $SeventyFive->microwave = $request->input('microwave');
            $SeventyFive->dishes_silverware = $request->input('dishes_silverware');
            $SeventyFive->kitchen = $request->input('kitchen');
            $SeventyFive->blender = $request->input('blender');
            $SeventyFive->coffee_maker = $request->input('coffee_maker');
            $SeventyFive->fire_extinguisher = $request->input('fire_extinguisher');
            $SeventyFive->bread_toaster = $request->input('bread_toaster');
            $SeventyFive->patio_balcony = $request->input('patio_balcony');
            $SeventyFive->backyard = $request->input('backyard');
            $SeventyFive->outdoor_grill = $request->input('outdoor_grill');
            $SeventyFive->beach_essential = $request->input('beach_essential');
            $SeventyFive->pool = $request->input('pool');
            $SeventyFive->parking = $request->input('parking');
            $SeventyFive->long_term = $request->input('long_term');
            $SeventyFive->private_entrance = $request->input('private_entrance');
            $SeventyFive->essentials = $request->input('essentials');

            $SeventyFive->oven = $request->input('oven');
            $SeventyFive->cinema = $request->input('cinema');
            $SeventyFive->children_play = $request->input('children_play');
            $SeventyFive->farm = $request->input('farm');
            $SeventyFive->ranch = $request->input('ranch');
            $SeventyFive->office_equipment = $request->input('office_equipment');
            $SeventyFive->shower = $request->input('shower');
            $SeventyFive->beach_front = $request->input('beach_front');
            $SeventyFive->games_court = $request->input('games_court');
            $SeventyFive->chef = $request->input('chef');
            $SeventyFive->shopping = $request->input('shopping');

            $SeventyFive->baby_cot = $request->input('baby_cot');
            $SeventyFive->mini_bar = $request->input('mini_bar');

            $SeventyFive->user = $request->input('userId');
            $SeventyFive->house_id = $request->input('house_id');
            $SeventyFive->update();

            return response()->json([
                'status'=> 200,
                'message'=> 'House details updated Successfully',
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
}

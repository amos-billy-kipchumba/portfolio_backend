<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use App\Models\Fifty;
use Illuminate\Support\Facades\DB;
class FiftyController extends Controller
{
    //
    public function storeFifty(Request $request)
    {
        $validator = FacadesValidator::make($request->all(), [
            'guests'=>'required|max:191',
            'bedrooms'=>'required|max:191',
            'beds'=>'required|max:191',
            'bathtubs'=>'required|max:191',
            'userId'=>'required|max:191',
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
            $Fifty = new Fifty;
            $Fifty->max_no_of_guests = $request->input('guests');
            $Fifty->number_of_bedrooms = $request->input('bedrooms');
            $Fifty->number_of_beds = $request->input('beds');
            $Fifty->number_of_bathtubs = $request->input('bathtubs');
            $Fifty->user_id = $request->input('userId');
            $Fifty->house_id = $request->input('house_id');
            $Fifty->save();

            return response()->json([
                'status'=> 200,
                'message'=> 'House details added Successfully',
            ]);
        }

    }

    public function getFiftyDetails($id)
    {
        $Fifty = Fifty::find($id);

        if($Fifty)
        {
            return response()->json([
                'status'=> 200,
                'fifty'=>$Fifty
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

    public function getMoonDetails($user_id)
    {
        $Fifty = Fifty::where('house_id', "=", $user_id)->first();

        if($Fifty)
        {
            return response()->json([
                'status'=> 200,
                'moon'=>$Fifty
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


    public function updateFiftyDetails(Request $request, $user_id)
    {
        $Fifty = Fifty::where('house_id', "=", $user_id)->first();
        if($Fifty)
        {
            $Fifty->max_no_of_guests = $request->input('guests');
            $Fifty->number_of_bedrooms = $request->input('bedrooms');
            $Fifty->number_of_beds = $request->input('beds');
            $Fifty->number_of_bathtubs = $request->input('bathtubs');
            $Fifty->user_id = $request->input('userId');
            $Fifty->update();

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

    public function getJoinFiftyDetails($id)
    {
        $Fifty = DB::table('fifty')
        ->join('house_details','fifty.house_id',"=",'house_details.id')
        ->where('house_details.id',"=",$id)
        ->select('fifty.*')
        ->get();

        return response()->json([
            'status'=> 200,
            'joinFifty'=>$Fifty,
        ]);
    }
}

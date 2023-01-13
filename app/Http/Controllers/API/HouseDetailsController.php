<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HouseDetails;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class HouseDetailsController extends Controller
{
    //
    public function storeHouseDetails(Request $request)
    {
        $validator = FacadesValidator::make($request->all(), [
            'houseTitle'=>'required|max:191',
            'location'=>'required|max:191',
            'price'=>'required|max:191',
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
            $HouseDetails = new HouseDetails;

            if($request->hasFile('image'))
            {
                $image = $request->file('image');
                $filename = Str::random(32).".".$image->getClientOriginalExtension();
                $image->move('uploads/', $filename);
            }
            $HouseDetails->cover = $filename;
            $HouseDetails->title = $request->input('houseTitle');
            $HouseDetails->description = $request->input('description');
            $HouseDetails->location = $request->input('location');
            $HouseDetails->price = $request->input('price');
            $HouseDetails->user_id = $request->input('userId');
            $HouseDetails->house_type = $request->input('house_type');
            $HouseDetails->save();

            return response()->json([
                'status'=> 200,
                'house_details_data'=> $HouseDetails,
            ]);
        }

    }

    public function getHouseDetails()
    {
        $HouseDetails = HouseDetails::all();

        return response()->json([
            'status'=> 200,
            'house_details'=> $HouseDetails
        ]);
    }

    public function getZeroDetails($id)
    {
        $HouseDetails = HouseDetails::find($id);

        if($HouseDetails)
        {
            return response()->json([
                'status'=> 200,
                'zero'=>$HouseDetails
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

    public function getHelloDetails($user_id)
    {
        $HouseDetails = HouseDetails::where('id', $user_id)->first();

        if($HouseDetails)
        {
            return response()->json([
                'status'=> 200, 'hello'=>$HouseDetails
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

    public function getMagicDetails($magic_id)
    {
        $HouseDetails = HouseDetails::where('id', $magic_id)->first();

        if($HouseDetails)
        {
            return response()->json([
                'status'=> 200, 'hello'=>$HouseDetails
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

    public function updateHouseDetails(Request $request, $user_id)
    {
        $HouseDetails = HouseDetails::where('id', $user_id)->first();
        if($HouseDetails)
        {
            if($request->hasFile('image'))
            {
                $path = 'uploads/'.$HouseDetails->cover;
                if(File::exists($path))
                {
                    File::delete($path);
                }
                $image = $request->file('image');
                $filename = Str::random(32).".".$image->getClientOriginalExtension();
                $image->move('uploads/', $filename);
                $HouseDetails->cover = $filename;
            }
            $HouseDetails->title = $request->input('houseTitle');
            $HouseDetails->description = $request->input('description');
            $HouseDetails->location = $request->input('location');
            $HouseDetails->price = $request->input('price');
            $HouseDetails->user_id = $request->input('userId');
            $HouseDetails->house_type = $request->input('house_type');
            $HouseDetails->update();

            return response()->json([
                'status'=> 200,
                'message'=> "house details updated successfully",
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


    public function getJoinMagicDetails()
    {
        $HouseDetails = DB::table('fifty')
        ->join('house_details','fifty.house_id',"=",'house_details.id')
        ->join('seventy_five','seventy_five.house_id','=','house_details.id')
        ->get();

        return response()->json([
            'status'=> 200,
            'joinSearchDetails'=> $HouseDetails,
        ]);
    }

    public function getHostHousesDetails($user_id)
    {
        $HouseDetails = HouseDetails::where('user_id',"=",$user_id)->get();

        return response()->json([
            'status'=> 200,
            'hostHousesDetails'=> $HouseDetails,
        ]);
    }

    public function getAllHouseMoreDetails($id)
    {
        $getAllHouseMoreDetails = DB::table('fifty')
        ->join('house_details','fifty.house_id',"=",'house_details.id')
        ->join('seventy_five','seventy_five.house_id','=','house_details.id')
        ->join('hundred','hundred.house_id','=','house_details.id')
        ->join('nearby_services','nearby_services.house_id','=','house_details.id')
        ->where('house_details.id','=',$id)
        ->get();

        return response()->json([
            'status'=> 200,
            'bookingInfoForHost'=> $getAllHouseMoreDetails,
        ]);
    }
}

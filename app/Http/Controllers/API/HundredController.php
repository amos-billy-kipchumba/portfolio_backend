<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Support\Str;
use App\Models\Hundred;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
class HundredController extends Controller
{
    //
    public function storeHundred(Request $request)
    {
        $validator = FacadesValidator::make($request->all(), [
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
            $Hundred = new Hundred;

            if($request->hasFile('sitting_room'))
            {
                $sitting_room = $request->file('sitting_room');
                $filename1 = Str::random(32).".".$sitting_room->getClientOriginalExtension();
                $sitting_room->move('parts/', $filename1);
                $Hundred->sitting_room = $filename1;
            }


            if($request->hasFile('dinning_room'))
            {
                $dinning_room = $request->file('dinning_room');
                $filename2 = Str::random(32).".".$dinning_room->getClientOriginalExtension();
                $dinning_room->move('parts/', $filename2);
                $Hundred->dinning_room = $filename2;
            }


            if($request->hasFile('kitchen'))
            {
                $kitchen = $request->file('kitchen');
                $filename3 = Str::random(32).".".$kitchen->getClientOriginalExtension();
                $kitchen->move('parts/', $filename3);
                $Hundred->kitchen = $filename3;
            }


            if($request->hasFile('bathroom'))
            {
                $bathroom = $request->file('bathroom');
                $filename4 = Str::random(32).".".$bathroom->getClientOriginalExtension();
                $bathroom->move('parts/', $filename4);
                $Hundred->bathroom = $filename4;
            }


            if($request->hasFile('bedroom'))
            {
                $bedroom = $request->file('bedroom');
                $filename5 = Str::random(32).".".$bedroom->getClientOriginalExtension();
                $bedroom->move('parts/', $filename5);
                $Hundred->bedroom = $filename5;
            }


            if($request->hasFile('swimming_pool'))
            {
                $swimming_pool = $request->file('swimming_pool');
                $filename6 = Str::random(32).".".$swimming_pool->getClientOriginalExtension();
                $swimming_pool->move('parts/', $filename6);
                $Hundred->swimming_pool = $filename6;
            }


            if($request->hasFile('lake'))
            {
                $lake = $request->file('lake');
                $filename7 = Str::random(32).".".$lake->getClientOriginalExtension();
                $lake->move('parts/', $filename7);
                $Hundred->lake = $filename7;
            }


            if($request->hasFile('beach'))
            {
                $beach = $request->file('beach');
                $filename8 = Str::random(32).".".$beach->getClientOriginalExtension();
                $beach->move('parts/', $filename8);
                $Hundred->beach = $filename8;
            }


            if($request->hasFile('ocean_view'))
            {
                $ocean_view = $request->file('ocean_view');
                $filename9 = Str::random(32).".".$ocean_view->getClientOriginalExtension();
                $ocean_view->move('parts/', $filename9);
                $Hundred->ocean_view = $filename9;
            }


            if($request->hasFile('balcony'))
            {
                $balcony = $request->file('balcony');
                $filename10 = Str::random(32).".".$balcony->getClientOriginalExtension();
                $balcony->move('parts/', $filename10);
                $Hundred->balcony = $filename10;
            }


            if($request->hasFile('parking'))
            {
                $parking = $request->file('parking');
                $filename11 = Str::random(32).".".$parking->getClientOriginalExtension();
                $parking->move('parts/', $filename11);
                $Hundred->parking = $filename11;
            }


            if($request->hasFile('front'))
            {
                $front = $request->file('front');
                $filename12 = Str::random(32).".".$front->getClientOriginalExtension();
                $front->move('parts/', $filename12);
                $Hundred->front = $filename12;
            }


            if($request->hasFile('right'))
            {
                $right = $request->file('right');
                $filename13 = Str::random(32).".".$right->getClientOriginalExtension();
                $right->move('parts/', $filename13);
                $Hundred->right = $filename13;
            }


            if($request->hasFile('left'))
            {
                $left = $request->file('left');
                $filename14 = Str::random(32).".".$left->getClientOriginalExtension();
                $left->move('parts/', $filename14);
                $Hundred->left = $filename14;
            }


            if($request->hasFile('back'))
            {
                $back = $request->file('back');
                $filename15 = Str::random(32).".".$back->getClientOriginalExtension();
                $back->move('parts/', $filename15);
                $Hundred->back = $filename15;
            }


            if($request->hasFile('aerial'))
            {
                $aerial = $request->file('aerial');
                $filename16 = Str::random(32).".".$aerial->getClientOriginalExtension();
                $aerial->move('parts/', $filename16);
                $Hundred->aerial = $filename16;
            }


            $Hundred->user = $request->input('userId');
            $Hundred->house_id = $request->input('house_id');
            $Hundred->save();

            return response()->json([
                'status'=> 200,
                'message'=> 'House details added Successfully',
            ]);
        }

    }

    public function getHundredDetails()
    {
        $Hundred = Hundred::all();

        return response()->json([
            'status'=> 200,
            'hundred'=> $Hundred
        ]);
    }

    public function getThousandDetails($id)
    {
        $Hundred = Hundred::find($id);

        if($Hundred)
        {
            return response()->json([
                'status'=> 200,
                'thousand'=>$Hundred
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

    public function getJoinThousandDetails($id)
    {
        $Hundred = DB::table('hundred')
        ->join('house_details','hundred.house_id',"=",'house_details.id')
        ->where('house_details.id',"=",$id)
        ->select('hundred.*')
        ->get();

        return response()->json([
            'status'=> 200,
            'joinThousand'=>$Hundred,
        ]);
    }

    public function getSunDetails($user_id)
    {
        $Hundred = Hundred::where('house_id', '=',$user_id)->first();

        if($Hundred)
        {
            return response()->json([
                'status'=> 200,
                'sun'=>$Hundred
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

    public function updateHundredDetails(Request $request, $user_id)
    {
        $Hundred = Hundred::where('house_id', '=',$user_id)->first();
        if($Hundred)
        {
            if($request->hasFile('sitting_room'))
            {
                $path = 'parts/'.$Hundred->sitting_room;
                if(File::exists($path))
                {
                    File::delete($path);
                }
                $image = $request->file('sitting_room');
                $filename = Str::random(32).".".$image->getClientOriginalExtension();
                $image->move('parts/', $filename);
                $Hundred->sitting_room = $filename;
            }

            if($request->hasFile('dinning_room'))
            {
                $path = 'parts/'.$Hundred->dinning_room;
                if(File::exists($path))
                {
                    File::delete($path);
                }
                $image = $request->file('dinning_room');
                $filename = Str::random(32).".".$image->getClientOriginalExtension();
                $image->move('parts/', $filename);
                $Hundred->dinning_room = $filename;
            }

            if($request->hasFile('kitchen'))
            {
                $path = 'parts/'.$Hundred->kitchen;
                if(File::exists($path))
                {
                    File::delete($path);
                }
                $image = $request->file('kitchen');
                $filename = Str::random(32).".".$image->getClientOriginalExtension();
                $image->move('parts/', $filename);
                $Hundred->kitchen = $filename;
            }

            if($request->hasFile('bathroom'))
            {
                $path = 'parts/'.$Hundred->bathroom;
                if(File::exists($path))
                {
                    File::delete($path);
                }
                $image = $request->file('bathroom');
                $filename = Str::random(32).".".$image->getClientOriginalExtension();
                $image->move('parts/', $filename);
                $Hundred->bathroom = $filename;
            }

            if($request->hasFile('bedroom'))
            {
                $path = 'parts/'.$Hundred->bedroom;
                if(File::exists($path))
                {
                    File::delete($path);
                }
                $image = $request->file('bedroom');
                $filename = Str::random(32).".".$image->getClientOriginalExtension();
                $image->move('parts/', $filename);
                $Hundred->bedroom = $filename;
            }

            if($request->hasFile('swimming_pool'))
            {
                $path = 'parts/'.$Hundred->swimming_pool;
                if(File::exists($path))
                {
                    File::delete($path);
                }
                $image = $request->file('swimming_pool');
                $filename = Str::random(32).".".$image->getClientOriginalExtension();
                $image->move('parts/', $filename);
                $Hundred->swimming_pool = $filename;
            }

            if($request->hasFile('lake'))
            {
                $path = 'parts/'.$Hundred->lake;
                if(File::exists($path))
                {
                    File::delete($path);
                }
                $image = $request->file('lake');
                $filename = Str::random(32).".".$image->getClientOriginalExtension();
                $image->move('parts/', $filename);
                $Hundred->lake = $filename;
            }

            if($request->hasFile('beach'))
            {
                $path = 'parts/'.$Hundred->beach;
                if(File::exists($path))
                {
                    File::delete($path);
                }
                $image = $request->file('beach');
                $filename = Str::random(32).".".$image->getClientOriginalExtension();
                $image->move('parts/', $filename);
                $Hundred->beach = $filename;
            }

            if($request->hasFile('ocean_view'))
            {
                $path = 'parts/'.$Hundred->ocean_view;
                if(File::exists($path))
                {
                    File::delete($path);
                }
                $image = $request->file('ocean_view');
                $filename = Str::random(32).".".$image->getClientOriginalExtension();
                $image->move('parts/', $filename);
                $Hundred->ocean_view = $filename;
            }

            if($request->hasFile('balcony'))
            {
                $path = 'parts/'.$Hundred->balcony;
                if(File::exists($path))
                {
                    File::delete($path);
                }
                $image = $request->file('balcony');
                $filename = Str::random(32).".".$image->getClientOriginalExtension();
                $image->move('parts/', $filename);
                $Hundred->balcony = $filename;
            }

            if($request->hasFile('parking'))
            {
                $path = 'parts/'.$Hundred->parking;
                if(File::exists($path))
                {
                    File::delete($path);
                }
                $image = $request->file('parking');
                $filename = Str::random(32).".".$image->getClientOriginalExtension();
                $image->move('parts/', $filename);
                $Hundred->parking = $filename;
            }

            if($request->hasFile('front'))
            {
                $path = 'parts/'.$Hundred->front;
                if(File::exists($path))
                {
                    File::delete($path);
                }
                $image = $request->file('front');
                $filename = Str::random(32).".".$image->getClientOriginalExtension();
                $image->move('parts/', $filename);
                $Hundred->front = $filename;
            }

            if($request->hasFile('right'))
            {
                $path = 'parts/'.$Hundred->right;
                if(File::exists($path))
                {
                    File::delete($path);
                }
                $image = $request->file('right');
                $filename = Str::random(32).".".$image->getClientOriginalExtension();
                $image->move('parts/', $filename);
                $Hundred->right = $filename;
            }

            if($request->hasFile('left'))
            {
                $path = 'parts/'.$Hundred->left;
                if(File::exists($path))
                {
                    File::delete($path);
                }
                $image = $request->file('left');
                $filename = Str::random(32).".".$image->getClientOriginalExtension();
                $image->move('parts/', $filename);
                $Hundred->left = $filename;
            }

            if($request->hasFile('back'))
            {
                $path = 'parts/'.$Hundred->back;
                if(File::exists($path))
                {
                    File::delete($path);
                }
                $image = $request->file('back');
                $filename = Str::random(32).".".$image->getClientOriginalExtension();
                $image->move('parts/', $filename);
                $Hundred->back = $filename;
            }

            if($request->hasFile('aerial'))
            {
                $path = 'parts/'.$Hundred->aerial;
                if(File::exists($path))
                {
                    File::delete($path);
                }
                $image = $request->file('aerial');
                $filename = Str::random(32).".".$image->getClientOriginalExtension();
                $image->move('parts/', $filename);
                $Hundred->aerial = $filename;
            }

            $Hundred->user = $request->input('userId');
            $Hundred->update();

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

    public function deleteHousePart(Request $request, $house_id)
    {
        $Hundred = Hundred::where('house_id', '=',$house_id)->first();
        if($Hundred)
        {
            $path = 'parts/'.$Hundred->sitting_room;
            if(File::exists($path))
            {
            File::delete($path);
            $Hundred->sitting_room = null;
            }

            $Hundred->update();

            return response()->json([
                'status'=> 200,
                'message'=> "success",
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

    public function deleteHousePart2(Request $request, $house_id)
    {
        $Hundred = Hundred::where('house_id', '=',$house_id)->first();
        if($Hundred)
        {
            $path = 'parts/'.$Hundred->dinning_room;
            if(File::exists($path))
            {
            File::delete($path);
            $Hundred->dinning_room = null;
            }

            $Hundred->update();

            return response()->json([
                'status'=> 200,
                'message'=> "success",
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


    public function deleteHousePart3(Request $request, $house_id)
    {
        $Hundred = Hundred::where('house_id', '=',$house_id)->first();
        if($Hundred)
        {
            $path = 'parts/'.$Hundred->kitchen;
            if(File::exists($path))
            {
            File::delete($path);
            $Hundred->kitchen = null;
            }

            $Hundred->update();

            return response()->json([
                'status'=> 200,
                'message'=> "success",
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

    public function deleteHousePart4(Request $request, $house_id)
    {
        $Hundred = Hundred::where('house_id', '=',$house_id)->first();
        if($Hundred)
        {
            $path = 'parts/'.$Hundred->bathroom;
            if(File::exists($path))
            {
            File::delete($path);
            $Hundred->bathroom = null;
            }

            $Hundred->update();

            return response()->json([
                'status'=> 200,
                'message'=> "success",
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

    public function deleteHousePart5(Request $request, $house_id)
    {
        $Hundred = Hundred::where('house_id', '=',$house_id)->first();
        if($Hundred)
        {
            $path = 'parts/'.$Hundred->bedroom;
            if(File::exists($path))
            {
            File::delete($path);
            $Hundred->bedroom = null;
            }

            $Hundred->update();

            return response()->json([
                'status'=> 200,
                'message'=> "success",
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

    public function deleteHousePart6(Request $request, $house_id)
    {
        $Hundred = Hundred::where('house_id', '=',$house_id)->first();
        if($Hundred)
        {
            $path = 'parts/'.$Hundred->swimming_pool;
            if(File::exists($path))
            {
            File::delete($path);
            $Hundred->swimming_pool = null;
            }

            $Hundred->update();

            return response()->json([
                'status'=> 200,
                'message'=> "success",
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

    public function deleteHousePart7(Request $request, $house_id)
    {
        $Hundred = Hundred::where('house_id', '=',$house_id)->first();
        if($Hundred)
        {
            $path = 'parts/'.$Hundred->lake;
            if(File::exists($path))
            {
            File::delete($path);
            $Hundred->lake = null;
            }

            $Hundred->update();

            return response()->json([
                'status'=> 200,
                'message'=> "success",
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

    public function deleteHousePart8(Request $request, $house_id)
    {
        $Hundred = Hundred::where('house_id', '=',$house_id)->first();
        if($Hundred)
        {
            $path = 'parts/'.$Hundred->beach;
            if(File::exists($path))
            {
            File::delete($path);
            $Hundred->beach = null;
            }

            $Hundred->update();

            return response()->json([
                'status'=> 200,
                'message'=> "success",
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

    public function deleteHousePart9(Request $request, $house_id)
    {
        $Hundred = Hundred::where('house_id', '=',$house_id)->first();
        if($Hundred)
        {
            $path = 'parts/'.$Hundred->ocean_view;
            if(File::exists($path))
            {
            File::delete($path);
            $Hundred->ocean_view = null;
            }

            $Hundred->update();

            return response()->json([
                'status'=> 200,
                'message'=> "success",
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

    public function deleteHousePart10(Request $request, $house_id)
    {
        $Hundred = Hundred::where('house_id', '=',$house_id)->first();
        if($Hundred)
        {
            $path = 'parts/'.$Hundred->balcony;
            if(File::exists($path))
            {
            File::delete($path);
            $Hundred->balcony = null;
            }

            $Hundred->update();

            return response()->json([
                'status'=> 200,
                'message'=> "success",
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

    public function deleteHousePart11(Request $request, $house_id)
    {
        $Hundred = Hundred::where('house_id', '=',$house_id)->first();
        if($Hundred)
        {
            $path = 'parts/'.$Hundred->parking;
            if(File::exists($path))
            {
            File::delete($path);
            $Hundred->parking = null;
            }

            $Hundred->update();

            return response()->json([
                'status'=> 200,
                'message'=> "success",
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

    public function deleteHousePart12(Request $request, $house_id)
    {
        $Hundred = Hundred::where('house_id', '=',$house_id)->first();
        if($Hundred)
        {
            $path = 'parts/'.$Hundred->front;
            if(File::exists($path))
            {
            File::delete($path);
            $Hundred->front = null;
            }

            $Hundred->update();

            return response()->json([
                'status'=> 200,
                'message'=> "success",
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

    public function deleteHousePart13(Request $request, $house_id)
    {
        $Hundred = Hundred::where('house_id', '=',$house_id)->first();
        if($Hundred)
        {
            $path = 'parts/'.$Hundred->right;
            if(File::exists($path))
            {
            File::delete($path);
            $Hundred->right = null;
            }

            $Hundred->update();

            return response()->json([
                'status'=> 200,
                'message'=> "success",
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

    public function deleteHousePart14(Request $request, $house_id)
    {
        $Hundred = Hundred::where('house_id', '=',$house_id)->first();
        if($Hundred)
        {
            $path = 'parts/'.$Hundred->left;
            if(File::exists($path))
            {
            File::delete($path);
            $Hundred->left = null;
            }

            $Hundred->update();

            return response()->json([
                'status'=> 200,
                'message'=> "success",
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

    public function deleteHousePart15(Request $request, $house_id)
    {
        $Hundred = Hundred::where('house_id', '=',$house_id)->first();
        if($Hundred)
        {
            $path = 'parts/'.$Hundred->back;
            if(File::exists($path))
            {
            File::delete($path);
            $Hundred->back = null;
            }

            $Hundred->update();

            return response()->json([
                'status'=> 200,
                'message'=> "success",
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

    public function deleteHousePart16(Request $request, $house_id)
    {
        $Hundred = Hundred::where('house_id', '=',$house_id)->first();
        if($Hundred)
        {
            $path = 'parts/'.$Hundred->aerial;
            if(File::exists($path))
            {
            File::delete($path);
            $Hundred->aerial = null;
            }

            $Hundred->update();

            return response()->json([
                'status'=> 200,
                'message'=> "success",
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

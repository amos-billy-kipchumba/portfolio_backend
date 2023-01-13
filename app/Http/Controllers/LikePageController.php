<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LikePage;

class LikePageController extends Controller
{
    //
    public function storeLike(Request $request)
    {
        $like = new LikePage;
        $like->house_id = $request->input('house_id');
        $like->user_id = $request->input('user_id');
        $like->save();

        return response()->json([
            'status'=> 200,
            'message'=> 'like added'
        ]);
    }

    public function getHouseLike($id)
    {
        $like = LikePage::where('house_id','=', $id)->get();

        if($like)
        {
            return response()->json([
                'status'=> 200,
                'likes'=>$like
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\customer_review;

class customer_review_controller extends Controller
{
    //
    public function addCustomerReview(Request $request)
    {
        $Review = new customer_review;
        $Review->review_rating = $request->input('review_rating');
        $Review->review_comment = $request->input('review_comment');
        $Review->user = $request->input('user');
        $Review->house_id = $request->input('house_id');
        $Review->save();

        return response()->json([
            'status'=> 200,
            'message'=> 'Review added successfully'
        ]);
    }

    public function getAllSpecificCustomerReviews($id){
        $review_page = customer_review::where('house_id',"=",$id)->get();

        return response()->json([
            'status'=> 200,
            'review_page'=> $review_page,
        ]);
    }

    public function updateCustomerReview(Request $request, $id){
        $review_page = customer_review::where('id', $id)->first();
        if($review_page)
        {
            $review_page->review_rating = $request->input('review_rating');
            $review_page->review_comment = $request->input('review_comment');
            $review_page->user = $request->input('user');
            $review_page->house_id = $request->input('house_id');
            $review_page->update();

            return response()->json([
                'status'=> 200,
                'message'=> 'Profile updated successfully',
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

<?php

namespace App\Http\Controllers;

use App\Models\BookingInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SendMail;
class BookingController extends Controller
{
    //
    public function storeBookingInfo(Request $request) {
        $bookingInfo = new BookingInfo;
        $bookingInfo->user_id = $request->input('user_id');
        $bookingInfo->house_id = $request->input('house_id');
        $bookingInfo->start_date = $request->input('start_date');
        $bookingInfo->end_date = $request->input('end_date');
        $bookingInfo->number_of_guests = $request->input('number_of_guests');
        $bookingInfo->number_of_days = $request->input('number_of_days');
        $bookingInfo->number_of_hours = $request->input('number_of_hours');
        $bookingInfo->total_price = $request->input('total_price');
        $bookingInfo->paid = "no";
        $bookingInfo->mpesa_message = "paid jjskdfgjkk";
        $bookingInfo->bank_message = "paid received ssdhkkjhjhrj";
        $bookingInfo->booking_phone = $request->input('booking_phone');
        $bookingInfo->pay_id = $request->input('pay_id');
        $bookingInfo->save();

        return response()->json([
            'status'=> 200,
            'joinThousand'=> "Booked",
        ]);
    }

    public function bookingEmail(Request $request){
        $f_name = $request->input('customer_first_name');
        $e_mail = $request->input('customer_email');

        $msg = "Congratulations, you have successfully booked a house at dineN'Stay. You may <a href='https://www.dinenstay.amosbilly.co.ke/login-user'>login</a>to your account";

        SendMail::sender($f_name,$e_mail,$msg);


        $h_name = $request->input('customer_first_name');
        $h_mail = $request->input('host_email');

        $msgee = "Congratulations, $h_name has booked your house. You may <a href='https://www.dinenstay.amosbilly.co.ke/login-user'>login</a>to your account";
        SendMail::Notify($h_name,$h_mail,$msgee);

        return response()->json([
            'status'=> 200,
            'joinThousand'=> "email sent",
        ]);
    }

    public function getToBookingInfo($id)
    {
        $BookingInfo = BookingInfo::where('pay_id', '=', $id)->get();

        if($BookingInfo)
        {
            return response()->json([
                'status'=> 200,
                'info'=>$BookingInfo
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

    public function updateBookingInfo(Request $request, $id)
    {
        $bookingInfo = BookingInfo::where('pay_id', $id)->first();
        $bookingInfo->user_id = $request->input('user_id');
        $bookingInfo->house_id = $request->input('house_id');
        $bookingInfo->start_date = $request->input('start_date');
        $bookingInfo->end_date = $request->input('end_date');
        $bookingInfo->number_of_guests = $request->input('number_of_guests');
        $bookingInfo->number_of_days = $request->input('number_of_days');
        $bookingInfo->number_of_hours = $request->input('number_of_hours');
        $bookingInfo->total_price = $request->input('total_price');
        $bookingInfo->paid = "yes";
        $bookingInfo->mpesa_message = "paid jjskdfgjkk";
        $bookingInfo->bank_message = "paid received ssdhkkjhjhrj";
        $bookingInfo->booking_phone = $request->input('booking_phone');
        $bookingInfo->pay_id = $request->input('pay_id');
        $bookingInfo->update();

        return response()->json([
            'status'=> 200,
            'paymentMade'=> "payment made",
        ]);
    }

    public function getBookedDates($id)
    {
        $BookingInfo = BookingInfo::where('house_id', $id)->get();

        if($BookingInfo)
        {
            return response()->json([
                'status'=> 200,
                'selectedDates'=>$BookingInfo
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

    public function getBookedInfo($id) {
        $BookingInfo = DB::table('booking_info')
        ->rightJoin('house_details','booking_info.house_id',"=",'house_details.id')
        ->where('booking_info.user_id','=',$id)
        ->select('*', 'booking_info.id as bid')
        ->orderBy('booking_info.start_date', 'desc')
        ->get();

        return response()->json([
            'status'=> 200,
            'bookingInfo'=> $BookingInfo,
        ]);
    }

    public function getTotalBooked($id)
    {
        $BookingInfo = BookingInfo::where('user_id', $id)->get();

        if($BookingInfo)
        {
            return response()->json([
                'status'=> 200,
                'totalBooked'=>$BookingInfo
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


    public function getTotalBookedForHost($id)
    {
        $BookingInfo = DB::table('booking_info')
        ->join('house_details','booking_info.house_id',"=",'house_details.id')
        ->join('dineusers','dineusers.id','=','house_details.user_id')
        ->where('house_details.user_id','=',$id)
        ->get();

        return response()->json([
            'status'=> 200,
            'bookingInfoForHost'=> $BookingInfo,
        ]);
    }

    public function getTotalBookedForAdmin()
    {
        $BookingInfo = DB::table('booking_info')
        ->join('house_details','booking_info.house_id',"=",'house_details.id')
        ->join('dineusers','dineusers.id','=','house_details.user_id')
        ->join('lnmo_api_response','lnmo_api_response.house_id','=','booking_info.house_id')
        ->get();

        return response()->json([
            'status'=> 200,
            'bookingInfoForAdmin'=> $BookingInfo,
        ]);
    }

    public function deleteCustomerBooking($id)
    {
        $BookingInfo = BookingInfo::find($id);

        $BookingInfo->delete();

        return response()->json([
            'status'=> 200,
            'message'=>'booking cancelled Successfully',
        ]);
    }


    public function deleteCustomerBookingTwo($id)
    {
        $BookingInfo = BookingInfo::find($id);

        $BookingInfo->delete();

        return response()->json([
            'status'=> 200,
            'message'=>'booking cancelled Successfully',
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SendMail;

class ContactController extends Controller
{
    //
    public function storeContactInfo(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $budget = $request->input('budget');
        $description = $request->input('description');
        $m_mail = "amosbillykipchumba@gmail.com";

        $msg = "Thank you for contacting us we will get back to you shortly.";

        SendMail::sendery($name,$email,$msg);

        $msg2 = "My name is $name, my email is $email. The project description is as follows: $description and $budget is my budget.";

        SendMail::Notif($name,$m_mail,$msg2);

        return response()->json([
            'status'=> 200,
            'message'=> "success"
        ]);
    }
}

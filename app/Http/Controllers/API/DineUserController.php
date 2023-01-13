<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\DineUser;
use App\Models\SendMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class DineUserController extends Controller
{
    //
    public function storeUser(Request $request)
    {
        $validator = FacadesValidator::make($request->all(), [
            'first_name'=>'required|max:30',
            'last_name'=>'required|max:30',
            'email'=>'required|email|max:50',
            'phone'=>'required|max:15',
            'password'=>'required|max:191',
            'host_id'=>'required|max:50',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'validate_err'=> $validator->getMessageBag(),

            ]);
        }
        else
        {
        $user = new DineUser;

            if($request->hasFile('image'))
            {
                $image = $request->file('image');
                $filename = Str::random(32).".".$image->getClientOriginalExtension();
                $image->move('users/', $filename);
            }
            $user->image = $filename;

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->phone = $request->input('phone');
        $user->host_id = $request->input('host_id');
        $user->user_type = 1;
        $user->save();

        $f_name = $request->input('first_name');
        $e_mail = $request->input('email');

        $msg = "Welcome, you have successfully registered an account at dineN'Stay";

        SendMail::sender($f_name,$e_mail,$msg);

        return response()->json([
            'status'=> 200,
            'message'=> 'Account created successfully'
        ]);
    }
    }


    public function storeVenturer(Request $request)
    {
        $validator = FacadesValidator::make($request->all(), [
            'first_name'=>'required|max:30',
            'last_name'=>'required|max:30',
            'email'=>'required|email|max:50',
            'phone'=>'required|max:15',
            'password'=>'required|max:191',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'validate_err'=> $validator->getMessageBag(),

            ]);
        }
        else
        {
        $user = new DineUser;
        if($request->hasFile('image'))
            {
                $image = $request->file('image');
                $filename = Str::random(32).".".$image->getClientOriginalExtension();
                $image->move('users/', $filename);
            }
            $user->image = $filename;
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->phone = $request->input('phone');
        $user->user_type = 2;
        $user->host_id = '00000';
        $user->save();

        $f_name = $request->input('first_name');
        $e_mail = $request->input('email');

        $msg = "Welcome, you have successfully registered an account at dineN'Stay";

        SendMail::sender($f_name,$e_mail,$msg);

        return response()->json([
            'status'=> 200,
            'message'=> 'Account created successfully'
        ]);
    }
    }


    public function forgotPassword($e_mail)
    {

        $admin= DineUser::where('email','=', $e_mail)->first();
        if(!$admin)
        {
            return response()->json([
                'status'=> 404,
                "error"=>"username or password is not matched"
            ]);
        }

        if($admin)
        {
            $token = Str::random(10);
            DB::table('password_resets')->insert(['email'=>$e_mail,'token'=>$token,'created_at'=>Carbon::now()]);

            // get token
            $passwordResets = DB::table('password_resets')->where('token',$token)->first();

            $rtoken = $passwordResets->token;


            // send mail,
            $user = DB::table('dineusers')->where('email','=',$e_mail)->first();
            $f_name = $user->first_name;
            $l_name = $user->last_name;

            $phone = $user->phone;
            $host_id = $user->host_id;
            $user_type = $user->user_type;
            $image = $user->image;
            $mailer = $e_mail;

            $msg = "Click the link below to reset your password. <a href='https://www.dinenstay.amosbilly.co.ke/password-reset?token={$rtoken}&email={$mailer}&first_name={$f_name}&last_name={$l_name}&phone={$phone}&host_id={$host_id}&user_type={$user_type}&image={$image}'>password reset</a>";

            SendMail::PassMe($f_name,$mailer,$msg);

            return response()->json([
                'status'=> 200,
                "message"=>"Check your email",
                'token'=>$passwordResets->token,
                'created_at'=> $passwordResets->created_at,
                'data'=>$admin,
                'first_name'=>$f_name,
            ]);
        }

    }

    public function getIn(Request $req)
    {
        $admin= DineUser::where('email',$req->email)->first();
        if(!$admin || !Hash::check($req->password, $admin->password))
        {
            return response()->json([
                'status'=> 404,
                "error"=>"username or password is not matched"
            ]);
        }
        return response()->json([
            'status'=> 200,
            'data'=>$admin
        ]);
    }


    public function getHostDetails($id)
    {
        $DineUser = DineUser::find($id);

        if($DineUser)
        {
            return response()->json([
                'status'=> 200,
                'host'=>$DineUser
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

    public function getHostSpecificDetails($id)
    {
        $DineUser = DineUser::find($id);

        if($DineUser)
        {
            return response()->json([
                'status'=> 200,
                'hostSpecific'=>$DineUser
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

    public function updateCustomerProfileDetails(Request $request, $user_id)
    {
        $DineUser = DineUser::where('id', $user_id)->first();
        if($DineUser)
        {
            if($request->hasFile('image'))
            {
                $path = 'users/'.$DineUser->image;
                if(File::exists($path))
                {
                    File::delete($path);
                }
                $image = $request->file('image');
                $filename = Str::random(32).".".$image->getClientOriginalExtension();
                $image->move('users/', $filename);
                $DineUser->image = $filename;
            }
            $DineUser->first_name = $request->input('first_name');
            $DineUser->last_name = $request->input('last_name');
            $DineUser->email = $request->input('email');
            $DineUser->phone = $request->input('phone');
            $DineUser->password = Hash::make($request->input('password'));
            $DineUser->update();

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

    public function updateForgottenPassword(Request $request, $e_mail)
    {
        $passwordResets = DB::table('password_resets')->where('token','=',$request->input('token'))->first();
        if($passwordResets) {
            $DineUser = DineUser::where('email', $e_mail)->first();
            if($DineUser)
            {
                if($request->hasFile('image'))
                {
                    $path = 'users/'.$DineUser->image;
                    if(File::exists($path))
                    {
                        File::delete($path);
                    }
                    $image = $request->file('image');
                    $filename = Str::random(32).".".$image->getClientOriginalExtension();
                    $image->move('users/', $filename);
                    $DineUser->image = $filename;
                }
                $DineUser->first_name = $request->input('first_name');
                $DineUser->last_name = $request->input('last_name');
                $DineUser->email = $request->input('email');
                $DineUser->phone = $request->input('phone');
                $DineUser->password = Hash::make($request->input('password'));
                $DineUser->host_id = $request->input('host_id');
                $DineUser->user_type = $request->input('user_type');
                $DineUser->update();

                return response()->json([
                    'status'=> 200,
                    'data'=>$DineUser,
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

    public function getAllHostDetails($id)
    {
        $DineUser = DineUser::where('user_type', $id)->get();
        if($DineUser)
        {
            return response()->json([
                'status'=> 200,
                'allHost'=>$DineUser
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

    public function getOneHostDetails($id)
    {
        $DineUser = DineUser::where('id', $id)->get();
        if($DineUser)
        {
            return response()->json([
                'status'=> 200,
                'oneHost'=>$DineUser
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

    public function deleteHost($id)
    {
        $DineUser = DineUser::find($id);

        $path1 = 'users/'.$DineUser->image;
        if(File::exists($path1))
        {
        File::delete($path1);
        }

        $DineUser->delete();

        return response()->json([
            'status'=> 200,
            'message'=>"account deleted successfully",
        ]);
    }

    public function deleteCustomer($id)
    {
        $DineUser = DineUser::find($id);

        $path1 = 'users/'.$DineUser->image;
        if(File::exists($path1))
        {
        File::delete($path1);
        }

        $DineUser->delete();

        return response()->json([
            'status'=> 200,
            'message'=>'account deleted Successfully',
        ]);
    }

    public function getHostJoinDetails($id)
    {
        $DineUser = DB::table('dineusers')
        ->join('house_details','dineusers.id',"=",'house_details.user_id')
        ->where('house_details.id',"=",$id)
        ->select('dineusers.*')
        ->get();

        return response()->json([
            'status'=> 200,
            'hostJoin'=>$DineUser,
        ]);
    }
}

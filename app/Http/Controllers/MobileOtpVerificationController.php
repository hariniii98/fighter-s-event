<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;


class MobileOtpVerificationController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function index(){

        $user=Auth::user();
        $user_mobile_number=$user->mobile_number;
        if($user->mobile_verified=='0'){
          return view('mobile-otp.mobile',compact('user_mobile_number'));
        }
        else{
          return redirect('/home');
        }





      }

      public function mobileOtpVerify(Request $request){



        if($request->verified==true){
          $id=auth()->user()->id; // user id

          $user=User::find($id);

          if(isset($user->mobile_number)==false){
            $user->mobile_number=$request->phone_number; // update the mobile number column
          }

          $user->mobile_verified='1'; // update the mobile verified column
          $user->save();

          return response()->json(array('success'=>true));
        }
        else{

          return response()->json(array('success'=>false));
        }

      }



}

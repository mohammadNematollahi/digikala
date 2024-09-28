<?php

namespace App\Http\Controllers\Auth;

use App\Models\OTP;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use App\Http\Requests\Auth\CustomerRequest;
use App\Http\Requests\Auth\CheckCodeRequest;
use App\Http\Services\Message\Email\SendMail;

class CustomerAuthController extends Controller
{
    public function __construct()
    {

        $this->middleware("guest")->except("logout");
        $this->middleware("auth")->only("logout");
        
    }
    public function loginRegister()
    {
        return view("customer.auth.login-register");
    }

    public function createOTPLoingRegister(CustomerRequest $request)
    {
        $input = $request->input("input");

        $type = null ;// 1 => email , 2 => phone
        $user = null ;
        $phone = null;
        $type_string = "";

        //if it was email
        if(filter_var($input, FILTER_VALIDATE_EMAIL))
        {
            $type = 1 ;
            $user = User::where("email" ,$input)->first();
        }

        //if it was mobile 9********

        elseif(preg_match("/0(9[0-9]{9})|\+[1-9]{2}(9\d{9})/" , $input , $phone)){

            $type = 2;
            $phone = $phone[1] ? $phone[1] : $phone[2];
            $user = User::where("mobile" , "0" . $phone)->first();

        }else{
            return back()->withErrors(["input" => "مقدار شما نه ایمیل است نه شماره موبایل لطفا مقدار درست را وارد کنید"]);
        }

        if(!$user){

            //check wich one is if it was type == 1 or type == 2 
            $type_string = $type == 1 ? "email" : "mobile";
            $input = $type == 1 ? $input : '0' . $phone;

            $user = User::create([$type_string => $input , "password" => Hash::make("User123*" , ['round' => 15]) , 'activation' => 1]);

        }

        $token = Str::random(60);
        $otp = rand(11111 , 99999);

        OTP::create([
            "token" => $token,
            "otp_code" => $otp,
            "input" => $input,
            "type" => $type,
            "user_id" => $user->id,
        ]);

        if($type == 1){

            $details = [
                "otp" => $otp
            ];
            $subjcet = "کد ارسالی برای ورود به وب سایت";

            $sendMail = new SendMail();
            $sendMail->setDetails($details);
            $sendMail->setSubject($subjcet);
            $sendMail->setFrom("zarghanbaner@gmail.com", "آمازون");
            $sendMail->setTo($user->email);
            $sendMail->send();

        }elseif($type == 2){
            //for send message
        }

        return redirect()->route("customer.send.code.login-register" , $token);

    }

    public function sendCode(OTP $token)
    {
        if(!$token){
            abort(404);
        }
        return view("customer.auth.send-code" ,  compact("token"));
    }

    public function checkCode(CheckCodeRequest $request)
    {
        $otp_code = $request->input("otp_code");

        $check_code = OTP::where(function($query) use($otp_code){
            $query->where("created_at" , ">=" , now()->addMinutes(-5))->where("otp_code" , $otp_code)->where("used" , 0);
        })->first();

        if(!$check_code){
            return redirect()->route("customer.login-register")->withErrors(["input" => "کد وارد شده نامعتبر است"]);
        }

        $check_code->update(["used" => 1]);
        $check_code->user->update(["email_verified_at" => Carbon::now()]);
        $user = $check_code->user;

        Auth::login($user);

        return redirect()->route("customer.home");
    }

    public function newCode(OTP $token)
    {
        $type = $token->type;
        $input = $token->input;
        $user = $token->user;
        $token = Str::random(60);
        $otp = rand(11111 , 99999);

        OTP::create([
            "token" => $token,
            "otp_code" => $otp,
            "input" => $input,
            "type" => $type,
            "user_id" => $user->id,
        ]);


        if($type == 1){

            $details = [
                "otp" => $otp
            ];
            $subjcet = "کد ارسالی برای ورود به وب سایت";

            $sendMail = new SendMail();
            $sendMail->setDetails($details);
            $sendMail->setSubject($subjcet);
            $sendMail->setFrom("zarghanbaner@gmail.com", "آمازون");
            $sendMail->setTo($user->email);
            $sendMail->send();

        }elseif($type == 2){
            
        }

        return redirect()->route("customer.send.code.login-register" , $token);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route("customer.home");
    }
}

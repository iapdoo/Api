<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTraits;
use Auth;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\JWTAuth;
use Validator;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    use GeneralTraits;

    public function login(Request $request)
    {
        try {
            $rules = [
                "email" => "required",
                "password" => "required"

            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            //login

            $credentials = $request->only(['email', 'password']);

            $token = Auth::guard('admin-api')->attempt($credentials);

            if (!$token)
                return $this->returnError('E001', 'بيانات الدخول غير صحيحة');

            $admin = Auth::guard('admin-api')->user();
            $admin->api_token = $token;
            //return token
            return $this->returnData('admin', $admin);

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
    public function logout( Request  $request){

        $token=$request->header('auth-token');
        if ($token){
            try {
                JWTAuth::setToken($token)->invalidate(); //logout user

            }catch (TokenInvalidException $e){
                return   $this->returnError('405','some ting went wrong');
            }
            return $this->returnSuccessMessage('تم تسجيل الخروج بنجاح','200');
        }else{
          return   $this->returnError('405','some ting went wrong');
        }
    }

}

<?php


namespace App\Http\Traits;


trait GeneralTraits
{
    public function returnError($errorNumber,$message)
    {
            return response()->json([
                'status'=>false,
                'ErrorNumber'=>$errorNumber,
                'Message'=>$message,
            ]);
    }
    public function ReturnSuccessMassage($message="",$ErrorNumber="5000"){
        return [
            'status'=>true,
            'errorNumber'=>$ErrorNumber,
            'Message'=>$message,
        ];
    }
    public function ReturnData($key,$value,$message=""){
        return [
            'status'=>true,
            'errorNumber'=>"5005",
            'Message'=>$message,
            $key=>$value,
        ];
    }
}

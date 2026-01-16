<?php

namespace App\services;

class ResponseSuccessOrFail
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function responseSucessOrfail($status,$message){
        return response()->json([
            "status" => $status,
            "message" => $message
        ]);
    }

    public function responseSucessOrfailAndData($status,$message,$data){
        return response()->json([
            "status" => $status,
            "message" => $message,
            "data" => $data
        ]);
    }
}

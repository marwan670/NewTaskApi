<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserValidator
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function validatorRegister(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            "password" => "required|min:6|max:23",
        ]);

        if($validator->fails()){
            return response()->json([
                "status" => 422,
                "errors" => $validator->errors()
            ]);
        }

        return null;
    }


    public function validatorLogin(Request $request){
        
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|exists:users',
            "password" => "required|min:6|max:23|confirmed",
        ]);

        if($validator->fails()){
            return response()->json([
                "status" => 422,
                "errors" => $validator->errors()
            ]);
        }

        return null;
    }
}

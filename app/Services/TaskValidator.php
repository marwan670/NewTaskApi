<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskValidator
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function TaskValidator(Request $request){
        $validator = Validator::make($request->all(), [
            "title" => "required|string",
            "description" => "required|string",
            "status" => "required|in:padding,in_progress,done",
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => 422,
                "errors" => $validator->errors()
            ]);
        }

        return null;
    }
}

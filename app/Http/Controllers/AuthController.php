<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\UserInterface;
use App\services\ResponseSuccessOrFail;
use App\Services\UserValidator;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(
        protected UserInterface $user_interface,
        protected ResponseSuccessOrFail $response,
        protected UserValidator $validate
    ) {}

    public function register(Request $request)
    {

        $validator = $this->validate->validatorRegister($request);
        if ($validator) {
            return $validator;
        }

        $user = $this->user_interface->create($request->all());

        $token = $user->createToken($request->name);

        return $this->response->responseSucessOrfailAndData(200, "success", $token->plainTextToken);
    }

    public function login(Request $request)
    {

        $validator = $this->validate->validatorLogin($request);
        if ($validator) {
            return $validator;
        }

        $user = $this->user_interface->checkUserExists($request->all());

        if (!$user) {
            return response()->json([
                "status" => 404,
                "message" => "Password Not Correct.."
            ]);
        }

        $token = $user->createToken($user->name);

        return $this->response->responseSucessOrfailAndData(200, "success", $token->plainTextToken);
    }

    public function logout(Request $request)
    {

        $request->user()->tokens()->delete();

        return $this->response->responseSucessOrfail(200, "success");
    }
}

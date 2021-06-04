<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api',['except' => ['login','register']]);
    }


    public function login(Request $req)
    {
        $credentials = $req->only('email', 'password');

            try {
                if (! $token = JWTAuth::attempt($credentials)) {
                    return response()->json(['error' => 'invalid_credentials'], 400);
                }
            } catch (JWTException $e) {
                return response()->json(['error' => 'could_not_create_token'], 500);
            }

            return response()->json(compact('token'));
    
    }

    protected function reponseWithToken($token)
    {
       return response()->json([
           'token' => $token,
           'token_type' => 'Bearer',
        //    'token_validity' => $this->guard()->factory()->getTTL() * 60,

       ]);
    }

    public function register()
    {
        # code...
    }

    public function logout()
    {
        # code...
    }

    public function profile()
    {
        # code...
    }

    protected function guard()
    {
       return Auth::guard();
    }
}

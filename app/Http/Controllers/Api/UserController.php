<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserSignin;
use App\Http\Requests\UserSignup;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function UserRegister(UserSignup $req)
    {
        $req->validated();
        $data = $req->all();
        $data['password'] = Hash::make($req['password']);
        $user = User::create($data);
        if ($user) {
            $res_sms = [
                'status' => 'succesfull',
                'message' => 'user imported succesfully',
                'data' => $user,
            ];
            return response($res_sms, 200);
        } else {
            return response()->json([
                'status' => 'succesfull',
                'message' => 'user imported succesfully',
            ]);
        }
    }
    public function UserLogin(UserSignin $req)
    {
        $req->validated();
        // Checking email & passwor credentials
        $credentials = [
            'email' => $req->email,
            'password' => $req->password,
        ];
        if (Auth::attempt($credentials)) {
            $user = Auth::User();
            $tokengen = $user->createToken('MyToken')->accessToken;
            return response()->json(
                [
                    'status' => 'Success',
                    'message' => 'Login success',
                    'login' => true,
                    'data' => $user,
                    'token' => $tokengen,
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => 'Unsuccess to login',
                    'message' => 'Login failed ',
                ],
                401
            );
        }
    }

    public function UserLogout(Request $req)
    {
        $token = $req->user()->token();
        $token->revoke();

        $response = [
            'status' => 'success',
            'message' => 'You have been successfully logged out!',
        ];
        return response($response, 200);
    }
}

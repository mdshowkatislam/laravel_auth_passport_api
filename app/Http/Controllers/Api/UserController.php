<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function UserRegister(Request $req)
    {
        $val_data = Validator::make($req->all(), [
            'first_name' => 'required|string|max:20',
            'last_name' => 'required|string|max:20',
            'email' => 'required|string|email|unique:users',
            'phone' => 'required|string|unique:users|digits:8',
            'password' => 'required|string|min:8|confirmed',
            // 'password_confirmation' => 'required|min:8',
        ]);
        if ($val_data->fails()) {
            $res_sms = [
                'status' => 'Unsuccessed',
                'message' => 'validation failed for you',
                'validation-errors' => $val_data->errors()->all(),
            ];
            return response($res_sms, 422);
        }
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
    public function UserLogin(Request $req)
    {
        dd($req->all());
    }
    public function UserLogout(Request $req)
    {
        dd($req->all());
    }
}

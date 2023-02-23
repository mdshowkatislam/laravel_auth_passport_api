<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function UserRegister(Request $req)
    {
        dd($req->all());
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

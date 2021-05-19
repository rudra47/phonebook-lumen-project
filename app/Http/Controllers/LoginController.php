<?php

namespace App\Http\Controllers;

use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use App\Models\UserRegistration;

class LoginController extends Controller
{
    public function onLogin(Request $request)
    {
        $username  = $request->username;
        $password  = $request->password;

        $result = UserRegistration::where(['username' => $username, 'password' => $password])->count();
        if ($result == 1) {
            $key = env('TOKEN_KEY');
            $payload = array(
                "authority" => "http://author.org",
                "username" => $username,
                "iat" => time(),
                "exp" => time()+3600
            );

            $jwt = JWT::encode($payload, $key);

            return response()->json([
                'Token'  => $jwt,
                'Status' => "Login Success"
            ]);
        }else{
            return "Username or Password not match";
        }
    }
}

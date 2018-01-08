<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;


class AdminController extends BaseController
{
    public function signin(Request $request) {
        $params = $request->all();
        $credentials = [
            'email' => byString($params, 'email'), 
            'password' => byString($params, 'password'),
        ];

        $user = User::where("email", $credentials['email'])->first();

        if(!$user){
            error('Wrong Username Or Password', 'redirect');
        }

        if(!Hash::check($credentials['password'], $user->password)) {
            error('Wrong Username Or Password', 'redirect');
        }

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::fromUser($user)) {
                error('Authentication Failed', 'redirect');
            }

        } catch (JWTException $e) {
            error('Unable to Generate Login Tokens', 'redirect');
        }

        return $token;
    }
}

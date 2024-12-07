<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function login(LoginRequest $request)
    {
        $login_data = $request->validated();

        if (Auth::attempt($login_data)) {


            // $user = User::where('email', $login_data['email'])->first();

            /**
             * @var \App\Models\User $user
             */

            $user = Auth::user();

            $token = $user->createToken('login', ['*'], now()->addSeconds(30))->plainTextToken;

            return ['user' => $user, 'token' => $token];


        } else {
            return 'No';
        }
    }
}

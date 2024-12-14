<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

            $token = $user->createToken('desktop-login', $user->roles, now()->addHours(30))->plainTextToken;


            return ['user' => $user, 'token' => $token];


        } else {
            return 'No';
        }
    }

    function logout()
    {
        return auth()->user()->currentAccessToken()->delete();
    }

    function logout_all()
    {
        return auth()->user()->tokens()->delete();
    }

    function change_password(Request $request)
    {

        $validated = $request->validate([
            'current_password' => 'required|min:8|max:20',
            'password' => 'required|min:8|max:20|confirmed',
        ]);


        // Get the loggedin user

        $user = Auth()->user();

        // Check current user password
        $matched = Hash::check($validated['current_password'], $user->password);

        if ($matched) {
            // Update the current password

            $user->password = Hash::make($validated['password']);

            // Save the changes
            if ($user->save()) {
                // logout from everywhere
                // return auth()->user()->tokens()->delete();
                self::logout_all();
            }

        }

        return 'Your current password is incorrect';
 
    }



}

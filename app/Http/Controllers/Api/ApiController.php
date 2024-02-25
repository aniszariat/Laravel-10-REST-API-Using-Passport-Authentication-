<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    //post
    public function register(Request $request)
    {
        // data validation
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|confirmed",
        ]);

        // cearte user in db users table
        $user = User::create(
            [
                "name" => $request->name,
                "email" => $request->email,
                "password" => Hash::make($request->password),
            ]
        );

        return
            response()->json(
                [
                    "status" => true,
                    "message" => "user created successfully",
                    "user" => $user
                ]
            );
    }

    //post
    public function login(Request $request)
    {
        // validate creds
        $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);

        // check if user exits
        if (Auth::attempt([
            "email" => $request->email,
            "password" => $request->password
        ])) {
            $user = Auth::user();
            $toekn = $user->createToken("myTkon")->accessToken;

            return response()->json([
                "status" => true,
                "user" => $user,
                "token" => $toekn
            ]);
        }
        return response()->json([
            "status" => false,
            "message" => "invalid credentials"
        ]);
    }
    //get
    public function profile()
    {
    }
    //get
    public function logout()
    {
    }
}

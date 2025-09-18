<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request){
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
    
        $user = User::where('email', $fields['email'])->first();

        if(!$user){
            return response(['message' => 'Wrong email'], status: 401);
        }

        if (!Hash::check($fields['password'], $user->password)) {
            return response(['message' => 'Wrong password'], status: 401);
        }

        $token = $user->createToken('myaptoken')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response, status: 201);
    }

    public function logout(Request $request)
        {
            auth()->user()->tokens()->delete();
            
            return response([
                'message' => 'Logged out'
            ]);
        }
    public function user(Request $request)
        {
            return response($request->user());
        }
}

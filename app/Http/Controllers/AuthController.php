<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        $request->validate([
            'name'=> 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password); 
        $user->save();

        $token = $user->createToken('api_token')->plainTextToken;
        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email'=> 'required',
            'password'=>'required',
        ]);

        if (!Auth::attempt($credentials)){
                return response()->json(['message' => 'Invalid Credentials'],401);
        }

        $user = Auth::user();
        $token = $user->createToken('api_token')->plainTextToken;

            return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
}

public function logout(Request $request)  {
    $request->user()->currentAccessToken()->delete();

return response()->json([
    'message' => 'Logged Out'
]);
}

}

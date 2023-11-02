<?php

namespace App\Http\Controllers\api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken($request->deviceName)->plainTextToken;
    
            return response()->json(['token' => $token, 'role'=>$user->type, 'id'=>$user->id], 200);
        }
    
        return response()->json(['message' => 'Invalid credentials'], 401);
    }
    
    
    public function logout(Request $request)
    {
        $user = $request->user();
    
        if ($user) {
            $user->currentAccessToken()->delete();
            return response()->json(['message' => 'Successfully logged out'], 200);
        }
    
        return response()->json(['message' => 'User not authenticated'], 401);
    }

}

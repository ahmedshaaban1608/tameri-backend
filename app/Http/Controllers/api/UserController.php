<?php

namespace App\Http\Controllers\api;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use  Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        {
            $users = User::all();
    
            return response()->json([
                'data' => $users,
            ]);
        }
        }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        
$validator = Validator::make($request->all(), [
    'name' => 'required',
    'email' => 'required|email|unique:users',
    'password' => 'required|min:6',
    'type' => 'required|string',
]);

if ($validator->fails()) {
    return response()->json([
        'errors' => $validator->errors(),
    ]);
}

// Create a new user
$user = User::create([
    'name' => $request->name,
    'email' => $request->email,
    'password' => Hash::make($request->password),
    'type' => $request->type,
]);

// Return the user
return response()->json([
    'data' => $user,
]);
}

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json([
            'data' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
         // Validate the request data
         $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ]);
        }

        // Update the user
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Return the user
        return response()->json([
            'data' => $user,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Delete the user
        $user->delete();

        // Return a success message
        return response()->json([
            'message' => 'User deleted successfully.',
        ]);
    
    }
}

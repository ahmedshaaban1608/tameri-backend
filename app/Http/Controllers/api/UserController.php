<?php

namespace App\Http\Controllers\api;

use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show', 'store']);
    }
    public function index()
    {
        try {
            $users = UserResource::collection(User::all());
            return response()->json(['data' => $users], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'An error occurred while retrieving the data.'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'type' => 'required|string|in:tourist,hotel,tourguide',
        ]);

        try {
            // Create a new user
            $user = User::create($request->all());
            // Return the user
            return response()->json(['data' => new UserResource($user)], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'An error occurred while creating the user'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json(new UserResource($user), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user)],
            'password' => 'required|min:6',
        ]);


        try {
            $user->update($request->all());
            // Return the user
            return response()->json(["message" => "user updated successfully", 'data' => new UserResource($user)], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'An error occurred while updating the user'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            // Delete the user
            $user->delete();
            // Return a success message
            return response()->json(['message' => 'User is deleted successfully.']);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'An error occurred while deleting the user'], 500);
        }

    }
}

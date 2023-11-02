<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {
            $users = UserResource::collection(User::all());
            return response()->json(['data' => $users], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'An error occurred while retrieving the data.'], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'type' => 'required|string|in:tourist,hotel,tourguide,admin',
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
    // public function show(User $user)
    // {
    //     //
    // }
    public function show()
{
<<<<<<< HEAD
<<<<<<< HEAD
    return response()->json(new UserResource($user), 200);
=======
    $users = User::all(); 

    return view('Dashboard.users', ['users' => $users]);
>>>>>>> 38bd3d0f367c13bd4e027d09a89b2a0ba795fe16
=======
    $users = User::all(); 

    return view('Dashboard.users', ['users' => $users]);
>>>>>>> 38bd3d0f367c13bd4e027d09a89b2a0ba795fe16
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user)],
            'password' => 'required|min:6',
            'type' => 'required|string|in:tourist,hotel,tourguide,admin',
        ]);




        try {
            // Update the user
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
        //
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

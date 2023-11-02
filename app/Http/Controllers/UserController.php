<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct(){
        $this->middleware('auth');
    }
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

        // try {
        //     // Create a new user
        //     $user = User::create($request->all());
        //     // Return the user
        //     return response()->json(['data' => new UserResource($user)], 200);
        // } catch (\Throwable $th) {
        //     return response()->json(['message' => 'An error occurred while creating the user'], 500);
        // }
    }

    /**
     * Display the specified resource.
     */
    // public function show(User $user)
    // {
    //     //
    // }
    public function show(User $user)
{


    return view('Dashboard.users', ['users' => $user]);

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

        try {
            if (Gate::allows('is-admin')) {
            // Update the user
            $user->update($request->all());
            // Return the user
            return response()->json(["message" => "user updated successfully", 'data' => new UserResource($user)], 200);
            }
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
            if (Gate::allows('is-admin')) {
            // Delete the user
            $user->delete();
            // Return a success message
            return response()->json(['message' => 'User is deleted successfully.']);
        }
        } catch (\Throwable $th) {
            return response()->json(['message' => 'An error occurred while deleting the user'], 500);
        }
    }
}

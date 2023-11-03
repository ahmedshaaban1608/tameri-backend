<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


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
            $users = UserResource::collection(User::paginate(20));
            return view('User.index', ['data' => $users]);


        } catch (\Throwable $th) {
            return abort(500, 'An error occurred while retrieving the data.');

        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('User.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try {
            if (Gate::allows('is-admin')) {
                $user = User::create($request->all());
                return to_route('User.index');
            } else {
                return abort(403, 'You are not allowed to create User.');

            }

        } catch (\Exception $e) {
            return abort(500, 'An error occurred while creating the User.');

        }


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

    try {
        return view('User.show', ['data' => new UserResource($user)]);
    } catch (\Exception $e) {
        return abort(500, 'An error occurred while retrieving the data.');
    }


}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
        try {
            if (Gate::allows('is-admin')) {
                return view('User.edit', ['data'=> $user]);
            } else{
                return abort(403, 'You are not allowed to edit this user.');
            }
        } catch (\Throwable $th) {
            return abort(500, 'An error occurred while retrieving the data.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            if (Gate::allows('is-admin')) {
                    $user->update($request->all());
                    return to_route('User.index');

            } else {
                return abort(403, 'You are not allowed to update user.');

            }
        } catch (\Exception $e) {
            return abort(500, 'An error occurred while updating the user.');

        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            if (Gate::allows('is-admin')) {

                    $user->delete();
                    return to_route('User.index');
            } else {
                return abort(403, 'You are not allowed to delete user.');
            }
        } catch (\Exception $e) {
            return abort(500, 'An error occurred while deleting the user.');

        }

    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Tourguide;
use App\Models\Tourist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct(){
        // $this->middleware('auth');
        $this->middleware(['auth','isadmin']);

    }
    public function index()
    {
        try {
            $users = UserResource::collection(User::paginate(10));
            return view('Dashboard.admin', ['users' => $users]);
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
    
    public function show($id)
{
    try {
        $user = User::findOrFail($id);
        return view('User.show', ['user' => $user]);
    } catch (\Exception $e) {
        return abort(500, 'An error occurred while retrieving the data.');
    }


}


    /**
     * Show the form for editing the specified resource.
     */
    /**
     * Update the specified resource in storage.
     */
   

    public function edit($id)
{
    try {
        if (Gate::allows('is-admin')) {
            $user = User::find($id);
            if ($user) {
                return view('User.edit', ['user' => $user]);
            } else {
                return redirect()->route('users')->with('error', 'User not found.');
            }
        } else {
            return abort(403, 'You are not allowed to edit this user.');
        }
    } catch (\Throwable $th) {
                return abort(500, 'An error occurred while retrieving the data.');
            }
}

public function update(Request $request, $id)
{
    try {
        $user = User::find($id);
        if ($user) {
            if (Gate::allows('is-admin')) {
                $user->update([
                    'type' => $request->input('type'),
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                ]);

                return back()->with('success', 'Tourguide updated successfully.');
            } else {
                return abort(403, 'You are not allowed to update the tourguide.');
            }
        } else {
            return back()->with('error', 'Tourguide not found.');
        }
    } catch (\Exception $e) {
        return back()->with('error', 'An error occurred while updating the tourguide.');
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            if (Gate::allows('is-admin')) {
                $user = User::findOrFail($id);
                $user->delete();
    
                $tourguide = Tourguide::where('id', $id)->first();
                if ($tourguide) {
                    $tourguide->delete();
                }
               
                $tourist = Tourist::where('id', $id)->first();
                if ($tourist) {
                    $tourist->delete();
                }
    
                return back()->with('success', 'User deleted successfully.');
            } else {
                return abort(403, 'You are not allowed to delete the user.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while deleting the user.');
        }
    }
    
    
}

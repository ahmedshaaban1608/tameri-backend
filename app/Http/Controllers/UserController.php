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
    }

    /**
     * Display the specified resource.
     */
    // public function show(User $user)
    // {
    //     //
    // }
//     public function show()
// {
//     $users = User::all(); 

//     return view('Dashboard.users', ['users' => $users]);
// }
// public function show(User $user)
// {
//     return view('Dashboard.users', compact('user'));
// }


public function show($id)
{
    $user = User::find($id);
    return view('Dashboard.user.showUser', ['user' => $user]);
}


    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(User $user)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(UpdateUserRequest $request, User $user)
    // {
    //     //
    // }
    public function edit($id)
    {
           $user = User::find($id);
        return view('Dashboard.user.editUser', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
    
        if ($user) {
            $user->update([
                'type' => $request->input('type'),
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                
            ]);
    
            return redirect()->route('users')->with('success', 'user updated successfully.');
        } else {
            return redirect()->back()->with('error', 'user not found.');
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}

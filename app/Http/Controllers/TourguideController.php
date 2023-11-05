<?php

namespace App\Http\Controllers;
use App\Models\Tourguide;
use App\Http\Resources\TourguideResource;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTourguideRequest;
use App\Http\Requests\UpdateTourguideRequest;
use Illuminate\Support\Facades\Gate;

class TourguideController extends Controller
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

            $tourguides = TourguideResource::collection(Tourguide::paginate(20));
           
            return view('Dashboard.admin', ['tourguides' => $tourguides]);
        } catch (\Exception $e) {
            return abort(500, 'An error occurred while retrieving the data.');
    }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Tourguide.create');
        //
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTourguideRequest $request)
    {
        try {
            if (Gate::allows('is-admin')) {
                $data = $request->all();
                $user = User::create([
                    'type' => 'tourguide',
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => $data['password']
                ]);
                $data['id'] = $user->id;
                $tourist = Tourguide::create($data);
                return route('Tourguide.index');
            } else {
                return abort(403, 'You are not allowed to create tourguide.');

            }

        } catch (\Exception $e) {
            return abort(500, 'An error occurred while creating the tourguide.');

        }
    }

    /**
     * Display the specified resource.
     */
    

    /**
     * Show the form for editing the specified resource.
     */
    public function show($id)
{
    try {
        $tourguide = Tourguide::findOrFail($id);
        $user = $tourguide->user; 
        return view('Tourguide.show', ['tourguide' => $tourguide , 'user' => $user]);
    } catch (\Exception $e) {
        return abort(500, 'An error occurred while retrieving the data.');
    }
}
    
    /**
     * Update the specified resource in storage.
     */
    public function edit($id)
    {
        try {
            if (Gate::allows('is-admin')) {
                $tourguide = Tourguide::find($id);
                if ($tourguide) {
                    return view('Tourguide.edit', ['tourguide' => $tourguide]); 
                } else {
                    return redirect()->route('users')->with('error', 'User not found.');
                }
            } else {
                return abort(403, 'You are not allowed to edit this user.');
            }
        } catch (\Exception $e) {
            return abort(500, 'An error occurred while retrieving the data.');
        }
    }
    
    
public function update(Request $request, $id)
{
    try {
        $tourguide = Tourguide::findOrFail($id);

        if ($tourguide) {
            if (Gate::allows('is-admin')) {
                $tourguide->update([
                    'description' => $request->input('description'),
                    'bio' => $request->input('bio'),
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
                $tourguide = Tourguide::findOrFail($id);
                $tourguide->delete();
                $user = User::findOrFail($id);
                $user->delete();
                return back()->with('success', 'Tourguide deleted successfully.');
            } else {
                return abort(403, 'You are not allowed to delete tourguide.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while deleting the tourguide.');
        }
    }
    
    

}

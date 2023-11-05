<?php

namespace App\Http\Controllers;

use App\Http\Resources\TouristResource;
use App\Models\Tourist;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTouristRequest;
use App\Http\Requests\UpdateTouristRequest;
use Illuminate\Support\Facades\Gate;


class TouristController extends Controller
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

            $tourists = TouristResource::collection(Tourist::paginate(20));
            return view('Dashboard.admin', ['tourists' => $tourists]);
        } catch (\Exception $e) {
            return abort(500, 'An error occurred while retrieving the data.');
    }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('Tourist.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTouristRequest $request)
    {
        try {
            if (Gate::allows('is-admin')) {
                $data = $request->all();
                $user = User::create([
                    'type' => 'tourist',
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => $data['password']
                ]);
                $data['id'] = $user->id;
                $tourist = Tourist::create($data);
                return to_route('Tourist.index');
            } else {
                return abort(403, 'You are not allowed to create tourist.');

            }

        } catch (\Exception $e) {
            return abort(500, 'An error occurred while creating the tourist.');

        }

    }

    /**
     * Display the specified resource.
     */

    public function show($id)
    {
        try {
            $tourist = Tourist::findOrFail($id);
            return view('Tourist.show', ['tourist' => $tourist]);
        } catch (\Exception $e) {
            return abort(500, 'An error occurred while retrieving the data.');
        }
    }
    

    /**
     * Show the form for editing the specified resource.
     */
   
    public function edit($id)
    {
        try {
            if (Gate::allows('is-admin')) {
                $tourist = Tourist::find($id);
                if ($tourist) {
                    return view('Tourist.edit', ['tourist' => $tourist]); 
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
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $tourist = Tourist::find($id);
    
            if ($tourist) {
                if (Gate::allows('is-admin')) {
                    $tourist->update([
                        'country' => $request->input('country'),
                        'gender' => $request->input('gender'),
                        'avatar' => $request->input('avatar'),
                        'phone' => $request->input('phone'),
                    ]);
                    return back()->with('success', 'Tourist updated successfully.');
                    } else {
                    return abort(403, 'You are not allowed to update the tourist.');
                }
            } else {
                return redirect()->back()->with('error', 'Tourist not found.');
            }
        } catch (\Exception $e) {
            return abort(500, 'An error occurred while updating the tourist.');
        }
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            if (Gate::allows('is-admin')) {
                $tourist = Tourist::findOrFail($id);
                $tourist->delete();
                $user = User::findOrFail($id);
                $user->delete();
                return back()->with('success', 'Tourist deleted successfully.');
            } else {
                return abort(403, 'You are not allowed to delete tourist.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while deleting the tourist.');
        }
    }
    

}


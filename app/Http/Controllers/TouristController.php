<?php

namespace App\Http\Controllers;

use App\Http\Resources\TouristDataResource;
use App\Http\Resources\TouristResource;
use App\Models\Tourist;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAreaRequest;
use App\Http\Requests\UpdateAreaRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
            $tourists = TouristResource::collection(Tourist::all());
            return response()->json(['data' => $tourists], 200);
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
    public function store(StoreAreaRequest $request)
    {
     
        // $data = $request->all();


        // try {
        //     $user = User::create([
        //         'type' => 'tourist',
        //         'name' => $data['name'],
        //         'email' => $data['email'],
        //         'password' => $data['password']
        //     ]);
        //     $data['id'] = $user->id;
        //     $tourist = Tourist::create($data);
        //     return response()->json(['data' => new TouristDataResource($tourist)], 200);
        // } catch (\Throwable $th) {
        //     return response()->json(['message' => 'An error occurred while creating the tourist', 'error' => $th], 500);
        // }
    }

    /**
     * Display the specified resource.
     */
    // public function show(Tourist $tourist)
    // {
    //     //
    // }
    public function show(Tourist $tourist)
    {
        return view('Dashboard.tourists', ['tourists' => $tourist]);
    }
 
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tourist $tourist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAreaRequest $request, Tourist $tourist)
    {
       
        try {
            if (Gate::allows('is-admin')) {

                    $tourist->update($request->all());
                    // Return the tourist
                    return response()->json(['data' => new TouristDataResource($tourist)], 200);
                } else {
                    return response()->json(['message' => 'You are not allowed to update this tourist.'], 403);
                }

        } catch (\Throwable $th) {
            return response()->json(['message' => 'An error occurred while updating the tourist'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tourist $tourist)
    {
        //
        try {
            // Delete the tourist
            if (Gate::allows('is-admin')) {
                    $tourist->delete();

                    // Return a success message
                    return response()->json([
                        'message' => 'Tourist deleted successfully.'
                    ], 200);
                } else {
                    return response()->json(['message' => 'You are not allowed to delete this tourist.'], 403);
                }
        } catch (\Throwable $th) {
            return response()->json(['message' => 'An error occurred while deleting the tourist'], 500);
        }
    }
}

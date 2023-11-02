<?php

namespace App\Http\Controllers;

use App\Http\Resources\TourguideDataResource;
use App\Http\Resources\TourguideResource;
use App\Models\Tourguide;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAreaRequest;
use App\Http\Requests\UpdateAreaRequest;
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
            $tourguide = TourguideResource::collection(Tourguide::all());
            return response()->json(['data' => $tourguide], 200);
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
            //         'type' => 'tourguide',
            //         'name' => $data['name'],
            //         'email' => $data['email'],
            //         'password' => $data['password']
            //     ]);
            //     $data['id'] = $user->id;
            //     $tourist = Tourguide::create($data);
            //     return response()->json(['data' => new TourguideDataResource($tourist)], 200);
            // } catch (\Throwable $th) {
            //     return response()->json(['message' => 'An error occurred while creating the tourist', 'error'=> $th], 500);
            // }

    }

    /**
     * Display the specified resource.
     */
    // public function show(Tourguide $tourguide)
    // {
    //     //
    // }
    public function show(Tourguide $tourguide)
    {

        return view('Dashboard.tourguides', ['tourguides' => $tourguide]);
    }
 
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tourguide $tourguide)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAreaRequest $request, Tourguide $tourguide)
    {
        

            try {
                if (Gate::allows('is-admin')) {


                        $tourguide->update($request->all());
                        return response()->json(['message' => 'Tourguide updated successfully', 'data' => new TourguideDataResource($tourguide)], 200);

                    } else {
                        return response()->json(['message' => 'You are not allowed to update this tourguide.'], 403);
                    }

            } catch (\Throwable $th) {
                return response()->json(['error' => 'An error occurred while updating the tourguide'], 500);
            }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tourguide $tourguide)
    {
        //
        try {
            if (Gate::allows('is-admin')) {

                    $tourguide->delete();
                    return response()->json([
                        'message' => 'Tourguide deleted successfully.'
                    ], 200);
                } else {
                    return response()->json(['message' => 'You are not allowed to delete this tourguide.'], 403);
                }

        } catch (\Throwable $th) {
            return response()->json(['message' => 'An error occurred while deleting the tourguide'], 500);
        }
    }
}

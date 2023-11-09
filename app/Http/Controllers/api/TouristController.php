<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\StoreTouristRequest;
use App\Http\Requests\UpdateTouristRequest;
use App\Http\Resources\TouristDataResource;
use App\Http\Resources\TouristResource;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Tourist;



class TouristController extends Controller
{
    function __construct()
    {
        $this->middleware('auth:sanctum')->except(['store']);
    }
    public function index()
    {

        try {
            $tourists = TouristResource::collection(Tourist::all());
            return response()->json(['data' => $tourists], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'An error occurred while retrieving the data.'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTouristRequest $request)
    {

        $data = $request->all();

        try {
            $user = User::create([
                'type' => 'tourist',
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password']
            ]);
            $data['id'] = $user->id;
            $tourist = Tourist::create($data);
            return response()->json(new TouristDataResource($tourist), 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'An error occurred while creating the tourist', 'error' => $th], 500);
        }
    }


    public function show(Tourist $tourist)
    {

        // Return the tourist
        return response()->json(new TouristDataResource($tourist), 200);
    }

    public function update(UpdateTouristRequest $request, Tourist $tourist)
    {
        try {
            if (Gate::allows('is-tourist')) {
                $currentUser = auth()->user();
                $oldAvatar = $tourist->avatar;
                if ($tourist->id === $currentUser->id) {
                    $user = User::findOrfail($currentUser->id);
                    $data = $request->all();
                    
                    // Update the "name" field
                    if (isset($data['name'])) {
                        $user->update(['name' => $data['name']]);
                    }
    
                    // Update the "phone" field
                    if (isset($data['phone'])) {
                        $tourist->update(['phone' => $data['phone']]);
                    }
    
                    // Update the "avatar" field if it's present
                    if ($request->hasFile('avatar')) {
                        $file = $request->file('avatar');
                        $filename = time() . $file->getClientOriginalName();
                        $file->move(public_path('img'), $filename);
                        $tourist->update(['avatar' => $filename]);
                       try {
                        if (!Str::startsWith($oldAvatar, 'http') && isset($oldAvatar)) {
                            $avatarPath = public_path('img/' . $oldAvatar);
                            if (file_exists($avatarPath)) {
                                unlink($avatarPath);
                                
                            }
                        }
                       } catch (\Throwable $th) {
                        //throw $th;
                       }
                    }
    
                    return response()->json(new TouristDataResource($tourist), 200);
                }
            } else {
                return response()->json(['message' => 'You are not allowed to update this tourist.'], 403);
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => $th], 500);
        }
    }
    

    public function destroy(Tourist $tourist)
    {
        try {
            // Delete the tourist
            if (Gate::allows('is-admin')) {
                $user = auth()->user();
                if ($tourist->id === $user->id) {

                    // $tourist->delete();

                    // Return a success message
                    return response()->json([
                        'message' => 'Tourist deleted successfully.'
                    ], 200);
                }
            } else {
                return response()->json(['message' => 'You are not allowed to delete this tourist.'], 403);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => 'An error occurred while deleting the tourist'], 500);
        }
    }
}

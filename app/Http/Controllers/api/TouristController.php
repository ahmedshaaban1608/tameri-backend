<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\StoreTouristRequest;
use App\Http\Requests\UpdateTouristRequest;
use App\Http\Resources\TouristDataResource;
use App\Http\Resources\TouristResource;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Tourist;
use Illuminate\Http\Request;


class TouristController extends Controller
{
    function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show', 'store']);
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
            return response()->json(['data' => new TouristDataResource($tourist)], 200);
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
                $user = auth()->user();
                if ($tourist->id === $user->id) {
                    $tourist->update($request->all());
                    // Return the tourist
                    return response()->json(['data' => new TouristDataResource($tourist)], 200);
                }
            } else {
                return response()->json(['message' => 'You are not allowed to update this tourist.'], 403);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => 'An error occurred while deleting the tourist'], 500);
        }
    }

    public function destroy(Tourist $tourist)
    {
        try {
            // Delete the tourist
            if (Gate::allows('is-admin')) {
                $user = auth()->user();
                if ($tourist->id === $user->id) {

                    $tourist->delete();

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

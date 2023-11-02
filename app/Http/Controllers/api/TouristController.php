<?php

namespace App\Http\Controllers\api;

use App\Http\Resources\TouristDataResource;
use App\Http\Resources\TouristResource;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Tourist;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTouristRequest;
use App\Http\Requests\UpdateTouristRequest;

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

        $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/^[a-zA-Z]{3,}(?:\s[a-zA-Z]{3,})*$/',
            'email' => 'required|unique:users|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'password' => 'required|min:6|max:15',
            'country' => 'required|string',
            'gender' => 'required|string|in:male,female',
            'phone' => 'required|unique:tourists|regex:/^\+?\d{7,14}$/',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
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

    public function update(Request $request, Tourist $tourist)
    {

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'country' => 'required|string',
            'gender' => 'required|string|in:male,female',
            'phone' => ['required', 'regex:/^\+?\d{7,14}$/', Rule::unique('tourists')->ignore($tourist)],
        ]);




        try {
            if (Gate::allows('is-tourist')) {
                $user = auth()->user();
                if ($tourist->id === $user->id) {
                    $tourist->update($request->all());
                    // Return the tourist
                    return response()->json(['data' => new TouristDataResource($tourist)], 200);
                } else {
                    return response()->json(['message' => 'You are not allowed to update this tourist.'], 403);
                }
            } else {
                return response()->json(['message' => 'You are not allowed to update this tourist.'], 403);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => 'An error occurred while updating the tourist'], 500);
        }

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
            return response()->json(['message' => 'An error occurred while updating the tourist'], 500);
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

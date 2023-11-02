<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TourguideDataResource;
use App\Http\Resources\TourguideResource;
use App\Models\Tourguide;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TourguideController extends Controller
{
    function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show', 'store']);
    }
    public function index()
    {
        try {
            $tourguide = TourguideResource::collection(Tourguide::all());
            return response()->json(['data' => $tourguide], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'An error occurred while retrieving the data.'], 500);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/^[a-zA-Z]{3,}(?:\s[a-zA-Z]{3,})*$/',
            'email' => 'required|unique:users|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'password' => 'required|min:6|max:15',
            'birth_date' => 'required|date',
            'gender' => 'required|string|in:male,female',
            'phone' => 'required|unique:tourguides|regex:/^\+?\d{7,14}$/',
            'bio' => 'required|min:10|max:50',
            'description' => 'required|min:100|max:1000',
            'day_price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ],422);
        }
        $data = $request->all();

        try {

            $user = User::create([
                'type' => 'tourguide',
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password']
            ]);
            $data['id'] = $user->id;
            $tourist = Tourguide::create($data);
            return response()->json(['data' => new TourguideDataResource($tourist)], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'An error occurred while creating the tourist', 'error'=> $th], 500);
        }

    }

    public function show(Tourguide $tourguide)
    {
        return response()->json(new TourguideDataResource($tourguide), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tourguide $tourguide)
    {
        $validator = Validator::make($request->all(), [
            'gender' => 'required|string|in:male,female',
            'birth_date' => 'required|date',
            'bio' => 'required|string',
            'description' => 'required|string',
            'profile_img' => 'required|string',
            'day_price' => 'required|numeric',
            'phone' => ['required', 'regex:/^\+?\d{7,14}$/', Rule::unique('tourguides')->ignore($tourguide)],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        try {
            if (Gate::allows('is-tourguide')) {
                $user = auth()->user();
                if ($tourguide->id === $user->id) {

                    $tourguide->update($request->all());

                }
            } else {
                return response()->json(['message' => 'You are not allowed to update this tourguide.'], 403);
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => 'An error occurred while updating the tourguide'], 500);
        }

        return response()->json(['message' => 'Tourguide updated successfully', 'data' => new TourguideDataResource($tourguide)], 200);
    }

    public function destroy(Tourguide $tourguide)
    {
        try {
            if (Gate::allows('is-admin')) {
                $user = auth()->user();
                if ($tourguide->id === $user->id) {

                    $tourguide->delete();
                    return response()->json([
                        'message' => 'Tourguide deleted successfully.'
                    ], 200);
                } 
            } else {
                return response()->json(['message' => 'You are not allowed to delete this tourguide.'], 403);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => 'An error occurred while deleting the tourguide'], 500);
        }
    }
}

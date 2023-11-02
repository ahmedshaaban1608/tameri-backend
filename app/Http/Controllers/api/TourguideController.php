<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TourguideDataResource;
use App\Http\Resources\TourguideResource;
use App\Models\Tourguide;
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
        //
        try {
            $tourguide = TourguideResource::collection(Tourguide::all());
            return response()->json(['data' => $tourguide], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'An error occurred while retrieving the data.'], 500);
        }


    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric|unique:tourguides',
            'gender' => 'required|string|in:male,female',
            'birth_date' => 'required|date',
            'bio' => 'required|string',
            'description' => 'required|string',
            'profile_img' => 'required|string',
            'day_price' => 'required|numeric',
            'phone' => 'required|unique:tourguides|regex:/^\+?\d{7,14}$/',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        try {
            $tourguide = Tourguide::create($request->all());
        } catch (\Exception $exception) {

            return response()->json(['error' => 'An error occurred while storing the tourguide'], 500);
        }

        return response()->json(['message' => 'Tourguide created successfully', 'tourguide' => new TourguideDataResource($tourguide)], 201);
    }

    public function show(Tourguide $tourguide)
    {
        //
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
            if (Gate::allows('action-by-tourguide', $tourguide)) {

                $tourguide->update($request->all());

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
            if (Gate::allows('action-by-tourguide', $tourguide)) {

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

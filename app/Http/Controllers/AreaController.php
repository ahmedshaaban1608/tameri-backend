<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAreaRequest;
use App\Http\Requests\UpdateAreaRequest;
class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {

            $areas = AreaResource::collection(Area::all());
            return response()->json(['data' => $areas], 200);
        } catch (\Exception $e) {
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
        //
        {
            $validator = Validator::make($request->all(), [
                'area' => 'required|string',
                // 'tourguide_id' => 'required|numeric',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            try {
                if (Gate::allows('is-tourguide')) {
                    $user = auth()->user();
                    // $tourguide = Tourguide::findOrFail($request->tourguide_id);
                    $request->merge(['tourguide_id' => $user->id]);
                    // if (!$tourguide) {
                    //     return response()->json(['message' => 'Tourguide Id not found'], 404);
                    // }
                    $area = Area::create($request->all());
                    return response()->json(['message' => 'Area created successfully', 'data' => new AreaResource($area)], 201);
                } else {
                    return response()->json(['message' => 'Only tourguides are allowed to create area.'], 403);
                }

            } catch (\Exception $e) {
                return response()->json(['message' => 'An error occurred while creating the area.'], 500);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Area $area)
    {
        //
        {
            try {
                return response()->json(new AreaResource($area), 200);
            } catch (\Exception $e) {
                return response()->json(['message' => 'An error occurred while retrieving the area.'], 500);
            }
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Area $area)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAreaRequest $request, Area $area)
    {
        //
        {



            $validator = Validator::make($request->all(), [
                'area' => 'required|string',
                // 'tourguide_id' => 'required|numeric',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            try {
                if (Gate::allows('is-tourguide')) {
                    $user = auth()->user();
                    if ($language->tourguide_id === $user->id) {
                        // $tourguide = Tourguide::findOrFail($request->tourguide_id);
                        // if (!$tourguide) {
                        //     return response()->json(['message' => 'Tourguide Id not found'], 404);
                        // }
                        $area->update($request->all());
                        return response()->json(['message' => 'Area updated successfully', 'data' => new AreaResource($area)], 200);
                    } else {
                        return response()->json(['message' => 'You are not allowed to update this area.'], 403);
                    }
                } else {
                    return response()->json(['message' => 'You are not allowed to update this area.'], 403);
                }
            } catch (\Exception $e) {
                return response()->json(['message' => 'An error occurred while updating the area.'], 500);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Area $area)
    {
        //
        try {
            if (Gate::allows('is-tourguide')) {
                $user = auth()->user();
                if ($language->tourguide_id === $user->id) {
                    $area->delete();
                    return response()->json(['message' => 'Area deleted successfully'], 200);
                } else {
                    return response()->json(['message' => 'You are not allowed to delete this area.'], 403);
                }
            } else {
                return response()->json(['message' => 'You are not allowed to delete this area.'], 403);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while deleting the area.'], 500);
        }
    }
}

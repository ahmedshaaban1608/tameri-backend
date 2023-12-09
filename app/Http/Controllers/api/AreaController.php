<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAreaRequest;
use App\Http\Requests\UpdateAreaRequest;
use App\Http\Resources\AreaResource;
use App\Http\Resources\TourguideDataResource;
use App\Models\Area;
use App\Models\Tourguide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class AreaController extends Controller
{
    function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    public function index()
    {
        try {
            $areas = AreaResource::collection(Area::all());
            return response()->json(['data' => $areas], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while retrieving the data.'], 500);
        }

    }
    public function store(StoreAreaRequest $request, )
    {
        try {
            if (Gate::allows('is-tourguide')) {
                $user = auth()->user();
                $request->merge(['tourguide_id' => $user->id]);

                $area = Area::create($request->all());
                $tourguide = Tourguide::findOrFail($user->id);
                return response()->json(new TourguideDataResource($tourguide), 200);
            } else {
                return response()->json(['message' => 'Only tourguides are allowed to create area.'], 403);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while creating the area.'], 500);
        }
    }
    public function show(Area $area)
    {
        try {
            return response()->json(new AreaResource($area), 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while retrieving the area.'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAreaRequest $request, Area $area)
    {
        try {
            if (Gate::allows('is-tourguide')) {
                $user = auth()->user();
                if ($area->tourguide_id === $user->id) {

                    $area->update($request->all());
                    return response()->json(['message' => 'Area updated successfully', 'data' => new AreaResource($area)], 200);
                }
            } else {
                return response()->json(['message' => 'You are not allowed to update this area.'], 403);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while updating the area.'], 500);
        }
    }

    public function destroy(Area $area)
    {
        try {
            if (Gate::allows('is-tourguide')) {
                $user = auth()->user();
                if ($area->tourguide_id === $user->id) {
                    $area->delete();

                    $tourguide = Tourguide::findOrFail($user->id);
                    return response()->json(new TourguideDataResource($tourguide), 200);
                }
            } else {
                return response()->json(['message' => 'You are not allowed to delete this area.'], 403);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while deleting the area.'], 500);
        }
    }

}

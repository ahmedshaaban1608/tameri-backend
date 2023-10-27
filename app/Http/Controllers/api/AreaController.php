<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Tourguide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
           //
           try {
            $areas = Area::all();
            return response( ['data'=>$areas], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while retrieving the data.'], 500);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
            $validator = Validator::make($request->all(), [
                'area' => 'required|string',
                'tourguide_id' => 'required|numeric',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            try {
            $tourguide = Tourguide::findOrFail($request->tourguide_id);
            if (!$tourguide) {
                return response()->json(['message' => 'Tourguide Id not found'], 404);
            }

            $area = Area::create($request->all());

            return response()->json(['message' => 'Area created successfully', 'data' => $area], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while creating the area.'], 500);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(Area $area)
    {
        try {
            return response()->json(['data' => $area], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while retrieving the area.'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Area $area)
    {
        
            $validator = Validator::make($request->all(), [
                'area' => 'required|string',
                'tourguide_id' => 'required|numeric',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            try {
            $tourguide = Tourguide::findOrFail($request->tourguide_id);
            if (!$tourguide) {
                return response()->json(['message' => 'Tourguide Id not found'], 404);
            }

            $area->update($request->all());

            return response()->json(['message' => 'Area updated successfully', 'data' => $area], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while updating the area.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Area $area)
    {
        try {
            $area->delete();
            return response()->json(['message' => 'Area deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while deleting the area.'], 500);
        }
    }

}

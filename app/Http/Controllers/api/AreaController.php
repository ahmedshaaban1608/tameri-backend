<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $areas = Area::all();
            return response()->json($areas, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred.'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'area' => 'required|string',
                'tourguide_id' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $area = Area::create($request->all());

            return response()->json(['message' => 'Area created successfully', 'area' => $area], 201);
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
            return response()->json(['area' => $area], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while retrieving the area.'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Area $area)
    {
        try {
            $validator = Validator::make($request->all(), [
                'area' => 'required|string',
                'tourguide_id' => 'required|numeric',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $area->update($request->all());

            return response()->json(['message' => 'Area updated successfully', 'area' => $area], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while updating the area.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {
        $area = Area::find($id);
        if (!$area) {
            return response()->json(['message' => 'Area not found'], 404);
        }
        try {
            $area->delete();
            return response()->json(['message' => 'Area deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while deleting the area.'], 500);
        }
    }

}

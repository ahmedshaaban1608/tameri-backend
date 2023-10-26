<?php

namespace App\Http\Controllers\api;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Tourist;
use Illuminate\Http\Request;

class TouristController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $tourists = Tourist::all();

        return response()->json([
            'data' => $tourists,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required|unique:tourists',
            'country' => 'required',
            'gender' => 'required',
            'phone' => 'required|unique:tourists',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ]);
        }

        $tourist = Tourist::create($request->all());

        return response()->json(['data' => $tourist]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tourist $tourist)
    {

        // Return the tourist
        return response()->json([
            'data' => $tourist,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tourist $tourist)
    {

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'country' => 'required',
            'gender' => 'required',
            'phone' => 'required|unique:tourists,' . $tourist->id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ]);
        }

        // Update the tourist
        $tourist->update([
            'country' => $request->country,
            'gender' => $request->gender,
            'phone' => $request->phone,
        ]);

        // Return the tourist
        return response()->json([
            'data' => $tourist,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tourist $tourist)
    {
        // Delete the tourist
        $tourist->delete();

        // Return a success message
        return response()->json([
            'message' => 'Tourist deleted successfully.',
        ]);
    }
}

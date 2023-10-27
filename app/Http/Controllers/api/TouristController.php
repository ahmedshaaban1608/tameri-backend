<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use  Illuminate\Validation\Rule;
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

        try {
            $tourists = Tourist::all();
        return response()->json(['data' => $tourists],200);
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
            'id' => 'required|unique:tourists|numeric',
            'country' => 'required|string',
            'gender' => 'required|string|in:male,female',
            'phone' => 'required|unique:tourists|regex:/^\+?\d{7,14}$/',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ]);
        }

        try {
            $user = User::findOrFail($request->id);
            if($user['type']!=='tourist'){
                return response()->json(['message' => 'user is not a tourist.'], 403);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => 'not valid user id.'], 403);
        }
      try {
        $tourist = Tourist::create($request->all());

        return response()->json(['data' => $tourist], 200);
      } catch (\Throwable $th) {
        return response()->json(['message' => 'An error occurred while creating the tourist'], 500);
      }
    }

    /**
     * Display the specified resource.
     */
    public function show(Tourist $tourist)
    {

        // Return the tourist
        return response()->json(['data' => $tourist],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tourist $tourist)
    {

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'country' => 'required|string',
            'gender' => 'required|string|in:male,female',
            'phone' => ['required','regex:/^\+?\d{7,14}$/',Rule::unique('tourists')->ignore($tourist)],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ]);
        }

    try {
           // Update the tourist
           $tourist->update($request->all());

           // Return the tourist
           return response()->json(['data' => $tourist],200);
    } catch (\Throwable $th) {
        return response()->json(['message' => 'An error occurred while updating the tourist'], 500);
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tourist $tourist)
    {
        try {
            // Delete the tourist
        $tourist->delete();

        // Return a success message
        return response()->json([
            'message' => 'Tourist deleted successfully.'],200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'An error occurred while deleting the tourist'], 500);
        }
    }
}

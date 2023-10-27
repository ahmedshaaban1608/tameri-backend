<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Tourguide;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use  Illuminate\Validation\Rule;
class TourguideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {
        $tourguide = Tourguide::all();
        return response()->json(['data' => $tourguide],200);
        }catch (\Throwable $th) {
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
        } catch (QueryException $exception) {
            if ($exception->errorInfo[1] === 1062) {
                return response()->json(['error' => 'Duplicate entry for primary key'], 409);
            }
            return response()->json(['error' => 'An error occurred while storing the tour guide'], 500);
        }
    
        return response()->json(['message' => 'Tourguide created successfully', 'tourguide' => $tourguide], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(Tourguide $tourguide)
    {
        //
        return response()->json(['data' => $tourguide],200);
     
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
            'phone' => ['required','regex:/^\+?\d{7,14}$/',Rule::unique('tourguides')->ignore($tourguide)],
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
    
        try {
            $tourguide->update($request->all());
        } catch (QueryException $exception) {
            if ($exception->errorInfo[1] === 1062) {
                return response()->json(['error' => 'Duplicate entry for primary key'], 409);
            }
            return response()->json(['error' => 'An error occurred while updating the tour guide'], 500);
        }
    
        return response()->json(['message' => 'Tourguide updated successfully', 'tourguide' => $tourguide], 200);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tourguide $tourguide)
    {
        try{
        //
        $tourguide->delete();
        //return "Dealeted Succssfully";
        return response()->json([
            'message' => 'Tourguide deleted successfully.'],200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'An error occurred while deleting the tourguide'], 500);
}
    }
}



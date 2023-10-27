<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Tourguide;
use App\Models\Language;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TourguideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $tourguide = Tourguide::all();
        return $tourguide;
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
            'bio' => 'required',
            'description' => 'required',
            'profile_img' => 'required',
            'day_price' => 'required|numeric',
            'phone' => 'required|unique:tourists|regex:/^\+?\d{7,14}$/',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
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
            $tourguide = Tourguide::create($request->all());
        } catch (\Throwable $th) {
            return response()->json(['error' => 'An error occurred while storing the tour guide'], 500);        }
            
        return response()->json(['message' => 'Tourguide created successfully', 'tourguide' => $tourguide], 201);
    }
    



    /**
     * Display the specified resource.
     */
    public function show(Tourguide $tourguide)
    {
        //
        return $tourguide;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tourguide $tourguide)
    {
        $validator = Validator::make($request->all(), [
            'gender' => 'required|string|in:male,female',
            'birth_date' => 'required|date',
            'bio' => 'required',
            'description' => 'required',
            'profile_img' => 'required',
            'day_price' => 'required|numeric',
            'phone' => 'required|unique:tourists|regex:/^\+?\d{7,14}$/',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
    
        try {
            $tourguide->update($request->all());
        } catch (\Throwable $th) {
            return response()->json(['error' => 'An error occurred while updating the tour guide'], 500);
        }
        
        return response()->json(['message' => 'Tourguide updated successfully', 'tourguide' => $tourguide], 200);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tourguide $tourguide)
    {
        //
       try {
        $tourguide->delete();
        return "Dealeted Succssfully";
       } catch (\Throwable $th) {
        return response()->json(['message' => 'An error occurred while deleting the tourguide'], 500);
       }
    }
}

<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Tourguide;
use App\Models\Language;
use Illuminate\Http\Request;
use  Illuminate\Support\Facades\Validator;

class TourguideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $tourguide  = Tourguide::all();
        return $tourguide;
    }




    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required', 
            'gender' => 'required',
            'birth_date' => 'required|date',
            'bio' => 'required',
            'description' => 'required',
            'profile_img' => 'required',
            'day_price' => 'required',
            'phone' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
    
        $tourguide = Tourguide::create($request->all());
    
        return $tourguide;
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
        //
        $validator = Validator::make($request->all(), [
           
            'gender' => 'required',
            'birth_date' => 'required|date',
            'bio' => 'required',
            'description' => 'required',
            'profile_img'=>'required',
            'day_price'=>'required',
            'phone'=>'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $tourguide->update($request->all());
        return $tourguide;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tourguide $tourguide)
    {
        //
        $tourguide->delete();
        return "Dealeted Succssfully";
    }
}

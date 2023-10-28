<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LanguageResource;
use App\Models\Language;
use App\Models\Tourguide;
use Illuminate\Http\Request;
use  Illuminate\Support\Facades\Validator;


class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        
        try {
            $languages  = LanguageResource::collection(Language::all());
            return response()->json(['data'=>$languages], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while retrieving the data.'], 500);
        }


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
            $vaidator = Validator::make($request->all(),
        [
            "tourguide_id"=>"required|numeric",
            "language"=>"required"]);
        if($vaidator -> fails()){
        return response( $vaidator->errors()->all(), 422);
    }
    try {
        $tourguide = Tourguide::findOrFail($request->tourguide_id);


    } catch (\Throwable $th) {
        return "not valid tourguide id";
    }
    $language = Language::create($request->all());
    return response()->json(['message' => 'Language created successfully', 'data' => new LanguageResource($language)], 201);

        }

    /**
     * Display the specified resource.
     */
    public function show(Language $language)
    {
        
        try {
            return response()->json(new LanguageResource($language), 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while retrieving the data.'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Language $language)
    {
        $validator = Validator::make($request->all(), [
            'tourguide_id' => 'required|numeric',
            'language' => 'required'
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        try {
            $tourguide = Tourguide::findOrFail($request->tourguide_id);
    
            $language->update($request->all());
        
            return response()->json(['message' => 'Language updated successfully', 'data' => new LanguageResource($language)], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'An error occurred while updating the language'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Language $language)
    {
        //

        try {
            $language->delete();
            return response()->json("Dealeted Succssfully", 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'An error occurred while deleting the language.'], 500);
        }

    }
}

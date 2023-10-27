<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
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
        //
        $languages  = Language::all();
        return $languages;


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
 return response()->json(['message' => 'Language created successfully', 'language' => $language], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Language $language)
    {
        //
        return $language;
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
    
        $tourguide = Tourguide::findOrFail($request->tourguide_id);
    
        $language->update($request->all());
    
        return response()->json(['message' => 'Language updated successfully', 'language' => $language], 200);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Language $language)
    {
        //

        try {
            $language->delete();
            return response("Dealeted Succssfully", 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'An error occurred while deleting the language.'], 500);
        }
        
    }
}

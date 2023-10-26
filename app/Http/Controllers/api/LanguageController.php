<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Language;
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
        "tourguide_id"=>"required",
         "image"=>"required"]);
       if($vaidator -> fails()){
       return response( $vaidator->errors()->all(), 422);
}
        $language = Language::create($request -> all());
        return $language;

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
        $vaidator = Validator::make($request->all(),
        [
      "tourguide_id"=>"required",
      "image"=>"required"]);
      if($vaidator -> fails()){
      return response( $vaidator->errors()->all(), 422);
}
        $language->update($request->all());
        return $language;
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Language $language)
    {
        //

        $language->delete();
        return "Dealeted Succssfully";
    }
}

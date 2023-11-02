<?php

namespace App\Http\Controllers;

use App\Http\Resources\LanguageResource;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAreaRequest;
use App\Http\Requests\UpdateAreaRequest;
use Illuminate\Support\Facades\Gate;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */ 
    function __construct(){
        $this->middleware('auth');
    }
    public function index()
    {
        //
        try {
            $languages = LanguageResource::collection(Language::all());
            return response()->json(['data' => $languages], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while retrieving the data.'], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAreaRequest $request)
    {
       
            // try {
            //     if (Gate::allows('is-admin')) {
            //         $language = Language::create($request->all());
            //         return response()->json(['message' => 'Language created successfully', 'data' => new LanguageResource($language)], 201);
            //     } else {
            //         return response()->json(['message' => 'Only admins are allowed to create languages.'], 403);
            //     }
            // } catch (\Exception $e) {
            //     return response()->json(['message' => 'An error occurred while creating the language.'], 500);

            // }
    }

    /**
     * Display the specified resource.
     */
    public function show(Language $language)
    {
        //
        try {
            return response()->json(new LanguageResource($language), 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while retrieving the data.'], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Language $language)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAreaRequest $request, Language $language)
    {
       
            try {
                if (Gate::allows('is-admin')) {
             
                        $language->update($request->all());
                        return response()->json(['message' => 'Language updated successfully', 'data' => new LanguageResource($language)], 200);
                    } else {
                        return response()->json(['message' => 'You are not allowed to update this languages.'], 403);
                    }
            } catch (\Exception $e) {
                return response()->json(['message' => 'An error occurred while updating the language.'], 500);
            }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Language $language)
    { {
        try {
            if (Gate::allows('is-admin')) {

                    $language->delete();
                    return response()->json("Deleted Succssfully", 200);
                } else {
                    return response()->json(['message' => 'You are not allowed to delete this language.'], 403);
                }


        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while deleteing the language.'], 500);
        }

    }
        //
    }
}

<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use App\Http\Resources\LanguageResource;
use App\Http\Resources\TourguideDataResource;
use App\Models\Language;
use App\Models\Tourguide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;


class LanguageController extends Controller
{
    function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    public function index()
    {
        try {
            $languages = LanguageResource::collection(Language::all());
            return response()->json(['data' => $languages], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while retrieving the data.'], 500);
        }
    }

    public function store(StoreLanguageRequest $request)
    {
       
        try {
            if (Gate::allows('is-tourguide')) {
                $user = auth()->user();
                $request->merge(['tourguide_id' => $user->id]);
                $language = Language::create($request->all());
                $tourguide = Tourguide::findOrFail($user->id);
                return response()->json(new TourguideDataResource($tourguide), 200);
            } else {
                return response()->json(['message' => 'Only tourguides are allowed to create languages.'], 403);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while creating the language.'], 500);
        }

    }
    public function show(Language $language)
    {
        try {
            return response()->json(new LanguageResource($language), 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while retrieving the data.'], 500);
        }
    }

    public function update(UpdateLanguageRequest $request, Language $language)
    {
       try {
            if (Gate::allows('is-tourguide')) {
                $user = auth()->user();
                if ($language->tourguide_id === $user->id) {
                    $language->update($request->all());
                    return response()->json(['message' => 'Language updated successfully', 'data' => new LanguageResource($language)], 200);
                } 
            } else {
                return response()->json(['message' => 'You are not allowed to update this languages.'], 403);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while updating the language.'], 500);
        }
    }

    public function destroy(Language $language)
    {
        try {
            if (Gate::allows('is-tourguide')) {
                $user = auth()->user();
                if ($language->tourguide_id === $user->id) {
                    $language->delete();
                    $tourguide = Tourguide::findOrFail($user->id);
                    return response()->json(new TourguideDataResource($tourguide), 200);
                } 
            } else {
                return response()->json(['message' => 'You are not allowed to delete this language.'], 403);
            }

        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while deleteing the language.'], 500);
        }

    }
}

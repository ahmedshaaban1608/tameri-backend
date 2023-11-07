<?php

namespace App\Http\Controllers;

use App\Http\Resources\LanguageResource;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use Illuminate\Support\Facades\Gate;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct(){
        $this->middleware(['auth','isadmin']);

    }
    public function index()
    {
        //

        try {

            $languages = LanguageResource::collection(Language::paginate(20));
            return view('Language.index', ['data' => $languages]);
        } catch (\Exception $e) {
            return abort(500, 'An error occurred while retrieving the data.');
    }


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('Language.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLanguageRequest $request)
    {

        try {
            if (Gate::allows('is-admin')) {
                $language = Language::create($request->all());
                return to_route('Language.index');
            } else {
                return abort(403, 'You are not allowed to create language.');

            }

        } catch (\Exception $e) {
            return abort(500, 'An error occurred while creating the language.');

        }
           
    }

    /**
     * Display the specified resource.
     */
    public function show(Language $language)
    {
        //
        try {
            return view('Language.show', ['data' => new LanguageResource($language)]);
        } catch (\Exception $e) {
            return abort(500, 'An error occurred while retrieving the data.');
        }


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Language $language)
    {
        //
        try {
            if (Gate::allows('is-admin')) {
                return view('Language.edit', ['data'=> $language]);
            } else{
                return abort(403, 'You are not allowed to edit this language.');
            }
        } catch (\Throwable $th) {
            return abort(500, 'An error occurred while retrieving the data.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLanguageRequest $request, Language $language)
    {

        try {
            if (Gate::allows('is-admin')) {
                    $language->update($request->all());
                    return to_route('Language.index');

            } else {
                return abort(403, 'You are not allowed to update language.');

            }
        } catch (\Exception $e) {
            return abort(500, 'An error occurred while updating the language.');

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
                    return to_route('Language.index');
            } else {
                return abort(403, 'You are not allowed to delete language.');
            }
        } catch (\Exception $e) {
            return abort(500, 'An error occurred while deleting the language.');

        }
    

    }
        //
    }
}

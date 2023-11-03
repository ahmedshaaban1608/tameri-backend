<?php

namespace App\Http\Controllers;

use App\Http\Resources\TouristDataResource;
use App\Http\Resources\TouristResource;
use App\Models\Tourist;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTouristRequest;
use App\Http\Requests\UpdateTouristRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TouristController extends Controller
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

            $tourists = TouristResource::collection(Tourist::all());
            return view('Tourist.index', ['data' => $tourists]);
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
        return view('Tourist.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTouristRequest $request)
    {
        try {
            if (Gate::allows('is-admin')) {
                $tourist = Tourist::create($request->all());
                return to_route('Tourist.index');
            } else {
                return abort(403, 'You are not allowed to create tourist.');

            }

        } catch (\Exception $e) {
            return abort(500, 'An error occurred while creating the tourist.');

        }

        // $data = $request->all();


        // try {
        //     $user = User::create([
        //         'type' => 'tourist',
        //         'name' => $data['name'],
        //         'email' => $data['email'],
        //         'password' => $data['password']
        //     ]);
        //     $data['id'] = $user->id;
        //     $tourist = Tourist::create($data);
        //     return response()->json(['data' => new TouristDataResource($tourist)], 200);
        // } catch (\Throwable $th) {
        //     return response()->json(['message' => 'An error occurred while creating the tourist', 'error' => $th], 500);
        // }
    }

    /**
     * Display the specified resource.
     */
    // public function show(Tourist $tourist)
    // {
    //     //
    // }
    public function show(Tourist $tourist)
    {

        try {
            return view('Tourist.show', ['data' => new TouristResource($tourist)]);
        } catch (\Exception $e) {
            return abort(500, 'An error occurred while retrieving the data.');
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tourist $tourist)
    {
        //
        try {
            if (Gate::allows('is-admin')) {
                return view('Tourist.edit', ['data'=> $tourist]);
            } else{
                return abort(403, 'You are not allowed to edit this tourist.');
            }
        } catch (\Throwable $th) {
            return abort(500, 'An error occurred while retrieving the data.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTouristRequest $request, Tourist $tourist)
    {
        try {
            if (Gate::allows('is-admin')) {
                    $tourist->update($request->all());
                    return to_route('Tourist.index');

            } else {
                return abort(403, 'You are not allowed to update tourist.');

            }
        } catch (\Exception $e) {
            return abort(500, 'An error occurred while updating the tourist.');

        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tourist $tourist)
    {
        //
        try {
            if (Gate::allows('is-admin')) {

                    $tourist->delete();
                    return to_route('Tourist.index');
            } else {
                return abort(403, 'You are not allowed to delete tourist.');
            }
        } catch (\Exception $e) {
            return abort(500, 'An error occurred while deleting the tourist.');

        }


    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Resources\TouristResource;
use App\Models\Tourist;
use App\Models\User;
use App\Http\Requests\StoreTouristRequest;
use App\Http\Requests\UpdateTouristRequest;
use Illuminate\Support\Facades\Gate;


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

            $tourists = TouristResource::collection(Tourist::paginate(20));
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
                $data = $request->all();
                $user = User::create([
                    'type' => 'tourist',
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => $data['password']
                ]);
                $data['id'] = $user->id;
                $tourist = Tourist::create($data);
                return to_route('Tourist.index');
            } else {
                return abort(403, 'You are not allowed to create tourist.');

            }

        } catch (\Exception $e) {
            return abort(500, 'An error occurred while creating the tourist.');

        }

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

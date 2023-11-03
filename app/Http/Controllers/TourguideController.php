<?php

namespace App\Http\Controllers;

use App\Http\Resources\TourguideDataResource;
use App\Http\Resources\TourguideResource;
use App\Models\Tourguide;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTourguideRequest;
use App\Http\Requests\UpdateTourguideRequest;
use Illuminate\Support\Facades\Gate;

class TourguideController extends Controller
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

            $tourguide = TourguideResource::collection(Tourguide::paginate(20));
            return view('Tourguide.index', ['data' => $tourguide]);
        } catch (\Exception $e) {
            return abort(500, 'An error occurred while retrieving the data.');
    }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Tourguide.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTourguideRequest $request)
    {
        try {
            if (Gate::allows('is-admin')) {
                $data = $request->all();
                $user = User::create([
                    'type' => 'tourguide',
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => $data['password']
                ]);
                $data['id'] = $user->id;
                $tourist = Tourguide::create($data);
                return to_route('Tourguide.index');
            } else {
                return abort(403, 'You are not allowed to create tourguide.');

            }

        } catch (\Exception $e) {
            return abort(500, 'An error occurred while creating the tourguide.');

        }
    }

    /**
     * Display the specified resource.
     */
    // public function show(Tourguide $tourguide)
    // {
    //     //
    // }
    public function show(Tourguide $tourguide)
    {
        try {
            return view('Tourguide.show', ['data' => new TourguideDataResource($tourguide)]);
        } catch (\Exception $e) {
            return abort(500, 'An error occurred while retrieving the data.');
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tourguide $tourguide)
    {
        //
        try {
            if (Gate::allows('is-admin')) {
                return view('Tourguide.edit', ['data'=> $tourguide]);
            } else{
                return abort(403, 'You are not allowed to edit this tourguide.');
            }
        } catch (\Throwable $th) {
            return abort(500, 'An error occurred while retrieving the data.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTourguideRequest $request, Tourguide $tourguide)
    {

        try {
            if (Gate::allows('is-admin')) {
                    $tourguide->update($request->all());
                    return to_route('Tourguide.index');

            } else {
                return abort(403, 'You are not allowed to update tourguide.');

            }
        } catch (\Exception $e) {
            return abort(500, 'An error occurred while updating the tourguide.');

        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tourguide $tourguide)
    {
        //
        try {
            if (Gate::allows('is-admin')) {

                    $tourguide->delete();
                    return to_route('Tourguide.index');
            } else {
                return abort(403, 'You are not allowed to delete tourguide.');
            }
        } catch (\Exception $e) {
            return abort(500, 'An error occurred while deleting the tourguide.');

        }
    }
}

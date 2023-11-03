<?php

namespace App\Http\Controllers;

use App\Http\Resources\AreaResource;
use App\Models\Area;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAreaRequest;
use App\Http\Requests\UpdateAreaRequest;
use Illuminate\Support\Facades\Gate;
class AreaController extends Controller
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

            $areas = AreaResource::collection(Area::all());

        } catch (\Exception $e) {return view('Area.index', ['data' => $areas]);
            return abort(500, 'An error occurred while retrieving the data.');
    }
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Area.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAreaRequest $request)
    {

            try {
                if (Gate::allows('is-admin')) {
                    $area = Area::create($request->all());
                    return to_route('Area.index');
                } else {
                    return abort(403, 'You are not allowed to create area.');

                }

            } catch (\Exception $e) {
                return abort(500, 'An error occurred while creating the area.');

            }

    }

    /**
     * Display the specified resource.
     */
    public function show(Area $area)
    {
            try {
                return view('Area.show', ['data' => new AreaResource($area)]);
            } catch (\Exception $e) {
                return abort(500, 'An error occurred while retrieving the data.');
            }
        }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Area $area)
    {
    try {
        if (Gate::allows('is-admin')) {
            return view('Area.edit', ['data'=> $area]);
        } else{
            return abort(403, 'You are not allowed to edit this area.');
        }
    } catch (\Throwable $th) {
        return abort(500, 'An error occurred while retrieving the data.');
    }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAreaRequest $request, Area $area)
    {

            try {
                if (Gate::allows('is-admin')) {
                        $area->update($request->all());
                        return to_route('Area.index');

                } else {
                    return abort(403, 'You are not allowed to update area.');

                }
            } catch (\Exception $e) {
                return abort(500, 'An error occurred while updating the area.');

            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Area $area)
    {
        //
        try {
            if (Gate::allows('is-admin')) {

                    $area->delete();
                    return to_route('Area.index');
            } else {
                return abort(403, 'You are not allowed to delete area.');
            }
        } catch (\Exception $e) {
            return abort(500, 'An error occurred while deleting the area.');

        }
    }
}

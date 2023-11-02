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
            return response()->json(['data' => $areas], 200);
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
            //         $area = Area::create($request->all());
            //         return response()->json(['message' => 'Area created successfully', 'data' => new AreaResource($area)], 201);
            //     } else {
            //         return response()->json(['message' => 'Only tourguides are allowed to create area.'], 403);
            //     }

            // } catch (\Exception $e) {
            //     return response()->json(['message' => 'An error occurred while creating the area.'], 500);
            // }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Area $area)
    {
        //
        {
            try {
                return response()->json(new AreaResource($area), 200);
            } catch (\Exception $e) {
                return response()->json(['message' => 'An error occurred while retrieving the area.'], 500);
            }
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Area $area)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAreaRequest $request, Area $area)
    {
        
            try {
                if (Gate::allows('is-admin')) {
                        $area->update($request->all());
                        return response()->json(['message' => 'Area updated successfully', 'data' => new AreaResource($area)], 200);
                  
                } else {
                    return response()->json(['message' => 'You are not allowed to update this area.'], 403);
                }
            } catch (\Exception $e) {
                return response()->json(['message' => 'An error occurred while updating the area.'], 500);
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
                    return response()->json(['message' => 'Area deleted successfully'], 200);
            } else {
                return response()->json(['message' => 'You are not allowed to delete this area.'], 403);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while deleting the area.'], 500);
        }
    }
}

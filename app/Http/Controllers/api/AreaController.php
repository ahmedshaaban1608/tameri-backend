<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $area = Area::all();
        return $area;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'area' => 'required',
            'tourguide_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response($validator->errors()->all(), 422);
        }
        $area = Area::create($request->all());
        return $area;
    }

    /**
     * Display the specified resource.
     */
    public function show(Area $area)
    {
        return $area;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Area $area)
    {
        $validator = Validator::make($request->all(), [
            'area' => 'required',
            'tourguide_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response($validator->errors()->all(), 422);
        }
        $area->update($request->all());
        return $area;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Area $area)
    {
        $area->delete();
        return "deleted";
    }
}

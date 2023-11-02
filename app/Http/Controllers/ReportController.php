<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReportResource;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAreaRequest;
use App\Http\Requests\UpdateAreaRequest;
use Illuminate\Support\Facades\Gate;

class ReportController extends Controller
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
            $report = ReportResource::collection(Report::all());
            return response()->json(['data' => $report], 200);
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
        //         $report = Report::create($request->all());
        //         return response()->json(['message' => 'Report created successfully', 'data' => new ReportResource($report)], 200);
        //     }
           
        // } catch (\Exception $e) {
        //     return response()->json(['message' => 'An error occurred while creating the report'], 500);
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        try {
            return response()->json(new ReportResource($report), 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while retrieving the data.'], 500);



        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAreaRequest $request, Report $report)
    {
        try {
            if (Gate::allows('is-admin')) {
                $report->update($request->all());
                return response()->json(['message' => 'Report updated successfully', 'data' => new ReportResource($report)], 200);
            } else {
                return response()->json(['message' => 'You are not allowed to update this report.'], 403);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while updating the report'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        try {
            if (Gate::allows('is-admin')) {

                $report->delete();
                return response()->json("deleted successfully", 200);
            } else {
                return response()->json(['message' => 'Only admins are allowed to delete reports.'], 403);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while deleting the report'], 500);
        }

    }
}
